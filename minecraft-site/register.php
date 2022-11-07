<?php session_start();
require 'functions.php';
$defaultavatar = 'default.png';
#Insert new user
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if (!empty($_POST["email"])) {
    $sqlQuery = 'INSERT INTO users(pseudo, email, password, is_banned, avatar) VALUES (:pseudo, :email, :password, :is_banned, :avatar)'; 
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <link rel='stylesheet' type='text/css' href='css/register.css'>
</head>

<body>
    <header>
        <div class="logbar">
            <div class="button">
                <nav class="back">
                    <a href="index.php">Retour</a>
                </nav>
            </div>
        </div>
        <div class="top-pagebar">
            <h1 class="inscription">Inscription</h1>
            <div class="registering">
                <form action="register.php" method="POST">
                    <label for="pseudo">Pseudonyme</label>
                    <input type="text" id="pseudo" name="pseudo" placeholder="Titigre" required>
                    <label for="email">Adresse Mail</label>
                    <input type="mail" id="email" name="email" placeholder="exemple@exemple.com" required>
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                    <label for="passwordconfirmed">Confirmer Mot de passe</label>
                    <input type="password" id="password" name="passwordconfirmed" required>
                    <div class="submit">
                        <button type="submit">Confirmer</button>
                    </div>
                </form>
                <div class="errors">

                    <?php
                    // 1 == 1 => OK
                    // "1" == 1 => OK
                    // 1 === 1 => OK
                    // "1" === 1 => NOPE
                    if ($_POST["password"] != $_POST["passwordconfirmed"] && !isEmailExist($_POST["email"])) {
                        echo "Veuillez indiquer un mot de passe identique";
                        session_destroy();
                    } elseif (isEmailExist($_POST["email"]) && $_POST["password"] == $_POST["passwordconfirmed"]) {
                        echo "Email déjà utilisé, veuillez insérer une autre adresse mail";
                    } elseif (isEmailExist($_POST["email"]) && $_POST["password"] != $_POST["passwordconfirmed"]) {
                        echo "Email déjà utilisé, veuillez insérer une autre adresse mail <br> Veuillez indiquer un mot de passe identique";
                    } elseif (isPseudoExist($_POST["pseudo"])) {
                        echo "Pseudo déjà utilisé, veuillez insérer un nouveau Pseudo ";
                    } else {
                        $insertusers = $db->prepare($sqlQuery);
                        $insertusers->execute(array(
                            "pseudo" => $_POST["pseudo"],
                            "email" => $_POST["email"],
                            "password" => $_POST["password"],
                            "is_banned" => 0,
                            "avatar" => $defaultavatar,
                        ));
                        $user = $insertusers->fetchALL();
                        if ($_POST["password"] == $_POST["passwordconfirmed"]) {
                            login($_POST["pseudo"], $_POST["password"]);
                            header("Location: /index.php");
                            die();
                        }
                    }
                    ?>
                </div>
                <p class="information">
                    Vos données sont et resteront strictement personnelles et privées
                </p>
            </div>
    </header>
    <footer>
        <p>
            <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
        </p>
    </footer>
</body>

</html>