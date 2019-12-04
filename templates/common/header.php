<?php

include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');

function draw_header()
{ ?>
  <nav class="topbar">
    <div class="bar-logo">
      <a href="../index.php">
        <p>Villat</p>
      </a>
    </div>
    <?php if (isset($_SESSION['username'])) { 
      $user = getUser($_SESSION['username']);
      print_r($user);
      ?>
      <a href="../actions/action_logout.php">logout</a>
      <a href="../pages/profile.php"><?= $user['firstName'] ?></a>
    <?php } else { ?> <div class="user-options-container">
      <p id="login-button" class="button">Sign in</p>
        
      <a href="../pages/register.php">
        <p id="register-button" class="button">Sign up</p>
        </a>

      </div>
    <?php } ?>
  </nav>
<?php } ?>