<?php
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'General') {
    header("Location: /PawsitiveWhispers/Main/view/SignIn.php?error=unauthorized");
    exit();
}

$activePage = 'home';

require_once '../view/GeneralUserHomepage.php';