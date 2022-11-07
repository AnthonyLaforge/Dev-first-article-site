<?php session_start();
include 'functions.php';
$myArticle['id_users'] = [];
$error = "Aucun article trouvé";
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} {
    $allArticles = 'SELECT * FROM `articles` WHERE id_article = :id_article';
    $Articles = $db->prepare($allArticles);
    $Articles->execute([
        'id_article' => $_GET['news'],
    ]);
    $everyArticles = $Articles->fetchALL();
    if (!empty($everyArticles)) {
        foreach ($everyArticles as $myArticle);
    }
}
?>
<!-- Get the last id article -->
<?php
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} {
    $Article = $db->query('SELECT id_article FROM articles ORDER BY id_article DESC LIMIT 1');
    $lastArticle = $Article->fetch();
};
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
    <link rel='stylesheet' type='text/css' href='css/modifynews.css'>
</head>

<body>
    <a class="backtomynews" href="mynews.php">Retour</a>
    <h1> Modification de mon article
    </h1>
    <?php
    if ($myArticle['id_users'] != $_SESSION['user_id'] && $_GET['news'] <= $lastArticle['id_article']) : ?>
        <div class="errors-message">
        <?php echo $error;
    endif; ?>
        <?php if ($_GET['news'] > $lastArticle['id_article']) {
            $articleDontExist = $lastArticle['id_article'];
            header("Location: /modifynews.php?news=$articleDontExist");
        } ?>
        <?php
        if ($myArticle['id_users'] == $_SESSION['user_id'] && $_GET['news'] <= $lastArticle['id_article']) : ?>
            <form action="updatenews.php?news=<?php echo $_GET['news'] ?>" method="POST">
                <input type="text" id="title" name="title" value="<?php echo $myArticle['title'] ?>" required>
                <div class="textarea">
                    <textarea name="textarea" id="textarea" rows="20" cols="60" required><?php echo $myArticle['article'] ?> </textarea>
                </div>
                <input type="submit" value="Modifier">
            </form>
        <?php endif;
        ?>
        </div>
        </form>
        <footer>
            <p>
                <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
            </p>
        </footer>
</body>

</html>