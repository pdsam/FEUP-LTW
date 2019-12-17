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

$houseId = $_POST['houseId'];
$house = getHouse($houseId);

if ($house['landlordID'] !== $user['id']) {
    error('403');
}

$target_dir = ROOT . "database/housePictures/";
$uploaded_file = $_FILES["image"]["tmp_name"];

if (validImage($_FILES['image'])) {
    $fileName = '';
    do {
        $fileName = generateRandomName(32);
    } while(file_exists($target_dir . $fileName));

    $target_file = $target_dir . $fileName;

    addHousePicture($houseId, $fileName);
    move_uploaded_file($uploaded_file, $target_file);
}

header("Location: ../pages/add_house_images.php?houseId=$houseId");

?>
