<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

if (!isset($_SESSION['username'])) {
    header('Location: ../pages/home.php');
    die;
}

$imageNames = $_FILES['images']['tmp_name'];
$houseId = $_POST['houseId'];
foreach($imageNames as $image) {
    $fileName = '';
    do {
        $fileName = generateRandomName(32);
    } while(pictureExists($fileName));
    addHousePicture($houseId, $fileName);
    move_uploaded_file($image, ROOT . 'database/housePictures/'.$fileName);
}

header('Location: ../pages/home.php');

?>
