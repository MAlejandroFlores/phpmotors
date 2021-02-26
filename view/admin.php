<?php 
     if ($_SESSION['loggedin']) {
        echo '<h1>Logeado</h1>';
        echo $_SESSION['clientData']['clientFirstname'];
     }
     else {
        echo '<h1>No Logeado</h1>';
     }
?> <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<h1> Admin </h1>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?> 