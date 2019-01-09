<?php
require_once 'dbconf.php';
if (isset($_SESSION['auth'])!="") {
	header("Location: index.php");
}
if(isset($_POST['submit'])){
	$username = $mysql->real_escape_string($_POST['username']);
	$password = $mysql->real_escape_string($_POST['password']);
	$cpassword = $mysql->real_escape_string($_POST['cpassword']);

	$query = $mysql->query("SELECT * FROM `users` WHERE login = '$username'");
	if(empty($username) OR empty($password) OR empty($cpassword)) {
		$msg = "Заполните все поля!!!!";
	}elseif($query->num_rows != 0){
		$msg = "Этот логин уже используется. Придумайте другой";
	}elseif ($password !=$cpassword) {
		$msg = "Ваш пароль не подходит!";
	}elseif (strlen($password) < 6) {
		$msg = "Ваш пароль должен быть больше 5 символов!";
	}else{
		$hashed_password = md5($password);
		$insert = $mysql->query("INSERT INTO `users` (login,password,access) VALUES ('$username','$hashed_password',0)");
			if($insert != TRUE){
				$msg = "Ошибка: <br />";
				$msg .= $mysql->error;
			}else{
				$msg = "<font color='green'>Регистрация завершена!</font>";
			}
	}
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Регистрация</title>
	<link rel="stylesheet" type="text/css" href="stylesheel.css">
</head>
<body>
	<form class="login" action="register.php" method="post">
		<h2>Форма регистрации</h2>
		<p></p>
		<input type="text" name="username" required="required" placeholder="Логин" autofocus required></input>
		<input type="password" name="password" required="required" placeholder="Пароль" required></input>
		<input type="password" name="cpassword" required="required" placeholder="Подтвердите пароль" required></input>
		<input type="submit" name="submit" value="Зарегестрироваться"></input>
		<div class="links">
    		<a href="login.php">Авторизоваться</a>
    	</div>
    	<?php
			if(isset($msg)){echo "<font color='red'>$msg</font>";} ?>
  	</form>
</body>
</html>