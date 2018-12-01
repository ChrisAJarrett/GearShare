<?php
require_once('util/main.php');
require_once('util/database.php');


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view_login';
        if (isset($_SESSION['user'])) {
            $action = 'view_account';
        }
    }
}


function addUser(string $username, string $email, string $password, string $fname, string $lname) {
    
    global $db;
    
    $password = sha1($username . $password);
    $query = '
        INSERT INTO users (username, email, access_level, first_name, last_name, pw)
        VALUES (:username, :email, "user", :first_name, :last_name, :pw)';
    
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':email', $email);
    $statement->bindValue(':pw', $password);
    $statement->bindValue(':first_name', $fname);
    $statement->bindValue(':last_name', $lname);
    $statement->execute();
    $userID = $db->lastInsertId();
    $statement->closeCursor();
    return $userID;
}

function getUserByID($userID) {
}

function getUserByUsername($username) {
    global $db;
    $query = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function is_valid_customer_login($username, $password) {
    global $db;
    $password = sha1($username . $password);
    $query = '
        SELECT * FROM users
        WHERE username = :username AND pw = :password';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->bindValue(':password', $password);
    $statement->execute();
    $valid = ($statement->rowCount() == 1);
    $statement->closeCursor();
    return $valid;
}
switch($action) {
    case 'view_register':
        include 'register.php';
        break;
    case 'register':
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $password2 = filter_input(INPUT_POST, 'password2');
        $fname = filter_input(INPUT_POST, 'fname');
        $lname = filter_input(INPUT_POST, 'lname');

        

        // If passwords don't match, redisplay Register page and exit controller
        if ($password !== $password2) {
//            $password_message = 'Passwords do not match.';
            include 'register.php';
            break;
        }

        // Validate the data for the customer
//        if (is_valid_customer_email($email)) {
//            display_error('The e-mail address ' . $email . ' is already in use.');
//        }
        
        //Add user
        $userID = addUser($username, $email, $password, $fname, $lname);
        // Store user data in session
        $_SESSION['user'] = getUserByID($userID);
        include 'index.php';
        break;
        
        case 'view_login':
            header('Location:login.php');
            break;
        
        case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        
        // Check username and password in database
        if (is_valid_customer_login($username, $password)) {
            $_SESSION['user'] = getUserByUsername($username);
            include 'index.php';
            break;
        } else {
            $password_message = 'Login failed. Invalid username or password.';
            header('Location: ./login.php');
            break;
        }
        
        case 'view_account':
            header('Location: ./mygear.php');
            break;
        
        case 'view_login':
            header('Location: ./login.php');
            break;
        
        case 'logout':
            unset($_SESSION['user']);
            header('Location: index.php');
            break;
}
?>

