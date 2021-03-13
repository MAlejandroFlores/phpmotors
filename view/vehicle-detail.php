<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>


<?php
    //Display message
    if (isset ($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset ($_SESSION['message']);
    }

    //Display vehicle Detailed info
    if (isset($vehicleInfo)) {
        echo $vehicleInfo;
    }
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 