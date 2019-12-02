<?php
include_once(ROOT . 'includes/database.php');

function getHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT houseID description FROM house');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house where landlord=?');
    $stmt->execute(array($landlordID));
    return $stmt->fetchAll();
}

?>