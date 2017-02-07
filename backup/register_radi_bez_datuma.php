<?php include_once 'konfig.php';  
	
	include_once 'predlozak/inputpolja.php';
$poruke=array();

if(isset($_POST["register"])){
	
	include_once 'kontrolaregister.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["register"]);
		unset($_POST["potvrdi_lozinku"]);
		$izraz=$veza->prepare("insert into korisnik 
		(ime,prezime,oib,datrodenja,ulica,mjesto,drzava,postanskibr,email,lozinka) values 
		(:ime,:prezime,:oib,:datrodenja,:ulica,:mjesto,:drzava,:postanskibr,:email,md5(:lozinka))");
		$izraz->execute($_POST);
		header("location: index.php");
	}
}
	
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
	<?php include_once 'predlozak/head.php'; ?>
	</head>
	<body>
	<?php include_once 'predlozak/topbar.php';  ?>
<div class="row columns">
	<form <?php echo $_SERVER["PHP_SELF"]  ?> method="post">
		
	<fieldset class="fieldset">
		<legend>Osobni podaci</legend>
			<?php 
			
				inputPolje("text","ime", "Ime", $poruke);
				inputPolje("text","prezime", "Prezime", $poruke);
				inputPolje("number","oib", "OIB", $poruke);
				inputPolje("date","datrodenja", "Datum rođenja", $poruke);
			
			 ?>
	</fieldset>
	<fieldset class="fieldset">
		<legend>Adresa stanovanja</legend>
			<?php 
			
				inputPolje("text","ulica", "Ulica", $poruke);
				inputPolje("text","mjesto", "Mjesto", $poruke);
				inputPolje("text","drzava", "Država", $poruke);
				inputPolje("number","postanskibr", "Poštanski broj", $poruke);
			
			 ?>
	</fieldset>
	<fieldset class="fieldset">
		<legend>Podaci za prijavu</legend>
			<?php 
			
				inputPolje("email","email", "E-mail", $poruke);
				inputPolje("password","lozinka", "Lozinka", $poruke);
				inputPolje("password","potvrdi_lozinku", "Ponovi lozinku", $poruke);
				unset($_POST["potvrdi_lozinku"]);
			
			 ?>
	</fieldset>

	<div class="row">
		<div class="large-6 columns">
			
			<input name="register" class="button expanded" type="submit" value="Registriraj se" />
		</div>
		<div class="large-6 columns">
			<a class="alert button expanded" href="index.php">Odustani</a>
	
		</div>
	</div>
	</form>	
</div>
	<?php include_once 'predlozak/footer.php'; ?>
	<?php include_once 'predlozak/skripte.php';  ?>
	<script>
			<?php 
			if(!isset($_POST["dodaj"])){
				?>
				$("#ime").focus();
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
