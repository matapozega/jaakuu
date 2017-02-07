<?php

//radi provjere
		$_POST["trajeod"]=trim($_POST["trajeod"]);
	if(strlen($_POST["trajeod"])==0){
		$poruke["trajeod"]="Trajanje obavezno";
	}
		$_POST["trajedo"]=trim($_POST["trajedo"]);
	if(strlen($_POST["trajedo"])==0){
		$poruke["trajedo"]="Trajanje obavezno";
	}
	if($_POST["trajeod"]>=$_POST["trajedo"]){
		$poruke["trajeod"]="Ponuda mora trajati nekoliko dana";
		$poruke["trajedo"]="Ponuda mora trajati nekoliko dana";
	}
/*		$_POST["vise"]=trim($_POST["vise"]);
	if(!is_float($_POST["vise"])){
		$poruke["vise"]="Koeficijent mora biti u decimalnom zapisu";
	}
		$_POST["manje"]=trim($_POST["manje"]);
	if(!is_float($_POST["manje"])){
		$poruke["manje"]="Koeficijent mora biti u decimalnom zapisu";
	}
	*/