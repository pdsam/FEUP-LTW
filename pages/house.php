<?php 
include_once('../config.php');
include_once(ROOT . 'templates/common/header.php');
include_once(ROOT.'templates/common/footer.php');
include_once(ROOT.'templates/common/loginForm.php');
?>
<DOCTYPE html>
<html>
  <head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="/stylesheets/common.css">
    <link rel="stylesheet" href="/stylesheets/topbar.css">
    <link rel="stylesheet" href="/stylesheets/login.css">
    <link rel="stylesheet" href="/stylesheets/house.css">
    <script src="/javascript/login.js" defer></script>
  </head>

  <body>
    <?php draw_header(); ?>
    <section class="main-content">
      <div class="house-carousel">
        <div class="image-changer">
          <p>&larr;</p>
        </div>
        <div class="image-wrapper">
          <img class="house-image" src="/house.jpg" alt="House image">
        </div>
        <div class="image-changer">
          <p>&rarr;</p>
        </div>
      </div>
      <div class="house-content-wrapper">
        <div class="house-information">
          <h1>House title</h1>
          <p>Rating</p>
          <p>1000$</p>
        </div>

        <ul class="content-tabs" >
          <li class="selected-tab" id="description-tab">Description</li>
          <li id="reviews-tab">Reviews</li>
        </ul>

        <section class="tabbed-content" >

        </section>
      </div>
    </section>

    <?php draw_login_form(); ?>
    <?php draw_footer(); ?>

  </body>
</html>

