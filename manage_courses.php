<?php
session_start();
include 'db.php';

if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'Trainer') {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Handle course deletion
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM courses WHERE id=$id AND trainer_email='$email'");
    header("Location: manage_courses.php");
    exit();
}

// Fetch courses
$courses = mysqli_query($conn, "SELECT * FROM courses WHERE trainer_email='$email'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
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

        .container {
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 100px;
            background: rgba(239, 238, 238, 0.5);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: rgba(239, 238, 238, 0.5);
        }

        th,
        td {
            text-align: center;
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #d28cbc;
            color: white;
        }

        a.button,
        button {
            padding: 6px 12px;
            background: #d28cbc;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .m_button {
            padding: 10px 20px;
            background: #d28cbc;
            color: white;
            text-decoration: none;
            border: none;
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
            nav ul li a {
                font-size: 16px;
            }

            table {
                border: 0;
            }

            th {
                display: none;
            }

            tr {
                display: block;
                margin-bottom: 15px;
                background-color: rgba(255, 255, 255, 0.5);
                border-radius: 10px;
                padding: 10px;
                box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
            }

            td {
                display: flex;
                /* justify-content: space-between; */
                padding: 10px;
                font-size: 14px;
                border-bottom: 1px solid #ccc;
            }

            td::before {
                content: attr(data-label);
                flex-basis: 30%;
                font-weight: 800;
                color: #d28cbc ;
            }

            td:last-child {
                border-bottom: none;
            }
        }

        .button {
            padding: 5px 10px;
            font-size: 13px;
            margin: 2px;
            display: inline-block;
        }
        
    </style>
</head>

<body>
    <nav>
        <ul>
            <li><a href="trainer_dashboard.php"><i class="fa-solid fa-arrow-left"></i></a></li>
        </ul>
    </nav>
    <div class="container">
        <h2>Manage My Courses</h2><br><br>
        <a href="add_course.php" class="m_button">Add New Course</a><br><br>
        <table>
            <tr>
                <th>Title</th>
                <th>Duration</th>
                <th>Level</th>
                <th>Join</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($courses)): ?>
                <tr>
                    <td data-label="Title"><?= htmlspecialchars($row['title']) ?></td>
                    <td data-label="Duration"><?= $row['duration'] ?></td>
                    <td data-label="Level"><?= $row['difficulty_level'] ?></td>
                    <td data-label="Join"><a href="<?= $row['whatsapp_group_link'] ?>" target="_blank">Join</a></td>
                    <td data-label="Actions">
                        <a href="edit_course.php?id=<?= $row['id'] ?>" class="button">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="button"
                            onclick="return confirm('Delete this course?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
    </div>
    </table>

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