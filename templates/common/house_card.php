<?php
include_once(ROOT . 'database/db_houses.php');

function draw_house_cards($houses) {

  foreach ($houses as $house) {
    draw_house_card($house);
  }
} 
?>


<?php function draw_house_card($house) { 
  $housePic = getFirstHousePic($house['houseID']);  
?>

<a href="../pages/house.php?h=<?= $house['houseID'] ?>">
  <div class="house-card">
    <div class="thumbnail-container">
    <?php if ($housePic === FALSE)  { ?>
      <div class="card-thumbnail" style="background-image: url('../house.jpg')"></div>
    <?php } 
    else { ?>
      <div class="card-thumbnail" style="background-image: url(../database/housePictures/<?= $housePic['pictureID']?>)"></div>
    <?php } ?>
    </div>
    <div class="card-info">
      <h3 class="house-card-title clip-text"><?= $house['title'] ?></h3>
      <p class="house-card-address clip-text"><?= $house['address'] ?></p>
      <div class="price-rating-container">
        <p class="house-card-price"><?= $house['pricePerNight'] ?>$/night</p>
        <p class="house-card-rating"><?= $house['avgRating'] ?>&star;</p>
      </div>
    </div>
  </div>
</a>
<?php } ?>