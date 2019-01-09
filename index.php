<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
require_once 'dbconf.php';
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
  header("location: login.php");
  exit();
}
$post = $mysql->query("SELECT * FROM `post`");

?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Домашняя Страничка</title>
	<link rel="stylesheet" type="text/css" href="stylesheel.css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<header id="navbar">
    <div class="logo"><a href="index.php">Главная<span> страница</span></a></div>
    <div id="navButtons">
    	<a class="navButton" href="logout.php">Выйти</a>
      	<?php if($_SESSION['login_admin']){ echo
          '<a class="navButton" href="admin.php">Админ Панель</a>';
        }else{}?>
      	<a class="navButton" href="index.php">Главная</a>
    </div>
  </header>
  <h1 class="titleh">Добро Пожаловать!</h1><hr>
  <p>
    <main class='blog-wrapper'>
    <?php if($post->num_rows > 0){ 
      while ($row = $post->fetch_assoc()) {
        echo "<div class='blog-card'><div class='card-img'></div><h1>" .$row['title'] . "</h1><div class='card-details'><span><i class='fa fa-calendar'></i>" .$row['date'] . "</span><span><i class='fa fa-heart'></i>" . $row['lykasi'] . "</span></div><div class='card-text'><p>" .$row['prevtext'] . "</p></div><div class='read-more'><a href='view_post.php?id=" . $row['id'] . "'>Читать</a></div></div>";
      }
    }
    ?>
  </main>
  <footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>