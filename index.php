<?php
// This is the main controller

// Get the database connecton file
require_once 'library/connections.php';
// Get the main model for use a needed
require_once 'model/main-model.php';
// Get the accounts model for use a needed
require_once 'model/accounts-model.php';
// Get the functions library
require_once 'library/functions.php';

// Get the array of classifications from DB using model
$classifications = getClassifications();

$navList=buildNavList($classifications);

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
