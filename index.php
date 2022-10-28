<?php
session_start();
if(!isset($_SESSION['id'])){
    header("Location: login.php");
    exit();
}
require_once("config.php");
$sql = "SELECT posts.id, posts.cateid, posts.contant, posts.title, posts.brief ,categories.catename AS cateid 
    FROM posts 
    INNER JOIN categories ON posts.cateid=categories.id ORDER BY id DESC ;";
$resultQuery = mysqli_query($conn, $sql);
?>

<?php 
    require_once 'header.php';
 ?>
<main>
<a href="addblog.php" class="btn btn-outline-primary my-2">Add new blog</a>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
      <?php 
          
          $row = mysqli_fetch_assoc($resultQuery)
          
          ?>
        <h1><?php echo $row['title']?></h1>
        <p class="lead text-muted"><?php echo $row['brief']?></p>
        <p>
          <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-outline-primary my-2">View</a>
          <a href="edit.php?id=<?=$row['id']?>" class="btn btn-outline-warning my-2">Edit</a>
          <a href="config.php?del=<?php echo $row['id']; ?>" class="btn btn-outline-danger my-2">Delete</a>
        </p>
      </div>
    
  </section>

  <div class="album py-5 bg-light">
    <div class="container">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 text-center">
      <?php 
          
          while($row = mysqli_fetch_assoc($resultQuery))

          {
          
          ?>
        <div class="col text-center">
          <div class="card shadow-sm">
            <div class="card-body">
            <h3 class="card-text fw-light"><?php echo $row['title']?></h3>
              <p class="card-text"><?php echo $row['brief']?></p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <a type="button" class="btn btn-sm btn-outline-primary" href="view.php?id=<?=$row['id']?>">View</a>
                  <a type="button" class="btn btn-sm btn-outline-warning" href="edit.php?id=<?=$row['id']?>">Edit</a>
                  <a type="button" class="btn btn-sm btn-outline-danger" href="config.php?del=<?php echo $row['id']; ?>">Delete</a>
                </div>
              </div>
            </div>
          </div>
        </div>  
<?php
          }
?>
        </div>
      
       
      </div>
    </div>
    <?php 
      require_once 'footer.php';
    ?>
  </div>
</main>