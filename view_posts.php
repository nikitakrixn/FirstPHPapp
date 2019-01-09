<?php
session_start();
require_once 'dbo.php';
if(!$_SESSION['login_admin']){
  header("Location: index.php");
  exit;
}
  if(isset($_GET['delete'])){
    $sql = 'DELETE FROM `post` WHERE id=$id';
    $id = $_GET['delete'];
    $result = $pdo->prepare($sql);
    $result->execute(array(':id' => $id));
    header("Location:view_posts.php");
  }
  $today = date("D M j G:i:s T Y");
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
          <li><a href="view_posts">Статьи</a></li>
          <li><a href="index">Главная</a></li>
          <li><a href="logout">Выйти</a></li>
        </ul>
    </nav>
    <div id="content-wrapper">
      <h1 class="title">Статьи</h1>
      <hr />
      <!--ТАБЛИЦА-->
      <table class="table data">
        <!--Столбцы-->
        <thead>
          <tr>
            <th>ID</th>
            <th>TITLE</th>
            <th>PREVTEXT</th>
            <th>ACTION<a href="add_post.php" class="add">Добавить</button></th></th>
          </tr>
        </thead>
        <!--СТРОКИ-->
        <tbody>
          <?php while ($row=$resultvp->fetch()) { ?>
            <tr>
              <td class="data"><?php echo $row['id']; ?></td>
              <td class="data"><?php echo $row['title']; ?></td>
              <td class="data"><?php echo $row['prevtext']; ?></td>
              <td class="data">
              <a href="edit_post.php?edit=<?php echo $row['id']; ?>" class="edit">Редактировать</a>
              <a href="view_posts.php?delete=<?php echo $row['id']; ?>" class="delete">Удалить</a></td>
            </tr>
          <?php } echo $today; ?>
        </tbody>
      </table>
    </div>
  </main>
  <footer>Привет, я что-то сделал в своей жизни :)</footer>
</body>
</html>