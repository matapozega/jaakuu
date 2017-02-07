<?php 



//koristiti u produkciji
error_reporting(0);

//prikazuje sve greške, upozorenja i bilješke
error_reporting(E_ALL);

//dobro za rad
error_reporting(E_ERROR | E_WARNING | E_PARSE);
//ili
ini_set('error_reporting', E_ERROR | E_WARNING | E_PARSE);

$naslov="Jaakuu";

session_start();
$formatDatumaPHP="d.m.Y.";
$formatDatumaJS="dd.mm.yy.";
$sid='jaakuu';
$GLOBALS["sid"]=$sid;

if($_SERVER["SERVER_NAME"]==="localhost"){
	$putanjaIMG="c:/xampp/htdocs/jaakuu/img/";
	$putanjaAPP="/jaakuu/";
	$host="localhost";
	$baza="jaakuu";
	$username="edunova";
	$password="edunova";
}else{
	$putanjaIMG="/home/vol3_3/byethost7.com/b7_19171738/htdocs/img/";
	$putanjaAPP="/";
	$host="sql304.byethost7.com";
	$baza="b7_19171738_jaakuu";
	$username="b7_19171738";
	$password="GjSq.865";
}

$veza = new PDO(
	"mysql:host=" . $host . ";dbname=" . $baza, $username, $password, 
		array(
			PDO::ATTR_EMULATE_PREPARES=> false,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8",
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
		)
	);

 ?>