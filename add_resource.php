<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Trainer') {
  header("Location: index.php");
  exit();
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $type = $_POST['type'];
  $visibility = $_POST['visibility'];
  $description = mysqli_real_escape_string($conn, $_POST['description']); // 🔥 Add this

  $link = '';
  $file_path = '';

  // Handle type-specific input
  if ($type === 'link') {
    $link = mysqli_real_escape_string($conn, $_POST['video_link']);
  } elseif ($type === 'pdf' && isset($_FILES['pdf_file']) && $_FILES['pdf_file']['error'] === 0) {
    $target_dir = "uploads/resources/";
    if (!is_dir($target_dir)) {
      mkdir($target_dir, 0777, true);
    }
    $file_path = $target_dir . basename($_FILES["pdf_file"]["name"]);
    move_uploaded_file($_FILES["pdf_file"]["tmp_name"], $file_path);
  }

  // 🔽 Update your query to include description
  $sql = "INSERT INTO resources (title, type, link, file_path, description, trainer_email)
            VALUES ('$title', '$type', '$link', '$file_path', '$description', '$email')";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die("Query failed: " . mysqli_error($conn));
  }

  header("Location: manage_resources.php");
  exit();
}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Upload Resource</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="images/flowerIcon.ico" type="image/x-icon" />
  <!-- ==============Link for google icons=================================  -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  </style>

  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
    }

    html,
    body {
      height: 100%;
      margin: 20px;
      padding: 0;
      position: relative;
      font-family: 'Work Sans', sans-serif;
    }

    body {
      opacity: 0;
      transition: opacity 0.5s ease-in-out;
    }

    body.fade-in {
      opacity: 1;
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
      border: 1px solid white;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin-bottom: 12px;
      border-radius: 5px;
      border: 1px solid #ccc;
      border-left: none;
      border-top: none;
      border-right: none;
      font-size: 18px;
      width: 95%;
      background: rgba(94, 93, 93, 0.2);
    }

    label {
      font-weight: bold;
    }

    .btn {
      background-color: #d28cbc;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
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
  </style>
  <script>
    function toggleFields() {
      const type = document.querySelector('select[name="type"]').value;
      document.getElementById('video_link_field').style.display = type === 'PDF' ? 'none' : 'block';
      document.getElementById('pdf_upload_field').style.display = type === 'PDF' ? 'block' : 'none';
    }
  </script>
</head>

<body>
  <nav>
    <ul>
      <li><a href="manage_courses.php"><i class="fa-solid fa-arrow-left"></i></a></li>
  </nav>
  <form method="POST" action="add_resource.php" enctype="multipart/form-data">
    <h2>Upload New Resource</h2>
    <br>
    <label>Title(For which you want to add resources):</label>
    <br><br>
    <select name="title" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ccc;">
      <option value="">-- Select Yoga Type --</option>
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

    <br><br>
    <label>Type:</label>
    <br><br>
    <select name="type" onchange="toggleFields()" required>
      <option value="YouTube">YouTube Link</option>
      <option value="Website">Website Link</option>
      <option value="PDF">PDF</option>
    </select>
    <br><br>
    <label>Description (optional):</label>
    <br><br>
    <textarea name="description" rows="3" placeholder="Write a short description about this resource..."></textarea>

    <br><br>
    <div id="video_link_field">
      <label>Video/Link URL:</label>
      <br><br>
      <input type="text" name="link">
    </div>

    <div id="pdf_upload_field" style="display:none;">
      <label>Upload PDF:</label>
      <br><br>
      <input type="file" name="pdf_file" accept=".pdf">
    </div>
    <br><br>
    <button type="submit" class="btn">Upload</button>
  </form>

  <script>toggleFields();</script>
  <script>
    window.addEventListener("DOMContentLoaded", () => {
      document.body.classList.add("fade-in");
    });

    function redirectWithFade(url) {
      document.body.style.opacity = 0;
      setTimeout(() => {
        window.location.href = url;
      }, 400);
    }
  </script>
</body>

</html>