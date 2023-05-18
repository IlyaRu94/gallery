<?php
session_start();
include 'bd.php';
require 'config.php';

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Галерея изображений | Список файлов</title>
</head>
<body>
<div class="container pt-4">
<h1 class="mb-4"><a href="<? echo URL ?>">Галерея изображений</a></h1>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($_POST['login']) || empty($_POST['password']) || empty($_POST['name']) || !preg_match("/^[-\w]+$/i", $_POST['login']) || !preg_match("/^[-\w]+$/i", $_POST['password']) || !preg_match("/^[-\w\p{Cyrillic}]+$/u", $_POST['name'])) {
		echo '<div style="text-align:center;"><div class="alert alert-danger" style="text-align:center;">Есть незаполненные поля или в них содержатся недопустимые символы!</div><a href="'.URL.'">Перейти на главную</a><br><a href="?">Попробовать еще раз</a></div></div></div></body></html>';
		exit();
	}

	$login = $_POST['login'];
	$password = $_POST['password'];
	$name = $_POST['name'];

	$sql = "SELECT id, login, password, name FROM users WHERE login = '$login'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	if (empty($row)) {
        mysqli_query($link, 'INSERT INTO `users`(`login`, `password`, `name`) VALUES(\''.$login.'\', \''.password_hash($password, PASSWORD_DEFAULT).'\', \''.$name.'\');');
        $_SESSION['auth'] = true;
		$_SESSION['name'] = $name;
		$_SESSION['login'] = $login;
	}else{
        echo '<div class="alert alert-danger" style="text-align:center;">Пользователь уже есть в базе данных, вспоминайте пароль или зарегистрируйтесь с другим логином</div>';
    }
}
if (!empty($_SESSION['auth'])) {
	echo <<<EOT
	<div style="text-align:center;">
	<h3> Добро пожаловать в галлерею, {$_SESSION['name']}!</h3>
	<div class="alert alert-success">Регистрация и авторизация прошли успешно!</div>
	<a href="./auth.php?exit=1">Выйти</a><br>
EOT;
	echo '<a href="'.URL.'">Перейти на главную</a></div>';

} else {
	echo <<<EOT
	<div class="blueBlock row">
	<div class="col-12 col-sm-8 offset-sm-2" style="text-align: center;">
	<h2>Придумайте имя, логин и пароль</h2>
	<br>
	<form method="post" class="form-group">
	<input type="text" name="name" placeholder="name">
	<input type="text" name="login" placeholder="login">
	<input type="text" name="password" placeholder="password">
	<input type="submit" class="btn btn-primary">
	</form>
	</div>
	</div>
EOT;
}
?>
<style>
.blueBlock {
    text-align: center;
    height: 300px;
    display: flex;
    flex-direction: column;
    background: aliceblue;
    border-radius: 10px;
    justify-content: center;
}
</style>
</div>
</body>
</html>