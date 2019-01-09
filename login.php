<?php
session_start();
require_once 'dbconf.php';
if (isset($_SESSION['auth'])!="") {
	header("Location: index.php");
}
if(isset($_POST['login'])){
	$username = $_POST['username'];
	$password = $_POST['password'];

	if(empty($username) || empty($password)){
		$msg = "Заполните все поля.";
	}else{
		$username = $mysql->real_escape_string($username);
		$password = $mysql->real_escape_string($password);

		$query = $mysql->query("SELECT id,access FROM users WHERE login = '$username' AND password = md5('$password')");
		$row=$query->fetch_array(MYSQLI_ASSOC);
		if($query->num_rows == 0){	
			$msg = "Неверный логин или пароль.";
		}else{
			if($row['access'] > 0){
				$_SESSION['login_admin'] = 'admin';
				header('location:admin.php');
			}
			else{
				
				$_SESSION['login_user'] = 'user';
				header('location:index.php');
			}
			$_SESSION['auth'] = true;
			$_SESSION['user'] = $username;
			exit();
		}
	}
	$mysql->close();
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Авторизация</title>
	<link rel="stylesheet" type="text/css" href="stylesheel.css">
</head>
<body>
	<form class="login" action="login.php" method="post">
		<h2>Форма авторизации</h2> <p> </p>

		<input type="text" name="username" required="required" placeholder="Логин" autofocus required></input>
		<input type="password" name="password" required="required" placeholder="Пароль" required></input>
		<input type="submit" name="login" value="Авторизоваться"></input>

		<div class="links">
    		<a href="register.php">Зарегистрироваться</a>
  		</div>
  		<?php
			if(isset($msg)){echo "<font color='red'>$msg</font>";} ?>
  	</form>
</body>
</html>