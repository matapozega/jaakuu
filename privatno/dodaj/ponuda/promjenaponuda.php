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
include_once '../../../predlozak/inputpolja.php';
$poruke=array();


	


if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	
	$izraz=$veza->prepare("select * from ponuda where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
	$d = strtotime($_POST["trajeod"]);
				if($d!=""){
			$_POST["trajeod"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["trajeod"]="";
			}
	$d1 = strtotime($_POST["trajedo"]);
				if($d!=""){
			$_POST["trajedo"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["trajedo"]="";
			}
}	
	
		
	
if(isset($_POST["promjeni"])){	
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["trajeod"]);
	
	if(!$d){
 		$poruke["trajeod"]="Format datuma nije dobar";
 	}	
	$d1 = DateTime::createFromFormat($formatDatumaPHP,$_POST["trajedo"]);
	
	if(!$d){
 		$poruke["trajedo"]="Format datuma nije dobar";
 	}	
 	
 	include_once 'kontrolaponuda.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["promjeni"]);
		$izraz=$veza->prepare("update ponuda 
		set video=:video,
		tipponude=:tipponude,
		trajeod=:trajeod,
		trajedo=:trajedo,
		koeficijent=:koeficijent,
		naziv=:naziv
		where sifra=:sifra");
		$izraz->bindParam("sifra",$_POST["sifra"]);
		$izraz->bindParam("video",$_POST["video"]);
		$izraz->bindParam("tipponude",$_POST["tipponude"]);
		
		if($_POST["trajeod"]==""){
			$izraz->bindValue("trajeod",$t=null,PDO::PARAM_NULL);
		}else{
			$izraz->bindParam("trajeod",$d->format("Y-m-d"));
		}
		
		if($_POST["trajedo"]==""){
			$izraz->bindValue("trajedo",$t=null,PDO::PARAM_NULL);
		}else{
			$izraz->bindParam("trajedo",$d1->format("Y-m-d"));
		}
		
		$izraz->bindParam("naziv",$_POST["naziv"]);
		$izraz->bindParam("koeficijent",$_POST["koeficijent"]);

		
		$izraz->execute();
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
				<input type="hidden" name="sifra" value="<?php echo $_POST["sifra"] ?>" />
				<fieldset class="fieldset">
					<legend >
						Unos podataka
					</legend>

					<label>Odabir Videa
						<select name="video">

							<?php

							$izraz1 = $veza -> prepare("select sifra, videoid from video;");
							$izraz1 -> execute();
							$video = $izraz1 -> fetchALL(PDO::FETCH_OBJ);
							foreach ($video as $stavka) :?>
								<option <?php 
								if (isset($_POST["video"]) && $_POST["video"]==$stavka->sifra) {
									echo " selected=\"selected\" ";
								}	
								echo ' value="' . $stavka -> sifra . '">' . $stavka -> videoid . '</option>';
							endforeach;
							?>
						</select>
					</label>
						<?php if (isset($poruke["video"])): ?>
						<p class="help-text" id="videoPomoc"><?php echo $poruke["video"]; ?></p>
						<?php endif; ?>
						
						<label>Odabir tipa ponude
						<select name="tipponude">
							<?php
							$izraz2 = $veza -> prepare("select sifra, naziv from tipponude;");
							$izraz2 -> execute();
							$tip = $izraz2 -> fetchALL(PDO::FETCH_OBJ);
							foreach ($tip as $stavka): ?>
								<option <?php 
								if (isset($_POST["tipponude"]) && $_POST["tipponude"]==$stavka->sifra) {
									echo " selected=\"selected\" ";
								}	
								echo ' value="' . $stavka -> sifra . '">' . $stavka -> naziv . '</option>';
							endforeach;
							?>
						</select> 
						</label>
						<?php if (isset($poruke["tipponude"])): ?>
						<p class="help-text" id="tipponudePomoc"><?php echo $poruke["tipponude"]; ?></p>
						<?php endif;

							inputPolje("text", "trajeod", "Ponuda traje od:", $poruke);
							inputPolje("text", "trajedo", "Ponuda traje do:", $poruke);
							inputPolje("text", "naziv", "Vrijednost", $poruke);
							inputPolje("text", "koeficijent", "Koeficijent", $poruke);
					?>
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
				$("#video").focus();
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
				</script>
				<script src="<?php echo $putanjaAPP ?>js/jquery-ui.js"></script>
		<script>
			
			$.datepicker.regional['hr'] = {
					closeText : 'Zatvori',
					prevText : 'Prethodni',
					nextText : 'Sljedeći',
					currentText : 'Trenutni',
					monthNames : ['Siječanj', 'Veljača', 'Ožujak', 'Travanj', 'Svibanj', 'Lipanj', 'Srpanj', 'Kolovoz', 'Rujan', 'Listopad', 'Studeni', 'Prosinac'],
					monthNamesShort : ['sij', 'velj', 'ožu', 'tra', 'svi', 'lip', 'srp', 'kol', 'ruj', 'lis', 'stu', 'pro'],
					dayNames : ['Nedjelja', 'Ponedjeljak', 'Utorak', 'Srijeda', 'Četvrtak', 'Petak', 'Subota'],
					dayNamesShort : ['ned', 'pon', 'uto', 'sri', 'čet', 'pet', 'sub'],
					dayNamesMin : ['N', 'P', 'U', 'S', 'Č', 'P', 'S'],
					weekHeader : 'Tjedan',
					dateFormat : '<?php echo $formatDatumaJS; ?>',
					firstDay : 1,
					isRTL : false,
					showMonthAfterYear : false,
					yearSuffix : '',
					changeMonth : true,
					changeYear : true,
					showButtonPanel : true,
					yearRange : '1940:2020'
				};
      	$.datepicker.setDefaults($.datepicker.regional['hr']);
      	
      	 var trajeod = document.getElementById('trajeod').value;
				
		$("#trajeod").datepicker();
		$("#trajeod").datepicker("option", $.datepicker.regional['hr']);
		$("#trajeod").val(trajeod);
		
		 var trajedo = document.getElementById('trajedo').value;
				
		$("#trajedo").datepicker();
		$("#trajedo").datepicker("option", $.datepicker.regional['hr']);
		$("#trajedo").val(trajedo);
		</script>
	</body>
</html>
