<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'includes/responses.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');
require_once(ROOT . 'includes/User.php');

$response = prepareResponse();

$user = new User();

$user->firstname = htmlspecialchars($_POST['firstname']);
$user->lastname = htmlspecialchars($_POST['lastname']);
$user->username = htmlspecialchars($_POST['username']);
$user->email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);


if ($user->username !== htmlspecialchars($user->username)) {
    $response['type'] = '2';
    $response['message'] = 'Username must not contain special characters.';
    reply($response);
}

if (userExists($user->username)) {
    $response['type'] = '2';
    $response['message'] = 'Username ' . $user->username . ' already in use.';
    reply($response);
}

if (emailExists($user->email)) {
    $response['type'] = '2';
    $response['message'] = 'Email already in use.';
    reply($response);
}

$firstname = $_POST['firstname'];
if (strlen($firstname) > 180) {
    $response['type'] = '2';
    $response['message'] = 'First name is too long. Must shorter than 180 characters.';
    reply($response);
}
$lastname = $_POST['lastname'];
if (strlen($lastname) > 180) {
    $response['type'] = '2';
    $response['message'] = 'Last name is too long. Must shorter than 180 characters.';
    reply($response);
}

addUser($user, $password);

$response['result'] = 'success';

$_SESSION['username'] = $user->username;

echo json_encode($response);
?>