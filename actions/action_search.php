<?php 
include_once('../config.php');
include_once(ROOT . 'includes/database.php');
include_once(ROOT . 'database/db_houses.php');


if(isset($_POST[''])){

    $query = 'select * from house where 1';
    $params = array();

    if(array_key_exists('location',$_get)){
        $query .= " and house.locationID=(select locationID from location where name=?) ";//prolly will break;
        $params[] = $_get['location'];
    }

    if(array_key_exists('checkin',$_get) && array_key_exists('checkout',$_get)){
        
        
        $query .= "and house.houseID not in (select houseID from reservation where julianDate(?)<julianDate(endDate) or julianDate(?) > julianDate(startDate))";
        
        $params[] = $_get['checkin'];
        $params[] = $_get['checkout'];

    }

    
    

    if(array_key_exists('capacity',$_get)){
        $query .= " and house.adress  like '%?%' ";//prolly will break;
        $params[] = $_get['capacity'];
    }

    if(array_key_exists('pricePerNight',$_get)){
        $query .= " and house.pricePerNight  < ? ";//prolly will break;
        $params[] = $_get['pricePerNight'];
    }


   $houses= search($query,$params);
}
?>