<?php 
include_once('../config.php');

echo json_encode(array(
    "u"=>$_POST['username'], 
    "p"=>$_POST['pw']
));

?>