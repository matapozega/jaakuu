<?php
include_once '../../konfig.php';
if (!isset($_SESSION["autoriziran"])) {
	header("location: ../../logout.php");
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
			<div class="row">
				<div class="large-4 columns">
					<a class="success button expanded"> Dodaj novi video </a>
				</div>
				<div class="large-4 columns">
					<a class="success button expanded" href="tip/unostip.php"> Dodaj novi tip ponude</a>
				</div>
				<div class="large-4 columns">
					<a class="success button expanded" href="ponuda/unosponuda.php"> Dodaj novu ponudu </a>
				</div>
			</div>
		<?php
		include_once '../../predlozak/footer.php';
		?>	
		<?php
		include_once '../../predlozak/skripte.php';
		?>
	</body>
</html>
