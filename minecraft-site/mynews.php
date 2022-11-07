<?php session_start();
include 'functions.php';
include('header.php');

#Know how my new per page
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$newsPerPage = 2;
$newsPosted = $db->query('SELECT id_article FROM articles WHERE id_users = ' . $_SESSION['user_id'] . '');
$newsTotal = $newsPosted->rowCount();
$totalPages = ceil($newsTotal / $newsPerPage);

if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $totalPages) {
    $_GET['page'] = intval($_GET['page']);
    $actualPage = $_GET['page'];
} else {
    $actualPage = 1;
}

$start = ($actualPage - 1) * $newsPerPage;
#Create a new
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
if (!empty($_POST["message"]) && !empty($_POST["title"])) {
    $sqlQuery = 'INSERT INTO articles(pseudo, id_users, title, article) VALUES (:pseudo, :id_users, :title, :article)';
    $insertarticle = $db->prepare($sqlQuery);
    $insertarticle->execute(array(
        "pseudo" => $user["pseudo"],
        "id_users" => $_SESSION["user_id"],
        "title" => $_POST["title"],
        "article" => $_POST["message"],
    ));
    $article = $insertarticle->fetchALL();
    header("Location: /news.php");
    die();
}
#Get my new
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} {
    $myAllArticles = 'SELECT * FROM `articles` WHERE id_users = :id_user ORDER BY id_article DESC LIMIT ' . $start . ',' . $newsPerPage . '';
    $myArticles = $db->prepare($myAllArticles);
    $myArticles->execute(array(
        'id_user' => $_SESSION['user_id']
    ));
    $myEveryArticles = $myArticles->fetchALL();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
    <!-- <link rel='stylesheet' type='text/css' href='css/styles.css'> -->
    <link rel='stylesheet' type='text/css' href='css/header.css'>
    <link rel='stylesheet' type='text/css' href='css/top-page.css'>
    <link rel='stylesheet' type='text/css' href='css/mynews.css'>
</head>

<body>
    <div id="mynews-content">
        <div class="post-news">
            <h1> Postuler un article </h1>
            <form action="mynews.php" method="POST">
                <label for="title">Titre</label>
                <input type="text" id="title" name="title" required>
                <label for="content">Mon Article</label>
                <div class="message">
                    <textarea name="message" rows="20" cols="60" placeholder="Votre message" required></textarea>
                </div>
                <input type="submit" value="Poster">
            </form>
        </div>
        <div class="posted-news">
            <h1>Mes articles</h1>
            <?php
            if (!empty($myEveryArticles)) {
                foreach ($myEveryArticles as $myArticles) { ?>
                    <div class="article">
                        <h1><?php echo $myArticles['title']; ?> </h1>
                        <p><?php echo $myArticles['article']; ?> </p>
                        <?php echo '<a href="modifynews.php?news=' . $myArticles['id_article'] . '"> Modifier </a>'; ?>
                        <?php echo '<a href="deletenews.php?news=' . $myArticles['id_article'] . '"> Supprimer </a>'; ?>
                    </div>
                <?php
                }
            } else {
                ?> <h3> <?php echo 'Aucun article publié'; ?> </h3>
            <?php }
            ?>
            <div id="pagination">
                <?php echo '<a class="previous" href="mynews.php?page=' . ($actualPage - 1) . '#mynews-content"> Précédent </a>';
                for ($i = 1; $i <= $totalPages; $i++)
                    if ($i == $actualPage) {
                        echo '<a class="active" </a>' . $i . ' ';
                    } elseif ($i <= 9) {
                        echo '<a href="mynews.php?page=' . $i . '#mynews-content">' . $i . ' </a> ';
                    }
                echo '<a class="next" href="mynews.php?page=' . ($actualPage + 1) . '#mynews-content"> Suivant </a>';
                ?>
                <form class="choose-page" action="mynews.php#mynews-content" method="GET">
                    <input type="text" id="page" name="page" placeholder="<?php echo $actualPage; ?>" onchange="submit()" required>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>
            <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
        </p>
    </footer>
</body>

</html>