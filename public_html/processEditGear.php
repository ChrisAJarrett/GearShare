<?php

require_once('util/database.php');

$nameErr = $description = $image = "";

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["gearphoto"]["tmp_name"]);
    if ($check !== false) {
        $image = $_FILES['gearphoto']['tmp_name'];
        $imgContent = addslashes(file_get_contents($image));
    }
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["itemname"])) {
        $nameErr = "Item name required";
    } else {
        $name = trim(filter_input(INPUT_POST, "itemname"));
    }
    if(!empty($_POST["description"])) {
        $description = trim(filter_input(INPUT_POST, "description"));
    }
    
    $dateTime = date("Y-m-d H:i:s");
    $owner_ID = '1'; // TEST , HARDCODED WAITING FOR ACCOUNT/LOGIN SYSTEM
    $category = $_POST["gearCat"];
    $gear_size = $_POST["size"];
    $owner_ID = "";
    $gear_id = $_POST['edit'];
    if($_POST['inuse'] == 'inuse') {
        $inuse = 0;
    } else $inuse = 1;
    
    $sql = "UPDATE gear"
          ." SET item_name = '$name', post_date = '$dateTime', photo = '$imgContent',"
            . "description = '$description', category = '$category',"
            . "gear_size = '$gear_size', available = '$inuse'"
            . "WHERE gear_id = '$gear_id';";
    
    try {
        
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}

/* Sends user  back to mygear.php page when finished */
header('Location: ./mygear.php');
?>

