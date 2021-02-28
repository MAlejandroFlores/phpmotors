<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<div class="login_form">
  <h1> Login </h1>

  <?php
  if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
  }
  ?>

  <form action="/phpmotors/accounts/" method="POST">
    <label for="email">Email address: *</label><br>
    <input type="email" id="email" name="clientEmail" required <?php
            if (isset($clientEmail)) {
                echo $clientEmail;
            }
            ?>
            ><br>
    <label for="password">Password: *</label><br>
    <span>Password must be at least 8 characters and contains at least 1 number,
        1 capital letter and 1 special character</span><br>
    <input type="password" id="password" name="clientPassword" pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" 
            required><br><br>
    <input type="submit" value="Login">
    <input type="hidden" name="action" value="new_login">
    <p>* Fields required</p>
  </form>

  <button onclick="window.location.href='/phpmotors/accounts/index.php?action=registration';">
    Create a New Account
  </button>
</div>



<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>