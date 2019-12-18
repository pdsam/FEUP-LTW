<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'includes/House.php');
include_once(ROOT . 'includes/responses.php');

$response = prepareResponse();

$user = getSessionUser();
if (!$user) {
    $response['type'] = '1';
    $response['message'] = 'Not logged in.';
    reply($response);
}

$house = new House();
$house->landlordID = $user['id'];

$house->title = htmlspecialchars($_POST['title']);

if (strlen($house->title) > 100) {
    $response['type'] = '2';
    $response['message'] = 'House title is too long. Should be shorter than 100 characters.';
    reply($response);
}

$house->pricePerNight = htmlspecialchars($_POST['pricePerNight']);
if (intval($house->pricePerNight) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Price per night should be positive.';
    reply($response);
}

$house->pricePerNight = htmlspecialchars($_POST['pricePerNight']);
if (intval($house->pricePerNight) > 1000000) {
    $response['type'] = '2';
    $response['message'] = 'Price per night should not me greater than one million.';
    reply($response);
}

$house->area = htmlspecialchars($_POST['area']);
if (intval($house->area) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Area should be positive.';
    reply($response);
}

$house->area = htmlspecialchars($_POST['area']);
if (intval($house->area) > 1000) {
    $response['type'] = '2';
    $response['message'] = 'Area should not be greater than 1000 meters squared.';
    reply($response);
}

$house->location = htmlspecialchars($_POST['locationId']);
if (!locationExists($house->location)) {
    $response['type'] = '2';
    $response['message'] = 'Location does not exist.';
    reply($response);
}

$house->capacity = htmlspecialchars($_POST['capacity']);
if (intval($house->capacity) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Capacity should be positive.';
    reply($response);
}

$house->capacity = htmlspecialchars($_POST['capacity']);
if (intval($house->capacity) > 1000) {
    $response['type'] = '2';
    $response['message'] = 'Capacity should not be greater than 1000 people.';
    reply($response);
}

$house->description = htmlspecialchars($_POST['description']);
if (strlen($house->description) > 500) {
    $response['type'] = '2';
    $response['message'] = 'Description is too long. Should be shorter than 500 characters.';
    reply($response);
}

$houseID = addHouse($house);

$response['result'] = 'success';
$response['type'] = '0';
$response['message'] = 'House added with success';
$response['houseId'] = $houseID;

reply($response);

?>