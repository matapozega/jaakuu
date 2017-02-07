<?php

//radi provjere
	$_POST["naziv"]=trim($_POST["naziv"]);
	if(strlen($_POST["naziv"])==0){
		$poruke["naziv"]="Naziv obavezno";
	}
		$_POST["opis"]=trim($_POST["opis"]);
	if(strlen($_POST["opis"])==0){
		$poruke["opis"]="Opis obavezno";
	}
	if(strlen($_POST["naziv"])>50){
		$poruke["naziv"]="Dužina naziva mora biti manja od 50";
	}
	