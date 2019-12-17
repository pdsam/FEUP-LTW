<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'includes/images.php');

$user = getSessionUser();
if (!$user) {
    header('Location: ../pages/home.php');
    die;
}

$target_dir = ROOT . "database/profilePictures/";
$uploaded_file = $_FILES["fileToUpload"]["tmp_name"];


if (validImage($_FILES['fileToUpload'])) {
    $pictureID = '';
    do {
        $pictureID = generateRandomName(32);
    } while(file_exists($target_dir . $pictureID));
    
    $target_file = $target_dir . $pictureID;
    
    move_uploaded_file($uploaded_file, $target_file);

    if ($user['profilePicture'] !== 'default') {
        unlink($target_dir . $user['profilePicture']);
    }

    setProfilePicture($user['id'], $pictureID);
}

header('Location:../pages/profile.php');
?>