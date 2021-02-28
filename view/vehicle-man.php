<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<?php
//If Not seesion login or Client level > 1, redirect to home
if (!(isset($_SESSION['loggedin']) && ($_SESSION['clientData']['clientLevel'] > '1') ) )  {
    header( 'Location: ../index.php');
}
?>

<div class="vehi-man">
<h1> Vehicle Management </h1>

<ul>
    <li><a href="/phpmotors/vehicles/?action=add_classification">Add Classification</a></li>
    <li><a href="/phpmotors/vehicles/?action=add_vehicle">Add Vehicle</a></li>
</ul>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>