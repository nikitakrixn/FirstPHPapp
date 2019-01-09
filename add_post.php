<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
	header("Location: index.php");
	exit;
}
if(isset($_POST['submit'])){
	$title_ad = $mysql->real_escape_string($_POST['title']);
	$prevtext_ad = $mysql->real_escape_string($_POST['prevtext']);
	$text_ad = $mysql->real_escape_string($_POST['text']);
	$today = date("Y-m-d");
	if(empty($title_ad) OR empty($text_ad)) {
		$msg = "Заполните все поля!!!!";
	}else{
		$insert = $mysql->query("INSERT INTO `post` (title,text,prevtext,date, lykasi) VALUES ('$title_ad','$text_ad', '$prevtext_ad', '$today', 0)");
		if($insert != TRUE){
			$msg = "Ошибка: <br />";
			$msg .= $mysql->error;
		}else{
			$msg = "<font color='green'>Добавление статьи завершено!</font>";
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
			<h1 class="title">Добавление статьи</h1><hr />
			<form class="login" style="max-width: 400px" action="add_post.php" method="post">
                <label for="title">Заголовок:</label>
                <input type="text" placeholder="Заголовок" name="title" tabindex="1" />
                <label for="prevtext">Короткое описание:</label>
                <input type="text" placeholder="Короткое описание" name="prevtext" tabindex="2" />
                <label for="text">Текст:</label>
                <textarea placeholder="Текст" name="text" tabindex="3"></textarea>
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