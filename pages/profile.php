<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

if (!isset($_SESSION['username'])) {
  // header('Location: ../pages/home.php');
  // die;
}

$signedUser = getUser($_SESSION['username']);


$id = $_GET['id'];
if (!isset($id)) {
  //header('Location: ../pages/home.php');
  //die;

}

$user = getUserById($id);
if (isset($user)) {
  renderPage(
    array('profile'),
    array(),
    function () use ($user, $signedUser) { ?>
    <div class="profile-content">
      <div class="profile-picture-container">
        <img src="../database/profilePictures/<?= $user['profilePicture'] ?>" alt="Profile picture">
      </div>
      <div class="user-details">
        <h1 class="name"><?= $user['firstName'] ?> <?= $user['lastName'] ?></h1>
        <p class="user-email"><?= $user['email'] ?></p>
      </div>
    </div>
    <?php if (!isLandlord($user['id']) && $user['id'] == $signedUser['id']) { ?>
      <a href="../actions/action_register_landlord.php"><button>Register this account as landlord.</button></a>
    <?php } else if ($user['id'] == $signedUser['id']) { ?>
      <section class="landlord-houses">
        <a id="add-house-link" href="add_house.php">
          <button>Post a house</button>
        </a>

        <div class="houses-container">
          <?php
                $houses = getLandlordHouses($user['id']);
                foreach ($houses as $house) { ?>
            <div class="house-overview">
              <p><?= $house['title'] ?></p>
              <p><?= $house['pricePerNight'] ?></p>
              <p><?= $house['description'] ?></p>
            </div>
          <?php } ?>
        </div>

      </section>
<?php }
  }
);
}
else{
  header('Location: ../pages/404.php');
}
?>