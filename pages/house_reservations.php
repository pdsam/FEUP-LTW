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

$renderFunction = function() use ($house) { ?>
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
<?php };

$house = getHouse($_GET['id']);
if ($house['landlordID'] !== $user['id']) {
    $renderFunction = error("You have no permission to access this page.");
    die;
}

renderPage(
    array('house_reservations'), 
    array('request', 'house_reservations'),
    $renderFunction 
); ?>