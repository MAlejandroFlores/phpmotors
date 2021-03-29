<?php
/* *****************************************************
*       Reviews Model
*  ***************************************************** */

function addReview($reviewText, $invId, $clientId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO reviews 
                            (reviewText, invId, clientId)
                VALUES 
                            (:reviewText, :invId, :clientId)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    // $stmt->bindValue(':reviewDate', $reviewDate(), PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_STR);
   

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

?>