<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');
include_once(ROOT . 'database/db_houses.php');

$signedUser = getSessionUser();
if (isset($_GET['id'])) {
  $user = getUserById($_GET['id']);
} else if ($signedUser) {
  $user = $signedUser;
}

if ($user) {
  renderPage(
    array('profile'),
    array(),
    function () use ($user, $signedUser) { ?>
    <section class="profile-container">
      <header class="profile-header">
        <div class="profile-picture-container">
          <div class="profile-picture-wrapper">
            <?php
            $path = ROOT . "database/profilePictures/" . $user['profilePicture'];
            if (file_exists($path)) { ?>
              <img src="../database/profilePictures/<?= $user['profilePicture'] ?>" alt="Profile picture">
            <?php } else {
                                                    echo " <img src='../database/profilePictures/default' alt='Profile picture'>";
                                                  } ?>
          </div>
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

          <div class=email-line>
            <i class="material-icons">email</i>
            <p class="user-email"><?= $user['email'] ?></p>
          </div>
          <div class="user-bio-wrapper">
            <p class="user-bio"><?= $user['bio'] ?></p>
          </div>
        </div>
      </header>
    </section>

<?php

                                                                                          }
                                                                                        );
                                                                                      } else {
                                                                                        error('404');
                                                                                      }
?>