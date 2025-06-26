<?php
session_start();
include 'db.php'; // Make sure db.php connects to your MySQL DB

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $role = $_POST['role'];


  // Trainer-specific fields
  $expertise = $_POST['specialization'] ?? '';
  $experience = $_POST['experience_years'] ?? '';
  $motivation = $_POST['bio'] ?? '';
  $whatsapp = $_POST['whatsapp_group'] ?? '';
  $instagram = $_POST['instagram'] ?? '';
  $linkedin = $_POST['linkedin'] ?? '';

  // Check if user already exists
  $checkQuery = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($conn, $checkQuery);

  if (mysqli_num_rows($result) > 0) {
    echo "User already exists!";
  } else {
    $query = "INSERT INTO users (name, email, password, role, specialization, experience_years, bio, whatsapp_group, instagram, linkedin)
                  VALUES ('$name', '$email', '$password', '$role', '$expertise', '$experience', '$motivation', '$whatsapp', '$instagram', '$linkedin')";

    if (mysqli_query($conn, $query)) {
      echo "Signup successful! You can now log in.";
      header("Location: login.html"); // or show success alert and redirect
      exit();
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign Up | SwasthaYoga</title>

  <link rel="stylesheet" href="css/auth.css" />
  <link rel="shortcut icon" href="images/flowerIcon.ico" type="image/x-icon" />
  <!-- ==============Link for google icons=================================  -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body.fade-out {
      opacity: 0;
      transition: opacity 0.3s ease-out;
    }

    body {
      opacity: 1;
      transition: opacity 0.3s ease-in;
    }


    html,
    body {
      height: 100%;
      margin: 20px;
      padding: 0;
      position: relative;
      font-family: 'Work Sans', sans-serif;
      justify-content: center;
      align-items: center;
      display: flex;
    }

    /* Background Image with Blur */
    body::before {
      content: "";
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url('images/yoga1.jpg') no-repeat center center/cover;
      filter: blur(5px);
      z-index: -1;
      opacity: 0.5;
    }

    @media screen and (max-width: 600px) {
      option{
        font-size: 10px;
      }
      input,
      select,
      textarea{
        font-size: 12px;
      }
      input::placeholder,
      select::placeholder,
      textarea::placeholder {
        font-size: 14px;
      }
      
    }
  </style>
</head>

<body>

  <div class="auth-container">
    <h2>Create Your Account</h2>

    <form action="signup_process.php" method="POST" id="signupForm">
      <input type="text" name="name" placeholder="Full Name" required />
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />

      <select name="role" id="roleSelect" required onchange="toggleTrainerFields(this.value)">
        <option value="">Select Role</option>
        <option value="User">User</option>
        <option value="Trainer">Trainer</option>
      </select>

      <div id="trainerFields" style="display: none;">
        <select name="specialization" id="expertise" required style="width: 97%; gap: 1rem;">
          <option value="">Select Your Yoga Expertise</option>
          <option value="HathaYoga">Hatha Yoga</option>
          <option value="VinyasaYoga">Vinyasa Yoga</option>
          <option value="AshtangaYoga">Ashtanga Yoga</option>
          <option value="IyengarYoga">Iyengar Yoga</option>
          <option value="BikramYoga">Bikram Yoga</option>
          <option value="KundaliniYoga">Kundalini Yoga</option>
          <option value="PowerYoga">Power Yoga</option>
          <option value="YinYoga">Yin Yoga</option>
          <option value="RestorativeYoga">Restorative Yoga</option>
          <option value="ChairYoga">Chair Yoga</option>
          <option value="Pranayama">Pranayama</option>
          <option value="PrenatalYoga">Prenatal Yoga</option>
        </select>

        <input type="number" name="experience_years" placeholder="Years of Experience" min="1"
          style="width: 93%; margin-top: 12px; margin-bottom: 12px;" />
        <textarea name="bio" placeholder="Tell about yourself..." rows="3"
          style="width: 93%; margin-top:12px; margin-bottom:12px;"></textarea>
        <input type="url" name="whatsapp_group" placeholder="WhatsApp Group Link"
          style="width: 93%; margin-top: 12px; margin-bottom:12px;" />
        <input type="url" name="instagram" placeholder="Instagram Link"
          style="width: 93%; margin-top: 12px; margin-bottom: 12px;" />
        <input type="url" name="linkedin" placeholder="LinkedIn Link"
          style="width: 93%; margin-top: 12px; margin-bottom: 12px;" />
      </div>


      <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>

  <script>
    function toggleTrainerFields(role) {
      const trainerFields = document.getElementById("trainerFields");
      const inputs = trainerFields.querySelectorAll("input, select, textarea");

      if (role === "Trainer") {
        trainerFields.style.display = "block";
        inputs.forEach(input => input.disabled = false);  // enable fields
      } else {
        trainerFields.style.display = "none";
        inputs.forEach(input => input.disabled = true);   // disable fields
      }
    }
  </script>

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