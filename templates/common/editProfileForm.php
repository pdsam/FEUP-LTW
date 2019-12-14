<?php
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'databse/db_users.php');

function draw_edit_profile_form()
{
    if(!isset($_SESSION['username'])){
        die;
    }   
    
    $user = getUser($_SESSION['username']);

    $firstName = $user['firstName'];
    $lastName = $user['lastName'];
    $email = $user['email'];
    $username = $user['username'];
    $email = $user['email'];


    ?>
    <div id="edit-form-wrapper" class="edit-wrapper">
        <div id="edit-form-container" class="edit-form-container">
            <form id="edit-profile-form" action="#" method="post">
                <label class="block-label" for="fname">First Name</label>
               <?= "<input class='text-input' type='text' name='fname' id='fname' value=$firstName required>" ?>

                <label class="block-label" for="lname">Last Name</label>
                <?= "<input class='text-input' type='text' name='lname' id='lname' value=$lastName required>" ?>>

                <label class="block-label" for="email">Email</label>
                <?= "<input class='text-input' type='email' name='email' id='email' value='$email' required>" ?>

                <label class="block-label" for="reg-password">Enter a password</label>
                <input class="text-input" type="password" name="password" id="reg-password" >

                <label class="block-label" for="cpassword">Confirm password</label>
                <input class="text-input" type="password" name="cpassword" id="cpassword">

                <p id="registration-error-field"></p>
                <input class="standart-border submit-button button" type="submit" value="Register">
            </form>
            <p id="edit-error-label"></p>
        </div>
    </div>
<?php } ?>