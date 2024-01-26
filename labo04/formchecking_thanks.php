<?php

	$bericht = isset($_GET['message']) ? $_GET['message'] : false;
	$email = isset($_GET['email']) ? $_GET['email'] : false;

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
    <title>Bedankt</title>
</head>
<body>
<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="./">home</a></li>
                <li><a href="./cv">cv</a></li>
                <li><a href="./projecten">projecten</a></li>
                <li><a href="./blogpagina">blogpagina</a></li>
                <li><a href="./contactpagina">contactpagia</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <article class="container">
        <?php

        if ($bericht && $email){
            ?>
            <h1>Bedankt voor contact op te nemen</h1>
            <p>Ik heb uw bericht goed ontvangen, en ik neem zo snel mogelijk contact met u op!</p>
            <div class="bevestiging">
                <p>Dit bericht heb ik ontvangen:</p>
                <?php echo '<p>' .htmlentities($bericht) . '</p>';?>
                <p>Dit is uw E-mail waar ik u kan op bereiken:</p>
                <?php echo '<p>' .htmlentities($email) . '</p>';?>

            </div>
            <?php
        }else{
            ?>
            <h1>Er is iets mis gegaan, probeer het bericht opnieuw te versturen</h1>
            <?php
        }
        ?>
    </article>




</main>

<footer class="container">

    <section >
        <p>&copy;2023 Art Van der Vennet - <a href="www.linkedin.com/in/art-van-der-vennet-8a9944267">linkedin</a> - Hoeksken 74, 9940 Evergem</p>
    </section>

</footer>
</body>
</html>
