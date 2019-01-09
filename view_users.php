<?php
session_start();
require_once 'dbconf.php';
if(!$_SESSION['login_admin']){
  header("Location: index.php");
  exit;
}
  if(isset($_GET['delete'])){
    $id = $_GET['delete'];

    $mysql->query("DELETE FROM `users` WHERE id=$id");
    header("Location:view_users.php");
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
      <h1 class="title">Пользователи</h1>
      <hr />
      <!--ТАБЛИЦА-->
      <table class="table data">
        <!--Столбцы-->
        <thead>
          <tr>
            <th>ID</th>
            <th>USERNAME</th>
            <th>ACCESS LVL</th>
            <th>ACTION<a href="add_user.php" class="add">Добавить</button></th></th>
          </tr>
        </thead>
        <!--СТРОКИ-->
        <tbody>
          <?php while ($row=$queryvz->fetch_array()) { ?>
            <tr>
              <td class="data"><?php echo $row['id']; ?></td>
              <td class="data"><?php echo $row['login']; ?></td>
              <td class="data"><?php echo $row['access']; ?></td>
              <td class="data">
              <a href="edit_user.php?edit=<?php echo $row['id']; ?>" class="edit">Редактировать</a>
              <a href="view_users.php?delete=<?php echo $row['id']; ?>" class="delete">Удалить</a></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </main>
  <footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>