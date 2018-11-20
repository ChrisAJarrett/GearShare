<?php
//    require_once('util/secure_conn.php');
    require_once('util/database.php');
?>

<!DOCTYPE html>
<!--
    Created by: Chris Jarrett
-->
<html>
    <head>
        <title>GearShare</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

        <link rel="stylesheet/less" type="text/css" href="css/style.less">
        <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.7.1/less.min.js" ></script>

        <style>
            /*Centers text in the table*/
            
            .table th, .table tbody > tr > td {
                text-align: left;
                vertical-align: middle;
            }

            #ResultTable img {
                margin: auto;
                max-height: 128px;
                max-width: 128px;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid header">            
            <h1 style="font-weight: bolder; font-size: 5vw"><a id="logo" href="index.php">GearShare</a></h1>
            <h3 style="font-size: 3vw">Outdoor Equipment and Trip Management</h3>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">News</a></li>
                        <li class="dropdown active">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gear
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li class><a href="findgear.php">Find Gear</a></li>
                                <li><a href="mygear.php">My Gear</a></li>
                            </ul>
                        </li>
                        <li><a href="trips.html">Trips</a></li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">GearShare
                                Account
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="myaccount.php">My Account</a></li>
                                <li><a href="messages.html">Messages</a></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--Table will be populated with search results using PHP-->
        <?php
        
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $category = $_POST["gearCat"];
                $gear_size = $_POST["size"];
                $search = $_POST["search"];
                
                $sql = "SELECT name FROM gear_category WHERE category_ID = $category";
                $getquery = $db->prepare($sql);
                $getquery->execute();
                $row = $getquery->fetch();
                $category = $row['name'];
                
            }
        ?>
        <div class="container-fluid">
            <div class="col-md-offset-2 col-md-8">
                <div class="table-responsive table-condensed">
                    <table class="table" id="ResultTable">
                        <tr>
                            <tr>
                            <?php
                            $sql = "SELECT gear.*, users.username, users.email"
                                   ." FROM gear"
                                   ." INNER JOIN users on gear.owner_ID=users.user_ID";
                            
                            foreach ($db->query($sql) as $row) {
                                echo "</tr><tr>";
                                echo '<td>';
                                echo '<img src="data:image/jpg;base64,' . base64_encode($row["photo"]) . '"/>';
                                echo "</td>";
                                echo "<td><p style='text-transform:capitalize'>Item: " . $row['item_name'] . ", Size: " .
                                    $row['gear_size'] . "</p>";
                                echo "<p>Description: " . $row['description'] . "</p>"
                                        . "Owner: ". $row['username']."</td>";
                                echo '<td>
                                     <button type="button" class="btn btn-basic btn-lg request" id="'.$row["gear_ID"]."request".'">Request Gear</button>
                                      </td>';
                            }
                            
                            echo "</tbody></table>";
                            ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function(){
        /* Request Button */
        $("button.request").click(function() {
            var button_id = this.id;
            button_id = button_id.substring(0, button_id.indexOf('d'));
            window.location.href = "searchresults.php?request=" + button_id;
        });
    });
</script>