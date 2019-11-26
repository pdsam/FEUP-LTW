<?php
include_once('includes/db_houses.php');

function draw_house_cards() {
  $houses = getHouseInfo();

  echo $houses;

  foreach ($houses as $house) {
    draw_house($house);
  }
} 
?>


<?php function draw_house($house) { ?>
    <div class="house-card">
    <div class="card-thumbnail"></div>
    <div class="card-info">
      <h3>House <?= $house['houseId'] ?> </h3>
      <p><?= $house['description'] ?> </p>
    </div>
  </div>
<?php } ?>