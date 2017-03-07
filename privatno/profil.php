<?php
  include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"]) || $_SESSION[$sid . "autoriziran"]->aktivan==0) {
	header("location: ../logout.php");
	exit;
}

if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
	header("location: ../logout.php");
	exit;
}
if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
}	



if(isset($_POST["obrisi"])){	
	
	
		unset($_POST["obrisi"]);
		$izraz=$veza->prepare("update korisnik set aktivan=0 where sifra=:sifra");
		$izraz->execute($_POST);
		//print_r($_POST);
		//exit;
		header("location: ../logout.php");
}

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
		
		<div class="row">&nbsp;</div>
		<div class="row expanded">
			<div class="large-4 columns callout">
				<h1>Korisnički podaci:</h1>
				<h3>
				<?php 
				$izraz=$veza->prepare("select concat(a.ime, ' ', a.prezime) as ime, a.email,a.oib, b.stanje
										from korisnik a inner join novcanik b on a.sifra=b.korisnik
										where a.sifra=:korisnik");
							$izraz->execute(array("korisnik"=>$_SESSION[$sid . "autoriziran"]->sifra));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
				foreach ($niz as $stavka): 			
				?>
				<img src="<?php echo $putanjaAPP; ?>img/<?php
					if (file_exists($putanjaIMG . $stavka->oib .  "1.jpg")) {
						echo $stavka->oib . "1";
					} else {
						echo "Unknown-person";
					}
				 ?>.jpg" alt="" /><br /><br />
				<?php
				echo $stavka->ime;
				?><br />
				<?php echo $stavka->email;  ?><br />
				Stanje na računu: <?php echo $stavka->stanje;  ?><br />
				
				
				<?php 
				endforeach;
	 			?>
				</h3> 
			</div>
		</div>
		<div class="row">&nbsp;</div>
		<h1>Odigrani listići:</h1>
		<table class="hover">
			<thead>
				<tr>
					<td>Listić broj</td>
					<td>Uplata</td>
					<td>Ukupni koeficijent</td>
					<td>Parovi</td>
					<td>Eventualni dobitak</td>
				</tr>
			</thead>
			<tbody>
		<?php  
		$izraz=$veza->prepare("select * from listic where korisnik=:korisnik and status=1");
							$izraz->execute(array("korisnik"=>$_SESSION[$sid . "autoriziran"]->sifra));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka): 	
				include '../predlozak/odigranilistici.php';
				endforeach;
	 			?>
	 		</tbody>	
	 	</table>
			<div class="row columns">
				<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
					<input type="hidden" name="sifra" value="<?php echo $_GET["sifra"] ?>" />
				<input class="alert button expanded" type="submit" name="obrisi" value="Obriši korisnika"/>
				</form>				
			</div>
		
		<?php 
		include_once '../predlozak/footer.php';
		?>
		<?php
		include_once '../predlozak/skripte.php';
		?>
	</body>

	
</html>

