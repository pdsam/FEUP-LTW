<?php 

include_once(ROOT . 'includes/database.php');

function addUser($user, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("INSERT INTO USER(username, firstName, lastName, email, password) values (?, ?, ?, ?, ?)");
    $stmt->execute(array(
        $user->username,
        $user->firstname,
        $user->lastname,
        $user->email,
        password_hash($password, PASSWORD_DEFAULT)
    ));
}

function checkUserPassword($username, $password) {
    $db = Database::instance()->db();

    $stmt = $db->prepare('SELECT username, password FROM user WHERE username=?');
    $stmt->execute(array($username));

    $user = $stmt->fetch();

    return user !== false && password_verify($password, $user['password']);
}

function userExists($username) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT username FROM USER WHERE username=?");
    $stmt->execute(array($username));

    return $stmt->rowCount() > 0;
}

function emailExists($email) {
    $db = Database::instance()->db();

    $stmt = $db->prepare("SELECT username FROM USER WHERE email=?");
    $stmt->execute(array($email));

    return $stmt->rowCount() > 0;
}

?>