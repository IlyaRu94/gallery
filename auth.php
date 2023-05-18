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

    <title>Авторизация</title>
</head>
<body>
<div class="container pt-4">
<h1 class="mb-4"><a href="<? echo URL ?>">Галерея изображений</a></h1>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (empty($_POST['login']) || empty($_POST['password']) || !preg_match("/^[-\w]+$/i", $_POST['login']) || !preg_match("/^[-\w]+$/i", $_POST['password'])) {
		echo '<div style="text-align:center;"><div style="text-align:center;" class="alert alert-danger">Не заполнено поле логин или пароль, или содержатся запрещенные символы</div><a href="'.URL.'">Перейти на главную</a><br><a href="?">Попробовать еще раз</a></div></div></div></body></html>';
		exit();
	}

	$login = $_POST['login'];
	$password = $_POST['password'];

	$sql = "SELECT id, login, password, name FROM users WHERE login = '$login'";
	$result = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	if (empty($row)) {
		//header('location: '.URL);
		echo '<div style="text-align:center;"><div style="text-align:center;" class="alert alert-danger">Пользователь не найден</div></div>';
	}

	if (password_verify ($password, $row['password'])) {
		$_SESSION['auth'] = true;
		$_SESSION['name'] = $row['name'];
		$_SESSION['login'] = $row['login'];
	}else{
		echo '<div style="text-align:center;"><div style="text-align:center;" class="alert alert-danger">Неверно введен логин или пароль</div></div>';
	}
	//header('location: '.URL);
}

if (!empty($_GET['exit'])) {
	session_destroy();
	header('location: '.URL);
}

if (!empty($_SESSION['auth'])) {
	echo '
	<div style="text-align:center;">
	<h3> Добро пожаловать, '.$_SESSION['name'].'! </h3>
	<div class="alert alert-success" style="text-align: center;">Вы успешно авторизованы!</div>
	<a href="?exit=1"> Выйти </a><br>
	<a href="'.URL.'"> Перейти на главную страницу </a></div>
';

} else {
	echo <<<EOT
	<div class="blueBlock row">
	<div class="col-12 col-sm-8 offset-sm-2" style="text-align: center;">
	<h2>Введите свой логин и пароль</h2>
	<br>
	<form method="post" class="form-group">
	<input type="text" name="login" placeholder="login">
	<input type="text" name="password" placeholder="password">
	<input type="submit" class="btn btn-primary">
	</form>
	<a href="./registry.php">Зарегистрироваться</a>
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