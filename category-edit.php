<?php
require_once 'header.php';

try {
    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM categories WHERE ID = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $section = $stmt->fetch();

    if (!$section) {
        $_SESSION['error'] = "category not Found!";
        header("location: categories.php");
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    try {
        $sql = "UPDATE sections SET name = :name";

        $sql .= " WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);

        $stmt->execute();

        $_SESSION['success'] = "category updated successfully";

        header("location: categories.php");
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Sections</h1>
    <a href="users.php" class="btn btn-warning">
        < back</a>
</div>
<div class="container card my-3 p-3">
    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $section['Name'] ?>">
            <label for="name">Name</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>

    </form>
</div>


<?php require_once 'footer.php'; ?>
