<?php
  include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
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
		$izraz=$veza->prepare("delete from korisnik where sifra=:sifra");
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
		
		<pre><?php print_r($_SESSION) ?></pre>
		
		<table>
			<thead>
				<tr>
					<td>Broj listića</td>
					<td>Uplata</td>
					<td>Ukupni koef</td>
					<td>Parovi</td>
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
