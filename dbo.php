<?php

	$DBhost = "localhost";//ПАОФЫВ
	$DBuser = "root";//ЛАГИН
	$DBpass = "";//ПАСС
	$DBname = "Student"; //БЖД
	$pdo = new PDO('mysql:host=localhost;dbname=Student;charset=utf8','root','');

	$sqlvp = 'SELECT * FROM `post`';
	$resultvp = $pdo->query($sqlvp);

	$sqlvz = 'SELECT * FROM `users`';
	$resultvz = $pdo->query($sqlvz);
?>