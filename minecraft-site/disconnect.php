<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['pseudo']);
unset($_SESSION['email']);
unset($_SESSION['password']);
header("Location: /index.php");
?>