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
	
	$izraz=$veza->prepare("select * from video where sifra=:sifra");
	$izraz->execute($_GET);
	$_POST = $izraz->fetch(PDO::FETCH_ASSOC);
	$d = strtotime($_POST["datum"]);
				if($d!=""){
			$_POST["datum"] = date( $formatDatumaPHP, $d ); 
			}else{
				$_POST["datum"]="";
			}
}	
	
		
if(isset($_POST["promjeni"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["datum"]);
	
	if(!$d){
 		$poruke["datum"]="Format datuma nije dobar";
 	}	
	
	include_once 'kontrolavideo.php';
	
	 
	if(count($poruke)==0){
		//radi insert
		unset($_POST["promjeni"]);
		$izraz=$veza->prepare("update video 
		set videoid=:videoid,
		naziv=:naziv,
		pregleda=:pregleda,
		likes=:likes,
		dislikes=:dislikes,
		datum=:datum
		where sifra=:sifra");
		$izraz->bindParam("sifra",$_POST["sifra"]);
		$izraz->bindParam("videoid",$_POST["videoid"]);
		$izraz->bindParam("naziv",$_POST["naziv"]);
		$izraz->bindParam("pregleda",$_POST["pregleda"]);
		$izraz->bindParam("likes",$_POST["likes"]);
		$izraz->bindParam("dislikes",$_POST["dislikes"]);
		
		if($_POST["datum"]==""){
			$izraz->bindValue("datum",$t=null,PDO::PARAM_NULL);
		}else{
			$izraz->bindParam("datum",$d->format("Y-m-d"));
		}
		
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
		<div class="row columns">
			<form action="<?php echo $_SERVER["PHP_SELF"]  ?>" method="post" accept-charset="utf-8">
				<fieldset class="fieldset">
					<legend >
						Promjena podataka
					</legend>
					<?php
					
						inputPolje("text", "videoid","Id youtube videa", $poruke);
						inputPolje("text", "naziv","Naziv videa", $poruke);
						inputPolje("number", "pregleda","Broj pregleda", $poruke);
						inputPolje("number", "likes","Broj like-ova", $poruke);
						inputPolje("number", "dislikes","Broj dislike-ova", $poruke);
						inputPolje("text", "datum","Datum postavljanja videa", $poruke);
					
					 ?>
					 <input type="hidden" name="sifra" value="<?php echo $_POST["sifra"] ?>" />
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
				$("#videoid").focus();
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
      	
      	 var datum = document.getElementById('datum').value;
				
		$("#datum").datepicker();
		$("#datum").datepicker("option", $.datepicker.regional['hr']);
		$("#datum").val(datum);
		</script>
	</body>
</html>
