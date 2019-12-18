<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'includes/responses.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'includes/Reservation.php');

$response = prepareResponse();

$user = getSessionUser();
if (!$user) {
    $response['type'] = '1';
    $response['message'] = 'Operation no allowed.';
    reply($response);
}

if ($user['id'] !== htmlspecialchars($_POST['tenantId'])) {
    $response['type'] = '1';
    $response['message'] = 'Operation no allowed.'; 
    reply($response);
}

$checkInDate = htmlspecialchars($_POST['checkInDate']);
$checkOutDate = htmlspecialchars($_POST['checkOutDate']);

if ($checkInDate == $checkOutDate) {
    $response['type'] = '2';
    $response['message'] = 'Check in and check out dates coincide.';
    reply($response);
}
if ($checkInDate > $checkOutDate) {
    $response['type'] = '2';
    $response['message'] = 'Check in date happens before check out date.';
    reply($response);
}

if (strcmp($checkInDate, date('Y-m-d')) < 0) {
    $response['type'] = '2';
    $response['message'] = 'Check in date happens in the past.';
    reply($response);
}

$reservations = array_merge(
    getReservations(htmlspecialchars($_POST['houseId']), 'accepted'), 
    getReservations(htmlspecialchars($_POST['houseId']), 'pending')
);


foreach ($reservations as $reservation) {
    $reservationStart = $reservation['startDate'];
    $reservationEnd = $reservation['endDate'];
    if (strcmp($checkInDate,$reservationEnd) <= 0 && strcmp($checkOutDate,$reservationStart) >= 0){
        $response['type'] = '2';
        $response['message'] = 'House will be occupied during the period you requested.';
        reply($response);
    }
}

$house = getHouse(htmlspecialchars($_POST['houseId']));

$numberOfPeople = intval(htmlspecialchars($_POST['numberOfPeople']));
$houseCapacity = intval($house['capacity']);

if ($numberOfPeople < 1) {
    $response['type'] = '2';
    $response['message'] = 'Please use a positive number of people.';
    reply($response);
}

if ($numberOfPeople > $houseCapacity) {
    $response['type'] = '2';
    $response['message'] = 'House capacity exceeded.';
    reply($response);
}

$reservation = new Reservation();
$reservation->houseId = htmlspecialchars($_POST['houseId']);
$reservation->tenantId = htmlspecialchars($_POST['tenantId']);
$reservation->startDate = $checkInDate;
$reservation->endDate = $checkOutDate;
$reservation->numberOfPeople = $numberOfPeople;

addReservation($reservation);

$response['result'] = 'success';
$response['type'] = '0';
$response['message'] = 'Reservation successful';

echo json_encode($response);

?>