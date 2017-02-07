<?php include_once 'konfig.php';  
	
	include_once 'predlozak/inputpolja.php';
$poruke=array();

if(isset($_POST["register"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["datrodenja"]);
	
	if(!$d){
 		$poruke["datrodenja"]="Format datuma nije dobar";
 	}	
	
	include_once 'kontrolaregister.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["register"]);
		unset($_POST["potvrdi_lozinku"]);
		$izraz=$veza->prepare("insert into korisnik 
		(ime,prezime,oib,datrodenja,ulica,mjesto,drzava,postanskibr,email,lozinka,aktivan) values 
		(:ime,:prezime,:oib,:datrodenja,:ulica,:mjesto,:drzava,:postanskibr,:email,md5(:lozinka),:aktivan)");
		$izraz->bindParam("ime",$_POST["ime"]);
		$izraz->bindParam("prezime",$_POST["prezime"]);
		$izraz->bindParam("oib",$_POST["oib"]);
		if($_POST["datrodenja"]==""){
			$izraz->bindValue("datrodenja",$t=null,PDO::PARAM_NULL);
		}else{
			$izraz->bindParam("datrodenja",$d->format("Y-m-d"));
		}
		$izraz->bindParam("ulica",$_POST["ulica"]);
		$izraz->bindParam("mjesto",$_POST["mjesto"]);
		$izraz->bindParam("drzava",$_POST["drzava"]);
		$izraz->bindParam("postanskibr",$_POST["postanskibr"]);
		$izraz->bindParam("email",$_POST["email"]);
		$izraz->bindParam("lozinka",$_POST["lozinka"]);
		$izraz->bindParam("aktivan",$_POST["aktivan"]);	
		$izraz->execute();
		header("location: index.php");
	}
}
	
?>
<!doctype html>
<html class="no-js" lang="en" dir="ltr">
	<head>
	<?php include_once 'predlozak/head.php'; ?>
	<link rel="stylesheet" href="<?php echo $putanjaAPP ?>css/jquery-ui.css">
	</head>
	<body>
	<?php include_once 'predlozak/topbar.php';  ?>
<div class="row columns">
	<form <?php echo $_SERVER["PHP_SELF"]  ?> method="post">
		
	<fieldset class="fieldset">
		<legend>Osobni podaci</legend>
			<?php 
			
				inputPolje("text","ime", "Ime", $poruke);
				inputPolje("text","prezime", "Prezime", $poruke);
				inputPolje("number","oib", "OIB", $poruke);
				inputPolje("text","datrodenja", "Datum rođenja", $poruke);
			
			 ?>
	</fieldset>
	<fieldset class="fieldset">
		<legend>Adresa stanovanja</legend>
			<?php 
			
				inputPolje("text","ulica", "Ulica", $poruke);
				inputPolje("text","mjesto", "Mjesto", $poruke);
				inputPolje("text","drzava", "Država", $poruke);
				inputPolje("number","postanskibr", "Poštanski broj", $poruke);
			
			 ?>
	</fieldset>
	<fieldset class="fieldset">
		<legend>Podaci za prijavu</legend>
			<?php 
			
				inputPolje("email","email", "E-mail", $poruke);
				inputPolje("password","lozinka", "Lozinka", $poruke);
				inputPolje("password","potvrdi_lozinku", "Ponovi lozinku", $poruke);
				//unset($_POST["potvrdi_lozinku"]);
				
			 ?>
			 	<input type="hidden" name="aktivan" value="1" />
	</fieldset>

	<div class="row">
		<div class="large-6 columns">
			
			<input name="register" class="button expanded" type="submit" value="Registriraj se" />
		</div>
		<div class="large-6 columns">
			<a class="alert button expanded" href="index.php">Odustani</a>
	
		</div>
	</div>
	</form>	
</div>
	<?php include_once 'predlozak/footer.php'; ?>
	<?php include_once 'predlozak/skripte.php';  ?>
	<script>
			<?php 
			if(!isset($_POST["dodaj"])){
				?>
				$("#ime").focus();
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
      	
      	 var datrodenja = document.getElementById('datrodenja').value;
				
		$("#datrodenja").datepicker();
		$("#datrodenja").datepicker("option", $.datepicker.regional['hr']);
		$("#datrodenja").val(datrodenja);
		</script>
	</body>
</html>
