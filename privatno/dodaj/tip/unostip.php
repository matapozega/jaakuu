<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}
include_once '../../../predlozak/inputpolja.php';
$poruke=array();

if(isset($_POST["dodaj"])){
	
	include_once 'kontrolatip.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("insert into tipponude 
		(naziv,opis) values 
		(:naziv,:opis)");
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
			<link rel="stylesheet" href="<?php echo $putanjaAPP ?>css/jquery-ui.css">
	</head>
	<body>
		<?php
		include_once '../../../predlozak/topbar.php';
		?>
		<div class="row columns">
			<form action="<?php echo $_SERVER["PHP_SELF"]  ?>" method="post" accept-charset="utf-8">
				<fieldset class="fieldset">
					<legend >
						Unos podataka
					</legend>
					<?php
					
						inputPolje("text", "naziv","Tip ponude", $poruke);
						inputPolje("text", "opis","Opis tipa", $poruke);
					
					 ?>
				</fieldset>	

				<div class="row">
					<div class="large-6 columns">
						<input name="dodaj" class="success button expanded" type="submit" value="Dodaj!" />

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
