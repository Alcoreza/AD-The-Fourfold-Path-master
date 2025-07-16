<?php
require_once dirname(__DIR__) . '/bootstrap.php';
require_once UTILS_PATH . 'logoutUser.util.php';

logoutUser();

// Optional: Notify user they have logged out successfully
$_SESSION['login_success'] = 'You have been logged out successfully.';

header("Location: /pages/loginPage/index.php");
exit();
