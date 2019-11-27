<?php
include_once('../config.php');
include_once(ROOT . 'includes/database.php');

function getHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT houseID,description FROM house');
    $stmt->execute();
    return $stmt->fetchAll();
}

?>