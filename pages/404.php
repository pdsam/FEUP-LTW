<?php 
include_once('../config.php');
include_once(ROOT . 'templates/drawTemplate.php');
include_once(ROOT . 'includes/db_users.php');

function draw_404() { ?>
    <h1>404 Page does not found</h1>
    <p>Don't worry a team of highly skilled monkeys is already working on creating that page for you</p>
<?php }

renderPage(array('common'),array(),'draw_404');

?>
