<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');

function register_page() { ?>

<form id="registration-form" action="#" method="post">
    <label class="block-label" for="firstname">First Name</label>
    <input class="text-input" type="text" name="firstname" id="firstname" required>

    <label class="block-label" for="lastname">Last Name</label>
    <input class="text-input" type="text" name="lastname" id="lastname" required>

    <label class="block-label" for="reg-username">Username</label>
    <input class="text-input" type="text" name="username" id="reg-username" required>

    <label class="block-label" for="email">Email</label>
    <input class="text-input" type="email" name="email" id="email" required>

    <label class="block-label" for="reg-password">Enter a password</label>
    <input class="text-input" type="password" name="password" id="reg-password" required>

    <label class="block-label" for="cpassword">Confirm password</label>
    <input class="text-input" type="password" name="cpassword" id="cpassword" required>
    <p id="registration-error-field"></p>
    <input class="standart-border submit-button button" type="submit" value="Register">
</form>

<?php
}

renderPage(array('registration','formPlacement'), array('register'), 'register_page');
?>