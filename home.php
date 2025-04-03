<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, username, email, created_at FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">User Management</a>
            <span class="navbar-text">Welcome, <strong><?php echo $_SESSION['user']['username']; ?></strong>!</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="text-center">Registered Users</h2>
        <div class="table-responsive">
        <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Joined</th>
            <th>Action</th> <!-- New Column -->
        </tr>
    </thead>
    <tbody>
        <?php
        include "config.php";
        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this user?\")'>Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </tbody>
</table>
        </div>
    </div>
</body>
</html>
