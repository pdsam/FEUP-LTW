<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    header('Location: ../pages/home.php');
    die;
}

$houseId = $_POST['houseId'];
$house = getHouse($houseId);

if ($house['landlordID'] !== $user['id']) {
    header('Location: ../pages/home.php');
    die;
}

$imageNames = $_FILES['images']['tmp_name'];

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
