<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div id=registration_form>
    <h1> New User </h1>

    <form action="new_user.php">
        <label for="first_name">First name: *</label><br>
        <input type="text" id="first_name"><br>
        <label for="last_name">Last name: *</label><br>
        <input type="text" id="last_name"><br>

        <label for="email">Email address: *</label><br>
        <input type="text" id="email"><br>
        <label for="password">Password: *</label><br>
        <input type="text" id="password"><br><br>
        <input type="submit" value="Register">

        <p>* Fields required</p>
    </form>
</div>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>