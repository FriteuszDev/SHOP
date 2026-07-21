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


        $stmt = $pdo->prepare("SELECT id, nazwa, haslo FROM uzytkownicy WHERE nazwa = :login");
        $stmt->execute(['login' => $login]);
        

        $user_data = $stmt->fetch(PDO::FETCH_ASSOC);



        if ($user_data && password_verify($haslo, $user_data['haslo'])) {
            $uzyte_id = $user_data['id'];
            $stmt2 = $pdo->prepare("SELECT koszyk_id FROM koszyk WHERE uzytkownik_id = :uzyte_id");
            $stmt2->execute(['uzyte_id' => $uzyte_id]);
            $koszyk = $stmt2->fetch();
            if($koszyk){
                $koszyk_id = $koszyk['koszyk_id'];
                $_SESSION['id_koszyk'] = $koszyk_id;
            } else {
                $stmt3 = $pdo->prepare("INSERT INTO koszyk (uzytkownik_id) VALUES (:id)");
                $stmt3->execute([
                    'id' => $uzyte_id
                ]);
            }


            $_SESSION['id_uzytkownika'] = $uzyte_id;
            $_SESSION['zalogowany'] = true;
            $_SESSION['user_login'] = $user_data['login'];
            
            header("Location: ../main/main.php");
            exit();
        } else {
            echo "Niepoprawny login lub hasło.";
            header("Location: ../login/login.html");
            exit();
        }

    } catch(PDOException $e) {
        echo "Błąd połączenia: " . $e->getMessage();
    }
}
?>