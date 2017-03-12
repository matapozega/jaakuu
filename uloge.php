<?php

function isAdmin() {
	//print_r($_SESSION[$GLOBALS["sid"] . "autoriziran"]);
	if ($_SESSION[$GLOBALS["sid"] . "autoriziran"] -> uloga === "admin") {
		return true;
	} else {
		return false;
	}
}