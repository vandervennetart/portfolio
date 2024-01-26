<?php

// Constanten (connectie-instellingen databank)
define('DB_HOST', 'localhost');
define('DB_USER', 'ArtVDV');
define('DB_PASS', '@c2171udG');
define('DB_NAME', 'art_vandervennet_contact');


date_default_timezone_set('Europe/Brussels');

// Verbinding maken met de databank
try {
    $db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Verbindingsfout: ' .  $e->getMessage();
    exit;
}

// Opvragen van alle taken uit de tabel tasks
$stmt = $db->prepare('SELECT * FROM messages ORDER BY added_on DESC');
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/@csstools/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,800;1,300;1,500;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../style.css">

    <title>Mijn berichten</title>
</head>

<body>
    <header>
        <div class="container">
            <div class="titel">
                <a href="../../">Art Van der Vennet</a>
            </div>
            <nav>
                <ul>
                    <li><a href="../../">home</a></li>
                    <li><a href="../../cv">cv</a></li>
                    <li><a href="../../projecten">projecten</a></li>
                    <li><a href="../../blogpagina">blog</a></li>
                    <li><a href="../../contactpagina" class="active">contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main class="container">
        <?php if (sizeof($items) > 0) { ?>
            <ul>
                <?php foreach ($items as $item) { ?>
                    <li><?php echo htmlentities($item['sender']); ?>: <?php echo htmlentities($item['message']); ?>; <?php echo htmlentities($item['known_from']) ?> (<?php echo (new Datetime($item['added_on']))->format('d-m-Y H:i:s'); ?>)</li>
                <?php } ?>
            </ul>
        <?php
            } else {
                echo '<p>Nog geen berichten ontvangen.</p>' . PHP_EOL;
            }
        ?>
    </main>

    <footer class="container">
        <section>
            <p>
                &copy;2023 Art Van der Vennet -
                <a rel="noopener" href="https://www.linkedin.com/in/art-van-der-vennet-8a9944267" target="_blank">linkedin</a>
                - Hoeksken 74, 9940 Evergem
            </p>
        </section>
    </footer>




</body>