<?php
// This is the main controller

// Get the database connecton file
require_once 'library/connections.php';
// Get the main model for use a needed
require_once 'model/main-model.php';


// Get the array of classifications from DB using model
$classifications = getClassifications();

//var_dump($classifications);
//	exit;

// Build a navigation bar using the $classifications array
$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
 $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

//echo $navList;
//exit;

//$action = filter_input(INPUT_GET, 'action');
//if ($action == NULL) {
//    $action = filter_input(INPUT_POST, 'action');
//}
?>