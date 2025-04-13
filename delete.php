<?php
require 'user.php';

if (isset($_GET['id'])) {
    deleteUser($_GET['id']);
    header("Location: dashboard.php");
}
?>