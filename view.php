<?php

require_once("config.php");
$id=$_GET['id'];
$sql = "SELECT * FROM posts WHERE posts.id='$id'";
$resultQuery = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

        include_once("header.php")

    ?>

<?php 
          
          $row = mysqli_fetch_assoc($resultQuery)

          
          
          ?>
        <div class="col text-center">
          <div class="card shadow-sm">
            <div class="card-body">
            <h3 class="card-text fw-light"><?php echo $row['title']?></h3>
              <p class="card-text"><?php echo $row['contant']?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <a href="edit.php?id=<?=$row['id']?>" class="btn btn-outline-warning my-2">Edit</a>
          <a href="config.php?del=<?php echo $row['id']; ?>" class="btn btn-outline-danger my-2">Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div>  
</body>
</html>
