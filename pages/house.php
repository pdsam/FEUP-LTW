<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_houses.php');

$houseID = $_GET['h'];

renderPage(array('house'),array('house','request'),function() use ($houseID) {
  $house = getHouse($houseID);

  if ($house === false) {
    header('Location: ../pages/404.php');
    die;
  }
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
      <h1><?= $house['title'] ?></h1>
      <p>Average Rating: <?= $house['avgRating'] ?></p>
      <p><?= $house['pricePerNight'] ?>$/night</p>
    </div>
  
    <ul class="content-tabs" id="tabs">
      <li class="selected-tab" id="description-tab">Description</li>
      <li id="reviews-tab">Reviews</li>
    </ul>
  
    <!-- only description for now -->
    <section class="tabbed-content" id="tabbed-content"> 
      <div>
        <p><?= $house['description'] ?></p>
      </div>
    </section>
  </div>
<?php } ); ?>

