<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'includes/session.php');

$user = getSessionUser();
if (!$user) {
    header('Location: ../pages/home.php');
    die;    
}

if ($user['id'] !== $_POST['userId']) {
    header('Location: ../pages/home.php');
    die;
}

$submittedFile = $_FILES['profilePicture']['tmp_name'];

$profilePictureName = generateRandomName(32);
while (file_exists(ROOT . 'database/profilePictures/' . $profilePictureName)) {
    $profilePictureName = generateRandomName(32);
}

setProfilePicture($user['id'], $profilePictureName);

header('Location: ../pages/profile.php');

?>