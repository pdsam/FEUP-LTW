<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

renderPage(array('add_house','forms','formPlacement'), array('request', 'add_house'), function() { ?>
    <div class="form-wrapper">
        <form id="add-house-form" action="#" method="post" enctype="multipart/form-data">
            <label class="block-label" for="title">House Title</label>
            <input class="text-input" type="text" name="title" id="title" required>

            <label class="block-label" for="price">Price per night</label>
            <input class="text-input" type="number" name="pricePerNight" id="price" required>

            <label class="block-label" for="area">Area of the house</label>
            <input class="text-input" type="number" name="area" id="area" required>

            <label for="location-id">Location</label>
            <select name="locationId" id="location-id">
                <?php 
                $locations = getLocations();
                foreach ($locations as $location) {
                    ?>
                    <option value="<?= $location['locationID'] ?>"><?= $location['name'] ?></option>
                <?php }
                ?>
                
            </select>

            <label class="block-label" for="capacity">Capacity</label>
            <input class="text-input" type="number" name="capacity" id="capacity" required>

            <label class="block-label" for="description">Description</label>
            <textarea class="text-input" name="description" id="description" cols="50" rows="10"></textarea>

            <p id="house-form-error-label"></p>

            <input type="submit" value="Submit">
        </form>
    </div>
<?php });

?>