<?php
session_start();
require_once 'dbo.php';
if(!isset($_SESSION['auth']) || empty($_SESSION['auth'])){
  header("location: login.php");
  exit();
}
if(isset($_GET['id'])){
    $sql = 'SELECT * FROM `post` WHERE id=:id';
    $id = $_GET['id'];
    $result = $pdo->prepare($sql);
    $result->execute(array(':id' => $id)); 
    while($row = $result->fetch())  {
      $title = $row['title'];
      $textu = $row['text'];
      $like = $row['lykasi'];
      $date = $row['date'];
  }
}
?>
<!DOCTYPE html>
<html lang="en">
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
      <a class="navButton" href="logout">Выйти</a>
        <?php if($_SESSION['login_admin']){ echo
          '<a class="navButton" href="admin">Админ Панель</a>';
        }else{}?>
        <a class="navButton" href="index">Главная</a>
    </div>
  </header>
    <main class='blog-wrapper'>
      <div class='blog-card'>
        <div class='card-img'></div>
        <h1> <? echo $title; ?> </h1>
        <div class='card-details'><span><i class='fa fa-calendar'></i> <? echo $date; ?></span><span><i class='fa fa-heart'></i><? echo $like; ?> </span></div>
        <div class='card-text'><p><? echo $textu; ?></p></div>
      </div>
  </main>
  <footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>