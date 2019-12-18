<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
  error('401');
}

if (!isset($_GET['id'])) {
  header('Location: home.php');
  die;
}

$houseID = htmlspecialchars($_GET['id']);
$renderFunction = function () use ($houseID, $user) { ?>
<div>
<form action="#" method="post" id="review-form">
  <div>
    <label for="text">Review</label>
    <textarea class="text-input" name="text" id="text" cols="50" rows="10"></textarea>
  </div>

  <div>
    <label for="myRange">Rating: <span id=rangeValue></span></label>
    <div>
        <input type='range' name='rating' id='myRange' min='0' max='10' value='0'>
    </div>
  </div>

  <input type="hidden" name="houseId" value="<?= $houseID ?>">
  <input type="hidden" name="tenantId" value="<?= $user['id'] ?>">

  <p id="review-error-label"></p>

  <input type="submit" value="Submit">
</form>
</div>
<?php };

renderPage(array('review','forms','formPlacement'), array('postReview','slider'), $renderFunction);

?>