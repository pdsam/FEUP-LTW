<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'includes/responses.php');
include_once(ROOT . 'database/db_houses.php');

$response = prepareResponse();

$user = getSessionUser();

if (!$user) {
    $response['message'] = 'Not logged in.';
    $response['type'] = '1';
    reply($response);
}

$house = getHouse($_POST['houseId']);
if (!$house) {
    $response['type'] = '2';
    $response['message'] = 'House doesnt exist.';
    reply($response);
}

if ($house['landlordID'] === $user['id']) {
    $response['type'] = '2';
    $response['message'] = 'You can\'t review your own house.';
    reply($response);
}

if (!hasRented($user['id'], $house['houseID'])) {
    $response['message'] = 'User has never rented the house.';
    $response['type'] = '2';
    reply($response);
}

$reservations = getUserHouseReservations($user['id'], $house['houseID']);
$beenTo = false;
$now = new DateTime();
foreach($reservations as $reservation) {
    if (strcmp($reservation['startDate'], $now->format('Y-m-d')) < 0) {
        $beenTo = true;
        break;
    }
}

if (!$beenTo) {
    $response['message'] = 'User has reservation but it still hasn\'t passed.';
    $response['type'] = '2';
    reply($response);
}

$rating = intval($_POST['rating']);
if ($rating < 0 || $rating > 10) {
    $response['message'] = 'Invalid rating value.';
    $response['type'] = '2';
    reply($response);
}

$text = htmlspecialchars($_POST['text']);
postReview($house['houseID'], $user['id'], $rating, $text);

$response['result'] = 'success';
echo json_encode($response);

?>