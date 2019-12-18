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

$house = getHouse(htmlspecialchars($_GET['houseId']));
if ($house['landlordID'] !== $user['id']) {
    error('403');
}

$pictures = getAllHousePictures($house['houseID']);

$renderFunction = function () use ($pictures, $house) { ?>
    <div class="content-wrapper">
        <h1>Manage your house's pictures</h1>
        <div class="picture-form-container">
            <p>Add a picture:</p>
            <form id="house-picture-form" action="../actions/action_addHousePicture.php" method="post" enctype="multipart/form-data">
                <input type="file" name="image" id="image">
                <input type="hidden" name="houseId" value="<?= htmlspecialchars($_GET['houseId']) ?>">

                <input type="submit" value="Submit">
            </form>
            <a class="finish-button" href="house.php?h=<?= htmlspecialchars($_GET['houseId']) ?>">Finish</a>
        </div>
        <div class="house-picture-galery">
            <?php
                                                            foreach ($pictures as $picture) { ?>
                <div class="house-picture-container">
                    <img src="../database/housePictures/<?= $picture['pictureID'] ?>" alt="House picture">
                    <form action="../actions/action_removeHousePicture.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="houseId" value="<?= $house['houseID'] ?>">
                        <input type="hidden" name="picId" value="<?= $picture['pictureID'] ?>">
                        <input type="submit" value="Remove">
                    </form>
                </div>
            <?php }
            ?>
        </div>
    </div>
<?php };

                                                            $house = getHouse(htmlspecialchars($_GET['houseId']));
                                                            if ($house['landlordID'] !== $user['id']) {
                                                                $renderFunction = error("You have no permissions to access this page.");
                                                            }

                                                            renderPage(array('picture_management'), array(), $renderFunction); ?>