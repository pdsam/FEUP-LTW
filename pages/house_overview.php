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

$house = getHouse(htmlspecialchars($_GET['id']));
if (!$house) {
    header('Location: home.php');
    die;
}

$renderFunction = function() use ($house) { ?>
        <h1 class="heading">House overview</h1>
        <div class="house-info">
            <h2 class="house-info-title"><?= $house['title'] ?></h2>
            <div class=info-wrapper>
                <p class="info-title">Average Rating</p> 
                <p class="info"><?= $house['avgRating'] ?> &star;</p>
          </div>
          <div class="info-wrapper">
            <p class="info-title">Price</p> 
            <p class="info"><?= $house['pricePerNight'] ?>$/night</p>
          </div>
          <div class="info-wrapper">
            <p class="info-title">Capacity</p> 
            <p class="info"><?= $house['capacity'] ?> people.</p>
          </div>
          <div class="info-wrapper">
            <p class="info-title">Address</p> 
            <p class="info"><?= $house['address'] ?></p>
          </div>
          
        </div>
        <div class="management-buttons">
            <a href="edit_house.php?houseId=<?= $house['houseID'] ?>">
                <button>Edit information</button>
            </a>
            <a href="manage_house_pictures.php?houseId=<?= $house['houseID'] ?>">
                <button>Manage pictures</button>
            </a>
        </div>
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