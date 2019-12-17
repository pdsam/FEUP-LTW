<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

if (!isset($_GET['houseId'])) {
    header('Location: home.php');
    die;
}

$house = getHouse($_GET['houseId']);
if ($house['landlordID'] !== $user['id']) {
    error('403');
}

$pictures = getAllHousePictures($house['houseID']);

$renderFunction = function() use($pictures) { ?>
    <h1>Add images to your house</h1>
    <form id="house-images" action="../actions/action_addPhotos.php" method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <input type="hidden" name="houseId" value="<?= $_GET['houseId'] ?>">

        <input type="submit" value="Submit">
    </form>
    <div class="house-image-galery">
        <?php 
        foreach ($pictures as $picture) { ?>
            <img src="../database/housePictures/<?= $picture['pictureID'] ?>" alt="House picture">
        <?php }
        ?>
    </div>
<?php };

$house = getHouse($_GET['houseId']);
if ($house['landlordID'] !== $user['id']) {
    $renderFunction = error("You have no permissions to access this page.");
}

renderPage(array(), array(), $renderFunction);?>