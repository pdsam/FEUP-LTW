<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'database/db_houses.php');

$houseID = htmlspecialchars($_GET['h']);

renderPage(array('house', 'elements/tabs'),array('house','request'),function() use ($houseID) {
  $house = getHouse($houseID);

  if ($house === false) {
    error('404');
  }

  $housePics = getAllHousePictures($houseID);
  $user = getSessionUser();
  ?>

  <div class="house-carousel">
    <div class="image-changer">
      <p id="left-arrow">&larr;</p>
    </div>
    <div class="image-wrapper" id="image-wrapper">
      <?php if (sizeof($housePics) === 0) { ?>
        <img class="house-image" src='../house.jpg' alt="House image">
      <?php }
      else {
        foreach($housePics as $housePic) { ?> 
          <img class="house-image" src=<?= '../database/housePictures/' . $housePic['pictureID'] ?> alt="House image">
        <?php } 
      } ?>
    </div>
    <div class="image-changer">
      <p id="right-arrow">&rarr;</p>
    </div>
  </div>
  
  <div class="house-content-wrapper">
    <div class="house-information">
      <h1><?= $house['title'] ?></h1>
      
      <div class="house-content">
        <div class="main-info">
          <div class=info-wrapper>
            <p class="info-title">Average Rating</p> 
            <p class="info"><?= $house['avgRating'] ?> &star;</p>
          </div>
          <div class="info-wrapper">
            <p class="info-title">Price</p> 
            <p class="info"><?= $house['pricePerNight'] ?>$/night</p>
          </div>
        </div>

        <div class="buttons">
            <a href="reserve.php?id=<?= $houseID ?>">
              <p class="button">Reserve</p>
            </a>
            <a href="post_review.php?id=<?= $houseID ?>">
              <p class="button">Review</p>
            </a>
            <?php if ($house['landlordID'] == $user['id']) { ?>
              <a href="manage_house_pictures.php?houseId=<?= $houseID ?>">
                <p class="button">Manage Pictures</p>
              </a>
            <?php } ?>
        </div>

      </div>
    </div>
  
    <ul class="content-tabs" id="tabs">
      <li class="selected-tab" id="description-tab">Description</li>
      <li class="unselected-tab" id="information-tab">Information</li>
      <li class="unselected-tab" id="reviews-tab">Reviews</li>
    </ul>
  
    <!-- only description for now -->
    <div class="tabbed-content" id="tabbed-content"> 
      <div>
        <p><?= $house['description'] ?></p>
      </div>
    </div>
  </div>
<?php } ); ?>

