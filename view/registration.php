<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div id=registration_form>
    <h1> New User </h1>

    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    ?>

    <form action="/phpmotors/accounts/index.php" method="POST">
        <label for="first_name">First name: *</label><br>
        <input type="text" id="first_name" name="clientFirstname"><br>
        <label for="last_name">Last name: *</label><br>
        <input type="text" id="last_name" name="clientLastname"><br>

        <label for="email">Email address: *</label><br>
        <input type="text" id="email" name="clientEmail"><br>
        <label for="password">Password: *</label><br>
        <input type="text" id="password" name="clientPassword"><br><br>
        <input type="submit" name="submit" value="Register">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="register_user">

        <p>* Fields required</p>
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>