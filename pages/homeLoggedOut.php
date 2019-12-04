<?php
include_once('../config.php');
include_once(ROOT . 'templates/common/header.php');
include_once(ROOT . 'templates/common/footer.php');
include_once(ROOT . 'templates/common/loginForm.php');
include_once(ROOT . 'includes/session.php');

?>

<!DOCTYPE html>
<html>

<head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="../stylesheets/homeLoggedOut.css">
    <link rel="stylesheet" href="../stylesheets/common.css">
    <link rel="stylesheet" href="../stylesheets/topbar.css">
    <link rel="stylesheet" href="../stylesheets/login.css">
    <link rel="stylesheet" href="../stylesheets/footer.css">
    <script src="../javascript/login.js" defer></script>
    <link rel="stylesheet" href="../stylesheets/forms.css">

    <?php if (!isset($_SESSION['username'])) { ?>
        <script src="../javascript/login.js" defer></script>
    <?php } ?>

</head>

<body>
    <?php draw_header(); ?>

    <main>
    <section class="intro">
        <section class="floater">
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
                <input type="number" id="numberPeople" value="1" min="1" max="100" step="1">
            </form>
            <button>search!</button>
        </section>
    </section>

    </main>

    <?php if (!isset($_SESSION['username'])) {
        draw_login_form();
    } ?>

    <?php draw_footer(); ?>
</body>

</html>