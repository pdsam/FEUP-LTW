<?php
include_once(ROOT . 'includes/database.php');

function addHouse($house) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('insert into house(landlordID, pricePerNight, title, description, area, locationID, capacity) values (?,?,?,?,?,?,?)');
    $stmt->execute(array(
        htmlspecialchars($house->landlordID),
        htmlspecialchars($house->pricePerNight),
        htmlspecialchars($house->title),
        htmlspecialchars($house->description),
        htmlspecialchars($house->area),
        htmlspecialchars($house->location),
        htmlspecialchars($house->capacity)
    ));

    return $db->lastInsertId();
}

function updateHouseInfo($houseId, $house) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('update house set pricePerNight=?, title=?, description=?, area=?, locationID=?, capacity=? where houseID=?');
    $stmt->execute(array(
        htmlspecialchars($house->pricePerNight),
        htmlspecialchars($house->title),
        htmlspecialchars($house->description),
        htmlspecialchars($house->area),
        htmlspecialchars($house->location),
        htmlspecialchars($house->capacity),
        $houseId
    ));
}

function getLocations() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM location');
    $stmt->execute();
    return $stmt->fetchAll();
}

function locationExists($locationId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT count(*) as count FROM location WHERE locationID=?');
    $stmt->execute(array($locationId));
    return intval($stmt->fetch()['count']) > 0;
}

function getAllHouseInfo() {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT *, location.name as address FROM house JOIN location using(locationID)');
    $stmt->execute();
    return $stmt->fetchAll();
}

function getHouse($houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT *, location.name as address FROM house JOIN location using(locationID) WHERE houseID=?');
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

function removeHousePicture($picID, $houseID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("DELETE FROM housePicture WHERE houseID=? and pictureID=?");
    $stmt->execute(array($houseID, $picID));
}

function getHousePicture($picID, $houseID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT * FROM housePicture WHERE houseID=? and pictureID=?");
    $stmt->execute(array($houseID, $picID));

    return $stmt->fetch();
}

function getAllHousePictures($houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT * FROM housePicture WHERE houseID = ?");
    $stmt->execute(array($houseId));

    return $stmt->fetchAll();
}

function getFirstHousePic($houseId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT * FROM housePicture WHERE houseID = ?");
    $stmt->execute(array($houseId));

    return $stmt->fetch();
}

function getLandlordHouses($landlordID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT *, location.name as address FROM house JOIN location using(locationID) where landlordID=?');
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
    $stmt->execute(array(
        $houseId, 
        $userId, 
        $rating, 
        htmlspecialchars($text)));
}

function getReservationByTenant($tenantId) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM reservation join house using(houseID) WHERE tenantID=?');
    $stmt->execute(array($tenantId));

    return $stmt->fetchAll();
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


function getReviews($houseID) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM review WHERE houseID = ?');
    $stmt->execute(array($houseID));

    return $stmt->fetchAll();
}


function search($query,$params){
    $db = Database::instance()->db();


    $stmt = $db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll();
}

function maxPrice(){
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT max(pricePerNight) FROM house');
    $stmt->execute();

    return $stmt->fetch();

}
?>

