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
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $wybrana_kategoria = $_POST['kategoria'] ?? '';
            $wybrane_sortowanie = $_POST['sortowanie'] ?? '';
            

            if (!empty($wybrana_kategoria)) {

                if (empty($wybrane_sortowanie)) {
                    if ($wybrana_kategoria == "wszystko"){
                        $sql = "SELECT nazwa, cena FROM produkty";
                                
                        $stmt3 = $pdo->prepare($sql);
                        $stmt3->execute();
                        $produkty = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                        $sql = "SELECT p.* 
                                FROM produkty p
                                INNER JOIN kategorie k ON p.kategoria_id = k.id
                                WHERE k.nazwa = :wybrana_kategoria";
                                
                        $stmt3 = $pdo->prepare($sql);
                        $stmt3->execute(['wybrana_kategoria' => $wybrana_kategoria]);
                        $produkty = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    }
                } else {
                    if ($wybrana_kategoria == "wszystko"){
                        if ($wybrane_sortowanie == "cena_r"){
                            $sql = "SELECT nazwa, cena FROM produkty ORDER BY cena ASC";
                        } else if ($wybrane_sortowanie == "cena_m") {
                            $sql = "SELECT nazwa, cena FROM produkty ORDER BY cena DESC";
                        } else if ($wybrane_sortowanie == "alfabetycznie_a"){
                            $sql = "SELECT nazwa, cena FROM produkty ORDER BY nazwa ASC";
                        } else if ($wybrane_sortowanie == "alfabetycznie_z"){
                            $sql = "SELECT nazwa, cena FROM produkty ORDER BY nazwa DESC";
                        }
                            
                            $stmt3 = $pdo->prepare($sql);
                            $stmt3->execute();
                            $produkty = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    } else {
                            $sql = "SELECT p.* 
                                    FROM produkty p
                                    INNER JOIN kategorie k ON p.kategoria_id = k.id
                                    WHERE k.nazwa = :wybrana_kategoria";
                                    
                            $stmt3 = $pdo->prepare($sql);
                            $stmt3->execute(['wybrana_kategoria' => $wybrana_kategoria]);
                            $produkty = $stmt3->fetchAll(PDO::FETCH_ASSOC);
                    }
                }

            }
        }
        $stmt = $pdo->query("SELECT nazwa, cena FROM produkty", PDO::FETCH_ASSOC);
        $stmt2 = $pdo->query("SELECT id, nazwa FROM kategorie", PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        echo "Błąd połączenia lub bazy danych: " . $e->getMessage();
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
    <?php if (isset($produkty) && !empty($produkty)): ?>
        
        <?php foreach ($produkty as $row): ?>
            <div class="<?php echo htmlspecialchars($row['nazwa']) ?>">
                <?php echo htmlspecialchars($row['nazwa']) ?>
                <div class="cena_produkt"><?php echo htmlspecialchars($row['cena']). " zł" ?></div>
            </div>
        <?php endforeach; ?>

    <?php elseif (isset($produkty) && empty($produkty)): ?>
        
        <p>Brak produktów w wybranej kategorii.</p>

    <?php else: ?>
        
        <?php foreach ($stmt as $row): ?>
            <div class="<?php echo htmlspecialchars($row['nazwa']) ?>">
                <?php echo htmlspecialchars($row['nazwa']) ?>
                <div class="cena_produkt"><?php echo htmlspecialchars($row['cena']). " zł" ?></div>
            </div>
        <?php endforeach; ?>

    <?php endif; ?>
</div>

        <a href="../koszyk/koszyk.php">
            <div class="koszyk"><i class="fa-solid fa-basket-shopping"></i></div>
        </a>
        <a href="../sprzedaz/sprzedaz.html">
            <div class="sprzedaz"><i class="fa-solid fa-plus"></i></div>
        </a>




       
        <form method ="POST" action="" class="filtry">
            <select name="kategoria" id="kategorie">
                <option value="wszystko">wszystko</option>
                <?php foreach ($stmt2 as $row): ?>
                    <option value="<?php echo htmlspecialchars($row['nazwa']) ?>"><?php echo htmlspecialchars($row['nazwa']) ?></option>
                <?php endforeach; ?>
                    
            </select>
            
            <select name="sortowanie" id="sortowanie">
                <option value="cena_r">Cena: Rosnąco 🢙</option>
                <option value="cena_m">Cena: Malejąco 🢛</option>
                <option value="alfabetycznie_a">Alfabetycznie: (A do Z)</option>
                <option value="alfabetycznie_z">Alfabetycznie: (Z do A)</option>
            </select>

            <button type="submit">WYSZUKAJ</button>
        </form>
        

        <script src="main.js"></script>
    </body>
    </html>
    <?php
}

?>




