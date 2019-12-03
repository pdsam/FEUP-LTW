<?php

include_once(ROOT . 'includes/session.php');

function draw_header()
{ ?>
  <nav class="topbar">
    <div class="bar-logo">
      <a href="/">
        <p>Villat</p>
      </a>
    </div>
    <?php if (isset($_SESSION['username'])) { ?>
      <a href="../pages/profile.php">Profile</a>
      <a href="../actions/action_logout.php">logout</a>
    <?php } else { ?> <div class="user-options-container">
      <p id="login-button" class="button">Sign in</p>
        
        <a href="../pages/register.php">
          <p id="register-button" class="button">Sign up</p>
        </a>
      </div>
    <?php } ?>
  </nav>
<?php } ?>