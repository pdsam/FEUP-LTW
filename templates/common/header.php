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
      ?>
      <div class="user-options-container">
        <a href="../pages/profile.php"><?= $user['firstName'] ?> </a>
      </div>

      <div class="user-options-container">
        <a href="../actions/action_logout.php">logout</a>
      </div>
    <?php } else { ?> <div class="user-options-container">
      <p id="login-button" class="button">Sign in</p>
        
        <a href="../pages/register.php">
          <p id="register-button" class="button">Sign up</p>
        </a>
      </div>
    <?php } ?>
  </nav>
<?php } ?>