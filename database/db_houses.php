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

    $stmt = $db->prepare('SELECT * FROM house');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getHouse($houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house WHERE houseID=?');
    $stmt->execute(array($houseId));
    return $stmt->fetch();
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house where landlordID=?');
    $stmt->execute(array($landlordID));
    return $stmt->fetchAll();
}

function getReservations($houseID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM rent WHERE houseID=?');
    $stmt->execute(array($houseID));

    return $stmt->fetchAll();
}

function addReservation($reservation) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('insert into rent(houseID, tenantID, startDate, endDate, numberOfPeople) values (?,?,?,?,?)');
    $stmt->execute(array(
        $reservation->houseId,
        $reservation->userId,
        $reservation->startDate,
        $reservation->endDate,
        $reservation->numberOfPeople
    ));

    return $db->lastInsertId();
}

?>