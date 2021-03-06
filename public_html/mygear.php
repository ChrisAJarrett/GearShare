<?php
require_once('util/main.php');
require_once('util/database.php');

if(!isset($_SESSION['user'])) {
    header('Location: login.php');
}
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
        <!--<script src="less.js" type="text/javascript"></script>-->

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
                                <?php
                                if (isset($_SESSION['user'])) :
                                ?>
                                    <li><a href="<?php echo 'myaccount.php'; ?>">My Account</a></li>
                                    <li><a href="<?php echo 'accountProcess.php?action=logout'; ?>">Logout</a>
                                <?php else: ?>
                                    <li><a href="<?php echo 'accountProcess.php' ?>">Login/Register</a></li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">

            <div class="col-md-offset-2 col-md-8">    
                <div class="row">
                    <h1 class="text-center" style="font-family: Segoe UI">My Gear</h1>
                </div>
                <div class="table-responsive table-condensed">
                    <table class="table" id="ResultTable">
                        <tbody>

                            <?php
                            $owner_ID = $_SESSION['user']['user_ID'];
                            $sql = "SELECT * from gear WHERE owner_ID= $owner_ID";
                            foreach ($db->query($sql) as $row) {
                                echo "<tr>";
                                echo '<td>';
                                echo '<img src="data:image/jpg;base64,' . base64_encode($row["photo"]) . '"/>';
                                echo "</td>";
                                echo "<td><p style='text-transform:capitalize'>Item: " . $row['item_name'] . ", Size: " .
                                $row['gear_size'] . "</p>";
                                echo "<p>Description: " . $row['description'] . "</p></td>";
                                echo '<td>';
                                    if($row['available'] == 0) {
                                        echo '<input type="checkbox" name="inuse" value="inuse" checked disabled>In Use?</input>';
                                    } else {
                                        echo '<input type="checkbox" name="inuse" value="inuse" disabled>In Use?</input>';
                                    }
                                echo '</td>
                                      <td>
                                        <button type="button" class="btn btn-basic btn-lg edit" id="' . $row["gear_ID"] . "edit" . '">Edit</button>
                                      </td>
                                      <td>
                                        <button type="button" class="btn btn-basic btn-lg delete" id="' . $row['gear_ID'] . "delete" . '">Delete</button>
                                      </td></tr>';
                            }
                            ?>
                        </tbody></table>
                </div>
                <form action="addgear.php">
                    <button class="btn btn-lg col-xs-offset-4 col-xs-4 col-md-offset-4 col-md-4">Add Gear</button>
                </form>
            </div>
        </div>
        
        <script>
            $(document).ready(function () {
                /* Delete Button */
                $("button.delete").click(function () {
                    var button_id = this.id;
                    button_id = button_id.substring(0, button_id.indexOf('d'));
                    window.location.href = "mygear.php?delete=" + button_id;
                });
                /* Edit Button */
                $("button.edit").click(function () {
                    var button_id = this.id;
                    button_id = button_id.substring(0, button_id.indexOf('e'));
                    window.location.href = "editgear.php?edit=" + button_id;
                });
            });
        </script>
    </body>
</html>

<?php
//    function deleteEntry() {
if (isset($_GET["delete"])) {
    
    $gear_id = $_GET["delete"];
    $sql = "DELETE FROM gear WHERE gear_ID=$gear_id";
    $db->exec($sql);
    echo "<script>location.replace('mygear.php')</script>";
    
}
?>
