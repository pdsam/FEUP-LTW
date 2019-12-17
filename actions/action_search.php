<?php 
include_once('../config.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_houses.php');


if(isset($_GET[''])){

    $query = 'select * from house where 1';
    $params = array();

    if(array_key_exists('location',$_GET)){
        $query .= " and house.locationID=(select locationID from location where name=?) ";//prolly will break;
        $params[] = $_GET['location'];
    }

    if(array_key_exists('checkin',$_GET) && array_key_exists('checkout',$_GET)){
        
        
        $query .= "and house.houseID not in (select houseID from reservation where julianDate(?)<julianDate(endDate) or julianDate(?) > julianDate(startDate))";
        
        $params[] = $_GET['checkin'];
        $params[] = $_GET['checkout'];

    }

    
    

    if(array_key_exists('capacity',$_GET)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_GET['capacity'];
    }

    if(array_key_exists('pricePerNight',$_GET)){
        $query .= " and house.pricePerNight  < ? ";//prolly will break;
        $params[] = $_GET['pricePerNight'];
    }


   $houses= search($query,$params);
}
?>