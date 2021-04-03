<?php if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
   unset($_SESSION['message']);
} ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<h1><?php if (isset($vehicleName)) {echo $vehicleName;} ?>Review </h1>
<h2>Reviewed on <?php if (isset($reviewDate)) {echo $reviewDate;} ?></h2>
<?php
    if (isset($message)) {
        echo '<p class="infoMessage">';
        echo $message;
        echo '</p><br>';    }
    ?>

<form id="review_form" action="/phpmotors/reviews/index.php" method="POST">
            <label for="review">Review Text: </label><br>
            <textarea id="review" name="reviewText"><?php  if (isset($reviewText)) {echo $reviewText;} ?></textarea><br>
            <label>*All fields are required </label><br>
            <input type="submit" name="submit" value="Update">

            <!-- Add the Review Id name - value pair -->
            <input type="hidden" name="reviewId" value="<?php  if (isset($reviewId)) {echo $reviewId;} ?>">
            <!-- Add the Action - value pair -->
            <input type="hidden" name="action" value="updateReview">
        </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 