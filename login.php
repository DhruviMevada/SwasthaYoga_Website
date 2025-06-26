<?php
session_start();

$showLoginModal = isset($_SESSION['login_required']);
unset($_SESSION['login_required']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login | SwasthaYoga</title>

  <!-- External CSS -->
  <!-- <link rel="stylesheet" href="css/style.css" /> -->

  <!-- Google Fonts or Icons (optional) -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
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

    .modal-overlay {
      position: fixed;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.5);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
    }

    .modal-box {
      background-color: #beb7b7;
      padding: 30px 40px;
      border-radius: 12px;
      text-align: center;
      max-width: 500px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .btn-confirm {
      padding: 10px 20px;
      background-color: #cc649c;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }



    @media (width <=400px) {
      .auth-container {
        width: 350px;
      }
    }
  </style>
</head>

<body>

  <div class="auth-container">
    <h2>Login to SwasthaYoga</h2>

    <form action="login_process.php" method="POST" class="login-form">
      <input type="email" name="email" placeholder="Email" required />
      <input type="password" name="password" placeholder="Password" required />
      <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
  </div>

  <?php if ($showLoginModal): ?>
    <div id="loginRequiredModal" class="modal-overlay" onclick="closeLoginRequiredModal()">
      <div class="modal-box" onclick="event.stopPropagation();">
        <p style="font-size: 18px; color: #cc0000; margin-bottom: 15px;">⚠️ Please login first to continue.</p>
        <button class="btn-confirm" onclick="closeLoginRequiredModal()">OK</button>
      </div>
    </div>
  <?php endif; ?>
  <script>
    function closeLoginRequiredModal() {
      const modal = document.getElementById("loginRequiredModal");
      if (modal) modal.style.display = "none";
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