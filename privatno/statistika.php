<?php
include_once '../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
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
		<div class="row">
			<div class="large-6 columns">
				<div style="text-align: center; background-color:rgba(0, 0, 0, 0.180392); " class="callout secondary">
						<h3>10 listića sa najviše odigranih ponuda</h3>
					</div>
				<table class="hover">
					<thead>
						<tr>
							<th width="200px">Ime i prezime igrača</th>
							<th width="200px">Odigrano ponuda na listiću</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$izraz = $veza -> prepare("select count(a.ponuda) as tip, concat(c.ime,' ',c.prezime) as korisnik from
													listic_ponuda a inner join listic b on a.listic=b.sifra
													inner join korisnik c on b.korisnik=c.sifra
													group by a.listic
													order by count(a.ponuda) desc limit 10
						");
						$izraz -> execute();
						$niz = $izraz -> fetchALL(PDO::FETCH_OBJ);
						foreach ($niz as $stats) :?>
					    <tr>
					      <td><?php echo $stats->korisnik; ?></td>
					      <td><?php echo $stats->tip; ?></td>
					    </tr>
					    <?php
						endforeach;
						?>
					</tbody>
				</table>
			</div>

			<div class="large-6 columns">
				<div style="text-align: center; background-color:rgba(0, 0, 0, 0.180392); " class="callout secondary">
						<h3>10 igrača sa najviše odigranih listića</h3>
					</div>
				<table class="hover">
					<thead>
						<tr>
							<th width="200px">Ime i prezime igrača</th>
							<th width="200px">Odigrano listića</th>
						</tr>
					</thead>
					 <tbody>

					<?php
					$izraz = $veza -> prepare("select count( distinct a.listic) as broj, concat(c.ime, ' ', c.prezime) as korisnik from
												listic_ponuda a inner join listic b on a.listic=b.sifra
												inner join korisnik c on b.korisnik=c.sifra
												group by korisnik
					");
					$izraz -> execute();
					$niz = $izraz -> fetchALL(PDO::FETCH_OBJ);
					foreach ($niz as $stats):?>
					    <tr>
					      <td><?php echo $stats->korisnik; ?></td>
					      <td><?php echo $stats->broj; ?></td>
					    </tr>
					<?php
					endforeach;
					?>
					</tbody>
				</table>
			</div>
		</div>

		<?php
		include_once '../predlozak/footer.php';
		?>
		<?php
		include_once '../predlozak/skripte.php';
		?>
	</body>
</html>

