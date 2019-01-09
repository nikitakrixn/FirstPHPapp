<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
	header("Location: index.php");
	exit;
}
if(isset($_POST['submit'])){
	$username = $mysql->real_escape_string($_POST['username']);
	$password = $mysql->real_escape_string($_POST['password']);
	$dostup = $mysql->real_escape_string($_POST['dostup']);

	$query = $mysql->query("SELECT * FROM `users` WHERE login = '$username'");
	if(empty($username) OR empty($password) OR empty($dostup)) {
		$msg = "Заполните все поля!!!!";
	}elseif($query->num_rows != 0){
		$msg = "Этот логин уже используется. Придумайте другой";
	}elseif (!is_numeric($dostup)) {
		$msg = "Вы должны ввести цифру";
	}elseif (strlen($password) < 6) {
		$msg = "Пароль должен быть больше 5 символов!";
	}else{
		$hashed_password = md5($password);
		$insert = $mysql->query("INSERT INTO `users` (login,password,access) VALUES ('$username','$hashed_password','$dostup')");
			if($insert != TRUE){
				$msg = "Ошибка: <br />";
				$msg .= $mysql->error;
			}else{
				$msg = "<font color='green'>Регистрация завершена!</font>";
			}
	}
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
			<h1 class="title">Добавление пользователя</h1><hr />
			<form class="login" style="max-width: 400px" action="add_user.php" method="post">
				<h2>Добавление пользователя</h2>
				<p></p>
				<input type="text" name="username" required="required" placeholder="Логин" autofocus required></input>
				<input type="password" name="password" required="required" placeholder="Пароль" required></input>
				<input type="text" name="dostup" required="required" placeholder="Доступ" required></input>
				<input type="submit" name="submit" value="Добавить"></input>
				<div class="links">
		    	</div>
		    	<?php
					if(isset($msg)){echo "<font color='red'>$msg</font>";} ?>
		  	</form>
		</div>
	</main>
	<footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>