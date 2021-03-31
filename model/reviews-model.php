<?php
/* *****************************************************
*       Reviews Model
*  ***************************************************** */

// Add a new Review to the database
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

// Get Vehicle Reviews by Vehicle Id
function getVehicleReviews($invId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                * 
            FROM 
                reviews 
            WHERE 
                invId = :invId
            ORDER BY
                reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

// Get Vehicle Reviews by Vehicle Id
function getCustomerReviews($clientId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                * 
            FROM 
                reviews 
            WHERE 
                clientId = :clientId
            ORDER BY
                reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}

// Get Review by Id
function getReviewInfo($reviewId) {
    $db = phpmotorsConnect();
    $sql = 'SELECT 
                * 
            FROM 
                reviews 
            WHERE 
            reviewId = :reviewId
            ORDER BY
                reviewDate DESC';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);
    $stmt->execute();
    $review = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $review;
}

// Update Review Text to dB
function updateReview($reviewId, $reviewText) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'UPDATE 
                reviews 
            SET 
                reviewText = :reviewText
            WHERE 
                reviewId = :reviewId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':reviewText', $reviewText, PDO::PARAM_STR);
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}

// Delete Review from the dB
function deleteReview($reviewId) {
    // Create a connection object from the phpmotors connection function
    $db = phpmotorsConnect();
    // The SQL statement to be used with the database 
    $sql = 'DELETE FROM 
                reviews 
            WHERE 
                reviewId = :reviewId';
    // The next line creates the prepared statement using the phpmotors connection      
    $stmt = $db->prepare($sql);
    //
    $stmt->bindValue(':reviewId', $reviewId, PDO::PARAM_INT);

    // The next line runs the prepared statement 
    $stmt->execute();
    //Ask how many rows has changed 
    $rowsChanged = $stmt->rowCount();
    //Close the database
    $stmt->closeCursor();
    //
    return $rowsChanged;
}
