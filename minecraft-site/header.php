<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
    <link rel='stylesheet' type='text/css' href='css/styles.css'>
    <link rel='stylesheet' type='text/css' href='css/header.css'>
    <link rel='stylesheet' type='text/css' href='css/top-page.css'>
</head>

<body>
    <header>
        <div class="logbar">
            <?php
            $user = getInformations();

            if (isConnected()) : ?>
                <p class="hello"> <?php echo 'Bonjour et bienvenue ' . $user["pseudo"] ?? "" ?> </p>
            <?php endif; ?>
            <?php if (!isConnected()) : ?>
                <div class="connexion-menu">
                    <div class="connexion-title">
                        <p>Connexion</p>
                    </div>
                    <div class="connexion-content">
                        <?php
                        if (!empty($_POST["pseudo"]) && !empty($_POST["password"])) {
                            $login = login($_POST["pseudo"], $_POST["password"]);
                            if ($login === true) {
                                header("Location: /index.php");
                                die();
                            } else {
                                echo "Email et/ou Mot de passe incorrect";
                            }
                        }
                        ?>
                        <?php if (empty($user['email'])) : ?> <form action="index.php" method="POST">
                                <label for="pseudo">Pseudo</label>
                                <input type="text" id="pseudo" name="pseudo" required>
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" required>
                                <button type="submit">Valider</button>
                            </form>
                        <?php endif; ?>
                        <a class="registration" href="register.php">Vous n'avez pas de compte ?</a>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (isConnected()) : ?>
                <!-- <div class="avatar">
                    <img src="users/avatar/<?php echo $user['avatar'] ?>" width="60">
                </div> -->
                <div class="profil-menu">
                    <div class="profil-title">
                        <p>Profil</p>
                    </div>
                    <div class="profil-content">
                        <a class="profil" href="profil.php#informations">Mon profile</a>
                        <a class="mynews" href="mynews.php">Mes Articles</a>
                        <a class="deconnexion" href="disconnect.php">Se déconnecter</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        </div>
        <div class="top-pagebar">
            <nav class="navbar">
                <a class="index" href="index.php">Accueil</a>
                <a class="news" href="news.php">Articles</a>
                <a class="rules" href="rules.php">Règlement</a>
                <a class="support" href="support.php">Support</a>
            </nav>
        </div>
    </header>