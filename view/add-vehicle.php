<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div class="add-vehi">

<h1>Add Vehicle</h1>
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
                echo $invMake;
            }
            ?>
            required><br><br>
    <label for="inv_model">Model</label><br>
    <input type="text" id="inv_model" name="invModel" <?php
            if (isset($invModel)) {
                echo $invModel;
            }
            ?>
            required><br><br>
    <label for="inv_description">Description</label><br>
    <input  type="text" id="inv_description" name="invDescription" <?php
            if (isset($invDescription)) {
                echo $invDescription;
            }
            ?>
            required><br><br>
    <label for="inv_image">Image Path</label><br>
    <input type="text" id="inv_image" name="invImage" <?php
            if (isset($invImage)) {
                echo $invImage;
            }
            ?>
            required><br><br>
    <label for="inv_thumbnail">Thumbnail Path</label><br>
    <input type="text" id="inv_thumbnail" name="invThumbnail" <?php
            if (isset($invThumbnail)) {
                echo $invThumbnail;
            }
            ?>
            required><br><br>
    <label for="inv_price">Price</label><br>
    <input type="text" id="inv_price" name="invPrice" <?php
            if (isset($invPrice)) {
                echo $invPrice;
            }
            ?>
            required><br><br>
    <label for="inv_stock"># In Stock</label><br>
    <input type="text" id="inv_stock" name="invStock" <?php
            if (isset($invStock)) {
                echo $invStock;
            }
            ?>
            required><br><br>
    <label for="inv_color">Color</label><br>
    <input type="text" id="inv_color" name="invColor" <?php
            if (isset($invColor)) {
                echo $invColor;
            }
            ?>
            required><br><br>

    <input type="submit" name="submit" value="Add Vehicle">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="add_new_car">
</form>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>