<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/db_users.php');

function draw_404() { ?>
    <h1>404 Page does not exist lol</h1>
<?php }

renderPage(array('common'),array(),'draw_404');

?>
