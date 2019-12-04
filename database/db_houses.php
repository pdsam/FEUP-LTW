<?php
include_once(ROOT . 'includes/database.php');

function getHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house');
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