<?php
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_users.php');

$user = getSessionUser();
if (!$user) {
    error('401');
}

renderPage(
    array('formPlacement'),
    array('editProfile'),
    function () use ($user) {
        $firstName = $user['firstName'];
        $lastName = $user['lastName'];
        $email = $user['email'];
        $username = $user['username'];
        $bio = $user['bio'];
        ?>
    <div id="edit-form-wrapper" class="edit-wrapper">
        <div id="edit-form-container" class="edit-form-container">
            <form id="edit-profile-form" action="#" method="post">
            <div class="inline-form-elements">
                <label class="block-label" for="fname">First Name</label>
                <?= "<input class='text-input' type='text' name='firstname' id='fname' value=$firstName maxlength='50' required>" ?>

                <label class="block-label" for="lname">Last Name</label>
                <?= "<input class='text-input' type='text' name='lastname' id='lname' value=$lastName maxlength='50' required>" ?>
            </div>

                <label class="block-label" for="email">Email</label>
                <?= "<input class='text-input' type='email' name='email' id='email' value='$email' maxlength='50' required>" ?>

                <label class="block-label" for="bio">Bio</label>
                <?= "<input class='text-input' type='text' name='bio' id='bio' value='$bio' maxlength='160' required>" ?>

                <label class="block-label" for="old-password">Enter old password</label>
                <input class="text-input" type="password" name="old-password" id="old-password" maxlength="1000">

                <label class="block-label" for="new-password">Enter new password</label>
                <input class="text-input" type="password" name="new-password" id="new-password" maxlength="1000">

                <label class="block-label" for="new-c-password">Confirm new password</label>
                <input class="text-input" type="password" name="new-c-password" id="new-c-password" maxlength="1000">



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