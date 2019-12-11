<?php 
include_once('../database/db_users.php');
session_start();

function generateToken() {
    return bin2hex(openssl_random_pseudo_bytes(64));
}

function getSessionUser() {
    if (!isset($_SESSION['username'])) {
        return false;
    }
    return getUser($_SESSION['username']);
}

function generateRandomName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

if (!isset($_SESSION['csrf'])) {
    $_SESSION['csrf'] = generateToken();
}
    
?>