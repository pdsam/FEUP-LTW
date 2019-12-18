<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');

function register_page()
{ ?>
    <div>
        <form id="registration-form" action="#" method="post">
            <label class="block-label" for="firstname">First Name</label>
            <input class="text-input" type="text" name="firstname" id="firstname" maxlength="50" required>

            <label class="block-label" for="lastname">Last Name</label>
            <input class="text-input" type="text" name="lastname" id="lastname" maxlength="50" required>

            <label class="block-label" for="reg-username">Username</label>
            <input class="text-input" type="text" name="username" id="reg-username" maxlength="25" required>

            <label class="block-label" for="email">Email</label>
            <input class="text-input" type="email" name="email" id="email" maxlength="50" required>

            <label class="block-label" for="reg-password">Enter a password</label>
            <input class="text-input" type="password" name="password" id="reg-password" maxlength="1000" required>

            <label class="block-label" for="cpassword">Confirm password</label>
            <input class="text-input" type="password" name="cpassword" id="cpassword" maxlength="1000" required>
            <p id="registration-error-field"></p>
            <input class="standart-border submit-button button" type="submit" value="Register">
        </form>
    </div>
<?php
}

renderPage(array('registration', 'formPlacement'), array('register'), 'register_page');
?>