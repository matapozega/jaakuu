<?php

include_once 'funkcije.php';

//radi provjere
	$_POST["ime"]=trim($_POST["ime"]);
	if(strlen($_POST["ime"])==0){
		$poruke["ime"]="* Ime obavezno";
	}
	if(strlen($_POST["ime"])>50){
		$poruke["ime"]="Dužina imena mora biti manja od 50";
	}
	$_POST["prezime"]=trim($_POST["prezime"]);
	if(strlen($_POST["prezime"])==0){
		$poruke["prezime"]="* Prezime obavezno";
	}
	if(strlen($_POST["prezime"])>50){
		$poruke["prezime"]="Dužina prezimena mora biti manja od 50";
	}
	$_POST["oib"]=trim($_POST["oib"]);
	if(strlen($_POST["oib"])==0){
		$poruke["oib"]="* OIB obavezno";
	}
	if(!provjeriOIB($_POST["oib"])){
		$poruke["oib"]="OIB neispravan";
	}
	
	$izraz=$veza->prepare("select count(oib) from korisnik where oib=:oib");
	$izraz->execute(array("oib" => $_POST["oib"]));
	$provjeraoib=$izraz -> fetchColumn();
	if ($provjeraoib>0){
		$poruke["oib"]="* OIB neispravan";
	}
	
	$_POST["datrodenja"]=trim($_POST["datrodenja"]);
	if(strlen($_POST["datrodenja"])==0){
		$poruke["datrodenja"]="* Datum rođenja obavezno";
	}	
	
	$_POST["ulica"]=trim($_POST["ulica"]);
	if(strlen($_POST["ulica"])==0){
		$poruke["ulica"]="* Ulica obavezno";
	}
	$_POST["mjesto"]=trim($_POST["mjesto"]);
	if(strlen($_POST["mjesto"])==0){
		$poruke["mjesto"]="* Mjesto obavezno";
	}
	$_POST["drzava"]=trim($_POST["drzava"]);
	if(strlen($_POST["drzava"])==0){
		$poruke["drzava"]="* Država obavezno";
	}
	$_POST["postanskibr"]=trim($_POST["postanskibr"]);
	if(strlen($_POST["postanskibr"])==0){
		$poruke["postanskibr"]="* Poštanski broj obavezno";
	}
	$_POST["email"]=trim($_POST["email"]);
	if(strlen($_POST["email"])==0){
		$poruke["email"]="* E-mail obavezno";
	}
	
	$izraz=$veza->prepare("select count(email) from korisnik where email=:email");
	$izraz->execute(array("email" => $_POST["email"]));
	$provjeraemail=$izraz -> fetchColumn();
	if ($provjeraemail>0){
		$poruke["email"]="* E-mail se već koristi";
	}
	
	
	$_POST["lozinka"]=trim($_POST["lozinka"]);
	if(strlen($_POST["lozinka"])==0){
		$poruke["lozinka"]="* Lozinka obavezno";
	}
	$_POST["potvrdi_lozinku"]=trim($_POST["potvrdi_lozinku"]);
	if(strlen($_POST["potvrdi_lozinku"])==0){
		$poruke["potvrdi_lozinku"]="* Obavezno ponoviti lozinku";
	}
	if($_POST["potvrdi_lozinku"]!=$_POST["lozinka"]){
		$poruke["potvrdi_lozinku"]="* Lozinke se ne podudaraju";
		$poruke["lozinka"]="* Lozinke se ne podudaraju";
	}

	
	