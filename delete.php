<?php
include "config.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL to delete user
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('User deleted successfully!');
                window.location.href='home.php';
              </script>";
    } else {
        echo "<script>
                alert('Error deleting user. Please try again.');
                window.location.href='home.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request!');
            window.location.href='home.php';
          </script>";
}
?>
