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


<div class="registration_form">
    <h1> Update Account Information</h1><br>

    <h3> Update Account Info</h3>

    <?php
    if (isset($message)) {
        echo '<p class="infoMessage">';
        echo $message;
        echo '</p>';
    }
    //print_r($_SESSION['clientData']);
    //print_r($_SESSION['clientData']['clientId']);
    ?>

    <form name="accountUpdate" action="/phpmotors/accounts/index.php" method="POST">
        <label for="first_name">First name: </label><br>
        <input type="text" id="first_name" name="clientFirstname" value="<?php
                                                                            if (isset($clientFirstname)) {
                                                                                echo "$clientFirstname";
                                                                            } elseif (isset($_SESSION['clientData']['clientFirstname'])) {
                                                                                echo $_SESSION['clientData']['clientFirstname'];
                                                                            }
                                                                            ?>" required> <br>

        <label for="last_name">Last name: </label><br>
        <input type="text" id="last_name" name="clientLastname" value="<?php
                                                                        if (isset($clientLastname)) {
                                                                            echo "$clientLastname";
                                                                        } elseif (isset($_SESSION['clientData']['clientLastname'])) {
                                                                            echo $_SESSION['clientData']['clientLastname'];
                                                                        }
                                                                        ?>" required> <br>

        <label for="email">Email address: </label><br>
        <input type="email" id="email" name="clientEmail" value="<?php
                                                                    if (isset($clientEmail)) {
                                                                        echo "$clientEmail";
                                                                    } elseif (isset($_SESSION['clientData']['clientEmail'])) {
                                                                        echo $_SESSION['clientData']['clientEmail'];
                                                                    }
                                                                    ?>" required> <br><br>

        <input type="submit" name="submit" value="Update Info">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="accountUpdate">
        <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
    </form>
    <br>
    <h3> Update Password</h3>
    <form name="passwordUpdate" action="/phpmotors/accounts/index.php" method="POST">

        <p><span>Password must be at least 8 characters and contains at least 1 number,
                1 capital letter and 1 special character.</span><br>
            <span>*Note your original password will be changed</span>
        </p>
        <label for="password">Password: </label>
        <input type="password" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
        <input type="submit" name="submit" value="Update Password">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="passwordUpdate">
        <input type="hidden" name="clientId" value="<?php echo $_SESSION['clientData']['clientId']; ?>">
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
<?php unset($_SESSION['message']); ?>