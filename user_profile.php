<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'User') {
  header("Location: index.php");
  exit();
}

$email = $_SESSION['email'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];

  if (!empty($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    mysqli_query($conn, "UPDATE users SET password='$password' WHERE email='$email'");
  }
  $sql = "UPDATE users SET name='$name' WHERE email='$email'";
  mysqli_query($conn, $sql);

  header("Location: user_dashboard.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Profile</title>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
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
      border: 1px solid white;
      max-width: 600px;
      margin: auto;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    input,
    textarea {
      width: 95%;
      margin-bottom: 12px;
      padding: 8px;
      border-bottom: 1px solid #ccc;
      border-left: none;
      border-right: none;
      border-top: none;
      background: rgba(239, 238, 238, 0.5);
    }

    input,
    textarea {
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
      padding: 15px 20px;
      border-radius: 20px;
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
        width: 90%;
      }

      input,
      textarea {
        width: 100%;
      }

      button {
        width: 50%;
        margin: 10px auto;
        display: block;
        

      }
    }
  </style>
</head>

<body>
  <nav>
    <ul>
      <li><a href="user_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></li>
    </ul>
  </nav>
  <form method="post" enctype="multipart/form-data">
    <h2>Edit Your Profile</h2>
    <br><br>
    <label>Name:</label><br><br>
    <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>
    <br><br>
    <label>Email (readonly):</label><br><br>
    <input type="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" readonly>
    <br><br>
    <label>New Password (leave blank to keep current):</label><br><br>
    <input type="password" name="password">
    <br><br>
    <button type="submit">Update Profile</button>
    <a href="user_dashboard.php"><button type="button">Back to Dashboard</button></a>
  </form>

  <script>
    // Add fade-out effect on link clicks
    document.addEventListener("DOMContentLoaded", function () {
      const links = document.querySelectorAll("a[href]");
      links.forEach(function (link) {
        // Ignore anchor links and new tab links
        if (link.getAttribute("target") === "_blank" || link.href.startsWith("javascript:")) return;

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