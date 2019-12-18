<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

if (!isLandlord($user['id'])) {
    error('403');
}

$houses = getLandlordHouses($user['id']);

renderPage(array('dashboard'), array(), function() use($houses) { ?>
    <h1>Dashboard</h1>
    <a href="../pages/add_house.php">
        <button>
            Post a house
        </button>
    </a>
    <section class="dashboard-houses">
    <?php 
    foreach ($houses as $house) {
        $housePic = getFirstHousePic($house['houseID']);  
    ?>
        <a href="house_overview.php?id=<?= $house['houseID'] ?>">
            <div class="dashboard-card">
                <div class="dashboard-house-pic-container">
                    <?php if ($housePic === FALSE)  { ?>
                        <img src="../database/housePictures/default" alt="House picture" class="reservation-house-picture">
                    <?php } 
                    else { ?>
                        <img src="../database/housePictures/<?= $housePic['pictureID'] ?>" alt="House picture" class="reservation-house-picture">
                    <?php } ?>
                </div>
                <div class="dashboard-card-main-info">
                    <h2 class="dashboard-card-title"><?=$house['title'] ?></h2>
                    <div class="dashboard-card-rating-price-info">
                        <p class="dashboard-card-rating"><?=$house['avgRating'] ?> &star;</p>
                        <p class="dashboard-card-price"><?=$house['pricePerNight']?>$/night </p>
                    </div>
                    <p class="dashboard-card-capacity">For <?= $house['capacity'] ?> people</p>
                    <p class="dashboard-card-address"><?=$house['address'] ?></p>
                </div>
            </div>
        </a>
    <?php } ?>
    </section>
<?php }); ?>