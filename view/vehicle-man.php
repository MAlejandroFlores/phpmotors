<?php
//If Not seesion login or Client level > 1, redirect to home
if (!$_SESSION['loggedin'] && ($_SESSION['clientData']['clientLevel'] > '1')) {
    header('Location: /phpmotors/index.php');
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<!-- <?php
        if ($_SESSION['clientData']['clientLevel'] < 2) {
            header('location: /phpmotors/');
            exit;
        }
        ?> -->
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>



<div class="vehi-man">
    <h1> Vehicle Management </h1>

    <ul>
        <li><a href="/phpmotors/vehicles/?action=add_classification">Add Classification</a></li>
        <li><a href="/phpmotors/vehicles/?action=add_vehicle">Add Vehicle</a></li>
    </ul>
</div>

<?php
if (isset($message)) {
    echo '<p class="infoMessage">';
    echo $message;
    echo '</p><br>';
}
if (isset($classificationList)) {
    echo '<h2>Vehicles By Classification</h2>';
    echo '<p>Choose a classification to see those vehicles</p>';
    echo $classificationList;
}
?>
<noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
</noscript>
<table id="inventoryDisplay"></table>

<script src="/phpmotors/js/inventory.js"></script>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
<?php unset($_SESSION['message']); ?>