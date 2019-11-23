<?php 
include_once('../config.php');
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
  </head>

  <body>
    <?php include_once(ROOT . 'templates/common/header.php') ?>

    <section class="main-content">
      <div class="house-carousel">
        <div class="image-changer">
          <svg width="100" height="100">
          <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
          </svg>
        </div>
        <div class="image-wrapper">
          <img class="house-image" src="/house.jpg" alt="House image">
        </div>
        <div class="image-changer">
          <svg width="100" height="100">
          <circle cx="50" cy="50" r="40" stroke="green" stroke-width="4" fill="yellow" />
          </svg>
        </div>
      </div>
      <div class="house-content-wrapper">
        <div class="house-information">
          <h1>House title</h1>
          <p>Rating</p>
          <p>1000$</p>
        </div>

        <ul class="content-tabs" >
          <li>Description</li>
          <li>Reviews</li>
        </ul>
      </div>
    </section>

    <div class="login-background">
      <div class="login-form-wrapper">
        <form class="login-form" action="login.php" method="post">
          <label for="username">Username</label>
          <input class="text-input" type="text" name="username" id="username">
          <label for="password">Password</label>
          <input class="text-input" type="password" name="pw" id="password">

          <input class="login-button standart-border" type="submit" value="Login">
        </form>
      </div>
    </div>

    <footer class="site-footer">
      <p>Villat 2019</p>
    </footer>
  </body>
</html>

