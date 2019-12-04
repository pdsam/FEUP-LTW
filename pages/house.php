<?php 
include_once('../config.php');
include_once(ROOT . 'templates/common/header.php');
include_once(ROOT.'templates/common/footer.php');
include_once(ROOT.'templates/common/loginForm.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

$houseID = $_GET['h'];

renderPage(array('house'),array(),function() use ($houseID) {
  $house = getHouseInfo($houseID);
  ?>
  <div class="house-carousel">
    <div class="image-changer">
      <p>&larr;</p>
    </div>
    <div class="image-wrapper">
      <img class="house-image" src="../house.jpg" alt="House image">
    </div>
    <div class="image-changer">
      <p>&rarr;</p>
    </div>
  </div>
  <div class="house-content-wrapper">
    <div class="house-information">
      <h1>House <?= $house['houseID'] ?></h1>
      <p>Rating</p>
      <p><?= $house['pricePerNight'] ?>€ per night</p>
    </div>
  
    <ul class="content-tabs" >
      <li class="selected-tab" id="description-tab">Description</li>
      <li id="reviews-tab">Reviews</li>
    </ul>
  
    <!-- only description for now -->
    <section class="tabbed-content" > 
      <div>
        <p><?= $house['description'] ?></p>
      </div>
    </section>
  </div>
<?php } ); ?>

