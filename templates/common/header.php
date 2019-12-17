<?php
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_users.php');


function draw_header()
{
  $user = getSessionUser();
?>
  <nav class="topbar">
    <section class="bar-logo">
      <a href="../index.php">
        <p>Villat</p>
      </a>
    </section>
    <?php if ($user) {
    ?>
      <section class="user-options-container">

        <?php
        $userID = $user['id'];
        echo "<a href='../pages/profile.php?id=$userID'>"; ?>
        <p class="nav-button">Profile</p>
        </a>
        <a href="../pages/user_reservations.php">
          <p class="nav-button">Your Reservations</p>
        </a>
        <?php if (isLandlord($user['id'])) { ?>
          <a href="../pages/dashboard.php">
            <p class="nav-button">Dashboard</p>
          </a>
        <?php } ?>
        <a href="../actions/action_logout.php">
          <p class="nav-button">Sign Out</p>
        </a>
      </section>
    <?php } else { ?>
      <section class="user-options-container">
        <p id="login-button" class="nav-button">Sign in</p>

        <a href="../pages/register.php">
          <p id="register-button" class="nav-button">Sign up</p>
        </a>
      </section>
      </a>
    <?php } ?>
    <div class="menu">
      <a href="javascript:void(0)" id="icon-menu" onClick="hamburguerDraw()">
        <span></span>
        <span></span>
        <span></span>
      </a>
    </div>
  </nav>
  <nav class="hamburguer-nav" id="hamburguer-nav">



    <?php
      if ($user) { ?>
      <div>
        <?php
        $userID = $user['id'];
        echo "<a href='../pages/profile.php?id=$userID'>"; ?>
        <p class="nav-button">Profile</p>
        </a>
      </div>
      <div>
        <a href="../pages/user_reservations.php">
          <p class="nav-button">Your Reservations</p>
        </a>
      </div>
      <div>
        <?php if (isLandlord($user['id'])) { ?>
          <a href="../pages/dashboard.php">
            <p class="nav-button">Dashboard</p>
          </a>
        <?php } ?>
      </div>
      <div>
        <a href="../actions/action_logout.php">
          <p class="nav-button">Sign Out</p>
        </a>
      </div>



    <?php
      } else { ?>
      <div>
        <p id="login-button" class="nav-button">Sign in</p>
      </div>
      <div>
        <a href="../pages/register.php">
          <p id="register-button" class="nav-button">Sign up</p>
        </a>
      </div>
    <?php } ?>
  </nav>
<?php } ?>