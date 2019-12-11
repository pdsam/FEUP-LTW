<?php
include_once(ROOT . 'database/db_houses.php');

function draw_house_cards() {
  $houses = getAllHouseInfo();

  foreach ($houses as $house) {
    draw_house_card($house);
  }
} 
?>


<?php function draw_house_card($house) { ?>
    <div class="house-card">
      <a class="card-thumbnail" href="house.php?h=<?= $house['houseID'] ?>"></a>
      <div class="card-info">
        <h3><?= $house['title'] ?></h3>
        <p><?= $house['description'] ?></p>
      </div>
  </div>
<?php } ?>