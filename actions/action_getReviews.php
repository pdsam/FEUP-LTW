<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$reviews = getReviews($_GET['houseId']);
$house = getHouse($_GET['houseId']);

if (sizeof($reviews) === 0) { ?>
    <p>This house has no reviews yet</p>
<?php }
else {
    foreach($reviews as $review) { 
        $user = getUserById($review['userID']);?>
    
        <article class="review-card">
            <?php if ($review['userID'] == $house['landlordID']) { ?>
                <div class="landlord-title">
                    <h1><?= $user['firstName']?>  <?=$user['lastName']?></h1>
                    <h1 class="landlord-tag">landlord</h1>
                </div>
            <?php }
            else { ?>
                <h1><?= $user['firstName']?>  <?=$user['lastName']?></h1>
            <?php } ?>
            <p><?= $review['reviewText'] ?></p>
            <footer class="review-card-footer">
                <p>Rating: <?= $review['rating'] ?></p>
                <p><?= $review['postedDate'] ?></p>
            </footer>
        </article>
    <?php } 
} ?>
