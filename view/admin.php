<?php 
     //if (!(isset($_SESSION['loggedin']))) {
     //   header( 'Location: ../index.php');
     //}
?><?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<?php 
     if (isset($_SESSION['loggedin'])) {
    
        echo '<h1> '. $_SESSION['clientData']['clientFirstname'] . $_SESSION['clientData']['clientLastname'] . '</h1>';

        echo '<p>You are logged in.</p>';
        echo '<ul><li>Email: ' .  $_SESSION['clientData']['clientEmail'] . '</li>';
        echo '<li>Client Level: ' .  $_SESSION['clientData']['clientLevel'] . '</li></ul>';

        if ($_SESSION['clientData']['clientLevel'] > '1') {
            echo '<a href="/phpmotors/vehicles/?action=default">Vehicle Management</a><br><br>';
        }
     }
     else {
        header( 'Location: ../index.php');
     }
?>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 