<?php

	
	$_POST["email"]=trim($_POST["email"]);
	if(strlen($_POST["email"])==0){
		$poruke["email"]="* E-mail obavezno";
	}
	
	$izraz=$veza->prepare("select email from korisnik where email=:email");
	$izraz->execute(array("email" => $_POST["email"]));
	$provjeraemail=$izraz -> fetchColumn();
	if ($provjeraemail==null){
		$poruke["email"]="* Taj E-mail ne postoji";
	}
	
	$_POST["oib"]=trim($_POST["oib"]);
	if(strlen($_POST["oib"])==0){
		$poruke["oib"]="* OIB obavezno";
	}
	$izraz=$veza->prepare("select oib from korisnik where email=:email");
	$izraz->execute(array("email" => $_POST["email"]));
	$provjeraoib=$izraz -> fetchColumn();
	if ($provjeraoib!=$_POST["oib"]){
		$poruke["oib"]="* OIB neispravan";
	}
	
	
	$_POST["lozinka"]=trim($_POST["lozinka"]);
	if(strlen($_POST["lozinka"])==0){
		$poruke["lozinka"]="* Lozinka obavezno";
	}
	$izraz=$veza->prepare("select lozinka from korisnik where email=:email");
	$izraz->execute(array("email" => $_POST["email"]));
	$provjeralozinka=$izraz -> fetchColumn();
	if ($provjeralozinka!=md5($_POST["lozinka"])){
		$poruke["lozinka"]="* Lozinka neispravna";
	}
	
	

	
	