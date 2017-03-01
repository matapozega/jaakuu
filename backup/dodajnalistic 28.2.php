<?php
include_once '../konfig.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../logout.php");
	exit;
}


if (!isset($_POST["id"]) && !isset($_POST["koef"])){ 
	header("location: ../logout.php");
	exit;
}

	$izraz = $veza -> prepare("select status,sifra from listic where korisnik=:korisnik and status=0;");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	$listic=$izraz->fetch(PDO::FETCH_OBJ);

if ($listic->status===null){
	$izraz = $veza -> prepare("insert into listic (status,korisnik,uplata,ukupnikoeficijent) values (0,:korisnik,0,0);");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	$zadnjasifralistica = $veza->lastInsertId();
	
	$izraz = $veza -> prepare("select status,sifra from listic where sifra=:sifra;");
	$izraz->execute(array("sifra"=>$zadnjasifralistica));
	$listic=$izraz->fetch(PDO::FETCH_OBJ);
	
}	
	$izraz = $veza -> prepare("select count(ponuda) from listic_ponuda where listic=:listic and ponuda like :ponudaid ");
	$izraz->execute(array("listic" => $listic->sifra,"ponudaid"=>$_POST["id"]));
	$provjera=$izraz->fetchColumn();
if ($provjera>=1){
	echo "Ta ponuda je već na listiću!";
	exit;
}
			
	$izraz = $veza->prepare("insert into listic_ponuda (listic,ponuda,koeficijent) 
	values (:sifra,:id,:koef)");
	$izraz->execute(array("sifra"=>$listic->sifra,"id"=>$_POST["id"],"koef"=>$_POST["koef"]));
	echo "OK";
		
	