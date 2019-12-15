<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

$user = getSessionUser();
if (!$user) {
  header('Location: home.php');
  die;
}

if (!isset($_GET['id'])) {
  header('Location: home.php');
  die;
}

$houseID = $_GET['id'];
$renderFunction = function () use ($houseID, $user) { ?>
<form action="#" method="post" id="reservation-form">
  <p id="reservation-error-label"></p>
  <div>
    <label for="number-people">Number of people</label>
    <input type="number" name="numberOfPeople" id="number-people">
  </div>

  <div>
    <label for="checkin">Check in date</label>
    <input type="date" name="checkInDate" id="checkin">
  </div>
  <div>
    <label for="checkout">Check out date</label>
    <input type="date" name="checkOutDate" id="checkout">
  </div>
  <input type="hidden" name="houseId" value="<?= $houseID ?>">
  <input type="hidden" name="tenantId" value="<?= $user['id'] ?>">

  <input type="submit" value="Submit">
</form>
<?php };

renderPage(array('reservation'), array('reservation'), $renderFunction);

?>