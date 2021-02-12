<?php
// This is the Vehicles Controller


// Get the database connecton file
require_once '../library/connections.php';
// Get the main model for use a needed
require_once '../model/main-model.php';
// Get the vehicle model for use a needed
require_once '../model/vehicles-model.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$classificationList = '<select id="classification_id" name="classificationId">';
$classificationList .= '<option value="Choose Car Classification"> Choose Car Classification</option>';
foreach ($classifications as $classification) {
$classificationList .= "<option value='" . $classification['classificationId'] . "'>$classification[classificationName]</option>";
}
$classificationList .= '</select>';

//echo '<pre>' . print_r($classifications, true) . '</pre>';
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add_classification':
        $pageTitle = 'Add Classification';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;
    case 'add_vehicle':
        $pageTitle = 'Add Vehicle';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
        break;
    case 'add_new_classification':
        //Filter and store variables
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

        //Checked for missing values
        if (empty($classificationName)) {
            $_SESSION['message'] = '<p> Please provide information fro all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }

        $regOutcome = addClassification($classificationName);

        if ($regOutcome === 1) {
            //$_SESSION['message'] = "<p>Classification $classificationName, add it successfully!</p>";
            header('Location: /phpmotors/vehicles');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry, but adding the $classificationName classification failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }
        break;
    case 'add_new_car':
        //Filter and store variables
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_STRING);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_STRING);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING);
        

        //Checked for missing values
        if (empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage)
         || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)) {
            $_SESSION['message'] = '<p> Please provide information fro all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }

        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if ($regOutcome === 1) {
            $_SESSION['message'] = "<p>The $invMake $invModel was added successfully!</p>";
            include ($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry, but adding the $invMake $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        break;
}
