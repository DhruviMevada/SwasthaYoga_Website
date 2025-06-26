<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'User') {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newBio = mysqli_real_escape_string($conn, $_POST['bio']);
    $newPassword = $_POST['password'];

    if (!empty($newPassword)) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $update = "UPDATE users SET bio='$newBio', password='$hashedPassword' WHERE email='$email'";
    } else {
        $update = "UPDATE users SET bio='$newBio' WHERE email='$email'";
    }

    mysqli_query($conn, $update);
    echo "<script>alert('Profile updated successfully!'); window.location.href='user_profile.php';</script>";
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body.fade-out {
            opacity: 0;
            transition: opacity 0.3s ease-out;
        }

        body {
            opacity: 1;
            transition: opacity 0.3s ease-in;
        }
    </style>
</head>

<body>
    <h2>Edit Profile</h2>
    <form method="POST">
        <label>Bio:</label><br>
        <textarea name="bio"><?php echo $user['bio'] ?? ''; ?></textarea><br><br>

        <label>New Password (leave blank to keep current):</label><br>
        <input type="password" name="password"><br><br>

        <input type="submit" value="Update Profile">
    </form>
    <a href="user_profile.php">Back</a>

    <script>
        // Add fade-out effect on link clicks
        document.addEventListener("DOMContentLoaded", function () {
            const links = document.querySelectorAll("a[href]");
            links.forEach(function (link) {
                // Ignore anchor links and new tab links
                if (link.getAttribute("target") === "_blank" ||
                    link.href.startsWith("javascript:") ||
                    link.getAttribute("href") === "#" ||
                    link.getAttribute("href")?.startsWith("#")
                ) return;

                link.addEventListener("click", function (e) {
                    e.preventDefault();
                    const href = this.href;
                    document.body.classList.add("fade-out");
                    setTimeout(() => {
                        window.location.href = href;
                    }, 400); // Wait for the transition
                });
            });
        });
    </script>
</body>

</html>