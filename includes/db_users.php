<?php 
include_once('../config.php');
include_once(ROOT . 'includes/database.php');

function getUserInfo($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT * FROM user WHERE username = ?');
    $stmt->execute(array($username));

    return $stmt->fetch();
}

?>