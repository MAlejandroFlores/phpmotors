<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<h1>Delete <?php if (isset($vehicleName)) {echo $vehicleName;} ?>Review </h1>
<h2>Reviewed on <?php if (isset($reviewDate)) {echo $reviewDate;} ?></h2>
<p class="infoMessage">Deletes cannot be undone. Are you sure you want to delete this review?</p>

<form id="deleting_form" action="/phpmotors/reviews/index.php" method="POST">
            <label for="customer_review">Review Text: </label><br>
            <textarea class="customer_review" id ="customer_review" name="reviewText" readonly><?php  if (isset($reviewText)) {echo $reviewText;} ?></textarea><br>
            <input type="submit" name="submit" value="Delete">

            <!-- Add the Review Id name - value pair -->
            <input type="hidden" name="reviewId" value="<?php  if (isset($reviewId)) {echo $reviewId;} ?>">
            <!-- Add the Action - value pair -->
            <input type="hidden" name="action" value="deleteReview">
        </form>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 