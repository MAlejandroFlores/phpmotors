<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div class="registration_form">
    <h1> New User </h1>

    <?php
    if (isset($message)) {
        echo '<p class="infoMessage">';
        echo $message;
        echo '</p>';
    }
    ?>

    <form action="/phpmotors/accounts/index.php" method="POST">
        <label for="first_name">First name: *</label><br>
        <input type="text" id="first_name" name="clientFirstname" <?php
                                                                    if (isset($clientFirstname)) {
                                                                        echo "value='$clientFirstname'";
                                                                    }
                                                                    ?> required> <br>
        <label for="last_name">Last name: *</label><br>
        <input type="text" id="last_name" name="clientLastname" <?php
                                                                if (isset($clientLastname)) {
                                                                    echo "value='$clientLastname'";
                                                                }
                                                                ?> required><br>

        <label for="email">Email address: *</label><br>
        <input type="email" id="email" name="clientEmail" <?php
                                                            if (isset($clientEmail)) {
                                                                echo "value='$clientEmail'";
                                                            }
                                                            ?> required><br>
        <label for="password">Password: *</label><br>
        <span>Password must be at least 8 characters and contains at least 1 number,
            1 capital letter and 1 special character</span><br>
        <input type="password" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required><br><br>
        <input type="submit" name="submit" value="Register">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register_user">

        <p>* Fields required</p>
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
<?php unset($_SESSION['message']); ?>