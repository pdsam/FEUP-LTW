<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/db_users.php');

function draw_profile() { 
  $username = $_GET['username'];
  $user = getUserInfo($username); 

  if (empty($user)) {
    header('Location: 404.php');
  }
  else { ?>
    <div class="profile-content">
    <div class="profile-picture-container">
      <img src="../database/profilePictures/<?= $user['profilePicture'] ?>" alt="Profile picture">
    </div>
    <div class="user-details">
      <h1 class="name"><?= $user['firstName'] . ' ' . $user['lastName'] ?></h1>
      <p class="user-email"><?= $user['email'] ?></p>
    </div>
  </div>
  <?php }

} 

renderPage(array('profile'), array(), 'draw_profile');

?>