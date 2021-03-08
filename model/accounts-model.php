<?php

/* 
 *   Accounts model
 */

// function to register new users
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
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

// Get client data based on an email address
function getClient($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}

//Verify existing email address
function checkExistingEmail($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}

function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'UPDATE 
                clients 
            SET
                clientFirstname = :clientFirstname, 
                clientLastname = :clientLastname, 
                clientEmail = :clientEmail
            WHERE
                clientId = :clientId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

function updatePasword($clientPassword, $clientId)
{
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'UPDATE 
                clients 
            SET
                clientPassword = :clientPassword
        WHERE
                clientId = :clientId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

// Get client data based on an clientId
function getClientByID($clientId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                clientId, 
                clientFirstname, 
                clientLastname, 
                clientEmail, 
                clientLevel 
            FROM 
                clients 
            WHERE 
                clientId = :clientId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}
