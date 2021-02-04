<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div id=login_form>
    <h1> Login </h1>

    <form action="new_login.php">
        <label for="email">Email address: *</label><br>
        <input type="text" id="email"><br>
        <label for="password">Password: *</label><br>
        <input type="text" id="password"><br><br>
        <input type="submit" value="Login">

        <p>* Fields required</p>
    </form>

    <button onclick="window.location.href='/phpmotors/accounts/index.php?action=registration';">
      Create a New Account
    </button>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>