<?php
    try {
		$db = new PDO("mysql:host=localhost;dbname=testsystem;","root", "");
	} 
	catch (PDOException $exception) {
		echo $exception->getMassage();
	}
?>