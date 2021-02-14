<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div class="add-class">
<h1>Add Car Classification</h1>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<form action="/phpmotors/vehicles/index.php" method="POST">
    <label for="classification_name">Classification Name</label><br>
    <input type="text" id="classification_name" name="classificationName"><br><br>

    <input type="submit" name="submit" value="Add Classification"><br><br>
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="add_new_classification">
</form>

</div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>