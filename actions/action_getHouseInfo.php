<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$house = getHouse($_GET['houseId']);
$landlord = getUserById($house['landlordID']);
?>

<div class="house-sec-information">
    <div class=sec-info-wrapper>
        <p class="info-title">Landlord</p> 
        <p class="info"><?= $landlord['firstName'] ?> <?= $landlord['lastName'] ?></p>
    </div>
    <div class="sec-info-wrapper">
        <p class="info-title">Area</p>
        <p class="info"><?= $house['area'] ?>$/night</p>
    </div>
    <div class="sec-info-wrapper">
        <p class="info-title">Capacity</p>
        <p class="info"><?= $house['capacity'] ?></p>
    </div>
    <div class="sec-info-wrapper">
        <p class="info-title">Location</p>
        <p class="info"><?= $house['name'] ?></p>
    </div>
</div>
    