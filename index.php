<?php
// This is the main controller

// Get the database connecton file
require_once 'library/connections.php';
// Get the main model for use a needed
require_once 'model/main-model.php';
// Get the accounts model for use a needed
require_once 'model/accounts-model.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

//echo '<pre>' . print_r($classifications, true) . '</pre>';
//exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

//echo $navList;
//exit;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


switch ($action) {
    case 'template':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php';
        break;
    case 'login-page':
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/accounts/index.php';
        break;
    default:
        include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/home.php';
        break;
}
