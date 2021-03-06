<?php
    require_once('util/main.php');
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
        <!--        <script src="less.js" type="text/javascript"></script>-->

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

        <!--Search-->
        <form class="form-horizontal" action="./processNewGear.php" method="post" enctype="multipart/form-data">
            <div class="container-fluid" style="padding-top: 2vw">
                <div class="row" style="padding-top: 1vw">          
                    <div class="col-xs-offset-1 col-xs-7 col-md-offset-2 col-md-2">
                        <label class="control-label" for="labelname">Item Name:</label>
                        <input class="form-control" type="text" name ="itemname" id="itemname" size="30">
                    </div>
                    <div class="col-xs-offset-1 col-xs-8 col-md-offset-0 col-md-2">
                        <label class="control-label" for="labelpic">Photo:</label>
                        <input type="file" name="gearphoto" size="40" id="gearphoto">
                    </div>
                </div>

                <div class="row" style="padding-top:1vw">
                    <div class="col-xs-offset-1 col-xs-5 col-md-offset-2 col-md-2">
                        <label class="control-label" for="gearCat">Category:</label>
                        <select class="form-control" name="gearCat" id="gearCat">
                            <!--This will pull options from the DB instead of hardcoded-->
                            <?php
                                $sql = 'SELECT * FROM gear_category;';

                                foreach ($db->query($sql) as $category):?>
                                <option value="<?php echo $category['category_ID']?>"><?php echo $category['name']?></option>
                                <?php endforeach;?>
                        </select>
                    </div>
                    <div class="col-xs-5 col-md-2">
                        <label class="control-label" for="size">Size:</label>
                        <select class="form-control" name="size" id="size">
                            <option value="any">Any Size</option>
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="large">Large</option>
                            <option value="xlarge">Extra Large</option>
                        </select>
                    </div>
                </div>
                <div class="row" style="padding-top: 1vw">
                    <div class="col-xs-offset-1 col-xs-5 col-md-offset-2 col-md-2">
<!--                        <label class="control-label" for="startDate">From:</label>
                        <input class="form-control" type="date" name="startDate" id="startDate">-->
                    </div>

                    <div class="col-xs-5 col-md-2">
<!--                        <label class="control-label" for="startDate">To:</label>
                        <input class="form-control" type="date" name="endDate" id="endDate">-->
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row" style="padding-top: 1vw">
                    <div class="col-xs-offset-1 col-xs-5 col-md-offset-2 col-md-2">
                        <label class="control-label" for="description">Description</label>
                        <textarea name="description" id="description" rows="5" cols="45"></textarea>
                    </div>
                </div>
                <div class="row" style="padding-top:2vw">
                    <div class="col-xs-offset-5 col-xs-2 col-md-offset-6 col-md-2">
                        <button class="btn btn-basic" name="submit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </body>
</html>
