<?php
session_start();

if (isset($_SESSION['email']) && $_SESSION['role'] === 'User') {
    echo json_encode(['logged_in' => true]);
} else {
    echo json_encode(['logged_in' => false]);
}
?>
