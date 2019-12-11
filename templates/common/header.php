<?php

include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');

function draw_header()
{ 
  ?>
  <nav class="topbar">
    <section class="bar-logo">
      <a href="../index.php">
        <p>Villat</p>
      </a>
    </section>
    <?php if (isset($_SESSION['username'])) { 
      ?>
      <section class="user-options-container">
        
        <?php
        $user = getUser($_SESSION['username']);
        $userID = $user['id'];
       echo "<a href='../pages/profile.php?id=$userID'>" ;?>
          <p class="nav-button">Profile</p>
        </a>
        <a href="../pages/dashboard.php">
          <p class="nav-button">Dashboard</p>
        </a>
        <a href="../actions/action_logout.php">
          <p class="nav-button">Sign Out</p>
        </a>
      </section>
    <?php } else { ?> <section class="user-options-container">
        <p id="login-button" class="nav-button">Sign in</p>

        <a href="../pages/register.php">
          <p id="register-button" class="nav-button">Sign up</p>
        </a>
      </section>
    <?php } ?>
  </nav>
<?php } ?>