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
    <?php include_once('templates/common/header.php'); ?>

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
        <div class="house-card">
          <div class="card-thumbnail"></div>
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <div class="card-thumbnail"></div>
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <div class="card-thumbnail"></div>
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <div class="card-thumbnail"></div>
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
      </section>
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

    <?php include_once('templates/common/footer.php'); ?>
  </body>
</html>
