<?php
include_once '../../../konfig.php';
if (!isset($_SESSION[$sid . "autoriziran"])) {
	header("location: ../../../logout.php");
	exit;
}
if(!isset($_GET["sifra"]) && !isset($_POST["sifra"])){
	header("location: ../../../logout.php");
	exit;
}

if(isset($_GET["sifra"])){
	if (!is_numeric($_GET["sifra"])){
		header("location: ../../../logout.php");
	//print_r(is_numeric($_GET["sifra"]));
		exit;
	}
	
	$izraz=$veza->prepare("select count(sifra) from ponuda where tipponude=:sifra;");
	$izraz->execute($_GET);
	$ukupnovideo = $izraz->fetchColumn;
}	
	
if(isset($_POST["obrisi"])){	
	
	
		unset($_POST["obrisi"]);
		$izraz=$veza->prepare("delete from tipponude 
		where sifra=:sifra");
		$izraz->execute($_POST);
		//print_r($_POST);
		//exit;
		header("location: index.php");
}


 ?>

<div id="obrisimodal" class="reveal" data-reveal>
	<div style="text-align: center;" class="row">
		<div class="large-12 columns">
			<div class="warning callout"><i class="fi-alert"></i>Jeste li sigurni da želite obrisati tip ponude</div>
		</div>
	</div>
	<div class="row">
		<form>
		<div class="large-6 columns">
			<?php if($ukupnoponuda==0): ?>
				<input name="obrisi" class="success button expanded" type="submit" value="Obriši!" />
			<?php else:?>
					Smjer se ne može obrisati jer na njemu 
					postoje grupe
			<?php endif;?>
		</div>
		<div class="large-6 columns">
			<button class="close-button" data-close aria-label="Close modal" type="button">
		<span aria-hidden="true">Odustani</span>
	</button>
			
		</div>
	</div>
	</form>
	
</div>
