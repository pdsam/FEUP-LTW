<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');

renderPage(
    array('formPlacement'),
    array('editProfile'),
    function () {

        if (!isset($_SESSION['username'])) {
            die;
        }

        $user = getUser($_SESSION['username']);

        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $username = $_SESSION['username'];


        ?>
    <div id="edit-form-wrapper" class="edit-wrapper">
        <div id="edit-form-container" class="edit-form-container">
            <form id="edit-profile-form" action="#" method="post">
                <label class="block-label" for="fname">First Name</label>
                <?= "<input class='text-input' type='text' name='fname' id='fname' value=$firstName required>" ?>

                <label class="block-label" for="lname">Last Name</label>
                <?= "<input class='text-input' type='text' name='lname' id='lname' value=$lastName required>" ?>

                <label class="block-label" for="email">Email</label>
                <?= "<input class='text-input' type='email' name='email' id='email' value='$email' required>" ?>

                <label class="block-label" for="old-password">Enter old password</label>
                <input class="text-input" type="password" name="old-password" id="old-password">

                <label class="block-label" for="new-password">Enter new password</label>
                <input class="text-input" type="password" name="new-password" id="new-password">
                
                <label class="block-label" for="new-c-password">Confirm new password</label>
                <input class="text-input" type="password" name="new-c-password" id="new-c-password">

                <p id="profile-error-field"></p>
                <input class="standart-border submit-button button" type="submit" value="Save">
            </form>
            <p id="edit-error-label"></p>
            <?= "<span id='hidden'>$username</span>" ?>
        </div>
    </div>


<?php
}
);
?>