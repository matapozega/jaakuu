<?php
include_once '../konfig.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../logout.php");
	exit;
}

if (!isset($_POST["id"])){ 
	header("location: ../logout.php");
	exit;
}

	$izraz = $veza -> prepare("select status,sifra from listic where korisnik=:korisnik and status=0;");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	$status=$izraz->fetch(PDO::FETCH_OBJ);

	$izraz = $veza->prepare("delete from listic_ponuda where listic=:sifra and ponuda=:id
	");
	$izraz->execute(array("sifra"=>$status->sifra,"id"=>$_POST["id"]));
	
	
	echo "OK";