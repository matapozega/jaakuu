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
	$status=$izraz->fetch(PDO::FETCH_OBJ);

if ($status->status===null){
	$izraz = $veza -> prepare("insert into listic (status,korisnik,uplata,ukupnikoeficijent) values (0,:korisnik,0,0);");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	
	$izraz = $veza -> prepare("select status,sifra from listic where korisnik=:korisnik and status=0;");
	$izraz->execute(array("korisnik" => $_SESSION[$sid . "autoriziran"]->sifra));
	$status=$izraz->fetch(PDO::FETCH_OBJ);
	
	
	$izraz = $veza->prepare("insert into listic_ponuda (listic, ponuda,koeficijent) 
	values (:sifra,:id,:koef)");
	$izraz->execute(array("sifra"=>$status->sifra,"id"=>$_POST["id"],"koef"=>$_POST["koef"]));
	echo "OK";
	
}
else{
	$izraz = $veza->prepare("insert into listic_ponuda (listic, ponuda,koeficijent) 
	values (:sifra,:id,:koef)");
	$izraz->execute(array("sifra"=>$status->sifra,"id"=>$_POST["id"],"koef"=>$_POST["koef"]));
	echo "OK";
}





	
	
	


