<?php
include_once 'konfig.php';
$lozinka = 'lozinka';


$izraz=$veza->prepare("select lozinka from korisnik where sifra=1");
	$izraz->execute();
	$provjeralozinke=$izraz -> fetchColumn();
	if ($provjeralozinke!=md5($lozinka)){
		$poruke["staralozinka"]="Stara lozinka nije točna";
	}
	