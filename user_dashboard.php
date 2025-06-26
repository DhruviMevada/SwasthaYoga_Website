<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'User') {
  header("Location: index.php");
  exit();
}

$email = $_SESSION['email'];

// Fetch user details
$userQuery = "SELECT * FROM users WHERE email = '$email'";
$userResult = mysqli_query($conn, $userQuery);
$user = mysqli_fetch_assoc($userResult);

// // Fetch enrollments with trainer info

$trainer_email = $_SESSION['email'];

$enrolledQuery = "SELECT e.*, u.name AS trainer_name, u.experience_years, u.bio, u.whatsapp_group
                  FROM enrollments e
                  LEFT JOIN users u ON e.trainer_email = u.email
                  WHERE e.user_email = '$trainer_email'";

$enrolledResult = mysqli_query($conn, $enrolledQuery);
$has_enrollments = mysqli_num_rows($enrolledResult) > 0;



$email = $_SESSION['email'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$trainer = mysqli_fetch_assoc($result);

$courseResult = mysqli_query($conn, "SELECT * FROM courses WHERE trainer_email='$email'");
$courseMain = mysqli_fetch_assoc($courseResult);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Dashboard</title>
  <!-- <link rel="stylesheet" href="css/style.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="images/flowerIcon.ico" type="image/x-icon" />
  <!-- ==============Link for google icons=================================  -->
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600;700;800&display=swap");

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

    h2 {
      font-weight: 500;
    }

    .card {
      background: rgba(239, 238, 238, 0.5);
      padding: 15px;
      margin: 20px 0;
      border-radius: 8px;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    h3 {
      font-size: 1.5rem;
      font-weight: 600;
    }

    .card h2,
    p {
      color: hsl(260, 77%, 19%);
      padding: 10px;
    }

    button {
      margin: 20px;
      margin-left: 8px;
      background-color: #d291bc;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 5px;
      cursor: pointer;
    }


    button:hover {
      background-color: #b3a5b3;
      color: hsl(260, 80%, 18%);
      transition: 0.3s;
      border-radius: 6rem;
    }
    
    p {
      color: hsl(264, 33%, 3%);
    }


    .enrollment-card {
      background: rgba(239, 238, 238, 0.5);
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      padding: 20px;
      margin-top: 16px;

    }

    .enrollment-card h4 {
      margin-bottom: 10px;
      color: #4a5568;
    }

    .enrollment-card p {
      margin: 4px 0;
      color: #2d3748;
    }

    h4 {
      font-size: 1.2rem;
      color: hsl(260, 90%, 30%);
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

    .btn {
      padding: 15px 20px;
      border-radius: 25px;
    }


    .modal.hidden {
      display: none;
    }


    .btn-confirm {
      font-weight: 600;
      padding: 10px 20px;
      border: 1px solid white;
      border-radius: 6px;
      background-color: #cc649c;
      color: white;

    }

    .btn-cancel {
      font-weight: 600;
      padding: 10px 20px;
      border: 1px solid white;
      border-radius: 6px;
      background-color: #6c757d;
      color: white;
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



    @media screen and (max-width: 400px) {
      .card {
        padding: 10px;
        /* margin: 5px 5px; */
        font-size: 14px;
      }

      h2,
      h3,
      p {
        font-size: 14px;
      }

      nav ul li a {
        font-size: 14px;
      }

      button {
        padding: 6px 12px;
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <nav>
    <ul>
      <li><a href="index.php"><i class="fa-solid fa-arrow-left"></i></a></li>
      <li> <a href="#" onclick="showLogoutModal()">Logout</a></li>
    </ul>
  </nav>
  <br><br>
  <h2>Welcome, <?php echo htmlspecialchars($user['name']); ?>!!</h2>
  <br>
  <div class="card">
    <h3>Profile</h3>
    <br>
    <div style="margin: 10px 0;">
      <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
    </div>
    <a href="user_profile.php"><button class="btn">Edit Profile</button></a>
  </div>
  <div class="card">
    <h3>My Enrollments</h3>
    <br>
    <?php
    $count = 0;
    $extraEnrollments = '';

    if ($has_enrollments):
      while ($row = mysqli_fetch_assoc($enrolledResult)):
        ob_start(); // Start output buffer to store each card content
        ?>
        <div class="enrollment-card"
          style="margin-bottom: 15px; padding: 10px; border: 1px solid white; border-radius: 10px;">
          <p><strong style="font-size: 18px;"><?= htmlspecialchars($row['yoga_type']) ?></strong></p>
          <p><strong>Trainer:</strong> <?= htmlspecialchars($row['trainer_name']) ?></p>
          <p><strong>Experience:</strong> <?= htmlspecialchars($row['experience_years']) ?> years</p>
          <p><strong>Enrolled On:</strong> <?= htmlspecialchars($row['enrolled_on']) ?></p>
          <?php
          $trainerEmail = $row['trainer_email'];
          $yogaType = $row['yoga_type'];
          $waQuery = "SELECT whatsapp_group_link FROM courses WHERE trainer_email = '$trainerEmail' AND title = '$yogaType' LIMIT 1";
          $waResult = mysqli_query($conn, $waQuery);
          $waData = mysqli_fetch_assoc($waResult);
          $whatsappLink = $waData['whatsapp_group_link'] ?? '';
          ?>
          <p><strong>WhatsApp Group:</strong>
            <?php if (!empty($whatsappLink)): ?>
              <a href="<?= htmlspecialchars($whatsappLink) ?>" target="_blank">Join Group</a>
            <?php else: ?>
              <span>Not provided</span>
            <?php endif; ?>
          </p>
        </div>
        <?php
        $card = ob_get_clean(); // Get buffered content
    
        if ($count < 2) {
          echo $card; // Show first 2 cards
        } else {
          $extraEnrollments .= $card; // Store rest
        }
        $count++;
      endwhile;

      if (!empty($extraEnrollments)) {
        echo '<button  class="btn" onclick="toggleEnrollments(this)">View All</button>';
        echo '<div id="extraEnrollments" style="display: none;">' . $extraEnrollments . '</div>';
      } else
        echo "<p>You haven't enrolled in any course yet.</p>";
    endif;
    ?>
    <a href="index.php"><button class="btn">Enroll More</button></a>
  </div>

  <!-- <div class="card">
    <h2>Need Help?</h2>
    <p>Join our support group on WhatsApp.</p>
    <button onclick="window.open('https://chat.whatsapp.com/exampleLink3')">Join Group</button>
  </div> -->

  <?php if (isset($_SESSION['enroll_success']) && $_SESSION['enroll_success']): ?>
    <div id="successModal" class="modal-overlay" onclick="closeSuccessModal()">
      <div class="modal-box" onclick="event.stopPropagation();">
        <p style="font-size: 18px; margin-bottom: 20px;">🎉 Enrollment Successful!</p>
        <p>For WhatsApp Group Link, check your enrollment section..!!</p>
        <button class="btn-confirm" onclick="closeSuccessModal()">OK</button>
      </div>
    </div>
    <?php unset($_SESSION['enroll_success']); ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['already_enrolled']) && $_SESSION['already_enrolled']): ?>
    <div id="alreadyEnrolledModal" class="modal-overlay" onclick="closeAlreadyEnrolledModal()">
      <div class="modal-box" onclick="event.stopPropagation();">
        <p style="font-size: 18px; margin-bottom: 20px; color: #cc0000;">⚠️ You're already enrolled in this course with
          this trainer!</p>
        <button class="btn-confirm" onclick="closeAlreadyEnrolledModal()">OK</button>
      </div>
    </div>
    <?php unset($_SESSION['already_enrolled']); ?>
  <?php endif; ?>


  <div id="logoutModal" class="modal hidden">
    <div class="modal-overlay" onclick="closeLogoutModal()">
      <div class="modal-box">
        <p>Are you sure you want to logout?</p>
        <div class="modal-actions">
          <button onclick="proceedLogout()" class="btn-confirm">Yes</button>
          <button onclick="closeLogoutModal()" class="btn-cancel">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showLogoutModal() {
      document.getElementById("logoutModal").classList.remove("hidden");
    }

    function closeLogoutModal() {
      document.getElementById("logoutModal").classList.add("hidden");
    }

    function proceedLogout() {
      window.location.href = "logout.php"; // Redirect to logout script
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

  <script>
    function toggleEnrollments(btn) {
      const container = document.getElementById("extraEnrollments");
      if (container.style.display === "none") {
        container.style.display = "block";
        btn.textContent = "View Less";
      } else {
        container.style.display = "none";
        btn.textContent = "View All";
      }
    }
  </script>

  <script>
    function closeSuccessModal() {
      const modal = document.getElementById("successModal");
      if (modal) modal.style.display = "none";
    }
  </script>

  <script>
    function closeAlreadyEnrolledModal() {
      const modal = document.getElementById("alreadyEnrolledModal");
      if (modal) modal.style.display = "none";
    }
  </script>

</body>

</html>