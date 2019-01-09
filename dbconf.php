<?php

	 $DBhost = "localhost";
	 $DBuser = "root";
	 $DBpass = "";
	 $DBname = "Student";
	 $charset = "utf8";
	 
	 $mysql = new mysqli($DBhost,$DBuser,$DBpass,$DBname);
    
     if ($mysql->connect_errno) {
         die("ERROR : -> ".$mysql->connect_error);
     }

     $queryvz = $mysql->query("SELECT * FROM `users`");
     $queryvp = $mysql->query("SELECT * FROM `post`");
?>