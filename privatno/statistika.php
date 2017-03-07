<?php
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"]) || $_SESSION[$sid . "autoriziran"]->aktivan==0) {
	header("location: ../logout.php");
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
						<h3>10 igrača dobitnih listića sa najviše odigranih ponuda</h3>
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
						$izraz = $veza -> prepare("select concat(a.ime, ' ', a.prezime) as korisnik, c.listic , count(d.tipponude)
						as tip, b.status
						from korisnik a inner join listic b on a.sifra=b.korisnik
						inner join listic_ponuda c on b.sifra=c.listic
						inner join ponuda d on c.ponuda=d.sifra
						inner join tipponude e on e.sifra=d.tipponude
						where b.status=1 group by korisnik, c.listic
						order by tip  desc limit 10
						");
						$izraz -> execute();
						$niz = $izraz -> fetchALL(PDO::FETCH_OBJ);
						foreach ($niz as $stats) {
							include '../predlozak/listaigraca.php';
						}
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
					$izraz = $veza -> prepare("select concat(a.ime, ' ', a.prezime) as korisnik, count(b.sifra) as listica
												from korisnik a inner join listic b on a.sifra=b.korisnik 
												inner join listic_ponuda c on b.sifra=c.listic
												inner join ponuda d on c.ponuda=d.sifra
												inner join tipponude e on e.sifra=d.tipponude
												group by korisnik
												order by listica desc limit 10
					");
					$izraz -> execute();
					$niz = $izraz -> fetchALL(PDO::FETCH_OBJ);
					foreach ($niz as $stats) {
						include '../predlozak/listaigraca1.php';
					}
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

