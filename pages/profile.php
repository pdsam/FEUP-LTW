<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

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

          <?php 
            $path = ROOT . "database/profilePictures/". $user['profilePicture'];
          if(file_exists($path)){ ?>
          <img src="../database/profilePictures/<?= $user['profilePicture'] ?>" alt="Profile picture">
          <?php } else{ echo " <img src='../database/profilePictures/default' alt='Profile picture'>" ;
          }?>
          <?php if ($user['id'] == $signedUser['id']) { ?>
            <form action="../actions/action_addProfilePhoto.php" method="post" enctype="multipart/form-data">
              <input type="file" name="fileToUpload" id="fileToUpload">
              <input type="submit" value="Upload Image" name="submit">
            </form>


          <?php } ?>
        </div>
        <div class="user-details">
          <div class="first-line">
            <h1 class="name"><?= $user['firstName'] ?> <?= $user['lastName'] ?></h1> <span>(<?= $user['username'] ?>)</span>
            <?php if ($user['id'] == $signedUser['id']) { ?>
              <a href="editProfile.php">
                <button id="edit-profile">Edit Profile</button>
              </a>
            <?php } ?>
            <?php if (!isLandlord($user['id']) && $user['id'] == $signedUser['id']) { ?>
              <a href="../actions/action_register_landlord.php"><button>Register this account as landlord.</button></a>
            <?php } ?>
          </div>
          <p class="user-email"><?= $user['email'] ?></p>
          <p class="user-bio"><?= $user['bio'] ?></p>
        </div>

      </header>
    </section>

<?php

  }
);
} else {
  header('Location: ../pages/404.php');
}
?>