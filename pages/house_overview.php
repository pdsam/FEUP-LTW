<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'templates/drawTemplate.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

$house = getHouse($_GET['id']);
if (!$house) {
    header('Location: home.php');
    die;
}

$renderFunction = function() use ($house) { ?>
        <h1>House overview</h1>
        <h2><?= $house['title'] ?></h2>
        <a href="manage_house_pictures.php?houseId=<?= $house['houseID'] ?>">Manage Pictures</a>
        <ul class="content-tabs" id="tabs">
            <li class="selected-tab" id="confirmed-reservations-tab">Confirmed</li>
            <li class="unselected-tab" id="pending-reservations-tab">Pending</li>
        </ul>
        <div id="reservations-table">
        </div>
<?php };

if ($house['landlordID'] !== $user['id']) {
    error('403');
}

renderPage(
    array('house_overview', 'elements/tabs'), 
    array('request', 'house_overview'),
    $renderFunction 
); ?>