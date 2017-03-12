<?php
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../logout.php");
	exit;
}

if ($_SESSION[$sid . "autoriziran"]->aktivan === 0){
	header("location: " . $putanjaAPP . "aktivacija.php");
	exit;
}
include_once '../predlozak/inputpolja.php';


	



		
if(isset($_POST["osobno"])){
	
		unset($_POST["osobno"]);
		$izraz=$veza->prepare("update korisnik 
		set ulica=:ulica,mjesto=:mjesto,postanskibr=:postanskibr,drzava=:drzava
		where sifra=:sifra");	
		$izraz->execute(array("ulica"=> $_POST["ulica"], "mjesto" => $_POST["mjesto"], "postanskibr" => $_POST["postanskibr"],
		"drzava" => $_POST["drzava"], "sifra" => $_SESSION[$sid . "autoriziran"]->sifra));
		header("location: profil.php?sifra=" . $_SESSION[$sid . "autoriziran"]->sifra);
	
	}

if(isset($_SESSION[$sid . "autoriziran"])){

	
	$izraz=$veza->prepare("select * from korisnik where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_SESSION[$sid . "autoriziran"] -> sifra));
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
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
		<div class="row columns">
			<form action="<?php echo $_SERVER["PHP_SELF"]  ?>" method="post" accept-charset="utf-8">
				<fieldset class="fieldset">
					<legend >
						Promjena osobnih podataka
					</legend>
					<?php
					
						inputPolje("text", "ulica","Ulica", $poruke);
						inputPolje("text", "mjesto","Mjesto", $poruke);
						inputPolje("text", "postanskibr","Poštanski broj", $poruke);
						inputPolje("text", "drzava","Država", $poruke);
					?>
				</fieldset>	
				<input type="hidden" name="sifra" value="<?php echo $_SESSION[$sid . "autoriziran"]->sifra; ?>" />
				<div class="row">
					<div class="large-6 columns">
						<input name="osobno" class="success button expanded" type="submit" value="Promjeni podatke!" />

					</div>
					<div class="large-6 columns">
						<a class="alert button expanded" href="profil.php?sifra=<?php echo  $_SESSION[$sid . "autoriziran"]->sifra; ?>">Odustani</a>

					</div>

				</div>
			</form>
		</div>
		<?php
		include_once '../predlozak/footer.php';
		?>
		<?php
		include_once '../predlozak/skripte.php';
		?>
		<script>
			<?php 
			if(!isset($_POST["dodaj"])){
				?>
				$("#ulica").focus();
				<?php
			}else{
				foreach ($poruke as $key => $value) {
					?>
					$("#<?php echo $key ?>").focus();
					<?php
					break;
				}
				?>
				
				<?php
			}
			?>
		</script>
	</body>
</html>