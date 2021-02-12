<?php

/* 
 *   Accounts model
 */
 
// function to register new users
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect(); 
    // The SQL statement to be used with the database 
    $sql = 'INSERT INTO clients 
                            (clientFirstname, clientLastname, clientEmail, clientPassword)
                VALUES 
                            (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
     // The next line runs the prepared statement 
    $stmt->execute(); 
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor(); 
    //
    return $rowsChanged;

}
