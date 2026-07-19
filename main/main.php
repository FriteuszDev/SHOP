<?php

session_start();

$host = 'localhost';
$db   = 'shop';
$user = 'root';
$pass = '';

$id = $_SESSION['id_uzytkownika'];
$koszyk_id = $_SESSION['id_koszyk'];

if (isset($_SESSION['zalogowany']) && $_SESSION['zalogowany'] === true) {
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT nazwa, cena FROM produkty", PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>SHOP - Main</title>
        <link rel="stylesheet" href="main.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    </head>
    <body>
        <div class="product-container">
            <?php foreach ($stmt as $row): ?>
                <div class="<?php echo htmlspecialchars($row['nazwa']) ?>"><?php echo htmlspecialchars($row['nazwa']) ?>
                    <div class="cena_produkt"><?php echo htmlspecialchars($row['cena']). " zł" ?></div>
                </div>
            <?php endforeach; ?>
        </div>


        <div class="koszyk"><i class="fa-solid fa-basket-shopping"></i></div>

        <script src="main.js"></script>
    </body>
    </html>
    <?php
}

?>




