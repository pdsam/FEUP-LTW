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

$houseId = $_POST['houseId'];
if (!$houseId) {
    $response['type'] = '1';
    $response['message'] = 'No house id given.';
    reply($response);
}

$givenHouse = getHouse($houseId);
if ($givenHouse['landlordID'] !== $user['id']) {
    $response['type'] = '1';
    $response['message'] = 'Not the house\'s owner.';
    reply($response);
}

$house = new House();

$house->title = $_POST['title'];
//var_dump($_POST);
if (strlen($house->title) > 100) {
    $response['type'] = '2';
    $response['message'] = 'House title is too long. Should be shorter than 100 characters.';
    reply($response);
}

$house->pricePerNight = $_POST['pricePerNight'];
if (intval($house->pricePerNight) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Price per night should be positive.';
    reply($response);
}

$house->area = $_POST['area'];
if (intval($house->area) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Area should be positive.';
    reply($response);
}

$house->location = $_POST['locationId'];
if (!locationExists($house->location)) {
    $response['type'] = '2';
    $response['message'] = 'Location does not exist.';
    reply($response);
}

$house->capacity = $_POST['capacity'];
if (intval($house->capacity) <= 0) {
    $response['type'] = '2';
    $response['message'] = 'Capacity should be positive.';
    reply($response);
}

$house->description = $_POST['description'];
if (strlen($house->description) > 500) {
    $response['type'] = '2';
    $response['message'] = 'Description is too long. Should be shorter than 500 characters.';
    reply($response);
}

updateHouseInfo($houseId, $house);

$response['result'] = 'success';
$response['type'] = '0';
$response['message'] = 'House updated with success.';
$response['houseId'] = $houseId;

reply($response);

?>