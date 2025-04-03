<form action="update.php" method="POST">
    <label>New Username:</label>
    <input type="text" name="username" value="<?php echo $_SESSION['user']['username']; ?>" required>

    <label>New Email:</label>
    <input type="email" name="email" value="<?php echo $_SESSION['user']['email']; ?>" required>

    <button type="submit" name="update">Update</button>
</form>
<?php
session_start();
include "config.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['update'])) {
    $new_username = $_POST['username'];
    $new_email = $_POST['email'];
    $user_id = $_SESSION['user']['id'];

    $sql = "UPDATE users SET username=?, email=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $new_username, $new_email, $user_id);

    if ($stmt->execute()) {
        $_SESSION['user']['username'] = $new_username;
        $_SESSION['user']['email'] = $new_email;
        echo "Profile updated successfully! <a href='home.php'>Go back</a>";
    } else {
        echo "Update failed.";
    }
}
?>
