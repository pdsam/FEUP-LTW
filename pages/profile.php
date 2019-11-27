<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');

function draw_profile() { ?>
  <div class="profile-content">
    <div class="profile-picture-container">
      <img src="../database/profilePictures/default" alt="Profile picture">
    </div>
    <div class="user-details">
      <h1 class="name">Name</h1>
      <p class="user-email">email@domain.com</p>
    </div>
  </div>
<?php 
} 

renderPage(array('profile'), array(), 'draw_profile');

?>