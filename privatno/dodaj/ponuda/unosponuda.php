<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}
include_once '../../../predlozak/inputpolja.php';
$poruke = array();

if(isset($_POST["dodaj"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["trajeod"]);
	
	if(!$d){
 		$poruke["trajeod"]="Format datuma nije dobar";
 	}	
	$d1 = DateTime::createFromFormat($formatDatumaPHP,$_POST["trajedo"]);
	
	if(!$d){
 		$poruke["trajedo"]="Format datuma nije dobar";
 	}	
	

	include_once 'kontrolaponuda.php';

	if (count($poruke) == 0) {
		//radi insert
		unset($_POST["dodaj"]);
		$izraz = $veza -> prepare("insert into ponuda 
		(video,tipponude,trajeod,trajedo,koeficijent,
		naziv,kolicina) values 
		(:video,:tipponude,:trajeod,:trajedo,:koeficijent,'Više',:kolicina)");
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
		
		$izraz->bindParam("koeficijent",$_POST["koeficijent1"]);
		$izraz->bindParam("kolicina",$_POST["kolicina"]);
		
		$izraz->execute();
		
		$izraz = $veza -> prepare("insert into ponuda 
		(video,tipponude,trajeod,trajedo,koeficijent,
		naziv,kolicina) values 
		(:video,:tipponude,:trajeod,:trajedo,:koeficijent,'Manje',:kolicina)");
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
		
		$izraz->bindParam("koeficijent",$_POST["koeficijent2"]);
		$izraz->bindParam("kolicina",$_POST["kolicina"]);
		
		$izraz->execute();

		header("location: index.php");
	}
}
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
		<div class="row">
			<form action="<?php echo $_SERVER["PHP_SELF"]  ?>" method="post" accept-charset="utf-8">
				<fieldset class="fieldset">
					<legend >
						Unos podataka
					</legend>

					<label>Odabir Videa
						<select name="video">
							<option value="">Odaberite video</option>
							<option disabled>──────────</option>
							<?php

							$izraz1 = $veza -> prepare("select sifra, videoid, naziv from video;");
							$izraz1 -> execute();
							$video = $izraz1 -> fetchALL(PDO::FETCH_OBJ);
							foreach ($video as $stavka) {
								echo '<option   value="' . $stavka -> sifra . '">' . $stavka -> videoid . ' || ' . $stavka->naziv . '</option>';
							}
							?>
							
						</select>
					</label>
						<?php if (isset($poruke["video"])): ?>
						<p class="help-text" id="videoidPomoc"><?php echo $poruke["video"]; ?></p>
						<?php endif; ?>
						
						<label>Odabir tipa ponude
						<select name="tipponude">
							<option value="">Odaberite tip ponude</option>
							<option disabled>──────────</option>
							<?php
							$izraz2 = $veza -> prepare("select sifra, naziv from tipponude;");
							$izraz2 -> execute();
							$tip = $izraz2 -> fetchALL(PDO::FETCH_OBJ);
							foreach ($tip as $stavka) {
								echo '<option   value="' . $stavka -> sifra . '">' . $stavka -> naziv . '</option>';
							}
							?>
						</select> 
						</label>
						<?php if (isset($poruke["tipponude"])): ?>
						<p class="help-text" id="tipponudePomoc"><?php echo $poruke["tipponude"]; ?></p>
						<?php endif;

							inputPolje("text", "trajeod", "Ponuda traje od:", $poruke);
							inputPolje("text", "trajedo", "Ponuda traje do:", $poruke);
							inputPolje("text", "koeficijent1", "Koeficijent za više", $poruke);
							inputPolje("text", "koeficijent2", "Koeficijent za manje", $poruke);
							inputPolje("text", "kolicina", "Količina", $poruke);
					?>
				</fieldset>

				<div class="row">
					<div class="large-6 columns">
						<input name="dodaj" class="success button expanded" type="submit" value="Dodaj" />

					</div>
					<div class="large-6 columns">
						<a class="alert button expanded" href="../index.php">Odustani</a>

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
		<script><?php
			if(!isset($_POST["dodaj"])){
			?>$("#naziv").focus();<?php
			}else{
			foreach ($poruke as $key => $value) {
			?>
			$("#<?php echo $key ?>").focus();<?php
			break;
			}
			?><?php
			}
		?></script>
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
