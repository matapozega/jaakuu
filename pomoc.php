<?php

include_once 'konfig.php';

$izraz = $veza -> prepare("
    select a.status,a.sifra,d.sifra as tip from listic a inner join listic_ponuda b on a.sifra=b.listic
	inner join ponuda c on c.sifra=b.ponuda 
	inner join tipponude d on d.sifra=c.tipponude where a.sifra=504;");
	$izraz->execute();
	$listic=$izraz->fetch(PDO::FETCH_OBJ);
	
	echo $listic->tip;
	
	
	$izraz = $veza -> prepare("select count(a.ponuda) from listic_ponuda a inner join ponuda b on a.ponuda=b.sifra 
	inner join tipponude c on c.sifra=b.tipponude where a.listic=:listic and (a.ponuda like :ponudaid or b.tipponude like :tipponude) ");
	$izraz->execute(array("listic" => 504,"tipponude" => $listic->tip,"ponudaid"=>41));
	$provjera=$izraz->fetchColumn();
	
	echo $provjera;