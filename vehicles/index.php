<?php
// This is the Vehicles Controller

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

// Get the array of classifications from DB using model
$classifications = getClassifications();

$navList = buildNavList($classifications);

//echo '<pre>' . print_r($classifications, true) . '</pre>';
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'add_classification':
        $page_title = 'Add Classification';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
        break;
    case 'add_vehicle':
        $page_title = 'Add Vehicle';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
        break;
    case 'add_new_classification':
        //Filter and store variables
        $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

        //Checked for missing values
        if (empty($classificationName)) {
            $_SESSION['message'] = '<p> Please provide information for all empty form fields.</p>';
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
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING);


        //Checked for missing values
        if (
            empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage)
            || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)
        ) {
            $_SESSION['message'] = '<p> Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }

        $regOutcome = addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

        if ($regOutcome === 1) {
            $_SESSION['message'] = "<p>The $invMake $invModel was added successfully!</p>";
            include($_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry, but adding the $invMake $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-classification.php';
            exit;
        }
        break;
        /* * ********************************** 
    * Get vehicles by classificationId 
    * Used for starting Update & Delete process 
    * ********************************** */
    case 'getInventoryItems':
        // Get the classificationId 
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB 
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
        echo json_encode($inventoryArray);
        break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (!isset($invId) || count($invInfo) < 1) {
            $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
        }
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            $page_title = "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            $page_title = "Modify $invMake $invModel";
        }
        include '../view/vehicle-update.php';
        exit;
        break;
    case 'updateVehicle':
        //Filter and store variables
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
        $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);
        $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);


        //Checked for missing values
        if (
            empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage)
            || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor) || empty($classificationId)
        ) {
            $_SESSION['message'] = '<p> Please provide information for all empty form fields.</p>';
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/add-vehicle.php';
            exit;
        }

        $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);

        if ($updateResult === 1) {
            $_SESSION['message'] = "<p>Congratulations, the $invMake $invModel was successfully updated!</p>";
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $_SESSION['message'] = "<p>Error, but updating the $invMake $invModel failed. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
            exit;
        }
        break;

    case 'del':
        $invId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if (!isset($invId) || count($invInfo) < 1) {
            $_SESSION['message'] = 'Sorry, no vehicle information could be found.';
        }
        if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            $page_title = "Delete $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            $page_title = "Delete $invMake $invModel";
        }
        include '../view/vehicle-delete.php';
        exit;
        break;

    case 'deleteVehicle':
        //Filter and store variables
        $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
        $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = deleteVehicle($invId);

        if ($deleteResult === 1) {
            $_SESSION['message'] = "<p>Congratulations, the $invMake $invModel was successfully deleted!</p>";
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $_SESSION['message'] = "<p>Error, but the $invMake $invModel was not deleted. Please try again.</p>";
            include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-update.php';
            exit;
        }
        break;

    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_STRING);
        $vehicles = getVehiclesByClassification($classificationName);
        if (!count($vehicles)) {
            $_SESSION['message'] = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            //print("<pre>".print_r($vehicles,true)."</pre>");
            //exit;
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        $page_title = "$classificationName vehicles";
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/classification.php';
        break;

    case 'getvehicleinfo':
        $vehicleId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_STRING);
        $vehicle = getVehicleById($vehicleId);
        $thumbnails = getVehicleThumbnailsPath($vehicleId);

        if (!count($vehicle)) {
            $_SESSION['message'] = "<p class='notice'>Sorry, no vehicle details could be found.</p>";
        } else {
            $vehicleInfo = buildVehicleDetail($vehicle);
            $page_title = $vehicle[0]['invMake'] . ' ' . $vehicle[0]['invModel'] . ' Details';
            $thumbnailsView = buildThumbnailView($thumbnails);
        }
        
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-detail.php';
        break;
    default:
        $classificationList = buildClassificationList($classifications);
        $page_title = 'Vehicle Management';
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/vehicle-man.php';
        exit;
        break;
}
