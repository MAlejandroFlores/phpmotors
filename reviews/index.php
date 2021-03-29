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
// Get the review\s model for use a needed
require_once '../model/reviews-model.php';

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

        $reviewText	 = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        
        if (empty($reviewText)){
            $_SESSION['message'] = '<p> Please provide a Review.</p>';
        
            // include($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php');
            
            include ($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/index.php?action=getvehicleinfo&vehicleId=' . $invId);
            exit;
        } else {
            //$reviewDate = time();
            $addReviewOutcome = addReview($reviewText, $invId, $clientId);
            
            if ($addReviewOutcome === 1) {
                $_SESSION['message'] = "<p>Thanks for the review, it is displayed below.</p>";
                // include($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php');
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/?action=getvehicleinfo&vehicleId=' . $invId;
                exit;
            } else {
                $_SESSION['message'] = "<p>Sorry, but the couldn't add the review. Please try again.</p>";
                // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
                include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/?action=getvehicleinfo&vehicleId=' . $invId;
                exit;
            }
            
        }

        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles/?action=getvehicleinfo&vehicleId=' . $invId;

        // Redirect to this controller for default action
        // include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/vehicles.php';
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
