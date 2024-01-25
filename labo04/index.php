<?php

// Show all errors (for educational purposes)
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

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
    echo 'Verbindingsfout: ' . $e->getMessage();
    exit;
}

$email = isset($_POST['email']) ? (string)$_POST['email'] : '';
$message = isset($_POST['message']) ? (string)$_POST['message'] : '';
$msgEmail = '';
$msgMessage = '';

// form is sent: perform formchecking!
if (isset($_POST['btnSubmit'])) {

    $allOk = true;

    // name not empty
    if (trim($email) === '') {
        $msgEmail = 'Gelieve een e-mail adres in te voeren';
        $allOk = false;
    }

    if (trim($message) === '') {
        $msgMessage = 'Gelieve een boodschap in te voeren';
        $allOk = false;
    }

    // end of form check. If $allOk still is true, then the form was sent in correctly
    if ($allOk) {
        // build & execute prepared statement
        $stmt = $db->prepare('INSERT INTO messages (sender, message, added_on) VALUES (?, ?, ?)');
        $stmt->execute(array($email, $message, (new DateTime())->format('Y-m-d H:i:s')));

        // the query succeeded, redirect to this very same page
        if ($db->lastInsertId() !== 0) {
            header('Location: formchecking_thanks.php?email=' . urlencode($email) ."&message=". urlencode($message));
            exit();
        } // the query failed
        else {
            echo 'Databankfout.';
            exit;
        }

    }

}

?><!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/@csstools/normalize.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;0,800;1,300;1,500;1,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Contact</title>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="veilig">home</a></li>
                <li><a href="./cv">cv</a></li>
                <li><a href="./projects">projects</a></li>
                <li><a href="./blogpagina">blogpagina</a></li>
                <li><a href="./contactpagina">contactpagia</a></li>
            </ul>
        </nav>
    </div>
</header>
<main class="container">

    <h1>Contacteer mij</h1>

    <div class="contact">
        <ul>

            <li>
                <h2>Adres</h2>
                <p>Hoeksken 74, 9940 Evergem, België</p>
                <iframe aria-label="kaart" title="kaart" class="kaart" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2504.8569638864433!2d3.7013054760208397!3d51.111099171725975!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c37085fd32190f%3A0x3b60d198878014e6!2sHoeksken%2074%2C%209940%20Evergem!5e0!3m2!1snl!2sbe!4v1702914016861!5m2!1snl!2sbe"  style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </li>
            <li>
                <h2>Telefoonnummer</h2>
                <p>+32 0479 20 65 26</p>
            </li>
            <li>
                <h2>Email</h2>
                <p>art.van.der.vennet.be@gmail.com</p>
            </li>

        </ul>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <div>
                <label for="message">Boodschap</label>
                <textarea name="message" id="message" rows="5" cols="40"><?php echo htmlentities($message); ?></textarea>
                <span class="message error"><?php echo $msgMessage; ?></span>
            </div>
            <div>
                <label for="email">Jouw Email Adres</label>
                <input type="email" id="email" name="email" value="<?php echo htmlentities($email); ?>" class="input-text"/>
                <span class="message error"><?php echo $msgEmail; ?></span>
            </div>



            <input type="submit" id="btnSubmit" name="btnSubmit" class="submit" value="Verstuur"/>
        </form>
    </div>

</main>

<footer class="container">

    <section >
        <p>&copy;2023 Art Van der Vennet - <a href="www.linkedin.com/in/art-van-der-vennet-8a9944267">linkedin</a> - Hoeksken 74, 9940 Evergem</p>
    </section>

</footer>

</body>
</html>
