<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

$response = array(
    'result' => 'error',
    'type'=>'0',
    'message'=>''
);

$user = getSessionUser();

if (!$user) {
    $response['message'] = 'Not logged in.';
    $response['type'] = '1';
    echo json_encode($response);
    die;
}

$house = getHouse($_POST['houseId']);
if (!$house) {
    $response['message'] = 'House doesnt exist.';
    $response['type'] = '2';
    echo json_encode($response);
    die;
}

if (!hasRented($user['id'], $house['houseID'])) {
    $response['message'] = 'User has never rented the house.';
    $response['type'] = '2';
    echo json_encode($response);
    die;
}

$reservations = getUserHouseReservations($user['id'], $house['houseID']);
$beenTo = false;
$now = new DateTime();
foreach($reservations as $reservation) {
    if ($reservation['startDate'] < $now->format('Y-m-d')) {
        $beenTo = true;
        break;
    }
}

if (!$beenTo) {
    $response['message'] = 'User has reservation but it still hasn\'t passed.';
    $response['type'] = '2';
    echo json_encode($response);
    die;
}

$rating = intval($_POST['rating']);
if ($rating < 0 || $rating > 10) {
    $response['message'] = 'Invalid rating value.';
    $response['type'] = '2';
    echo json_encode($response);
    die;
}

$text = htmlspecialchars($_POST['text']);
postReview($house['houseID'], $user['id'], $rating, $text);

?>