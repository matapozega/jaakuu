<?php
include_once '../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../logout.php");
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
				select count(sifra) from korisnik where concat(ime,prezime,uloga,oib,email)
				 like :uvjet
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
		include_once '../../predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once '../../predlozak/topbar.php';
		?>
			<table class="hover">
			<thead>
				<tr>
					<td>Ime i prezime</td>
					<td>E-mail</td>
					<td>Lozinka</td>
					<td>OIB</td>
					<td>Uloga</td>
					<td colspan="2">
						<div class="row columns expanded">
							<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
								<input style="margin-bottom: 0px;" value="<?php echo str_replace("%","", $uvjet); ?>" type="text" name="uvjet" placeholder="Search" />
							</form>
						</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$izraz = $veza->prepare("select concat(ime, ' ' , prezime) as korisnik ,oib,sifra,uloga,email,lozinka from korisnik 
				where concat(ime,prezime,uloga,oib,email) like :uvjet limit :odKuda,:poStranici;");
				$izraz->execute(array("uvjet" => $uvjet, "odKuda"=>$odKuda,"poStranici"=>$poStranici));
				$niz = $izraz->fetchALL(PDO::FETCH_OBJ);
				foreach ($niz as $red) :?>
					<tr>
						<td><?php echo $red->korisnik; ?></td>
						<td style="max-width: 400px;"><?php echo $red->email; ?></td>
						<td><?php echo $red->lozinka; ?></td>
						<td><?php echo $red->oib; ?></td>
						<td><?php echo $red->uloga; ?></td>
						<td style="width: 150px;"><a style="margin-bottom: 0px;" title="Dodaj admina" class="button expanded" href="dodajadmina.php?sifra=<?php echo $red -> sifra; ?>"><i class="fi-star"></i> </a></td>
						<td style="width: 150px;"><a style="margin-bottom: 0px;" class="alert button expanded" title="Ukloni admina" href="ukloniadmina.php?sifra=<?php echo $red -> sifra ?>"><i class="fi-x"></i> </td>
					</tr>
				<?php
				endforeach;
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
		include_once '../../predlozak/footer.php';
		?>	
		<?php
		include_once '../../predlozak/skripte.php';
		?>
	</body>
</html>