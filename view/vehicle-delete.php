<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<?php
//If Not seesion login or Client level > 1, redirect to home
if (!(isset($_SESSION['loggedin']) && ($_SESSION['clientData']['clientLevel'] > '1'))) {
    header('Location: /phpmotors/index.php');
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
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classification['classificationId'] === $invInfo['classificationId']) {
            $classificationList .= ' selected ';
        }
    }
    $classificationList .= ">$classification[classificationName]</option>";
}
$classificationList .= '</select>';
?><div class="add-vehi">

    <h1><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
            echo "Delete $invInfo[invMake] $invInfo[invModel]";
        } ?></h1>

    <p>Confirm Vehicle Deletion. The delete is permanent.</p>
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>
    <form action="/phpmotors/vehicles/index.php" method="POST">
        <?php
        //print_r($invInfo);
        //exit;
        if (isset($classificationList)) {
            echo $classificationList;
        }
        ?><br><br>
        <label for="inv_make">Make</label><br>
        <input type="text" id="inv_make" name="invMake" <?php
                                                        if (isset($invInfo['invMake'])) {
                                                            echo "value='$invInfo[invMake]'";
                                                        }
                                                        ?>readonly><br>
        <label for="inv_model">Model</label><br>
        <input type="text" id="inv_model" name="invModel" <?php
                                                            if (isset($invInfo['invModel'])) {
                                                                echo "value='$invInfo[invModel]'";
                                                            }
                                                            ?>readonly><br>
        <textarea name="invDescription" id="invDescription"> <?php
                                                                    if (isset($invInfo['invDescription'])) {
                                                                        echo $invInfo['invDescription'];
                                                                    }
                                                                    ?>
                                                            readonly</textarea><br>

        <input type="submit" name="submit" value="Delete Vehicle">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="deleteVehicle">
        <!-- Add the Inventary ID - value pair -->
        <input type="hidden" name="invId" value=<?php
                                                if (isset($invInfo['invId'])) {
                                                    echo $invInfo['invId'];
                                                } ?>>
    </form>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>