<?php
//If Not seesion login, redirect to home
if (!$_SESSION['loggedin']) {
   header('Location: /phpmotors/index.php');
}
if (isset($_SESSION['message'])) {
   $message = $_SESSION['message'];
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<?php
if (isset($_SESSION['loggedin'])) {

   echo '<h1> ' . $_SESSION['clientData']['clientFirstname'] . $_SESSION['clientData']['clientLastname'] . '</h1>';

   echo '<p>You are logged in.</p>';
   if (isset($message)) {
      echo '<p class="infoMessage">';
      echo $message;
      echo '</p>';
   }
   echo '<ul><li>First name: ' .  $_SESSION['clientData']['clientFirstname'] . '</li>';
   echo '<li>Last name: ' .  $_SESSION['clientData']['clientLastname'] . '</li>';
   echo '<li>Email: ' .  $_SESSION['clientData']['clientEmail'] . '</li></ul>';
   //echo '<li>Client Level: ' .  $_SESSION['clientData']['clientLevel'] . '</li></ul>';
?>
   <h2>Account Management</h2>
   <p>Use this link to update account information.</p>
   <a href="/phpmotors/accounts/?action=mod_user">Update Account Information</a><br><br>


<?php
   if ($_SESSION['clientData']['clientLevel'] > '1') {
      echo '<h2>Inventory Management</h2>';
      echo '<p>Use this link to manage the inventory.</p>';
      echo '<a href="/phpmotors/vehicles/?action=default">Vehicle Management</a><br><br>';
   }

   //Manage Vehicle reviews
   if (isset($manageReviews)) {
      echo $manageReviews;
   }
} else {
   header('Location: /phpmotors/index.php');
}
?>

<?php

?>


<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
<?php unset($_SESSION['message']); ?>