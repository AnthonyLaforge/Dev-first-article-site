<?php session_start();
include 'functions.php';
include_once('header.php');
#Get the 2 lasted news
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} {
    $allArticles = 'SELECT * FROM `articles` ORDER BY id_article DESC LIMIT 2';
    $Articles = $db->prepare($allArticles);
    $Articles->execute([]);
    $everyArticles = $Articles->fetchALL();
}
?>
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
    <link rel='stylesheet' type='text/css' href='css/index.css'>
</head>

<body>
    <div class="index-content">
        <p class='introduction'>Suit toute l'actualité Minecraftienne ! <br>
            Rejoins une communautée soudée <br>
            Partage toutes tes expériences ainsi que tes créations </p>
        <h1> Dernier articles publiés</h1>
        <div class="last-news">
            <?php
            if (!empty($everyArticles)) {
                foreach ($everyArticles as $Articles) { ?>
                    <div class="article">
                        <i class="pseudo">
                            <img src="users/avatar/<?php echo getAvatar($Articles) ?>" width="100">
                            <h2><?php echo $Articles['pseudo']; ?> </h2>
                        </i>
                        <h1><?php echo $Articles['title']; ?> </h1>
                        <p><?php echo $Articles['article']; ?> </p>
                    </div>
                <?php }
            } else {
                ?> <h3> <?php echo 'Aucun article publié'; ?></h3>
            <?php }
            ?>
        </div>
    </div>
    <footer>
        <p>
            <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
        </p>
    </footer>
</body>

</html>