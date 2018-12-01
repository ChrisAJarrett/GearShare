<?php
    require_once('util/main.php');
    require_once('util/database.php');
    
    $action = filter_input(INPUT_POST, 'action');
    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        header('Location: accountProcess.php');
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
            header('Location: accountProcess.php');
        }
    }
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
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Gear
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="findgear.php">Find Gear</a></li>
                                <li><a href="mygear.php">My Gear</a></li>
                            </ul>
                        </li>
                        <li><a href="trips.html">Trips</a></li>
                        <li class="dropdown active">
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
        <form class="form-horizontal" action="">
            <div class="form-group">
                <div class="container-fluid" style="padding-top: 2vw">
                    <div class="row" style="padding-top: 1vw">          
                        <div class="col-xs-offset-2 col-xs-7 col-md-offset-5 col-md-2">
                            <label class="control-label" for="username">Username:</label>
                            <input class="form-control" type="text" name="username" id="username" size="30">
                        </div>
                    </div>

                    <div class="row" style="padding-top:1vw">
                        <div class="col-xs-offset-2 col-xs-7 col-md-offset-5 col-md-2">
                            <label class="control-label" for="password">Password:</label>
                            <input class="form-control" type="text" name="password" id="password" size="30">
                        </div>
                    </div>

                    <div class="row" style="padding-top:2vw">
                        <div class="col-xs-offset-4 col-xs-2 col-md-offset-5 col-md-2">
                            <button class="btn btn-basic">Login</button>
                        </div>
                    </div>
                </div>
        </form>
    </body>
</html>
