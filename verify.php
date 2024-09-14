<?php
require_once '../classes/user.class.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    $user = new User();
    if ($user->verifyToken($token)) {
        echo "Your email has been successfully verified.";
    } else {
        echo "Invalid or expired token.";
    }
} else {
    echo "No token provided.";
}
?>