<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
	header("Location: index.php");
	exit;
}
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Админ-Панель</title>
	<link rel="stylesheet" type="text/css" href="stylesheel.css">
</head>
<body>
	<header id="navbar">
		<div class="logo"><a href="admin.php">Админ-<span>Панель</span></a></div>
	</header>
    <main id="main">
    	<nav>
			<ul class="sidebar">
		      <li><a href="view_users.php">Пользователи</a></li>
		      <li><a href="view_posts.php">Статьи</a></li>
		      <li><a href="index.php">Главная</a></li>
		      <li><a href="logout.php">Выйти</a></li>
    		</ul>
		</nav>
		<div id="content-wrapper">
			<h1 class="title">Главная</h1><hr />
			<div class="container">
  				<h1>Нужно дополнить инфу</h1>
  			</div>
		</div>
	</main>
	<footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>
