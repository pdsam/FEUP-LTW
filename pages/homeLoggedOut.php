<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');

function homeLoggedOut()
{ ?>

    <main>
    <section class="search-form-image"> 
        <form id="search-form" action="#" method="post">
            <label class="block-label" for="flocation">Where</label>
            <input class="text-input" type="text" name="fname" id="flocation" required>
            
            <?php 
                $today = date('Y-m-d');
                $nextDay = new DateTime(date('Y-m-d'));
                $nextDay->modify('+1 day');

            echo '<label class="block-label" for="start-date" >Check-In</label>';
            echo '<input type= "date" id="start-date" min=$today >';
            echo '<label class="block-label" for="end-date" >Checkout</label>';
            echo '<input type= "date" id="end-date" min=$nextDay >';

            ?>

            <label class="block-label" for="numberPeople">Number of guests</label>
            <input type= "number" id="numberPeople" value="1" min="1" max="100" step="1">
        </form>
        <button>search!</button>
    </section>
    <section id = "slogan">

    </section>
</main>
<?php
}

renderPage(array('homeLoggedOut'), array('homeLoggedOut'), 'homeLoggedOut');
?>