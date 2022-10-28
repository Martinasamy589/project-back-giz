<?php

require_once("config.php");

$sql = "SELECT * FROM categories";
$query = mysqli_query($conn, $sql);

$id = $_GET['id'];
$sql2 = "SELECT posts.id, posts.cateid, posts.contant, posts.title, posts.brief ,categories.catename AS cateid 
    FROM posts 
    INNER JOIN categories ON posts.id='$id';";
$query2 = mysqli_query($conn, $sql2);
$resultQuery = mysqli_fetch_assoc($query2);

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Album example · Bootstrap v5.2</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">

    
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>

    
</head>

  <body>
<?php 
    require_once 'header.php';
 ?>
<main>
    <div class="container">
        <div class="row">
                <div class="card mt-5">
                    <div class="card-header">
                        <h6 class="mb-2 font-weight-bold text-priamry mt-2">Save</h6>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="d-flex flex-column">
                                <input type="text" name="title" placeholder="Blog Title" value="<?=$resultQuery['title']?>" class="from-control"><br />
                                <input type="text" name="contant" placeholder="Blog body" value="<?=$resultQuery['contant']?>"class="from-control"><br />
                                <select class="form-control" name="category">
                                    <?php
                                    while($cats=mysqli_fetch_assoc($query)) { ?>
                                    <option value="<?=$cats['id'] ?>"
                                        <?= ($resultQuery['cateid']==$cats['catename'])?"
                                            selected":'';?>>
                                            <?= $cats['catename'] ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                </select>
                                <input type="text" name="brief" placeholder="Blog brief" value="<?=$resultQuery['brief']?>"><br />
                            </div>
                            <div>
                                <input type="submit" name="edit" value="Save" class="btn btn-primary">
                                <a href="index.php" class="btn btn-secondary">Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<?php 

require_once 'footer.php';

if(isset($_POST['edit'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $contant = mysqli_real_escape_string($conn, $_POST['contant']);
    $cateid = mysqli_real_escape_string($conn, $_POST['category']);
    $brief = mysqli_real_escape_string($conn, $_POST['brief']);
    
        $sql3="UPDATE posts SET title='$title',contant='$contant', cateid='$cateid' ,brief='$brief' WHERE id='$id';";
        var_dump($sql3);
        $query3 = mysqli_query($conn,$sql3);
        if($query3){
           
            echo "<script>window.location.href= 'index.php';</script>";

        }else{
            echo "Failed, PLease try again !";
        }
}

?>
    </div>
</main>
        <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

  </body>
</html>
