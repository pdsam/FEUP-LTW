<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');


$user = getSessionUser();
if (!$user) {
    header('Location: ../pages/home.php');
    die;
}

$target_dir = ROOT . "database/profilePictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
var_dump($target_file);
$pictureID = generateRandomName(32);
$new_target_file = $target_dir . $pictureID;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$error_message = "";

if(isset($_POST["submit"])) {

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check=== true){
        $uploadOk = 0;
        $error_message = "Not a real image";
        echo "$error_message";
    }

    else if ($_FILES["fileToUpload"]["size"] > 2000000) {
        $uploadOk = 0;
        $error_message = "Image size must be lower then 2mb";
        echo "$error_message";
    } 

    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        $uploadOk = 0;
        $error_message = "<p>Unsupported Image Type</p>";
        echo "$imageFileType" . " :stuff";
        echo "$error_message";
    } 

    if($uploadOk == 1){
        move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
        rename($target_file,$new_target_file);
        setProfilePicture($user['id'],$pictureID);
    }
}

    header('Location:../pages/profile.php');
?>