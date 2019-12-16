<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');

if (!isset($_SESSION['username'])) {
    header('Location: ../pages/home.php');
    die;
}

if ($_SESSION['username'] !== $_POST['username']) {
    header('Location: ../pages/home.php');
    die;
}

$response = array(
    'result'=>'error',
    'message'=>''
);

$username = $_POST['username'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$bio = $_POST['bio'];
$oldPassword = $_POST['oldPassword'];
$newPassword = $_POST['newPassword'];

if ($oldPassword !== '') {
    if (!updateUserPassword($username, $oldPassword, $newPassword)) {
        $response['message'] = 'Invalid password.';
        echo json_encode($response);
        die;
    }
}

updateUserInfo($username, $firstname, $lastname, $email, $bio);

$response['result'] = 'success';
$response['message'] = 'Profile updated with success';

echo json_encode($response);

?>