<?php
session_start();
if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOP - Main</title>
    </head>
    <body>
        <p>zalogowany</p>
    </body>
    </html>
    <?php
} else {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOP - Main</title>
    </head>
    <body>
        <p>nie zalogowany</p>
    </body>
    </html>
    <?php
}

?>




