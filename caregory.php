<?php
require_once 'header.php';

// if (!empty($_GET['delete'])) {
//     $id = (int) $_GET['delete'];

//     $sql = "DELETE FROM categories WHERE ID = $id";
//     $stmt = $conn->prepare($sql);
//     $stmt = $stmt->execute();

//     $_SESSION['success'] = "User Deleted!";

//     header("location: users.php");
//     die;
// }

// try {
//     $sql = "SELECT * FROM categories";

//     // die($sql);

//     $stmt = $conn->prepare($sql);
//     $stmt->execute();

//     // set the resulting array to associative
//     $users = $stmt->setFetchMode(PDO::FETCH_ASSOC);

//     $users = $stmt->fetchAll();
// } catch (PDOException $e) {
//     echo "Error: " . $e->getMessage();
// }
// $conn = null;


require_once("config.php");
$sql = "SELECT 'id', 'catename' FROM categories";
$resultQuery = mysqli_query($conn, $sql);
// var_dump($resultQuery);


?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Sections</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar" class="align-text-bottom"></span>
            This week
        </button>
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while($data = mysqli_fetch_assoc($resultQuery))
            {

             ?>
                <tr>
                    <td><?= $data['id'] ?></td>
                    <td><?= $data['catename'] ?></td>
                    <td>
                        
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>ا

<!-- <script>
    function deleteClick(e) {
        console.log(e)
        let id = e.getAttribute('data-id');
        let answer = confirm("Are you sure to delete user " + id + "?")
        if (answer) {
            window.location = "?delete=" + id
        }

    }
</script> -->

<?php require_once 'footer.php'; ?>
