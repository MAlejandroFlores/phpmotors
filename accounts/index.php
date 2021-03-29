<?php
// This is the Accounts Controller

// Create or access a Session
session_start();
// Get the database connecton file
require_once '../library/connections.php';
// Get the main model for use a needed
require_once '../model/main-model.php';
// Get the accounts model for use a needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build Navigation Menu
$navList = buildNavList($classifications);

// Build Review Management View
$manageReviews = '<h2>Manage Your Product Reviews</h2>';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'login':
        $page_title = 'New Login';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
        break;
    case 'registration':
        $page_title = 'User Registation';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
        break;
    case 'register_user':
        //Filter and store variables
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        //Checking for existing email
        if (checkExistingEmail($clientEmail)) {
            $_SESSION['message'] = '<p class="notice">That email address already exists. Do you want to login instead?</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/login.php';
            exit;
        }

        //Checked for missing values
        // Check for missing data
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p> Please provide information for all empty fileds </p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        if ($regOutcome === 1) {
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "<p>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
            //include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
            header('Location: /phpmotors/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            $page_title = 'Failed Registry';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }
        break;
    case 'new_login':
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        if (empty($clientEmail) || empty($checkPassword)) {
            $_SESSION['message'] = '<p> Please provide information for all empty fileds </p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($clientEmail);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        // Send them to the admin view
        //include '../view/admin.php';
        $page_title = 'Account';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        exit;

        break;
    case 'logout':
        session_destroy();
        unset($_SESSION);
        setcookie('PHPSESSID', '', strtotime('-1 hour'), '/');
        header('Location: /phpmotors/');
        break;

    case 'mod_user':
        $page_title = 'Update Account Information';

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
        break;

    case 'accountUpdate':
        //Filter and store variables
        $clientFirstname = filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING);
        $clientLastname = filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING);
        $clientEmail = filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        //Validate Email requirements
        $clientEmail = checkEmail($clientEmail);

        //Checking for existing email
        if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
            if (checkExistingEmail($clientEmail)) {
                $_SESSION['message'] = 'That email address ' . $clientEmail . ' already exists in our database. Please try using a different one';
                $clientEmail = $_SESSION['clientData']['clientEmail'];
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
                exit;
            }
        }

        //Checked for missing values
        if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
            $_SESSION['message'] = 'Please provide information for all empty fileds';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }

        // Hash the checked password
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);

        if ($updateResult === 1) {
            //Update Session Info
            $clientData = getClientByID($clientId);
            $_SESSION['clientData'] = $clientData;
            setcookie('firstname', $_SESSION['clientData']['clientFirstname'], strtotime('+1 year'), '/');
            $_SESSION['message'] = "$clientFirstname. Your information has been updated.";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
            exit;
        } else {
            $_SESSION['message'] = "Sorry $clientFirstname, we could not update your account information. Please try again.";
            $page_title = 'Failed Account Change';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }
        break;

    case 'passwordUpdate':
        //Filter and store variables
        $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING);
        $clientId = $_SESSION['clientData']['clientId'];

        if (empty($clientPassword)) {
            $_SESSION['message'] = 'Please provide a password, must not be blank.!';
            //print_r($_SESSION);
            //exit;
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        } 

        $checkPassword = checkPassword($clientPassword, $clientId);
        
        //Checked for missing values
        // Check for missing data
        
        if (empty($checkPassword)) {
            $_SESSION['message'] = 'Please provide a valid password.';
            //print_r($_SESSION);
            //exit;
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updateResult = updatePasword($hashedPassword, $clientId);

        if ($updateResult === 1) {
            $_SESSION['message'] = $_SESSION['clientData']['clientFirstname'] . ", your password has been changed succesfully.!";
            //include $_SERVER['DOCUMENT_ROOT'] .'/phpmotors/view/login.php';
            $page_title = 'Password Changed Succesfully';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/client-update.php';
            exit;
        } else {
            $_SESSION['message'] = "Sorry $clientFirstname, but the password change failed. Please try again.";
            $page_title = 'Password Changed Error';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/registration.php';
            exit;
        }
        break;

    default:
        //echo 'Default';
        //exit;
        if (isset($_SESSION['loggedin'])) {
            $page_title = 'Account';
            
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        } else {
            header('Location: /phpmotors/index.php');
        }
        break;
}
