<?php
  include_once 'konfig.php';
if (isset($_SESSION[$sid . "autoriziran"])) {
	header("location: privatno/index.php");
}
 ?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
		<?php
		include_once 'predlozak/head.php';
		?>
	</head>
	<body>
		<?php
		include_once 'predlozak/topbar.php';
		?>
		
		

			<div style="min-height: 600px; text-align: center;" class="large-12 columns primary callout">
				<h1 style="margin-top: 10%">Dobro došli na Jaakuu!</h1><br />
				<h3>Prva Youtube kladionica!</h3><br />
				<a  data-open="myModal" class="button"  href="#">Prijavi se</a>
			</div>
		
		<?php 
		include_once 'predlozak/footer.php';
		?>
		<?php 
		include_once 'predlozak/popupprijava.php';
		?>

		<?php
		include_once 'predlozak/skripte.php';
		?>
	</body>
</html>