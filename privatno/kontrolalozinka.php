<?php

//radi provjere
	$_POST["staralozinka"]=trim($_POST["staralozinka"]);
	if(strlen($_POST["staralozinka"])==0){
		$poruke["staralozinka"]="Stara lozinka nije točna";
	}
	
	$izraz=$veza->prepare("select lozinka from korisnik where sifra=:sifra");
	$izraz->execute(array("sifra"=>$_SESSION[$sid . "autoriziran"] -> sifra));
	$provjeralozinke=$izraz -> fetchColumn();
	if ($provjeralozinke!=md5($_POST["staralozinka"])){
		$poruke["staralozinka"]="Stara lozinka nije točna";
	}
	
	$_POST["novalozinka"]=trim($_POST["novalozinka"]);
	if(strlen($_POST["novalozinka"])==0){
		$poruke["novalozinka"]="Nova lozinka mora imati barem 1 znak";
	}
	if(strlen($_POST["novalozinka"])>16){
		$poruke["novalozinka"]="Nova lozinka mora biti kraca od 16 znakova";
	}
	
	
	if($_POST["novalozinka"] != $_POST["ponovljenalozinka"]){
		$poruke["ponovljenalozinka"]="Lozinke se ne podudaraju";
		$poruke["novalozinka"]="Lozinke se ne podudaraju";
	}