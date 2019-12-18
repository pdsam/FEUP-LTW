<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    redirectHome();
}

$house = getHouse(htmlspecialchars($_POST['houseId']));
if ($house['landlordID'] !== $user['id']) {
    echo 'e';
    error('403');
}

$target_dir = ROOT . 'database/housePictures/';

$filename = htmlspecialchars($_POST['picId']);
$file = $target_dir . $filename;

$picture = getHousePicture($filename, $house['houseID']);
if (!$picture) {
    error($filename . ' ' . $house['houseID']);
}

removeHousePicture($filename, $house['houseID']);
unlink($file);

header("Location: ../pages/manage_house_pictures.php?houseId={$house['houseID']}");

?>