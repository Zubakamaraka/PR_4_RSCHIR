<?php
session_start();
$con = mysqli_connect("db", "user", "password", "appDB");
if ( mysqli_connect_errno() ) 
{
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
$result=$con->query("SELECT * FROM accounts"); 

if(isset($_POST["login-btn"])) {
    if (empty($_POST['usname']) || empty($_POST['paswd'])) {
        echo '<script>alert("Please fill both the username and password fields!")</script>';
    } else {
        if ($stmt = $con->prepare('SELECT username, passwords FROM accounts WHERE username = ?')) {
            $stmt->bind_param('s', $_POST['usname']);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $password);
                $stmt->fetch();
                if ($_POST['paswd'] === $password) {
                    session_regenerate_id();
                    $_SESSION['loggedin'] = TRUE;
                    $_SESSION['name'] = $_POST['usname'];
                    $_SESSION['id'] = $id;
                    $_SESSION['pass'] = $password;
                    header('Location: home.php');
                } else {
                    echo '<script>alert("incorrect password")</script>';
                }
            } else {
                echo '<script>alert("incorrect username")</script>';
            }
            $stmt->close();
        }
    }                     
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <title>Форма входа</title>
</head>
<body>
    <div class="container">
        <div class="container2">
            <div class="login">
                <form method = "post">
                    <div class="form-input">
                        <input type="text" name="usname" placeholder="Username"/>	
                    </div>
                    <div class="form-input">
                        <input type="password" name="paswd" placeholder="password"/>
                    </div>
                    <input type="submit" value="LOGIN" class="btn-login" name ="login-btn"/>
                </form>
            </div>
        </div>
    </div>
</body>
</html>