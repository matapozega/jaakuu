<?php 
include_once '../konfig.php';
if(!isset($_SESSION[$sid . "autoriziran"]) || $_SESSION[$sid . "autoriziran"]===0){
	header("location: ../logout.php");
	exit;
}


/*if (!isset($_POST["id"]) && !isset($_POST["koef"])){ 
	header("location: ../logout.php");
	exit;
}
*/

	$izraz = $veza -> prepare("select sifra from listic where korisnik=:korisnik and status=0;");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	$listic=$izraz->fetchColumn();
	
	$izraz = $veza -> prepare("select koeficijent from listic_ponuda where listic = :listic");
	$izraz->execute(array("listic" => $listic));
	$niz = $izraz -> fetchAll(PDO::FETCH_COLUMN);
	$rez = count($niz);
	if ($rez==0){
		$novikoef=0;
	}else{
		$novikoef = array_product($niz);
	}
	

	$izraz = $veza -> prepare("update listic set ukupnikoeficijent=:ukupno where korisnik=:korisnik and status=0");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra, "ukupno" => $novikoef));

	echo number_format((float)$novikoef, 2, '.', '');
 ?>