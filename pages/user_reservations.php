<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

$reservations = getReservationByTenant($user['id']);

$renderFunction = function() use($reservations) { ?>
    <h1>Your reservations</h1>
    <ul class="reservation-list">
        <?php foreach($reservations as $reservation) { ?>
            <li class="list-item-reservation">
                <a class="reservation-title" href="../pages/house.php?h=<?= $reservation['houseID'] ?>"> 
                    <p><?= $reservation['title'] ?></p>
                </a>
                <p class="reservation-date">Start date: <?= $reservation['startDate'] ?></p>
                <p class="reservation-date">End date: <?= $reservation['endDate'] ?></p>
                <p class="reservation-status-<?=$reservation['status']?>"> 
                    <?php 
                        switch($reservation['status']) {
                            case 'pending' : echo 'Pending'; break;
                            case 'accepted' : echo 'Accepted'; break;
                            case 'rejected' : echo 'rejected'; break;
                            case 'canceled' : echo 'Rejected'; break;
                        }
                    ?>
                </p>
            </li>
        <?php } ?>
    </ul>
<?php };

renderPage(
    array('user_reservations'),
    array(),
    $renderFunction  
);

?>