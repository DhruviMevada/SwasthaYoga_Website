<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Trainer') {
  header("Location: index.php");
  exit();
}

$email = $_SESSION['email'];
$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

if ($id <= 0) {
  die("Invalid course ID.");
}

// 🔁 Always fetch course for both GET and POST methods
$courseResult = mysqli_query($conn, "SELECT * FROM courses WHERE id=$id AND trainer_email='$email'");
$course = mysqli_fetch_assoc($courseResult);

if (!$course) {
  die("Course not found or access denied.");
}

// ✅ Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $duration = $_POST['duration'];
  $difficulty_level = $_POST['difficulty_level'];
  $whatsapp_group_link = $_POST['whatsapp_group_link'];

  $sql = "UPDATE courses 
          SET title='$title', 
              description='$description', 
              duration='$duration', 
              difficulty_level='$difficulty_level', 
              whatsapp_group_link='$whatsapp_group_link' 
          WHERE id=$id AND trainer_email='$email'";

  if (mysqli_query($conn, $sql)) {
    header("Location: manage_courses.php");
    exit();
  } else {
    echo "Error updating course: " . mysqli_error($conn);
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Course</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="images/flowerIcon.ico" type="image/x-icon" />
  <!-- ==============Link for google icons=================================  -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
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

    form {
      background: rgba(239, 238, 238, 0.5);
      padding: 20px;
      border-radius: 10px;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    input,
    textarea,
    select {
      background: rgba(94, 93, 93, 0.2);
      width: 95%;
      margin-bottom: 12px;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid darkgray;
      font-size: 18px;
      border-top: none;
      border-left: none;
      border-right: none;
    }

    label {
      font-weight: bold;
    }

    button {
      background-color: #d28cbc;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 6px;
      cursor: pointer;
    }

    ul {
      list-style: none;
    }

    nav ul {
      display: flex;
      justify-content: space-between;
      width: 100%;
      align-items: center;
      padding: 10px;
      border-radius: 6px;
    }

    nav ul li a {
      /* background-color: #d291bc; */
      color: hsl(260, 80%, 18%);
      text-decoration: none;
      padding: 10px 10px;
      border-radius: 5px;
      font-weight: bold;
      font-size: 18px;
      text-decoration: none;
    }

    nav ul li a:hover {
      background-color: #b3a5b3;
      color: hsl(260, 80%, 18%);
      transition: 0.3s;
      border-radius: 6rem;
    }

    @media screen and (max-width: 600px) {
      form {
        width: 100%;
      }

      input,
      textarea,
      select {
        width: 100%;
        font-size: 14px;
      }

      button {
        width: 50%;
        margin: 10px auto;
        /* display: block; */
      }

      option {
        font-size: 10px;
      }
    }
  </style>
</head>

<body>
  <nav>
    <ul>
      <li><a href="manage_courses.php"><i class="fa-solid fa-arrow-left"></i></a></li>
  </nav>
  <form method="POST">
    <br>
    <h2>Edit Course</h2>
    <br>

    <label>Course Title:</label><br><br>
    <input type="text" name="title" value="<?= htmlspecialchars($course['title']) ?>" required>

    <label>Description:</label><br><br>
    <textarea name="description" required><?= htmlspecialchars($course['description']) ?></textarea>

    <label>Duration:</label><br><br>
    <input type="text" name="duration" value="<?= $course['duration'] ?>" required>

    <label>Difficulty Level:</label><br><br>
    <select name="difficulty_level" required>
      <option value="Beginner" <?= $course['difficulty_level'] == 'Beginner' ? 'selected' : '' ?>>Beginner</option>
      <option value="Intermediate" <?= $course['difficulty_level'] == 'Intermediate' ? 'selected' : '' ?>>Intermediate
      </option>
      <option value="Advanced" <?= $course['difficulty_level'] == 'Advanced' ? 'selected' : '' ?>>Advanced</option>
    </select>

    <label>WhatsApp Group Link:</label><br><br>
    <input type="text" name="whatsapp_group_link" value="<?= htmlspecialchars($course['whatsapp_group_link'] ?? '') ?>"
      required>

    <button type="submit">Update Course</button>
    <button type="button" onclick="window.location.href='manage_courses.php'">Cancel</button>
  </form>
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