<?php
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
// exit;

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role     = $_POST['role'] ?? 'User';  // fallback default

    $specialization   = $_POST['specialization'] ?? '';
    $experience_years = $_POST['experience_years'] ?? '';
    $bio              = $_POST['bio'] ?? '';
    $whatsapp         = $_POST['whatsapp_group'] ?? '';
    $instagram        = $_POST['instagram'] ?? '';
    $linkedin         = $_POST['linkedin'] ?? '';

    if ($role !== 'Trainer') {
    $specialization = null;
    $experience_years = null;
    $bio = null;
    $whatsapp = null;
    $instagram = null;
    $linkedin = null;
}

    // INSERT
    $query = "INSERT INTO users (name, email, password, role, specialization, experience_years, bio, whatsapp_group, instagram, linkedin)
              VALUES ('$name', '$email', '$password', '$role', '$specialization', '$experience_years', '$bio', '$whatsapp', '$instagram', '$linkedin')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Signup successful!'); window.location.href='login.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
