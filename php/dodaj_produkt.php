<?php
session_start();
$host = 'localhost';
$db   = 'shop';
$user = 'root';
$pass = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nazwa = $_POST['nazwa'];
    $opis = $_POST['opis'];
    $cena = $_POST['cena'];


    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $stmt = $pdo->prepare("INSERT INTO produkty (nazwa, opis, cena) VALUES (:nazwa, :opis, :cena)");
        $stmt->execute([
            'nazwa' => $nazwa,
            'opis' => $opis,
            'cena' => $cena
            ]);
        echo "DODANO PRODUKT";
    } catch(PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
header("Location: ../sprzedaz/sprzedaz.html");
exit();
}




?>