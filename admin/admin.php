<?php
include_once 'connection.php';

if (isset($_SESSION['admin'])) {
    header('Location: dashboard.php');
} else {
    header('Location: login.php');
}
?>