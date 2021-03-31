<?php

/* 
 *   Vehicles model
 */

// function to Add new Classification
function addClassification($classificationName)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO carclassification 
                            (classificationName)
                VALUES 
                            (:classificationName)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    // 
    return $rowsChanged;
}

function addVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO inventory 
                            (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
                VALUES 
                            (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}

// Update vehicle information
function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'UPDATE 
                inventory 
            SET 
                invMake = :invMake, invModel = :invModel, 
	            invDescription = :invDescription, invImage = :invImage, 
	            invThumbnail = :invThumbnail, invPrice = :invPrice, 
	            invStock = :invStock, invColor = :invColor, 
	            classificationId = :classificationId 
            WHERE 
                invId = :invId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

//Delete vehicle
function deleteVehicle($invId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

// Get a list of vehicles based on the classification.
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT 
	            * 
            FROM 
	            inventory
            INNER JOIN	
	            images
            ON 
	            inventory.invId = images.invId
            WHERE 
	            classificationId 
            IN 
	            (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)
            AND
	            imgPrimary = 1
            AND 
                imgName 
            LIKE
	            "%-tn.%"';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

function getVehicleById($vehicleId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT 
	            * 
            FROM 
                inventory 
            INNER JOIN	
	            images
            ON 
	            inventory.invId = images.invId
            WHERE 
                inventory.invId 
            IN 
                (SELECT inventory.invId FROM inventory WHERE inventory.invId = :invId)
            AND
	            imgPrimary = 1
            AND 
            imgName 
            NOT LIKE
	            "%-tn.%"';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $vehicleId, PDO::PARAM_STR);
    $stmt->execute();
    $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    // foreach ($vehicles as $ind_vehicle) {
    //     foreach ($ind_vehicle as $key => $value) {
    //         $vehicle[$key] = $value;
    //     }
    // }
    return $vehicle;
}

// Get information for all vehicles
function getVehicles()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}
