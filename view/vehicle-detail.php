<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>


<?php


//Display vehicle Detailed info
if (isset($vehicleInfo)) {
    echo $vehicleInfo;
}

//Display vehicle thumbnails view
if (isset($thumbnailsView)) {
    echo $thumbnailsView;
}

?>
<div class="customer_reviews">
    <hr>
    <h3>Customer Reviews</h3>
    <?php
    if (!isset($_SESSION['loggedin'])) {
    ?>
        <p>You must <a href="../view/login.php">login</a> to write a review.</p>
    <?php
    } else {

    ?>
        <!-- <h3>Review the <?php echo $vehicle['invMake'] . " " . $vehicle['invModel']; ?></h3> -->
        <?php
        //Display message
        if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        ?>
        <form action="/phpmotors/reviews/index.php" method="POST">
            <label for="screen_name">Screen Name: </label><br>
            <input type="text" id="screen_name" name="screen_name" value="<?php
                                                                            // Alternatve
                                                                            //echo ucfirst($_SESSION['clientData']['clientFirstname'][0]);
                                                                            echo substr($_SESSION['clientData']['clientFirstname'], 0, 1);
                                                                            echo ucfirst($_SESSION['clientData']['clientLastname']);
                                                                            ?>" readonly><br>
            <label for="review">Review: </label><br>
            <textarea id="review" name="reviewText" require></textarea><br>
            <input type="submit" name="submit" value="Submit Review">

            <!-- Add the Inventory Id name - value pair -->
            <!-- <br><label for="review">inv Id: </label><br> -->
            <input type="hidden" name="invId" value="<?php echo $vehicle['invId']; ?>">
            <!-- Add the Inventory Id name - value pair -->
            <!-- <br><label for="review">clientId: </label><br> -->
            <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
            <?php
            // echo "<br>Session: <br>";
            // print_r($_SESSION);
            // echo "<br>Vehicle: <br>";
            // print_r($vehicle);
            ?>


            <input type="hidden" name="action" value="addReview">
        </form>

    <?php
    }
    //Display Customer vehicle's reviews
    if (isset($customerReviews)) {
        echo $customerReviews;
    }
    ?>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>