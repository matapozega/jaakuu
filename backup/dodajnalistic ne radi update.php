<?php
include_once '../konfig.php';
if(!isset($_SESSION[$sid . "autoriziran"])){
	header("location: ../logout.php");
	exit;
}


//if (!isset($_POST["id"]) && !isset($_POST["koef"])){ 
//	header("location: ../logout.php");
//	exit;
//}

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
	$izraz = $veza -> prepare("select a.listic, a.ponuda, a.koeficijent,
	    b.sifra, b.status, b.korisnik, b.uplata, b.ukupnikoeficijent
		from listic_ponuda a 
		inner join listic b on a.listic=b.sifra
		inner join ponuda c on a.ponuda=c.sifra
		where listic=:listic");
	$izraz->execute(array("listic" => $status->sifra));
	$status=$izraz->fetch(PDO::FETCH_OBJ);
	
	echo $status->ponuda; 
	echo "  ";
	print_r($_POST["id"]);
	echo "  ";
	if ($status->ponuda==$_POST["id"]){
		$izraz = $veza->prepare("update listic_ponuda set koeficijent=:koef where listic=:sifra");
		$izraz->execute(array("sifra"=>518,"koef"=>$_POST["koef"]));
		echo "OK update listic_ponuda set koeficijent=:koef where listic=:sifra";
	}
	else{
		
		$izraz = $veza->prepare("insert into listic_ponuda (listic, ponuda,koeficijent) 
		values (:sifra,:id,:koef)");
		$izraz->execute(array("sifra"=>518,"id"=>$_POST["id"],"koef"=>$_POST["koef"]));
		echo "OK  insert into listic_ponuda (listic, ponuda,koeficijent) 
		values (:sifra,:id,:koef)";
		
	}
	
	
}



