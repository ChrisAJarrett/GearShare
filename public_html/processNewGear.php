<?php
    require_once('util/main.php');
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
    $category = $_POST["gearCat"];
    $gear_size = $_POST["size"];
    $owner_ID = $_SESSION['user']['user_ID'];

    
    $sql = "INSERT INTO gear (item_name, post_date, photo, description, "
            . "owner_ID, category, gear_size, available) VALUES ('$name', '$dateTime',
                '$imgContent', '$description', $owner_ID , '$category', '$gear_size', '1')";
//    
//    $db->exec($sql);
    
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

