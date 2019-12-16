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
$house->title = htmlspecialchars($_POST['title']);
$house->pricePerNight = htmlspecialchars($_POST['pricePerNight']);
$house->area = htmlspecialchars($_POST['area']);
$house->location = $_POST['locationId'];
$house->capacity = $_POST['capacity'];
$house->description = $_POST['description'];

$houseID = addHouse($house);

header("Location: ../pages/add_house_images.php?houseId=$houseID");

?>