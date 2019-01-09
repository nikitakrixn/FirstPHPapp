<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
	header("Location: index.php");
	exit;
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
	$queryvd = $mysql->query("SELECT * FROM `post` WHERE id='$id'");
	while ($row=$queryvd->fetch_array()) {
		$title = $row['title'];
		$text = $row['text'];
		$prevtext = $row['prevtext'];
    	$like = $row['lykasi'];
    	$date = $row['date'];
	}
}


if(isset($_POST['submit'])){
	$id = $mysql->real_escape_string($_POST['id']);
	$title_ed = $mysql->real_escape_string($_POST['title']);
	$prevtext_ed = $mysql->real_escape_string($_POST['prevtext']);
	$text_ed = $mysql->real_escape_string($_POST['text']);
	if(empty($title_ed) OR empty($text_ed)) {
		$msg = "Заполните все поля!!!!";
	}else{
		$update = $mysql->query("UPDATE `post` SET title = '$title_ed', prevtext = '$prevtext_ed', text = '$text_ed' WHERE id='$id'");
		if($update != TRUE){
			$msg = "Ошибка: <br />";
			$msg .= $mysql->error;
		}else{
			$msg = "<font color='green'>Редактирование статьи успешно!</font>";
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
			<h1 class="title">Редактирование статьи</h1><hr />
			<form class="login" style="max-width: 400px" action="edit_post.php" method="post">
                <label for="title">Заголовок:</label>
                <input type="text" placeholder="Заголовок" name="title" tabindex="1" value="<?php echo $title;?>" />
                <label for="prevtext">Короткое описание:</label>
                <input type="text" placeholder="Короткое описание" name="prevtext" tabindex="2" value="<?php echo $prevtext;?>" />
                <label for="text">Текст:</label>
                <textarea placeholder="Текст" name="text" tabindex="3"><?php echo $text;?></textarea>
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