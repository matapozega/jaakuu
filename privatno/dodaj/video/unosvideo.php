<?php
include_once '../../../konfig.php';
include_once $putanjaIMG . "../uloge.php";
if (!isset($_SESSION[$sid . "autoriziran"]) || isAdmin()===false) {
	header("location: ../../../logout.php");
	exit;
}
include_once '../../../predlozak/inputpolja.php';
$poruke=array();

if(isset($_POST["dodaj"])){
	
	$d = DateTime::createFromFormat($formatDatumaPHP,$_POST["datum"]);
	
	if(!$d){
 		$poruke["datum"]="Format datuma nije dobar";
 	}	
	
	include_once 'kontrolavideo.php';
	
	if(count($poruke)==0){
		//radi insert
		unset($_POST["dodaj"]);
		$izraz=$veza->prepare("insert into video 
		(videoid,naziv,pregleda,likes,dislikes,datum) values 
		(:videoid,:naziv,:pregleda,:likes,:dislikes,:datum)");
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
						Unos podataka
					</legend>
					<?php
						
						inputPolje("text", "videoid","Id youtube videa", $poruke);
						inputPolje("text", "naziv","Naziv videa", $poruke);
						inputPolje("number", "pregleda","Broj pregleda", $poruke);
						inputPolje("number", "likes","Broj like-ova", $poruke);
						inputPolje("number", "dislikes","Broj dislike-ova", $poruke);
						inputPolje("text", "datum","Datum postavljanja videa", $poruke);
					
					 ?>
				</fieldset>

				<div class="row">
					<div class="large-6 columns">
						<input name="dodaj" class="success button expanded" type="submit" value="Dodaj!" />

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
