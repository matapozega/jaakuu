<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}
if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
	header("location: ../../../logout.php");
	exit;
}
include_once '../../../predlozak/inputpolja.php';
$poruke=array();


	


if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	
	$izraz=$veza->prepare("select * from tipponude where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
}	
	
		include_once 'kontrolatip.php';
	
if(isset($_POST["promjeni"])){	
	
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["promjeni"]);
		$izraz=$veza->prepare("update tipponude 
		set naziv=:naziv,
		opis=:opis
		where sifra=:sifra");
		$izraz->execute($_POST);
		header("location: index.php");
	}
}

//$poruke["naziv"]="Naziv obavezno";

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
		<div class="row columns">
			<form action="<?php echo $_SERVER["PHP_SELF"]  ?>" method="post" accept-charset="utf-8">
				<fieldset class="fieldset">
					<legend >
						Promjena podataka
					</legend>
					<?php
					
						inputPolje("text", "naziv","Tip ponude", $poruke);
						inputPolje("text", "opis","Opis tipa", $poruke);
					
					 ?>
					 <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"] ?>" />
				</fieldset>	

				<div class="row">
					<div class="large-6 columns">
						<input name="promjeni" class="success button expanded" type="submit" value="Promjeni!" />

					</div>
					<div class="large-6 columns">
						<a class="alert button expanded" href="index.php">Odustani</a>

					</div>

				</div>
			</form>
		</div>
		<?php
		include_once '../../../predlozak/footer.php';
		?>
		<?php
		include_once '../../../predlozak/skripte.php';
		?>
		<script>
			<?php 
			if(!isset($_POST["dodaj"])){
				?>
				$("#naziv").focus();
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
