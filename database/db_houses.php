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

function getAllHouseInfo() {
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

function pictureExists($picID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT count(*) as count FROM housePicture WHERE pictureID=?");
    $stmt->execute(array($picID));

    return intval($stmt->fetch()['count']) > 0;
}

function addHousePicture($houseId, $pictureId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("INSERT INTO housePicture(pictureID, houseID) values (?,?)");
    $stmt->execute(array($pictureId, $houseId));
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM house where landlordID=?');
    $stmt->execute(array($landlordID));
    return $stmt->fetchAll();
}

function hasRented($userId, $houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT count(*) as count FROM reservation WHERE houseID=? and tenantID=?');
    $stmt->execute(array($houseId, $userId));

    return intval($stmt->fetch()['count']) > 0;
}

function getUserHouseReservations($userId, $houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reservation WHERE houseID=? and tenantID=?');
    $stmt->execute(array($houseId, $userId));

    return $stmt->fetchAll();
}

function postReview($houseId, $userId, $rating, $text) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('INSERT INTO review(houseID, userID, rating, reviewText) values(?,?,?,?)');
    $stmt->execute(array($houseId, $userId, $rating, $text));
}

function getReservations($houseID, $status) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reservation WHERE houseID=? and status=?');
    $stmt->execute(array($houseID, $status));

    return $stmt->fetchAll();
}

function getReservationsNumber($houseId, $status) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT count(*) as count FROM reservation WHERE houseID=? and status=?');
    $stmt->execute(array($houseId, $status));

    return $stmt->fetch();
}

function getReservation($reservationId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT * FROM reservation WHERE reservationID=?");
    $stmt->execute(array($reservationId));

    return $stmt->fetch();
}

function setReservationStatus($reservationId, $status) {
    if ($status !== 'accepted' && $status !== 'pending' && $status !== 'rejected' && $status !== 'canceled') {
        return false;
    }
    $db = Database::instance()->db();

    $stmt = $db->prepare('UPDATE reservation SET status=? WHERE reservationID=?');
    $stmt->execute(array($status, $reservationId));

    return true;
}

function addReservation($reservation) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('insert into reservation(houseID, tenantID, startDate, endDate, numberOfPeople) values (?,?,?,?,?)');
    $stmt->execute(array(
        $reservation->houseId,
        $reservation->tenantId,
        $reservation->startDate,
        $reservation->endDate,
        $reservation->numberOfPeople
    ));

    return $db->lastInsertId();
}

?>
