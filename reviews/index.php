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

        $reviewText     = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        $reviewDate = filter_input(INPUT_POST, 'reviewDate', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

        if (empty($reviewText)) {
            $_SESSION['message'] = 'Please provide a Review.!';
        } else {
            //$reviewDate = time();
            $addReviewOutcome = addReview($reviewText, $invId, $clientId);

            if ($addReviewOutcome === 1) {
                $_SESSION['message'] = "Thanks for the review, it is displayed below.";
            } else {
                $_SESSION['message'] = "Sorry, but the couldn't add the review. Please try again.";
            }
        }

        header('Location: /phpmotors/vehicles/?action=getvehicleinfo&vehicleId=' . $invId . '#customer_reviews');
        exit;
        break;

    case 'mod':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewInfo($reviewId);
        // Validate for an existing review
        if (empty($review)) {
            $_SESSION['message'] = 'Error: Review could not be found';
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $reviewDate = getReviewDate($review);
            $vehicleName = getVehicleNameByReview($review);
            $reviewText = $review['reviewText'];
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-update.php';
        exit;
        break;
    case 'updateReview':
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);
        $reviewText = filter_input(INPUT_POST, 'reviewText', FILTER_SANITIZE_STRING);
        if (empty($reviewText) ||  empty($reviewId)) {
            $_SESSION['message'] = 'Error: Review not edited. Please enter a review';
            header('Location: /phpmotors/reviews/?action=mod&reviewId='.$reviewId);
            exit;
        } else {
            $updateResult = updateReview($reviewId, $reviewText);
            // Store message to session
            if ($updateResult === 1) {
                $_SESSION['message'] = 'The review was updated successfully.';
            }
        }
        // Redirect to this controller for default action
        header('location: /phpmotors/accounts/');
        exit;
        break;
    case 'del':
        $reviewId = filter_input(INPUT_GET, 'reviewId', FILTER_VALIDATE_INT);
        $review = getReviewInfo($reviewId);
        // Validate for an existing review
        if (empty($review)) {
            $_SESSION['message'] = 'Error: Review could not be found';
            header('location: /phpmotors/accounts/');
            exit;
        } else {
            $reviewDate = getReviewDate($review);
            $vehicleName = getVehicleNameByReview($review);
            $reviewText = $review['reviewText'];
        }
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/review-delete.php';
        exit;
        break;
    case 'deleteReview':
        //Filter and store variables
        $reviewId = filter_input(INPUT_POST, 'reviewId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteReview($reviewId);

        if ($deleteResult === 1) {
            $_SESSION['message'] = "The review was deleted successfully";
            
        } else {
            $_SESSION['message'] = "Error, but couldn't delete the review.";
        }
        header('location: /phpmotors/accounts/');
        exit;
        break;

        // Store message to session
        $_SESSION['message'] = $message;

        // Redirect to this controller for default action
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/admin.php';
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
