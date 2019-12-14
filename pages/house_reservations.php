<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'templates/drawTemplate.php');

$user = getSessionUser();
if (!$user) {
    header('Location: home.php');
    die;
}

$house = getHouse($_GET['id']);
if ($house['landlordID'] !== $user['id']) {
    header('Location: home.php');
    die;
}

$reservations = getReservations($house['houseID'], 'accepted');

renderPage(
    array('house_reservations'), 
    array('request', 'house_reservations'), 
    function() use ($house) { ?>

        <h1>House overview</h1>
        <h2><?= $house['title'] ?></h2>
        <div id="reservation-type-buttons">
            <a class="selected-tab" id="confirmed-reservations-tab">
                Confirmed
            </a>
            <a id="pending-reservations-tab">
                Pending
            </a>
        </div>
        <div id="reservations-table">
        </div>

<?php }) ?>