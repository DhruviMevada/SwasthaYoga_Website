<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Trainer') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trainer_email = $_SESSION['email'];
    $course_name = $_POST['course_name'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $level = $_POST['difficulty_level'];
    $whatsapp_group_link = $_POST['whatsapp_group_link'];

    $sql = "INSERT INTO courses (trainer_email, title, description, duration, difficulty_level, whatsapp_group_link)
            VALUES ('$trainer_email', '$course_name', '$description', '$duration', '$level', '$whatsapp_group_link')";
    mysqli_query($conn, $sql);
    header("Location: manage_courses.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Course</title>
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
            option{ 
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
    <form method="POST" class="add-course-form">
        <h2>Add New Course</h2>
        <br>
        <select name="course_name" required>
            <option value="">Select a Yoga Course</option>
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
        <label>Description:</label>
        <br><br>
        <textarea name="description" required></textarea>
        <br><br>
        <label>Duration:</label>
        <br><br>
        <input type="text" name="duration" placeholder="e.g., 4 weeks" required>
        <br><br>
        <label>Difficulty Level:</label>
        <br><br>
        <select name="difficulty_level" required>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
        </select>
        <br><br>
        <label>WhatsApp Group Link:</label>
        <br><br>
        <input type="text" name="whatsapp_group_link" placeholder="https://chat.whatsapp.com/..." required>
        <br><br>
        <button type="submit">Add Course</button>
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