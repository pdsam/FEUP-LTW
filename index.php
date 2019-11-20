<html>
  <head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="stylesheets/common.css">
    <link rel="stylesheet" href="stylesheets/topbar.css">
    <link rel="stylesheet" href="stylesheets/index.css">
  </head>

  <body>
    
  <?php include_once('templates/common/footer.php'); ?>

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
          <img class="card-thumbnail" src="/database/profilePictures/default" alt="p">
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <img class="card-thumbnail" src="house.jpg" alt="p">
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <img class="card-thumbnail" src="/database/profilePictures/default" alt="p">
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <img class="card-thumbnail" src="/database/profilePictures/default" alt="p">
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
        <div class="house-card">
          <img class="card-thumbnail" src="/database/profilePictures/default" alt="p">
          <div class="card-info">
            <h3>House</h3>
            <p>house desc</p>
          </div>
        </div>
      </section>
    </section>

    <?php include_once('templates/common/footer.php'); ?>
  </body>
</html>
