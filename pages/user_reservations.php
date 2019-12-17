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
        <?php foreach($reservations as $reservation) { 
            $housePic = getFirstHousePic($reservation['houseID']);  
            ?>
            <li class="list-item-reservation">
                <div class="reservation-house-pic-container">
                    <?php if ($housePic === FALSE)  { ?>
                        <img src="../database/housePictures/default" alt="House picture" class="reservation-house-picture">
                    <?php } 
                    else { ?>
                        <img src="../database/housePictures/<?= $housePic['pictureID'] ?>" alt="House picture" class="reservation-house-picture">
                    <?php } ?>
                </div>
                <div>
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
                                case 'rejected' : echo 'Rejected'; break;
                                case 'canceled' : echo 'Canceled'; break;
                            }
                        ?>
                    </p>
                    <?php 
                        $twoDaysFromNow = new DateTime('+2 days');
                        if (strcmp($reservation['startDate'], $twoDaysFromNow->format('Y-m-d')) > 0 &&
                            ($reservation['status'] !== 'canceled' && $reservation['status'] !== 'rejected')) { ?>
                            <button class="cancel-reservation-button" id="<?= $reservation['reservationID'] ?>">Cancel</button>
                        <?php }
                    ?>
                </div>
            </li>
        <?php } ?>
    </ul>
<?php };

renderPage(
    array('user_reservations'),
    array('request', 'user_reservations'),
    $renderFunction  
);

?>