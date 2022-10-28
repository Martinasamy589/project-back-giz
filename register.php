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
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('config.php');
    require('Validator.php');

    $username = $email = $password = '';
    if (isset($_POST['username'])) {
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $email    = stripslashes($_POST['email']);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($conn, $password);

        $validation = new Validator();
        $validation->empty('Username', $username);
        $validation->username('Username', $username);
        $validation->empty('Password', $password);
        $validation->min('Password', $password, 6);
        $validation->empty('Email', $email);
        $validation->email('Email', $email);
        $errors = $validation->getErrors();

        $query    = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $query);
        $rows = mysqli_num_rows($result);
        if($rows > 0){
            $errors[] = 'Username exists';
        }

        if(count($errors) == 0){
            $query    = "INSERT into `users` (username, password, email)
                        VALUES ('$username', '" . md5($password) . "', '$email')";
            $result   = mysqli_query($conn, $query);
            if ($result) {
                $_SESSION['id'] = $conn->insert_id;
                $_SESSION['username'] = $username;

                header('Location: index.php');
                exit();
            } else {
                echo "<div class='form'>
                    <h3>Required fields are missing.</h3>
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
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" value="<?= $username ?>"/>
        <input type="text" class="login-input" name="email" placeholder="Email Adress" value="<?= $email ?>">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="login.php">Click to Login</a></p>
    </form>
</body>
</html>