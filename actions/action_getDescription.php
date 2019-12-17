<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');

$houseID = $_GET['houseId'];

$house = getHouse($houseID);
?>
      
<div class="description">
    <p><?= $house['description'] ?></p>
</div>
