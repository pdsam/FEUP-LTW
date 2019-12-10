<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'templates/drawTemplate.php');

if (!isset($_SESSION['username'])) {
    header('Location: home.php');
    die;
}

$user = getUser($_SESSION['username']);
$house = getHouse($_GET['id']);

if ($house['landlordID'] !== $user['id']) {
    header('Location: home.php');
    die;
}

$reservations = getConfirmedReservations($house['houseID']);

renderPage(array('house_reservations'), array(), function() use ($house, $reservations) { ?>

<h1>House overview</h1>
<h2><?= $house['title'] ?></h2>

<table id="reservations-table">
    <tr>
        <th align="left">Tenant</th>
        <th align="left">Check in date</th>
        <th align="left">Check out date</th>
        <th align="left">Numer of people</th>
    </tr>
    <?php foreach($reservations as $reservation) { 
        $tenant = getUserById($reservation['tenantID']);
        ?>

        <tr class="reservation">
            <td>
                <a href="profile.php?Id=<?= $tenant['id'] ?>">
                    <b><?= $tenant['firstName'] ?> <?= $tenant['lastName'] ?></b>
                </a>
            </td>
            <td><?= $reservation['startDate'] ?></td>
            <td><?= $reservation['endDate'] ?></td>
            <td><?= $reservation['numberOfPeople'] ?></td>
        </tr>
    <?php } ?>
</table>

<?php }) ?>