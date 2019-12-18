<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'templates/drawTemplate.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

$house = getHouse($_GET['houseId']);
if (!$house) {
    redirectHome();
    die;
}

if ($house['landlordID'] !== $user['id']) {
    error('403');
}

$renderFunction = function () use ($house) { ?>
    <div>
        <form id="edit-house-form" action="#" method="post" enctype="multipart/form-data">
            <label class="block-label" for="title">House Title</label>
            <input class="text-input" type="text" name="title" id="title" value="<?= $house['title'] ?>" required>

            <label class="block-label" for="price">Price per night</label>
            <input class="text-input" type="number" name="pricePerNight" id="price" value="<?= $house['pricePerNight'] ?>" required>

            <label class="block-label" for="area">Area of the house</label>
            <input class="text-input" type="number" name="area" id="area" value="<?= $house['area'] ?>" required>

            <label for="location-id">Location</label>
            <select name="locationId" id="location-id">
                <?php
                                                                                            $locations = getLocations();
                                                                                            foreach ($locations as $location) {

                ?>
                    <option <?php
                                                                                                if ($location['locationID'] === $house['locationID']) {
                                                                                                    echo "selected=\"selected\"";
                                                                                                }
                            ?> value="<?= $location['locationID'] ?>"><?= $location['name'] ?></option>
                <?php }
                ?>

            </select>

            <label class="block-label" for="capacity">Capacity</label>
            <input class="text-input" type="number" name="capacity" id="capacity" value="<?= $house['capacity'] ?>" required>

            <label class="block-label" for="description">Description</label>
            <textarea class="text-input" name="description" id="description" cols="50" rows="10"><?= $house['description'] ?></textarea>

            <p id="house-form-error-label"></p>

            <input type="submit" value="Submit">
        </form>
    </div>
<?php };

                                                                                                renderPage(array('add_house', 'forms', 'formPlacement'), array('request', 'edit_house'), $renderFunction);

?>