<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'templates/common/house_card.php');
include_once(ROOT . 'database/db_houses.php');



renderPage(array('home', 'forms'), array('slider','hamburguer'), function () {
  $today = date('Y-m-d');
  $nextDay = new DateTime(date('Y-m-d'));
  $nextDay->modify('+1 day');
  $nextDay = $nextDay->format('Y-m-d');

  $maxPrice = maxPrice()['max(pricePerNight)'];

  if (!empty($_GET)) {

    $query = 'SELECT *, location.name as address FROM house JOIN location using(locationID) where 1 ';
    $params = array();

    if (array_key_exists('location', $_GET) && $_GET['location'] != "") {
      $query .= " and house.locationID=(select locationID from location where name=?) "; //prolly will break;
      $params[] = htmlspecialchars($_GET['location']);
    }

    if (array_key_exists('checkin', $_GET) && array_key_exists('checkout', $_GET) && $_GET['checkin'] != "" && $_GET['checkout']) {


      $query .= "and house.houseID not in (select houseID from reservation where julianDate(?)<julianDate(endDate) or julianDate(?) > julianDate(startDate))";

      $params[] = htmlspecialchars($_GET['checkin']);
      $params[] = htmlspecialchars($_GET['checkout']);
    }




    if (array_key_exists('capacity', $_GET)) {
      $query .= " and house.capacity >= ? "; //prolly will break;
      $params[] = htmlspecialchars($_GET['capacity']);
    }

    if (array_key_exists('priceRange', $_GET)) {
      $query .= " and house.pricePerNight  <= ? "; //prolly will break;
      $params[] = htmlspecialchars($_GET['priceRange']);
    }

    $houses = search($query, $params);
  } else {

    $houses = getAllHouseInfo();
  }


?>
  <section class="filter-renderer">
    <div class="search-form-container">
      <a href="javascript:void(0)"  onClick="hiddenMenuDraw()" >
        <button class="hidden-button" id="hidden-button">Filters</button>
      </a>
      <form class="filter-form" id="filter-form" action="#" method="GET">
        <div class="search-field-container">

          <div class="form-element">
          <label class="block-label" for="flocation">Location</label>
            <select name="location" id="flocation">
              <?php 
              $locations = getLocations();
              foreach ($locations as $location) { ?>
                  <option value="<?= $location['name'] ?>"><?= $location['name'] ?></option>
              <?php }
              ?>
            </select>
          </div>

          <div class="form-element">
            <label class="block-label" for="start-date">Check-In:</label>
            <div>
              <?= "<input type= 'date' id='start-date' min=$today name='checkin' >" ?>
            </div>
          </div>

          <div class="form-element">
            <label class="block-label" for="end-date">Checkout:</label>
            <div>
              <?= "<input type= 'date' id='end-date' min=$nextDay name='checkout'>" ?>
            </div>
          </div>


          <div class="form-element">
            <label class="block-label" for="numberPeople">Number of guests:</label>
            <div>
              <input type="number" id="numberPeople" value="1" min="1" max="100" step="1" name="capacity">
            </div>
          </div>
          <!--<label class="block-label" for="priceRange">Price:</label>-->
          <div class="ranged-slider">
            <p> Max Price: <span id="rangeValue"></span></p>
            <div>
              <?= "<input type='range' name='priceRange' id='myRange' min='0' max='$maxPrice' value='$maxPrice'>" ?>
            </div>
          </div>

        </div>

        <div class="submit-button-wrapper">
          <input class="submit-button" type="submit" value="Search">
        </div>
      </form>
    </div>
  </section>

  <section class="houses-display">
    <?php
              draw_house_cards($houses); ?>
  </section>
<?php }) ?>