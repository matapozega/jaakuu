<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}


$uvjet = "";
		if (isset($_GET["uvjet"])){
			$uvjet="%" . $_GET["uvjet"] . "%";
		}else{
			$uvjet="%";
}
			
		$poStranici=8;
			
			$izraz = $veza -> prepare("
				select count(a.sifra) from video a inner join ponuda b on a.sifra=b.video
				inner join tipponude c on c.sifra=b.tipponude
				where concat(a.videoid,b.trajeod, b.trajedo, b.koeficijent, c.naziv) like :uvjet
			");
			$izraz -> execute(array("uvjet" => $uvjet));
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
		include_once '../../../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../../../predlozak/topbar.php';
		?>
			<div class="row expanded">
						<a class="button expanded" href="unosponuda.php"> Dodaj novu ponudu</a>
			</div>
			<table class="hover">
			<thead>
				<tr>
					<td>Video</td>
					<td>Tip ponude</td>
					<td>Ponuda traje od:</td>
					<td>Ponuda traje do:</td>
					<td>Vrijednost</td>
					<td>Količina</td>
					<td>Koeficijent</td>
					<td colspan="2">
						<div class="row columns expanded">
							<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
								<input style="margin-bottom: 0px;" value="<?php echo str_replace("%","", $uvjet); ?>" type="text" name="uvjet" placeholder="ID videa" />
							</form>
						</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$izraz = $veza->prepare("
				select a.videoid, a.naziv as video, b.naziv as vrijednost, b.sifra, b.trajeod, b.trajedo, b.koeficijent,b.kolicina, c.naziv
				from video a inner join ponuda b on a.sifra=b.video
				inner join tipponude c on c.sifra=b.tipponude
				where concat(a.videoid,b.trajeod, b.trajedo, b.koeficijent, c.naziv) like :uvjet limit :odKuda,:poStranici
				");
				$izraz->execute(array("uvjet" => $uvjet, "odKuda"=>$odKuda,"poStranici"=>$poStranici));
				$niz = $izraz->fetchALL(PDO::FETCH_OBJ);
				foreach ($niz as $red) {
					include '../../../predlozak/stavkaponuda.php';
				}
				 ?>
			</tbody>
		</table>
		
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
		include_once '../../../predlozak/footer.php';
		?>	
		<?php
		include_once '../../../predlozak/skripte.php';
		?>
	</body>
</html>
