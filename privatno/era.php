<?php
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../logout.php");
	exit;
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
		<div class="row expanded">
			<img style="display: block; margin-left: auto; margin-right: auto;" src="<?php echo $putanjaAPP; ?>img/jaakuu.png"  />
		</div>
		<?php
		include_once '../predlozak/footer.php';
		?>	
		<?php
		include_once '../predlozak/skripte.php';
		?>
	</body>
</html>
