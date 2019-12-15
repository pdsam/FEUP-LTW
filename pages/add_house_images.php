<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    header('Location: home.php');
    die;
}

if (!isset($_GET['houseId'])) {
    header('Location: home.php');
    die;
}

$renderFunction = function() { ?>
    <h1>Add images to your house</h1>
    <form id="house-images" action="../actions/action_addPhotos.php" method="post" enctype="multipart/form-data">
        <input type="file" name="images[]" id="images" multiple>
        <input type="hidden" name="houseId" value="<?= $_GET['houseId'] ?>">

        <input type="submit" value="Submit">
    </form>
<?php };

$house = getHouse($_GET['houseId']);
if ($house['landlordID'] !== $user['id']) {
    $renderFunction = error("You have no permissions to access this page.");
}

renderPage(array(), array(), $renderFunction);?>