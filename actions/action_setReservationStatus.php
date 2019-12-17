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
$house = getHouse($reservation['houseID']);

if ($_POST['status'] === 'canceled') {
    if ($house['landlordID'] !== $user['id'] && $reservation['tenantID'] !== $user['id']) {
        $response['type'] = '1';
        $response['message'] = 'Not allowed to do this.';
        echo json_encode($response);
        die;
    }

    $twoDaysFromNow = new DateTime('+2 days');

    if (strcmp($reservation['startDate'], $twoDaysFromNow->format('Y-m-d')) <= 0) {
        $response['type'] = '2';
        $response['message'] = 'Too late.';
        echo json_encode($response);
        die;
    }
} else {
    if ($house['landlordID'] !== $user['id']) { 
        $response['type'] = '1';
        $response['message'] = 'Not owner of the house.';
        echo json_encode($response);
        die;
    }
}

if (!setReservationStatus($_POST['reservationId'], $_POST['status'])) {
    $response['type'] = '2';
    $response['message'] = 'Incorrect status.';
    echo json_encode($response);
    die;
}

$response['result'] = 'success';
$response['message'] = 'Changed reservation status succesfully';
$response['reservationId'] = $_POST['reservationId'];

echo json_encode($response);

?>