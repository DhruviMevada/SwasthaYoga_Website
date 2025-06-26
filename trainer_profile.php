<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Trainer') {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];
$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
$trainer = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $specialization = $_POST['specialization'];
    $experience_years = $_POST['experience_years'];
    $bio = $_POST['bio'];
    $whatsapp_group = $_POST['whatsapp_group'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];

    // Password update
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$password' WHERE email='$email'");
    }

    // Profile picture upload
    if (!empty($_FILES['profile_pic']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true); // make uploads folder if not exist
        }

        $profile_pic = $target_dir . basename($_FILES["profile_pic"]["name"]);

        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $profile_pic)) {
            mysqli_query($conn, "UPDATE users SET profile_pic='$profile_pic' WHERE email='$email'");
        } else {
            echo "<script>alert('Failed to upload profile picture.');</script>";
        }
    }

    // Update other fields
    $sql = "UPDATE users SET 
            name = '$name', 
            specialization = '$specialization', 
            experience_years = '$experience_years',
            whatsapp_group = '$whatsapp_group', 
            instagram = '$instagram', 
            linkedin = '$linkedin', 
            bio = '$bio' 
        WHERE email = '$email'";

    mysqli_query($conn, $sql);

    header("Location: trainer_dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trainer Profile</title>
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

        img {
            max-height: 100px;
            margin-bottom: 10px;
        }

        .profile-pic {
            max-height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
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
            textarea {
                width: 100%;
            }

            button {
                width: 50%;
                margin: 10px auto;
                /* display: block; */


            }
        }
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="trainer_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></li>
        </ul>
    </nav>
    <form method="post" enctype="multipart/form-data">
        <h2>Edit Your Profile</h2>
        <br><br>
        <!-- <label>Profile Picture:</label><br><br>
        <?php if (!empty($trainer['profile_pic'])): ?>
            <img src="<?php echo $trainer['profile_pic']; ?>" class="profile-pic" alt="Profile Picture">
        <?php endif; ?>
        <input type="file" name="profile_pic"><br> -->

        <label>Name:</label><br><br>
        <input type="text" name="name" value="<?= htmlspecialchars($trainer['name']) ?>" required>

        <label>Email (readonly):</label><br><br>
        <input type="email" value="<?php echo htmlspecialchars($trainer['email'] ?? ''); ?>" readonly>

        <label>Specialization:</label><br><br>
        <input type="text" name="specialization"
            value="<?php echo htmlspecialchars($trainer['specialization'] ?? ''); ?>">

        <label>Experience (years):</label><br><br>
        <input type="number" name="experience_years"
            value="<?php echo htmlspecialchars($trainer['experience_years'] ?? ''); ?>">

        <label>WhatsApp Group Link:</label><br><br>
        <input type="text" name="whatsapp_group"
            value="<?php echo htmlspecialchars($trainer['whatsapp_group'] ?? ''); ?>">

        <label>Instagram:</label><br><br>
        <input type="text" name="instagram" value="<?php echo htmlspecialchars($trainer['instagram'] ?? ''); ?>">

        <label>LinkedIn:</label><br><br>
        <input type="text" name="linkedin" value="<?php echo htmlspecialchars($trainer['linkedin'] ?? ''); ?>">

        <label>Bio:</label><br><br>
        <textarea name="bio"><?php echo htmlspecialchars($trainer['bio'] ?? ''); ?></textarea>

        <label>New Password (leave blank to keep current):</label><br><br>
        <input type="password" name="password">


        <button type="submit">Update Profile</button>
        <a href="trainer_dashboard.php"><button type="button">Back to Dashboard</button></a>
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