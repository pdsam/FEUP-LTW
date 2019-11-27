<?php

include_once(ROOT . 'includes/session.php');

function draw_header() { ?>
  <nav class="topbar">
  <div class="bar-logo">
    <p>Villat</p>
  </div>
  <?php if (isset($_SESSION['username'])) { ?>
    <p><?=$_SESSION['username']?></p>
  <?php } else { ?> <div class="user-options-container">
    <a href="../pages/register.php"><p id="register-button" class="button" >Register</p></a>
    <p id="login-button" class="button" >Login</p>
  </div>
  <?php } ?>
</nav>
<?php } ?>