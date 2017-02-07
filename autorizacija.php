<?php
include_once 'konfig.php';


if(isset($_POST["autorizacija"])){
	
	
	$izraz=$veza->prepare("select * from korisnik 
	where email=:korisnik and lozinka=md5(:lozinka)");
	unset($_POST["autorizacija"]);
	$izraz->execute($_POST);
	$korisnik = $izraz->fetch(PDO::FETCH_OBJ);
	
	if($korisnik!=null){
		$_SESSION[$sid . "autoriziran"]=$korisnik;
		header("location: privatno/index.php");
		exit;
	}
	else {
		header("location: login.php?korisnik=".$_POST["korisnik"]);
	}
}
