<?php 
  include_once('templates/common/header.php');
  include_once('templates/common/footer.php');
  include_once('templates/common/house_card.php')
?>


<!DOCTYPE html>
<html>
  <head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="stylesheets/common.css">
    <link rel="stylesheet" href="stylesheets/topbar.css">
    <link rel="stylesheet" href="stylesheets/index.css">
    <link rel="stylesheet" href="stylesheets/login.css">
  </head>

  <body>
    <?php draw_header(); ?>

    <section class="main-content">
      <section class="filter-renderer">
        <div class="search-form-container">
          <form class="filter-form" action="#" method="GET">
            <div class="search-field-container">
              <input class="search-field" type="text" id="search" placeholder="Search">
            </div>
            <input class="submit-button" type="button" value="Search">
          </form>
        </div>
      </section>

      <section class="houses-display">
        <?php draw_house_cards(); ?>
      </section>
    </section>

    <?php include_once('templates/common/loginForm.php'); ?>
    <?php include_once('templates/common/registerForm.php'); ?>

    <?php draw_footer(); ?>
  </body>
</html>
