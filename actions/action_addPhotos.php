<?php 
include_once('../config.php');
include_once(ROOT . 'includes/session.php');
include_once(ROOT . 'database/db_houses.php');

if (!isset($_SESSION['username'])) {
    header('Location: ../pages/home.php');
    die;
}

function generateRandomName($n) { 
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
    $randomString = ''; 
  
    for ($i = 0; $i < $n; $i++) { 
        $index = rand(0, strlen($characters) - 1); 
        $randomString .= $characters[$index]; 
    } 
  
    return $randomString; 
} 

$imageNames = $_FILES['images']['tmp_name'];
$houseId = $_POST['houseId'];
foreach($imageNames as $image) {
    $fileName = '';
    do {
        $fileName = generateRandomName(32);
    } while(pictureExists($picID));
    addHousePicture($houseId, $fileName);
    move_uploaded_file($image, ROOT . 'database/housePictures/'.$fileName);
}

header('Location: ../pages/home.php');

?>
