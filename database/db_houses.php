<?php
include_once(ROOT . 'includes/database.php');

function getAllHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getHouseInfo($house) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house WHERE houseID = ?');
    $stmt->execute(array($house));
    return $stmt->fetch();
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();
    $stmt = $db->prepare('SELECT * FROM house where landlordID=?');
    $stmt->execute(array($landlordID));
    return $stmt->fetchAll();
}

?>