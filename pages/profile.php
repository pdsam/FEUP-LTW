<?php 
include_once('../config.php');
include_once(ROOT . 'templates/common/header.php');
include_once(ROOT.'templates/common/footer.php');
?>
<html>
  <head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="/stylesheets/common.css">
    <link rel="stylesheet" href="/stylesheets/topbar.css">
    <link rel="stylesheet" href="/stylesheets/index.css">
    <link rel="stylesheet" href="/stylesheets/login.css">
    <link rel="stylesheet" href="/stylesheets/profile.css">
    <script src="/javascript/login.js" defer></script>
  </head>

  <body>
    <?php draw_header(); ?>

    <section class="main-content">
      <div class="profile-content">
        <div class="profile-picture-container">
          <img src="/database/profilePictures/default" alt="Profile picture">
        </div>
        <div class="user-details">
          <h1 class="name">Name</h1>
          <p class="user-email">email@domain.com</p>
        </div>
      </div>

    </section>

    <?php include_once(ROOT .'templates/common/loginForm.php'); ?>

    <?php draw_footer(); ?>
  </body>
</html>
