<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email'])) {
  $_SESSION['login_required'] = true;
  header("Location: login.php");
  exit();
}


// if (!isset($_SESSION['email'])) {
//   header("Location: login.php");
//   exit();
// }

$user_email = $_SESSION['email'];
$yoga_type = $_POST['yogaType'];
$trainer_email = $_POST['trainer']; // Correct name from <select name="trainer">
$trainer_name = '';

// Check if course exists for this trainer and yoga type
$courseResult = mysqli_query($conn, "SELECT * FROM courses WHERE trainer_email='$trainer_email' AND title='$yoga_type'");
$course = mysqli_fetch_assoc($courseResult);

if (!$course) {
  echo "<script>alert('Trainer or course not found!'); window.location.href='index.php';</script>";
  exit();
}

// Optional: Get trainer name from users table
$trainer_query = mysqli_query($conn, "SELECT name FROM users WHERE email='$trainer_email'");
$trainer = mysqli_fetch_assoc($trainer_query);
$trainer_name = $trainer['name'] ?? '';

// Prevent duplicate enrollments (same course AND same trainer)
$check = mysqli_query($conn, "SELECT * FROM enrollments WHERE user_email='$user_email' AND yoga_type='$yoga_type' AND trainer_email='$trainer_email'");
if (mysqli_num_rows($check) > 0) {
    $_SESSION['already_enrolled'] = true;
    header("Location: user_dashboard.php");
    exit();
}



// Save enrollment
$insert = "INSERT INTO enrollments (user_email, yoga_type, trainer_email, trainer_name, enrolled_on) 
           VALUES ('$user_email', '$yoga_type', '$trainer_email', '$trainer_name', NOW())";

if (mysqli_query($conn, $insert)) {
  // // Redirect to dashboard or show WhatsApp link directly
  // $whatsappLink = $course['whatsapp_group_link'] ?? '#';

  //   echo "<script>
//           alert('Enrollment successful!');
//           window.location.href='user_dashboard.php?whatsapp=" . urlencode($whatsappLink) . "';
//         </script>";
// } else {
//   echo "<script>alert('Error enrolling!'); window.location.href='index.php';</script>";
  $_SESSION['enroll_success'] = true;
} else {
  $_SESSION['enroll_error'] = "Enrollment failed.";
}

header("Location: user_dashboard.php");
exit();

?>
