<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$reservations = getReservations($_GET['houseId'],  $_GET['status']);

$response = array(
    'result'=>'error',
    'message'=>''
);

$responseContent = array();
foreach ($reservations as $reservation) {
    $res = array();
    $tenant = getUserById($reservation['tenantID']);

    $res['reservationId'] = $reservation['reservationID'];
    $res['tenantId'] = $reservation['tenantID'];
    $res['tenantName'] = $tenant['firstName'] . ' ' . $tenant['lastName'];
    $res['startDate'] = $reservation['startDate'];
    $res['endDate'] = $reservation['endDate'];
    $res['numberOfPeople'] = $reservation['numberOfPeople'];
    $res['status'] = $reservation['status'];

    $twoDaysFromNow = new DateTime('+2 days');
    $res['cancelable'] = strcmp($reservation['startDate'], $twoDaysFromNow->format('Y-m-d')) > 0;

    $responseContent[] = $res;
}

$response['result'] = 'success';
$response['message'] = 'Retrived reservations successfully';
$response['reservationsStatus'] = $_GET['status'];
$response['content'] = $responseContent;

echo json_encode($response);

?>