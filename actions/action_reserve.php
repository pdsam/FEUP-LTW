<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'includes/Reservation.php');

$response = array(
    'result'=>'error',
    'type'=>'0',
    'message'=>''
);

$user = getSessionUser();
if (!$user) {
    $response['type'] = '1';
    $response['message'] = 'Operation no allowed.';
    echo json_encode($response);
    die;
}

if ($user['id'] !== $_POST['tenantId']) {
    $response['type'] = '1';
    $response['message'] = 'Operation no allowed.'; 
    echo json_encode($response);
    die;
}

$checkInDate = $_POST['checkInDate'];
$checkOutDate = $_POST['checkOutDate'];

if ($checkInDate == $checkOutDate) {
    $response['type'] = '2';
    $response['message'] = 'Check in and check out dates coincide.';
    echo json_encode($response);
    die;
}
if ($checkInDate > $checkOutDate) {
    $response['type'] = '2';
    $response['message'] = 'Check in date happens before check out date.';
    echo json_encode($response);
    die;
}

if ($checkInDate > date("d/m/Y")) {
    $response['type'] = '2';
    $response['message'] = 'Check in date happens in the past.';
    echo json_encode($response);
    die;
}

$reservations = array_merge(
    getReservations($_POST['houseId'], 'accepted'), 
    getReservations($_POST['houseId'], 'pending')
);


foreach ($reservations as $reservation) {
    $reservationStart = $reservation['startDate'];
    $reservationEnd = $reservation['endDate'];
    if (strcmp($checkInDate,$reservationEnd) <= 0 && strcmp($checkOutDate,$reservationStart) >= 0){
        $response['message'] = 'House will be occupied during the period you requested.';
        echo json_encode($response);
        die;
    }
}

$house = getHouse($_POST['houseId']);

$numberOfPeople = intval($_POST['numberOfPeople']);
$houseCapacity = intval($house['capacity']);

if ($numberOfPeople < 1) {
    $response['message'] = 'Please use a positive number of people.';
    echo json_encode($response);
    die;
}

if ($numberOfPeople > $houseCapacity) {
    $response['message'] = 'House capacity exceeded.';
    echo json_encode($response);
    die;
}

$reservation = new Reservation();
$reservation->houseId = $_POST['houseId'];
$reservation->tenantId = $_POST['tenantId'];
$reservation->startDate = $checkInDate;
$reservation->endDate = $checkOutDate;
$reservation->numberOfPeople = $numberOfPeople;

addReservation($reservation);

$response['result'] = 'success';
$response['message'] = 'Reservation successful';

echo json_encode($response);

?>