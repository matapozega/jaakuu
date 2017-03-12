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
$poruke=array();
	
		
if(isset($_POST["lozinka"])){
	include_once 'kontrolalozinka.php';
	
	 
if(count($poruke)==0){
		unset($_POST["lozinka"]);
		unset($_POST["ponovljenalozinka"]);
		unset($_POST["staralozinka"]);
		$izraz=$veza->prepare("update korisnik 
		set lozinka=:lozinka
		where sifra=:sifra");
		$izraz->execute(array("lozinka" => md5($_POST["novalozinka"]),"sifra"=>$_POST["sifra"]));
		header("location: profil.php?sifra=" . $_SESSION[$sid . "autoriziran"]->sifra);
	}
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
						Promjena lozinke
					</legend>
					<?php
						inputPolje("password", "staralozinka","Upiši staru lozinku", $poruke);
						inputPolje("password", "novalozinka","Upiši novu lozinku", $poruke);
						inputPolje("password", "ponovljenalozinka","Ponovi novu lozinku", $poruke);
					?>
					
					 <input type="hidden" name="sifra" value="<?php echo $_SESSION[$sid . "autoriziran"]->sifra; ?>" />
				</fieldset>	

				<div class="row">
					<div class="large-6 columns">
						<input name="lozinka" class="success button expanded" type="submit" value="Promjeni lozinku!" />

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
				$("#staralozinka").focus();
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