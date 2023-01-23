<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
if(isset($_POST["submit"])) {
	
	$url = 'http://192.168.0.192:1000';

	$data = array('user' => $_SESSION['name'], 'info' => $_POST['info']);
	$options = array(
	    'http' => array(
	        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
	        'method'  => 'POST',
	        'content' => http_build_query($data)
	    )
	);
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result === FALSE) {
	var_dump($result);
	}
}		
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Главная страница</title>
		<link href="second.css" rel="stylesheet" type="text/css">
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
			<h2>Главная страница</h2>
			<div class="form">
				<form method = "post">
                    <input type="info" name="info" placeholder="Добавьте свой совет"/>
                    <input type="submit" value="Добавить" class="submit" name ="submit"/>
                </form>
			</div> 
            <?php
			$json = file_get_contents("http://192.168.0.192:1000/posts");
			$obj = json_decode($json);
			
			foreach($obj as $post){

				echo '<div class="post">';
				echo "<h3>" ."Этот совет был предложен: "  ."$post->post_user". "</h3>" . "<p >". $post->post_info . "</p>";
				echo '</div> ';
			}
			?>
			
        </div>
	</body>
</html>