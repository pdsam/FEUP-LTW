<?php 
define("ROOT", __DIR__ . '/');
define("IMAGE_SIZE_LIMIT", 5000000);


function error($code) {
    header("Location: ../pages/error.php?e=$code");
    die;
}

?>