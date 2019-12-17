<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'templates/common/house_card.php');
include_once(ROOT . 'database/db_houses.php');



renderPage(array('home', 'forms'), array('slider'), function () {
  $today = date('Y-m-d');
  $nextDay = new DateTime(date('Y-m-d'));
  $nextDay->modify('+1 day');
  $nextDay = $nextDay->format('Y-m-d');

  $maxPrice = maxPrice()['max(pricePerNight)'];
  
  if(!empty($_GET)){
    

    $query = 'select * from house where 1';
    $params = array();

    if(array_key_exists('location',$_GET)&&$_GET['location'] != ""){
        $query .= " and house.locationID=(select locationID from location where name=?) ";//prolly will break;
        $params[] = $_GET['location'];
    }

    if(array_key_exists('checkin',$_GET) && array_key_exists('checkout',$_GET)){
        
        
        $query .= "and house.houseID not in (select houseID from reservation where julianDate(?)<julianDate(endDate) or julianDate(?) > julianDate(startDate))";
        
        $params[] = $_GET['checkin'];
        $params[] = $_GET['checkout'];

    }

    
    

    if(array_key_exists('capacity',$_GET)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_GET['capacity'];
    }

    if(array_key_exists('pricePerNight',$_GET)){
        $query .= " and house.pricePerNight  < ? ";//prolly will break;
        $params[] = $_GET['pricePerNight'];
    }


   $houses= search($query,$params);
  }
  else{
    
    $houses = getAllHouseInfo();
  }


  ?>
  <section class="filter-renderer">
    <div class="search-form-container">
      <form class="filter-form" action="#" method="GET">
        <div class="search-field-container">

          <div class="form-element">
            <label class="block-label" for="flocation">Where:</label>
            <div>
              <input class="text-input" type="text" name="location" id="flocation">
            </div>
          </div>

          <!--<div class="form-inline-container">-->
            <div class="form-element">
              <label class='block-label' for='start-date'>Check-In:</label>
              <div>
                <?= "<input type= 'date' id='start-date' min=$today >" ?>
              </div>
            </div>

            <div class="form-element">
              <label class='block-label' for='end-date'>Checkout:</label>
              <div>
                <?= "<input type= 'date' id='end-date' min=$nextDay >" ?>
              </div>
            </div>
          <!--</div>-->

          <div class="form-element">
            <label class="block-label" for="numberPeople">Number of guests</label>
            <div>
              <input type="number" id="numberPeople" value="1" min="1" max="100" step="1">
            </div>
          </div>
          <!--<label class="block-label" for="priceRange">Price:</label>-->
          <div>
            <p>Price: <span id="rangeValue"></span></p>
            <div>
             <?= "<input type='range' name='priceRange' id='myRange' min='0' max='$maxPrice'>" ?>
            </div>
          </div>

        </div>

    </div>
    <input class="submit-button" type="submit" value="Search">
    </form>
    </div>
  </section>

  <section class="houses-display">
    <?php
    draw_house_cards($houses); ?>
  </section>
<?php }) ?>