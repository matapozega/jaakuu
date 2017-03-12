<?php  
include_once '../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"]) || $_SESSION[$sid . "autoriziran"]->aktivan==0) {
	header("location: ../../logout.php");
	exit;
}


	if (isset($_POST["potvrdi"])){
		unset($_POST["potvrdi"]);
		$izraz=$veza->prepare("select stanje from novcanik where korisnik=:korisnik");
		$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
		$stanje=$izraz->fetchColumn();
		
		$novostanje = $stanje - $_POST["uplata"];
		if($novostanje < 0){
			echo "<script>
			alert('Nemate dovoljno jaakuu novcica');
			window.location.href='../index.php';
			</script>"; 
		}else{
		
		$izraz=$veza->prepare("update novcanik set stanje=:novostanje where korisnik=:korisnik");
		$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra, "novostanje"=>$novostanje));
		
		$izraz=$veza->prepare("update listic set status=1, uplata=:uplata, ukupnikoeficijent=:ukkoef, evdobitak=:evdobitak where sifra=:listic");
		$izraz->execute(array("evdobitak"=>$_POST["evdobitak"], "ukkoef" => $_POST["ukkoef"],"uplata" => $_POST["uplata"], "listic" => $_POST["listic"]));
		header("location: ../index.php");
		}	
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
		<form action="<?php echo $_SERVER["PHP_SELF"] ?>" 
			method="post">
		<table style="margin-top: 40px">	
			<thead>
				<tr>
					<td>Listić broj</td>
					<td>Uplata</td>
					<td>Ukupni koeficijent</td>
					<td>Eventualni dobitak</td>
				</tr>
			</thead>
			<tbody>
				
				<?php 
					$izraz=$veza->prepare("select * from listic where sifra=:listic");
							$izraz->execute(array("listic"=> $_POST["listic"]));
							$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
							
				foreach ($niz as $stavka): 	?>
				<tr>
					<td>
						<?php echo $stavka->sifra; $listic = $stavka->sifra;?>
					</td>
					<td>
						<?php echo number_format((float)$_POST["uplata"], 2, '.', ''); $uplata = $_POST["uplata"]?>
					</td>
					<td>
						<?php echo number_format((float)$stavka->ukupnikoeficijent, 2, '.', ''); $ukkoef= $stavka->ukupnikoeficijent;?>
					</td>
					<td>
						<?php 
							$evdobitak = $stavka->ukupnikoeficijent * $uplata;
							echo number_format((float)$evdobitak, 2, '.', ''); 
						 ?> Jaakuu
					</td>
					<td>
						<table>
						
							<tbody>
								
									<?php 
										$izraz=$veza->prepare("select a.sifra, c.naziv as vm, c.koeficijent as koef, d.naziv as ime,e.naziv as tip from
														listic a inner join	listic_ponuda b on a.sifra=b.listic
														inner join ponuda c on b.ponuda=c.sifra
														inner join video d on c.video=d.sifra
														inner join tipponude e on e.sifra=c.tipponude
														where a.korisnik=:korisnik and a.sifra=:sifra;");
													$izraz->execute(array("korisnik"=>$_SESSION[$sid . "autoriziran"]->sifra, "sifra"=>$stavka->sifra));
													$niz=$izraz->fetchALL(PDO::FETCH_OBJ);
													
										foreach ($niz as $stavka): 
									?>
									<tr>	
										<td><?php echo $stavka->ime; ?></td> 
										<td><?php echo $stavka->vm; ?> <?php echo $stavka->tip; ?></td>
										<td><?php echo $stavka->koef; ?></td>	
									</tr>
									<?php
										endforeach;
										
								 	?> 
					 				
					 		</tbody>
					 	</table>
					</td>
				</tr>
				<?php
				endforeach;
	 			?>

		</tbody>
		</table>
		<input type="hidden" name="uplata" value="<?php echo $_POST["uplata"] ?>" />
		<input type="hidden" name="ukkoef" value="<?php echo $ukkoef ?>" />
		<input type="hidden" name="listic" value="<?php echo $listic ?>" />
		<input type="hidden" name="evdobitak" value="<?php echo $evdobitak ?>" />
		
		<div class="row columns">
				<input name="potvrdi" class="button expanded" type="submit" value="Uplati!" />
					</div>
			</div>
			
			<div class="row columns">
				<a class="alert button expanded" href="../index.php">Odustani</a>
		
			</div>
		</div>
		
		</form>
		<?php
		include_once '../predlozak/footer.php';
		?>
		<?php
		include_once '../predlozak/skripte.php';
		?>

	