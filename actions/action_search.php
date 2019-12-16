<?php 
include_once('../config.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_houses.php');


if(isset($_POST['']))

    $query = 'select * from house where 1';
    $params = array();

    if(array_key_exists('location',$_get)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_get['location'];
    }


    if(array_key_exists('location',$_get)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_get['location'];
    }

    if(array_key_exists('capacity',$_get)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_get['capacity'];
    }



?>