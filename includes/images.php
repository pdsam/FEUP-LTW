<?php
function validImage($imageFile) {

    $check = getimagesize($imageFile["tmp_name"]);
    if($check === false){
        return false;
    } 
    
    if ($imageFile["size"] > IMAGE_SIZE_LIMIT) {
        return false;
    } 
    
    $imageFileType = strtolower(pathinfo($imageFile['name'], PATHINFO_EXTENSION));
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        return false;
    }

    return true;
}

?>