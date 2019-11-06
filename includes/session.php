<?php 
session_start();

function generateToken() {
    return bin2hex(openssl_random_pseudo_bytes(64));
}

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generateToken();
}
    
?>