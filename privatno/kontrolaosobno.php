<?php

//radi provjere
	$_POST["videoid"]=trim($_POST["videoid"]);
	if(strlen($_POST["videoid"])==0){
		$poruke["videoid"]="videoid obavezan";
	}
		$_POST["pregleda"]=trim($_POST["pregleda"]);
	if(strlen($_POST["pregleda"])==0){
		$poruke["pregleda"]="Broj pregleda obavezno";
	}
		$_POST["likes"]=trim($_POST["likes"]);
	if(strlen($_POST["likes"])==0){
		$poruke["likes"]="Broj like-ova obavezno";
	}
			$_POST["dislikes"]=trim($_POST["dislikes"]);
	if(strlen($_POST["dislikes"])==0){
		$poruke["dislikes"]="Broj like-ova obavezno";
	}
	
	