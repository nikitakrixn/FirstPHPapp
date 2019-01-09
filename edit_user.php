<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
	header("Location: index.php");
	exit;
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
	$queryed = $mysql->query("SELECT * FROM `users` WHERE id='$id'");
	while ($row=$queryed->fetch_array()) {
		$login = $row['login'];
		$dostp = $row['access'];
	}
}


if(isset($_POST['submit'])){
	$id = $mysql->real_escape_string($_POST['id']);
	$username = $mysql->real_escape_string($_POST['username']);
	$dostup = $mysql->real_escape_string($_POST['dostup']);

	$query = $mysql->query("SELECT * FROM `users` WHERE login = '$username'");
	if(empty($username) OR empty($dostup)) {
		$msg = "Заполните все поля!!!!";
	}elseif (!is_numeric($dostup)) {
		$msg = "Вы должны ввести цифру";
	}else{
		$update = $mysql->query("UPDATE `users` SET login = '$username', access = '$dostup' WHERE id='$id'");
			if($update != TRUE){
				$msg = "Ошибка: <br />";
				$msg .= $mysql->error;
			}else{
				$msg = "<font color='green'>asdasdaние успешно!</font>";
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
			<h1 class="title">Редактирование пользователя</h1><hr />
			<form class="login" style="max-width: 400px" action="edit_user.php" method="post">
				<h2>Редактирование пользователя</h2>
				<p></p>
				<input type="text" name="username" required="required" placeholder="Логин" value="<?php echo $login;?>" autofocus required></input>
				<label for="dostup">Доступ:</label>
				<div class="selectdiv">
				<select name="dostup">
					<option selected value="<?php echo $dostp;?>"><?php echo $dostp;?></option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
				</select>
				<input type="hidden" name="id" required="required" value="<?php echo $_GET['edit'];?>"></input>
				<input type="submit" name="submit" value="Редактировать"></input>
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