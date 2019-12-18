<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'includes/responses.php');
include_once(ROOT . 'database/db_users.php');

$response = prepareResponse();

$user = getSessionUser();
if (!$user) {
    $response['type'] = '1';
    $response['message'] = 'User not logged in.';
    reply($response);
}

$firstname = htmlspecialchars($_POST['firstname']);
if (strlen($firstname) > 180) {
    $response['type'] = '2';
    $response['message'] = 'First name is too long. Must shorter than 180 characters.';
    reply($response);
}
$lastname = htmlspecialchars($_POST['lastname']);
if (strlen($lastname) > 180) {
    $response['type'] = '2';
    $response['message'] = 'Last name is too long. Must shorter than 180 characters.';
    reply($response);
}
$email = htmlspecialchars($_POST['email']);
$bio = htmlspecialchars($_POST['bio']);
if (strlen($bio) > 500) {
    $response['type'] = '2';
    $response['message'] = 'Bio is too long. Must shorter than 500 characters.';
    reply($response);
}
$oldPassword = htmlspecialchars($_POST['old-password']);
$newPassword = htmlspecialchars($_POST['new-password']);

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