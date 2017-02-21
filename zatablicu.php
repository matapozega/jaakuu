<?php

$videoid = array('cHHLHGNpCSA', 'E2PglxuFtUg', 'IcrbM1l_BoI', 'IXdNnw99-Ic', 'K6S4O-VtZBI', '-Du-CWASm20', 'KCy7lLQwToI', 'b4Bj7Zb-YD4', 'PT2_F-1esPk', 'AeGfss2vsZg', 'RgKAFK5djSk', 'vjW8wmF5VWc', 'j7leQB_Oe_k', 'O4irXQhgMqg', 'P9JoZwkliSI', 'EAeZPiZbpvw', 'Jw1R40lRlI4', 'pzVhub-FziQ', '0IofpvkGJPM', 'DVoBVEDiCIQ', 'Z6YjGldSD8A', 'YKsksDrZs8s');
// usipavanje u video tablicu
echo "insert into video (videoid,pregleda,likes,dislikes,datum) values <br />";
$length = count($videoid);
for ($i = 0; $i < $length; $i++) {
	
	if ($i < $length-1) {
		echo "('" . $videoid[$i] . "', " . mt_rand(1000000, 10000000000) . ", " . mt_rand(1, 1000000) . ", " . mt_rand(1, 100000) . ", '" . date('Y-m-d', strtotime('+' . mt_rand(-5000, 0) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "'),<br />";
	} else {
		echo "('" . $videoid[$i] . "', " . mt_rand(1000000, 10000000000) . ", " . mt_rand(1, 1000000) . ", " . mt_rand(1, 100000) . ", '" . date('Y-m-d', strtotime('+' . mt_rand(-5000, 0) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "');<br />";
	}
}



// usipavanje u tipponude tablicu
echo "insert into tipponude (naziv,opis) values <br />";
for ($i = 1; $i < 16; $i++) {
	if ($i < 15) {
		echo "('tip ponude" . $i . "', 'ponuda tipa" . $i . "'  ),<br />";
	} else {
		echo "('tip ponude" . $i . "', 'ponuda tipa" . $i . "'  );<br />";
	}
}


// usipavanje u ponuda tablicu
echo "insert into ponuda (video,tipponude,trajeod,trajedo,koeficijent) values <br />";
for ($i = 1; $i < 51; $i++) {
	$od = "'" . date('Y-m-d', strtotime('+' . mt_rand(-30, 30) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "'";
	$do = "'" . date('Y-m-d', strtotime('+' . mt_rand(-30, 30) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "'";
	if ($i < 50) {
		echo "(" . mt_rand(1, $length) . ", " . mt_rand(1, 15) . ", " . (($od < $do) ? $od : $do) . ", " . (($od < $do) ? $do : $od) . ", " . mt_rand(1 * 100, 10 * 100) / 100 . " ),<br />";
	} else {
		echo "(" . mt_rand(1, $length) . ", " . mt_rand(1, 15) . ", " . (($od < $do) ? $od : $do) . ", " . (($od < $do) ? $do : $od) . ", " . mt_rand(1 * 100, 10 * 100) / 100 . " );<br />";
	}
}



// usipavanje u korisnik tablicu
//lista imena
$names = array('Allison', 'Arthur', 'Ana', 'Alex', 'Arlene', 'Alberto', 'Barry', 'Bertha', 'Bill', 'Bonnie', 'Bret', 'Beryl', 'Chantal', 'Cristobal', 'Claudette', 'Charley', 'Cindy', 'Chris', 'Dean', 'Dolly', 'Danny', 'Danielle', 'Dennis', 'Debby', 'Erin', 'Edouard', 'Erika', 'Earl', 'Emily', 'Ernesto', 'Felix', 'Fay', 'Fabian', 'Frances', 'Franklin', 'Florence', 'Gabielle', 'Gustav', 'Grace', 'Gaston', 'Gert', 'Gordon', 'Humberto', 'Hanna', 'Henri', 'Hermine');
//lista prezimena
$last_names = array('Abbott', 'Acevedo', 'Ayers', 'Bailey', 'Baird', 'Baker', 'Blevins', 'Cervantes', 'Chambers', 'Dudley', 'Duffy', 'Duke', 'Duncan', 'Dunlap', 'Dunn', 'Duran', 'Durham', 'Dyer', 'Eaton', 'Edwards', 'Elliott', 'Ellis', 'Ellison', 'Emerson', 'England', 'Farley', 'Farmer', 'Farrell', 'Faulkner', 'Ferguson', 'Fernandez', 'Ferrell', 'Fields', 'Hatfield', 'Hawkins', 'Hayden', 'Hayes', 'Haynes', 'Hays', 'Head', 'Heath', 'Hebert', 'Henderson', 'Mcgee', 'Mcgowan', 'Mcguire', 'Mcintosh');
//generator pass
//lista mail adresa
$mail = array('@gmail.com', '@yaahoo.com', '@example.com', '@mail.to', '@live.com', '@net.com', '@hotmail.com');
echo "insert into korisnik (email,lozinka,ime,prezime,oib,datrodenja,aktivan,postanskibr,drzava,mjesto,ulica) values <br />";
for ($i = 1; $i < 51; $i++) {
	$ime = array_rand($names);
	$prez = array_rand($last_names);
	$nast = array_rand($mail);
	$pass = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 10);
	$gradovi = array("Buffalo","New York","Ridgewood","Utica","Port Washington","Brecksville","Streetsboro","Hartford","Nashville","Chester","Richmond","Jacksonville","Kissimmee","Clinton","Denver","Fort Worth","Brandon","Dover","Union Township","Nazareth","Pine Brook","Edison","Redwood City","Arvada","Pineville","Ponte Vedra Beach","Sarasota","Jackson","Nacogdoches","Tomball","McKinney","Little Rock","Dallas","Halethorpe","Crofton","Northbrook","Palatine");
	$pokrajine = array('AL' => 'ALABAMA', 'AK' => 'ALASKA', 'AS' => 'AMERICAN SAMOA', 'AZ' => 'ARIZONA', 'AR' => 'ARKANSAS', 'CA' => 'CALIFORNIA', 'CO' => 'COLORADO', 'CT' => 'CONNECTICUT', 'DE' => 'DELAWARE', 'DC' => 'DISTRICT OF COLUMBIA', 'FM' => 'FEDERATED STATES OF MICRONESIA', 'FL' => 'FLORIDA', 'GA' => 'GEORGIA', 'GU' => 'GUAM GU', 'HI' => 'HAWAII', 'ID' => 'IDAHO', 'IL' => 'ILLINOIS', 'IN' => 'INDIANA', 'IA' => 'IOWA', 'KS' => 'KANSAS', 'KY' => 'KENTUCKY', 'LA' => 'LOUISIANA', 'ME' => 'MAINE', 'MH' => 'MARSHALL ISLANDS', 'MD' => 'MARYLAND', 'MA' => 'MASSACHUSETTS', 'MI' => 'MICHIGAN', 'MN' => 'MINNESOTA', 'MS' => 'MISSISSIPPI', 'MO' => 'MISSOURI', 'MT' => 'MONTANA', 'NE' => 'NEBRASKA', 'NV' => 'NEVADA', 'NH' => 'NEW HAMPSHIRE', 'NJ' => 'NEW JERSEY', 'NM' => 'NEW MEXICO', 'NY' => 'NEW YORK', 'NC' => 'NORTH CAROLINA', 'ND' => 'NORTH DAKOTA', 'MP' => 'NORTHERN MARIANA ISLANDS', 'OH' => 'OHIO', 'OK' => 'OKLAHOMA', 'OR' => 'OREGON', 'PW' => 'PALAU', 'PA' => 'PENNSYLVANIA', 'PR' => 'PUERTO RICO', 'RI' => 'RHODE ISLAND', 'SC' => 'SOUTH CAROLINA', 'SD' => 'SOUTH DAKOTA', 'TN' => 'TENNESSEE', 'TX' => 'TEXAS', 'UT' => 'UTAH', 'VT' => 'VERMONT', 'VI' => 'VIRGIN ISLANDS', 'VA' => 'VIRGINIA', 'WA' => 'WASHINGTON', 'WV' => 'WEST VIRGINIA', 'WI' => 'WISCONSIN', 'WY' => 'WYOMING', 'AE' => 'ARMED FORCES AFRICA \ CANADA \ EUROPE \ MIDDLE EAST', 'AA' => 'ARMED FORCES AMERICA (EXCEPT CANADA)', 'AP' => 'ARMED FORCES PACIFIC');
	$grad = array_rand($gradovi);
	$ulica = array_rand($pokrajine);
	if ($i < 50) {
		echo "('" . $names[$ime] . $last_names[$prez] . $mail[$nast] . "', '" . md5($pass) . "', '" . $names[$ime] . "', '" . $last_names[$prez] . "', '" . mt_rand(10000, 99999) . mt_rand(100000, 999999) .  "', '" . date('Y-m-d', strtotime('+' . mt_rand(-12000, -9000) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "', " . mt_rand(0, 1) . ", " . mt_rand(10000, 99999) . ", 'USA', '" . $gradovi[$grad] . "', '" . $pokrajine[$ulica] . "'),<br />";
	} else {
		echo "('" . $names[$ime] . $last_names[$prez] . $mail[$nast] . "', '" . md5($pass) . "', '" . $names[$ime] . "', '" . $last_names[$prez] . "', '" . mt_rand(10000, 99999) . mt_rand(100000, 999999) .  "', '" . date('Y-m-d', strtotime('+' . mt_rand(-12000, -9000) . ' days')) . " " . date('H', strtotime('+' . mt_rand(0, 24) . ' hours')) . ":" . rand(1, 59) . ":" . rand(1, 59) . "', " . mt_rand(0, 1) . ", " . mt_rand(10000, 99999) . ", 'USA', '" . $gradovi[$grad] . "', '" . $pokrajine[$ulica] . "');<br />";
	
	}
}


// usipavanje u novcanik tablicu
echo "insert into novcanik (korisnik,stanje,valuta) values <br />";
for ($i = 1; $i < 51; $i++) {
	if ($i < 50){
	echo "(" . $i . ", " . mt_rand(0 * 100, 1000 * 100) / 100 . ", 'Jaakuu'),<br />";
}else {
	echo "(" . $i . ", " . mt_rand(0 * 100, 1000 * 100) / 100 . ", 'Jaakuu');<br />";
	}
}



// usipavanje u listic tablicu
echo "insert into listic (status,korisnik,uplata,ukupnikoeficijent) values <br />";
for ($i = 1; $i < 501; $i++) {
	if ($i < 500){
	echo "(" . 1 . ", " . mt_rand(1, 50) . ", " . mt_rand(0 * 100, 100 * 100) / 100 . ", " . mt_rand(0 * 100, 1000 * 100) / 100 . "),<br />";
}else {
	echo "(" . 1 . ", " . mt_rand(1, 50) . ", " . mt_rand(0 * 100, 100 * 100) / 100 . ", " . mt_rand(0 * 100, 1000 * 100) / 100 . ");<br />";
	}
}


// usipavanje u listic_ponuda tablicu
echo "insert into listic_ponuda (listic,ponuda) values <br />";
for ($i = 1; $i < 2001; $i++) {
	if ($i < 2000){
	echo "(" . mt_rand(1, 500) . ", " . mt_rand(1, 50) . "),<br />";
}else {
	echo "(" . mt_rand(1, 500) . ", " . mt_rand(1, 50) . ");<br />";
	}
}