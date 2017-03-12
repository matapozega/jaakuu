<?php
include_once '../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../logout.php");
	exit;
}

if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
	header("location: ../../logout.php");
	exit;
}

if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	$izraz=$veza->prepare("select uloga from korisnik where sifra=:sifra;");
	$izraz->execute($_GET);
	$provjerauloga = $izraz->fetchColumn();
}
	
if(isset($_POST["dodaj"])){	
	
	
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("update korisnik set uloga='admin' where sifra=:sifra");
		$izraz->execute($_POST);
		//print_r($_POST);
		//exit;
		header("location: popiskorisnika.php");
}


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
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" 
			method="post">
			
				
				<input type="hidden" name="sifra" value="<?php echo $_GET["sifra"] ?>" />
				
		
		
			<div class="row columns">
				<?php if($provjerauloga=='admin'): ?>
					<div style="text-align: center;" class="warning callout">
						Korisnik već je admin!
					</div>
				<?php else:?>
				<input name="dodaj" class="button expanded" type="submit" value="Dodaj admina!" />
				<?php endif;?>
	
			</div>
			
			<div class="row columns">
				<a class="alert button expanded" href="popiskorisnika.php">Odustani</a>
			</div>
		</div>
		
		</form>
		<?php
		include_once '../../predlozak/footer.php';
		?>
		<?php
		include_once '../../predlozak/skripte.php';
		?>
	</body>
</html>
