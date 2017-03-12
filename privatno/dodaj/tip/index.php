<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}
$uvjet="";
		if(isset($_GET["uvjet"])){
			$uvjet="%" . $_GET["uvjet"] . "%";
		}else{
			$uvjet="%";
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
			<div class="row expanded">
						<a class="button expanded" href="unostip.php"> Dodaj novi tip ponude</a>
			</div>
		
		<table class="hover">
			<thead>
				<tr>
					<td>Tip ponude</td>
					<td>Opis tipa ponude</td>
					<td colspan="2">
						<div class="row columns expanded">
								<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="GET">
									<input style="margin-bottom: 0px;" value="<?php echo str_replace("%","", $uvjet); ?>" type="text" name="uvjet" placeholder="dio naziva" />
								</form>
						</div>
					</td>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$izraz = $veza->prepare("select sifra, naziv, opis from tipponude where concat(naziv, opis) like :uvjet order by naziv desc");
				$izraz->execute(array("uvjet" => $uvjet));
				$niz = $izraz->fetchALL(PDO::FETCH_OBJ);
				foreach ($niz as $red) {
					include '../../../predlozak/stavkatip.php';
				}
				 ?>
			</tbody>
		</table>

		
		<?php
		include_once '../../../predlozak/footer.php';
		?>	
		<?php
		include_once '../../../predlozak/skripte.php';
		?>
	</body>
</html>
