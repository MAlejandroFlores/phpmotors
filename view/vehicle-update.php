<?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
    echo "Modify $invInfo[invMake] $invInfo[invModel]";
} elseif (isset($invMake) && isset($invModel)) {
    echo "Modify $invMake $invModel";
} ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<?php
//If Not seesion login or Client level > 1, redirect to home
if (!(isset($_SESSION['loggedin']) && ($_SESSION['clientData']['clientLevel'] > '1'))) {
    header('Location: ../index.php');
}
?>

<?php
$classificationList = '<select id="classification_id" name="classificationId">';
$classificationList .= "<option>Choose a Car Classification</option>";
foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
        if ($classification['classificationId'] === $classificationId) {
            $classificationList .= ' selected ';
        } elseif (isset($invInfo['classificationId'])) {
            if ($classification['classificationId'] === $invInfo['classificationId']) {
                $classifList .= ' selected ';
            }
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><div class="add-vehi">

    <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Modify $invInfo[invMake] $invInfo[invModel]";
        } elseif (isset($invMake) && isset($invModel)) {
            echo "Modify$invMake $invModel";
        } ?></h1>

    <p>* Note all the Fields are Required</p>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>


    <form action="/phpmotors/vehicles/index.php" method="POST">
        <?php
        if (isset($classificationList)) {
            echo $classificationList;
        }
        ?><br><br>
        <label for="inv_make">Make</label><br>
        <input type="text" id="inv_make" name="invMake" <?php
                                                        if (isset($invMake)) {
                                                            echo "value='$invMake'";
                                                        } elseif (isset($invInfo['invMake'])) {
                                                            echo "value='$invInfo[invMake]'";
                                                        }
                                                        ?> required><br>
        <label for="inv_model">Model</label><br>
        <input type="text" id="inv_model" name="invModel" <?php
                                                            if (isset($invModel)) {
                                                                echo "value='$invModel'";
                                                            } elseif (isset($invInfo['invModel'])) {
                                                                echo "value='$invInfo[invModel]'";
                                                            }
                                                            ?> required><br>
        <label for="inv_description">Description</label><br>
        <input type="text" id="inv_description" name="invDescription" <?php
                                                                        if (isset($invDescription)) {
                                                                            echo "value='$invDescription'";
                                                                        }
                                                                        ?> required><br>
        <label for="inv_image">Image Path</label><br>
        <input type="text" id="inv_image" name="invImage" <?php
                                                            if (isset($invImage)) {
                                                                echo "value='$invImage'";
                                                            }
                                                            ?> required><br>
        <label for="inv_thumbnail">Thumbnail Path</label><br>
        <input type="text" id="inv_thumbnail" name="invThumbnail" <?php
                                                                    if (isset($invThumbnail)) {
                                                                        echo "value='$invThumbnail'";
                                                                    }
                                                                    ?> required><br>
        <label for="inv_price">Price</label><br>
        <input type="text" id="inv_price" name="invPrice" <?php
                                                            if (isset($invPrice)) {
                                                                echo "value='$invPrice'";
                                                            }
                                                            ?> required><br>
        <label for="inv_stock"># In Stock</label><br>
        <input type="text" id="inv_stock" name="invStock" <?php
                                                            if (isset($invStock)) {
                                                                echo "value='$invStock'";
                                                            }
                                                            ?> required><br>
        <label for="inv_color">Color</label><br>
        <input type="text" id="inv_color" name="invColor" <?php
                                                            if (isset($invColor)) {
                                                                echo "value='$invColor'";
                                                            }
                                                            ?> required><br>

        <input type="submit" name="submit" value="Update Vehicle">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="updateVehicle">
    </form>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>