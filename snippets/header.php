<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        if (isset($page_title)) {
            echo $page_title . ' | ';
        }
        ?>
        PHP Motors
    </title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" type="text/css" media="screen">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=East+Sea+Dokdo&display=swap" rel="stylesheet">

</head>

<body>
    <div class="content">
        <header>
            <a class="logo"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo"></a>
            <?php if (isset($_SESSION['loggedin'])) {
                echo '<span class="account"><a href="/phpmotors/accounts" title="User">' .
                    $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname'] . '</a>';
                echo '<a href="/phpmotors/accounts?action=logout" title="Logout">Logout</a></span>';
            } else {
                echo '<a class="account" href="/phpmotors/accounts?action=login" title="Login or Register with PHP Motors">My Account</a>';
            }
            ?>
        </header>
        <nav class="topnav">
            <div class="topnav-centered">
                <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php';
                //echo $navList; 
                ?>
            </div>
        </nav>
        <main>