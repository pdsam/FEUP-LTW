<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'includes/House.php');

$user = getSessionUser();
if (!$user) {
    header('Location: ../pages/home.php');
    die;
}

$house = new House();
$house->landlordID = $user['id'];
$house->title = $_POST['title'];
$house->pricePerNight = $_POST['pricePerNight'];
$house->area = $_POST['area'];
$house->address = $_POST['address'];
$house->capacity = $_POST['capacity'];
$house->description = $_POST['description'];

$houseID = addHouse($house);

header("Location: ../pages/add_house_images.php?houseId=$houseID");

?>