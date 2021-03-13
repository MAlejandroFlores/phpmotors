<?php
/* 
* Library functions
*/


function checkEmail($clientEmail)
{
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
  return preg_match($pattern, $clientPassword);
}

function buildNavList($classifications)
{
  $navList = '<ul>';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
}

function buildClassificationList($classifications)
{
  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= "<option>Choose a Classification</option>";
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
  }
  $classificationList .= '</select>';
  return $classificationList;
}

// Build a display of vehicles within an unordered list.
function  buildVehiclesDisplay($vehicles)
{
  $dv = '<ul id="inv-display">';
  foreach ($vehicles as $vehicle) {
    $dv .= '<li>';
    $dv .= "<a href='/phpmotors/vehicles/?action=getvehicleinfo&vehicleId=" . urlencode($vehicle['invId']) . "'> <img src='/phpmotors$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
    $dv .= '<hr>';
    $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
    $dv .= "<span>$" . number_format($vehicle['invPrice']) . "</span>";
    $dv .= '</li>';
  }
  $dv .= '</ul>';
  return $dv;
}

// Build the Vehicle display view
function buildVehicleDetail($vehicle)
{
  $dv = "<h1>" . $vehicle[0]['invMake'] . ' ' . $vehicle[0]['invModel'] . " Details </h1>";

  $dv .= '<div id="info-display">';

  foreach ($vehicle as $info) {
    $dv .= '<div class="image_area">';
    $dv .= "<img src='/phpmotors$info[invImage]' alt='Image of $info[invMake] $info[invModel] n phpmotors.com'>";
    $dv .= '</div><div class="text_area">';
    $dv .= "<h3>Price:   $" . number_format($info['invPrice']) . "</h1>";
    $dv .= '<hr>';
    $dv .= '<ul>';
    $dv .= "<li><h3>$info[invMake] $info[invModel] Details</h3></li>" ;
    $dv .= "<li> $info[invDescription] </li>" ;
    $dv .= "<li> Color: $info[invColor] </li>" ;
    $dv .= "<li> # in Stock: $info[invStock] </li>" ;

    $dv .= '</ul>';
    $dv .= '</div></div>';
  }
  return $dv;
}
