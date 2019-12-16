<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');

$errors = array(
    '404'=>'Content not found.',
    '401'=>'You are not loged in.',
    '403'=>'You have no permission to access this page.',
);

renderPage(
    array(),
    array(),
    function() use($errors) {
        $message = $errors[$_GET['e']];
    ?>
        <h2><?= $message ?></h2>
    <?php }
);

?>