<?php
session_start();
$host = 'localhost';
$db   = 'shop';
$user = 'root';
$pass = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['logowanie_login'];
    $haslo = $_POST['logowanie_haslo'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 1. Szukamy w bazie TYLKO JEDNEGO użytkownika o podanym loginie
        $stmt = $pdo->prepare("SELECT id, nazwa, haslo FROM uzytkownicy WHERE nazwa = :login");
        $stmt->execute(['login' => $login]);
        
        // 2. Pobieramy ten jeden wiersz (bez żadnej pętli while!)
        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

        // 3. Sprawdzamy czy użytkownik istnieje ORAZ czy hasło pasuje
        if ($user_data && password_verify($haslo, $user_data['haslo'])) {
            $_SESSION['zalogowany'] = true;
            $_SESSION['user_login'] = $user_data['login'];
            
            header("Location: ../main/main.php");
            exit();
        } else {
            // Bezpieczniej jest podać ogólny komunikat, żeby haker nie wiedział, czy pomylił login czy hasło
            echo "Niepoprawny login lub hasło.";
            header("Location: ../login/login.html");
            exit();
        }

    } catch(PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
}
?>