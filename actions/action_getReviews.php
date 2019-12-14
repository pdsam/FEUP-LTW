<?php 
include_once('../config.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'database/db_users.php');

$reviews = getReviews($_GET['houseId']);

foreach($reviews as $review) { 
    $user = getUserById($review['userID']);?>

    <article class="review">
        <h1><?= $user['firstName']?>  <?=$user['lastName']?></h1>
        <p><?= $review['reviewText'] ?></p>
        <footer>
            <p>Rating: <?= $review['rating'] ?></p>
            <p>Date : <?= $review['postedDate'] ?></p>
        </footer>
    </article>

<?php } ?>
