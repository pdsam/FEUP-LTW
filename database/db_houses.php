<?php
include_once(ROOT . 'includes/database.php');

function addHouse($house) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('insert into house(landlordID, pricePerNight, title, description, area, address, capacity) values (?,?,?,?,?,?,?)');
    $stmt->execute(array(
        $house->landlordID,
        $house->pricePerNight,
        $house->title,
        $house->description,
        $house->area,
        $house->address,
        $house->capacity
    ));

    return $db->lastInsertId();
}

function getHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT houseID description FROM house');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house where landlordID=?');
    $stmt->execute(array($landlordID));
    return $stmt->fetchAll();
}

?>