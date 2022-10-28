<?php
session_start();
if(isset($_SESSION['id'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
    <?php
    require('config.php');
    require('Validator.php');

    $username = $password = '';
    if (isset($_POST['username'])) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        
        $validation = new Validator();
        $validation->empty('Username', $username);
        $validation->empty('Password', $password);
        $errors = $validation->getErrors();

        if(count($errors) == 0){
            $query    = "SELECT * FROM `users` WHERE username='$username'
                        AND password='" . md5($password) . "'";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_row($result);
            $rows = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['id'] = $row[0];
                $_SESSION['username'] = $username;

                header("Location: index.php");
                exit();
            } else {
                echo "<div class='form'>
                    <h3>Incorrect Username/password.</h3>
                    </div>";
            }
        }else{
            echo "<div class='form'>";
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
            echo "</div>";
        }
    }
?>
<form class="form" method="post">
    <h1 class="login-title">Login</h1>
    <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" value="<?= $username ?>"/>
    <input type="password" class="login-input" name="password" placeholder="Password" value="<?= $username ?>"/>
    <input type="submit" value="Login" name="submit" class="login-button"/>
    <p class="link"><a href="register.php">New Registration</a></p>
</form>
</body>
</html>