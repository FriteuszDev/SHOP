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

    $stmt = $pdo->prepare("SELECT produkt_id, ilosc FROM koszyk_produkty WHERE koszyk_id = :koszyk_id");
    $stmt->execute(['koszyk_id' => $koszyk_id]);

    $stmt2 = $pdo->prepare("SELECT nazwa, cena FROM produkty WHERE id = :produkt_id");
$stmt->execute(['koszyk_id' => $koszyk_id]);
$wszystkie_produkty = $stmt->fetchAll(PDO::FETCH_ASSOC); 
$produkty_do_html = [];
foreach ($wszystkie_produkty as $koszyk_data) {
    $produkt_id = $koszyk_data['produkt_id'];
    $ilosc = $koszyk_data['ilosc'];

    $stmt2->execute(['produkt_id' => $produkt_id]);
    $produkt = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($produkt) {
        $produkty_do_html[] = [
            'nazwa' => $produkt['nazwa'],
            'cena' => $produkt['cena'],
            'ilosc' => $ilosc,
            'lacznie' => $produkt['cena'] * $ilosc
        ];
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $produkt_do_usuniecia = $_POST['produkt_do_usuniecia'] ?? '';

    if (!empty($produkt_do_usuniecia)){
        $sql = "SELECT id FROM produkty WHERE nazwa = :nazwa_produktu";
        $stmt4 = $pdo->prepare($sql);
        $stmt4->execute(['nazwa_produktu' => $produkt_do_usuniecia]);
        $id_produktu_wiersz = $stmt4->fetch(PDO::FETCH_ASSOC);

        if ($id_produktu_wiersz){
            $id_produktu = $id_produktu_wiersz['id'];
            $sql = "DELETE FROM koszyk_produkty WHERE produkt_id = :id_produktu AND koszyk_id = :koszyk_id";
            $stmt3 = $pdo->prepare($sql);
            $stmt3->execute([
                'id_produktu' => $id_produktu,
                'koszyk_id' => $koszyk_id
            ]);
        }

    }
}

} catch(PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SHOP - Koszyk</title>
    <link rel="stylesheet" href="koszyk.css">
</head>
<body>
    <div class="product-container">

        <?php foreach ($produkty_do_html as $item): ?>
            <div class="<?php echo htmlspecialchars($item['nazwa'], ENT_QUOTES, 'UTF-8'); ?>"> <?php echo htmlspecialchars($item['nazwa'], ENT_QUOTES, 'UTF-8'); ?>
                <div class="cena_ilosc_kontener">
                    <div class="cena"><?php echo $item['cena']; ?> zł</div>
                    <div class="ilosc"><?php echo $item['ilosc']; ?></div>
                </div>
                <div class="cena_razem"><?php echo $item['lacznie']; ?> zł</div>
            </div>
        <?php endforeach; ?>


    </div>
    <script src="koszyk.js"></script>
</body>
</html>

        
<?php
}
?>