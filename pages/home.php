<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'templates/common/house_card.php');

renderPage(array('home'), array(), function() { ?>
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
<?php }) ?>