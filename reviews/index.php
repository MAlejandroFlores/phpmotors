<?php
/* *****************************************************
*       Reviews Controller
*  ***************************************************** */

// Create or access a Session
session_start();
// Get the database connecton file
require_once '../library/connections.php';
// Get the main model for use a needed
require_once '../model/main-model.php';
// Get the vehicle model for use a needed
require_once '../model/vehicles-model.php';
// Get the functions library
require_once '../library/functions.php';
// Get the uploads model
require_once '../model/uploads-model.php';
// Get the accounts model for use a needed
require_once '../model/accounts-model.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();
// Build a navigation bar using the $classifications array
$navList = buildNavList($classifications);

$action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_STRING);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
}

switch ($action) {
    case 'addReview':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        break;

    case 'displayReview':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        break;
    case 'updateReview':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        break;
    case 'confirmDeletion':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        break;
    case 'deletReview':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        break;
    case 'delete':

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        header('location: .');
        break;
    default:

        if (isset($_SESSION['loggedin'])) {
            $page_title = 'Account';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
        } else {
            header('Location: /phpmotors/index.php');
        }

        $page_title = 'Image Management';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/image-admin.php';
        exit;
        break;
}
