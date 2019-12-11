<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$response = array(
    'result'=>'error',
    'type'=>'0',
    'message'=>''
);

$user = getSessionUser();
if (!$user) {
    $response['type'] = '1';
    $response['message'] = 'Not logged in.';
    echo json_encode($response);
    die;
}

$reservation = getReservation($_POST['reservationId']);
$house = getHouse($reservation[0]['houseID']);
//$response['id'] = var_dump($reservation);
//TODO ask wth fethc() returns array in array.

if ($house['landlordID'] !== $user['id']) {
    $response['type'] = '2';
    $response['message'] = 'Not owner of the house.';
    echo json_encode($response);
    die;
}

if (!setReservationStatus($_POST['reservationId'], $_POST['status'])) {
    $response['type'] = '3';
    $response['message'] = 'Incorrect status.';
    echo json_encode($response);
    die;
}

$response['result'] = 'success';
$response['message'] = 'Changed reservation status succesfully';
$response['reservationId'] = $_POST['reservationId'];

echo json_encode($response);

?>