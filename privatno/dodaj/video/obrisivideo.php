<?php
include_once '../../../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"]) || $_SESSION[$sid . "autoriziran"]->aktivan==0) {
	header("location: ../../../logout.php");
	exit;
}
if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
	header("location: ../../../logout.php");
	exit;
}

if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	
	$izraz=$veza->prepare("select count(sifra) from ponuda where video=:sifra;");
	$izraz->execute($_GET);
	$ukupnovideo = $izraz->fetchColumn();
}	
	
if(isset($_POST["obrisi"])){	
	
	
		unset($_POST["obrisi"]);
		$izraz=$veza->prepare("delete from video 
		where sifra=:sifra");
		$izraz->execute($_POST);
		//print_r($_POST);
		//exit;
		header("location: index.php");
}


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
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" 
			method="post">
			
				
				<input type="hidden" name="sifra" value="<?php echo $_GET["sifra"] ?>" />
				
		
		
		<div class="row columns">
				<?php if($ukupnovideo==0): ?>
				<input name="obrisi" class="button expanded" type="submit" value="Obriši!" />
				<?php else:?><div style="text-align: center;" class="warning callout">
					Video se ne može obrisati jer postoji ponuda sa tim videom!
					<?php endif;?>
					</div>
			</div>
			
			<div class="row columns">
				<a class="alert button expanded" href="index.php">Odustani</a>
		
			</div>
		</div>
		
		</form>
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
