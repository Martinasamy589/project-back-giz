<?php
  
    $conn = mysqli_connect("localhost","root","","blog");

    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($conn, "DELETE FROM posts WHERE id=$id");
        $_SESSION['message'] = "Address deleted!"; 
        header('location: index.php');
    }
?>
