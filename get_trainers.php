<?php
include 'db.php';

$yoga_type = $_GET['yoga_type'];

$query = "SELECT DISTINCT u.name, u.email, u.bio, u.experience_years, u.linkedin, u.instagram
          FROM courses c
          JOIN users u ON c.trainer_email = u.email
          WHERE c.title = '$yoga_type'";

$result = mysqli_query($conn, $query);

$trainers = [];
while ($row = mysqli_fetch_assoc($result)) {
    $trainers[] = $row;
}
echo json_encode($trainers);
?>

