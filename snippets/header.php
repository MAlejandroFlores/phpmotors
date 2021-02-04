<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css" type="text/css" media="screen">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=East+Sea+Dokdo&display=swap" rel="stylesheet">
</head>

<body>
    <div class="content">
        <header>
            <a class="logo"><img src="/phpmotors/images/site/logo.png" alt="PHP Motors logo"></a>
            <a class="account" href="/phpmotors/accounts?action=login" title="Login or Register with PHP Motors">My Account</a>
        </header>
        <nav>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; 
            //echo $navList; ?> 
        </nav>
        <main>