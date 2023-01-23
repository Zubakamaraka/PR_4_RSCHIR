<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Страница профиля</title>
		<link href="second.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Советы для собачников</h1>
                <a href="home.php"><i class="fas fa-home-alt"></i>Главная</a>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Профиль</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Выход</a>
			</div>
		</nav>
		<div class="content">
			<h2>Страница профиля</h2>
			<div class="block">
				<p>Ваш аккаунт</p>
				<table>
					<tr>
						<td>Логин:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Пароль:</td>
						<td><?=$_SESSION['pass']?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>