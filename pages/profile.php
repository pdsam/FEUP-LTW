<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');
include_once(ROOT . 'templates/common/editProfileForm.php');

$id = $_GET['id'];
$signedUser = getUser($_SESSION['username']);

if (isset($id)) {
  $user = getUserById($id);
} else if (isset($_SESSION['username'])) {
  $user = getUser($_SESSION['username']);
}

if ($user) {
  renderPage(
    array('profile'),
    array(),
    function () use ($user, $signedUser) { ?>
    <section class="profile-container">
      <header class="profile-header">
        <div class="profile-picture-container">
          <img src="../database/profilePictures/<?= $user['profilePicture'] ?>" alt="Profile picture">
        </div>
        <div class="user-details">
          <div class="first-line">
            <h1 class="name"><?= $user['firstName'] ?> <?= $user['lastName'] ?></h1> <span>(<?= $user['username'] ?>)</span>
            <?php if ($user['id'] == $signedUser['id']) { ?>
              <button id="edit-profile">Edit Profile</button>
            <?php } ?>
            <?php if (!isLandlord($user['id']) && $user['id'] == $signedUser['id']) { ?>
              <a href="../actions/action_register_landlord.php"><button>Register this account as landlord.</button></a>
          </div>
          <p class="user-email"><?= $user['email'] ?></p>
          <p class="user-bio"><?= $user['bio'] ?></p>
        </div>

      </header>
    </section>

<?php
    }
    draw_edit_profile_form();
  }
);
} else {
  header('Location: ../pages/404.php');
}
?>