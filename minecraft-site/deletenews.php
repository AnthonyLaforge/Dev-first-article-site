<?php session_start();
include 'functions.php';
#if my new exist go back mynews
if (isset ($_GET["confirmed"]) && $_GET["confirmed"] == 'yes') {
    header("Location: /mynews.php#mynews-content");
}
#Delete my new
if (isset($_GET["confirmed"])) {
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'DELETE FROM articles WHERE id_users = :id_user AND id_article = :id_article';
    $deleteArticle = $db->prepare($sqlQuery);
    $deleteArticle->execute(array(
        'id_user' => $_SESSION['user_id'],
        'id_article' => $_GET['news'],
    ));
}
#Get my new
$myArticle['id_users'] = [];
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
} ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
    <link rel='stylesheet' type='text/css' href='css/deletenews.css'>
</head>

<body>
    <h1 class="alert"><?php if (isset ($_GET["confirmed"]) && $_GET['confirmed'] == 'no') {
                            echo 'Une erreur est survenue en essayant de supprimer l\'article <br>';
                            echo 'L\'article n\'existe pas ou ne vous appartient peut-être pas, si ce n\'est pas le cas <br> veuillez contacter un administrateur';
                            echo '<a href="mynews.php#mynews-content"> Retour </a>';
                        } ?>
        <?php if (!isset($_GET["confirmed"])) :?>
            Voulez-vous vraiment supprimer cet article ? <br>
            <?php if ($myArticle['id_users'] == $_SESSION['user_id']) : ?>
                <form action="updatenews.php?news=<?php echo $_GET['news'] ?>" method="POST">
                    <input type="text" id="title" name="title" value="<?php echo $myArticle['title'] ?>" required readonly>
                    <div class="textarea">
                        <textarea name="textarea" id="textarea" rows="20" cols="60" required readonly><?php echo $myArticle['article'] ?> </textarea>
                    </div>
                </form> <?php endif; ?>
            <?php if ($myArticle['id_users'] == $_SESSION['user_id']) echo '<a href="deletenews.php?news=' . $_GET['news'] .'&confirmed=yes"> Confirmer </a>'; ?>
            <?php if ($myArticle['id_users'] != $_SESSION['user_id']) echo '<a href="deletenews.php?news=' . $_GET['news'] .'&confirmed=no"> Confirmer </a>'; ?>
        <?php echo '<a href="mynews.php#mynews-content"> Annuler </a>';
        endif; ?>
    </h1>
    <footer>
        <p>
            <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
        </p>
    </footer>
</body>

</html>