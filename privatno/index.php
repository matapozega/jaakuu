<?php
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../logout.php");
}
$uvjet="";
		if(isset($_GET["uvjet"])){
			$uvjet="%" . $_GET["uvjet"] . "%";
		}else{
			$uvjet="%";
		}
		

	$poStranici=6;
	
	$izraz = $veza -> prepare("
		select count(a.sifra) from ponuda a inner join video b on a.video=b.sifra inner join tipponude c on a.tipponude=c.sifra
		where concat(a.trajeod,a.trajedo,b.naziv,c.naziv) like :uvjet;");
	$izraz -> execute(array("uvjet"=>$uvjet));
	$ukupno = $izraz->fetchColumn();
	
	$ukupnoStranica=ceil($ukupno/$poStranici);
	
	if(isset($_GET["stranica"])){
		$stranica=$_GET["stranica"];
	}else{
		$stranica=1;
	}
	
	if($stranica>$ukupnoStranica){
		$stranica=1;
	}
	
	if($stranica==0){
		$stranica=$ukupnoStranica;
	}
	
	
	$odKuda = $stranica*$poStranici-$poStranici;
	
		

		
		
 ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once '../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../predlozak/topbar.php';
		?>
		
		<div class="expanded row">
			<!-- Početal liste tipova -->
			<div class="large-2 columns"> 
				<ul class="tabs vertical" style="margin-top: 40px;" id="example-vert-tabs" data-tabs>
      
    
			<?php 
			
				$izraz = $veza -> prepare("select naziv from tipponude");
				$izraz -> execute();
				$tip = $izraz -> fetchALL(PDO::FETCH_OBJ);
				foreach ($tip as $red) {
					echo '<li class="tabs-title"><a href="#">' . $red->naziv . '</a></li>';
				}
			
			 ?>		
			 </ul>
			</div>
			
			
			<!-- Početak liste videa -->
			<div class="large-8 columns">
			<div class="row expanded">
			
		<?php 	
		
		
				$izraz=$veza->prepare("select b.sifra, a.videoid, a.sifra as vid, a.naziv as ime, a.pregleda, a.likes, a.dislikes, a.datum,
										b.trajeod, b.trajedo, b.vise, b.manje,
										c.sifra as tip,c.naziv, c.opis
										from video a inner join ponuda b on a.sifra=b.video
										inner join tipponude c on c.sifra=b.tipponude
										where concat(a.videoid,a.naziv,b.trajeod,b.trajedo,c.naziv)
										 like :uvjet order by c.naziv desc limit :odKuda,:poStranici
							");
							$izraz->execute(array("uvjet"=>$uvjet, "odKuda"=>$odKuda,"poStranici"=>$poStranici));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka) {					
				include '../predlozak/ponudalista.php';
			};
		 ?>
		 		
					</div>
				</div>
				<div class="large-2 columns expanded"> Ticket 
					<ol id="ponude">
						
		<?php 	
		
		
				$izraz=$veza->prepare("select  d.naziv as ime,e.naziv as tip from
				listic a inner join	listic_ponuda b on a.sifra=b.listic
				inner join ponuda c on b.ponuda=c.sifra
				inner join video d on c.video=d.sifra
				inner join tipponude e on e.sifra=c.tipponude
				where a.korisnik=:korisnik and a.status=0;
							");
							$izraz->execute(array("korisnik"=>$_SESSION[$sid . "autoriziran"]->sifra));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka):					
				?>
				
				<li><?php echo $stavka->ime ?> | <?php echo $stavka->tip ?></li>
				<?php
				endforeach;
	 			?>
					</ol>
					
					</div>
			</div>
				
			
					  <div class="column row">
					    <ul class="pagination" role="navigation" aria-label="Pagination" data-page="6" data total="16">
					      <li><a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&<?php echo "stranica=" . ($stranica-1) ?>" >« <span class="show-for-sr">Previous page</span></a></li> 
					      <?php
					      
					      for($i=1;$i<=$ukupnoStranica;$i++):
							if($i==$stranica):
					      
					      ?>
					      <li><a class="current" href="#" aria-label="Page 1"> <?php echo $i ?></a></li>
					      <?php else: ?>
					      	<li><a  aria-label="Page 1" href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&stranica=<?php echo $i; ?>" ><?php echo $i; ?></a></li>
					      		<?php endif; ?>
			
								<?php endfor; ?>
								
					      <li><a href="?uvjet=<?php echo str_replace("%","", $uvjet); ?>&<?php echo "stranica=" . ($stranica+1) ?>" aria-label="Next page">» </a></li>
					    </ul>
					  </div>
					
					
		<?php
		include_once '../predlozak/footer.php';
		?>	
		<?php
		include_once '../predlozak/skripte.php';
		?>
		<script>
			$(".k1").click(function(){
				var id=$(this).attr("id").split("_")[1];
				var koef=$(this).attr("id").split("_")[2];
				var vid=$(this).attr("id").split("_")[3];
				var tip=$(this).attr("id").split("_")[4];
				//ajax na php šalješ id i koef
				$.ajax({
				type: "POST",
				url: "../predlozak/dodajnalistic.php",
				data: "id=" + id + "&koef=" + koef,
				success: function(vratioServer){
					if(vratioServer==="OK"){
						$("#ponude").append("<li>" + $("#t_" + vid).html() + " | " + $("#n_" + tip).html() + "</li>");
					}else{
						alert(vratioServer);
					}
					}
					
				});
				//kada se vrati response od ajax
				
			});
			
			$(".k2").click(function(){
				var id=$(this).attr("id").split("_")[1];
				var koef=$(this).attr("id").split("_")[2];
				//ajax na php šalješ id i koef
				$.ajax({
				type: "POST",
				url: "../predlozak/dodajnalistic.php",
				data: "id=" + id + "&koef=" + koef,
				success: function(vratioServer){
					if(vratioServer=="OK"){
						$("#ponude").append("<li>" + polaznik.ime 
						+ " " + polaznik.prezime + "</td><td>" 
						+ "<a href=\"#\" class=\"polaznik\" id=\"p_" + polaznik.sifra + "\">Obriši</a></td></tr>");
						definirajBrisanje();
						$("#uvjet").focus();
					}else{
						alert(vratioServer);
					}
					}
					
				});	
				//kada se vrati response od ajax
				$("#ponude").append("<li>bbbb</li>");
			});
		</script>
	</body>
</html>
