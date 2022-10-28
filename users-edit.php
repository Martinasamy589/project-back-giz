<?php
require_once 'header.php';

try {
    $id = (int) $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = '$id'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "User not Found!";
        header("location: users.php");
        die;
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $sql = "UPDATE users SET name = :name, email = :email";

        if (!empty($password))
            $sql .= ", password = :password";

        $sql .= " WHERE id = :id";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);

        if (!empty($password))
            $stmt->bindParam(':password', $password);

        $stmt->execute();

        $_SESSION['success'] = "Account updated successfully";

        echo "<script> window.location='users.php'</script>";
        die;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Users</h1>
    <a href="users.php" class="btn btn-warning">
        < back</a>
</div>
<div class="container card my-3 p-3">
    <form method="POST">
        <div class="form-floating my-3">
            <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?= $user['name'] ?>">
            <label for="name">Name</label>
        </div>
        <div class="form-floating my-3">
            <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" value="<?= $user['email'] ?>">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating my-3">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Update</button>

    </form>
</div>


<?php require_once 'footer.php'; ?>
