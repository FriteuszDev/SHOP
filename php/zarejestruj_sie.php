<?php
session_start();
$host = 'localhost';
$db   = 'shop';
$user = 'root';
$pass = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['rejestracja_login'];
    $haslo = $_POST['rejestracja_haslo'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $haslo_zabezpieczone = password_hash($haslo, PASSWORD_DEFAULT);
        // 1. Szukamy w bazie TYLKO JEDNEGO użytkownika o podanym loginie
        $stmt = $pdo->prepare("
    INSERT INTO uzytkownicy (nazwa, haslo)
    SELECT :login, :haslo
    WHERE NOT EXISTS (
        SELECT 1 FROM uzytkownicy WHERE nazwa = :login
    )
");
        $stmt->execute([
            'login' => $login,
            'haslo' => $haslo_zabezpieczone
            ]);
        if ($stmt->rowCount() > 0) {
            // 2. Pobieramy ten jeden wiersz (bez żadnej pętli while!)
            $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['zalogowany'] = true;
            $_SESSION['user_login'] = $login;
            header("Location: ../main/main.php");
            exit();
        } else {
            header("Location: ../login/login.html");
            exit();
        }


    } catch(PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
}
?>