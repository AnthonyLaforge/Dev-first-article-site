<?php session_start();
include 'functions.php';
#Know how much new per page and how much page
try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
$newsPerPage = 5;
$newsPosted = $db->query('SELECT id_article FROM articles');
$newsTotal = $newsPosted->rowCount();
$totalPages = ceil($newsTotal / $newsPerPage);

if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $totalPages) {
    $_GET['page'] = intval($_GET['page']);
    $actualPage = $_GET['page'];
} else {
    $actualPage = 1;
}
#Get the 1st new from the page
$start = ($actualPage - 1) * $newsPerPage;

try {
    $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
} {
    $allArticles = 'SELECT * FROM `articles` ORDER BY id_article DESC LIMIT ' . $start . ',' . $newsPerPage . '';
    $Articles = $db->prepare($allArticles);
    $Articles->execute([]);
    $everyArticles = $Articles->fetchALL();
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
        <link rel='stylesheet' type='text/css' href='css/news.css'>
    </head>

    <body>
        <?php include_once('header.php'); ?>
        <div id="news-content">
            <div class="news">
                <h1><br></h1>
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
            } ?>
            <div id="pagination">
                <?php echo '<a class="previous" href="news.php?page=' . ($actualPage - 1) . '#news-content"> Précédent </a>';
                for ($i = 1; $i <= $totalPages; $i++)
                    if ($i == $actualPage) {
                        echo '<a class="active" </a>' . $i . ' ';
                    } elseif ($i <= 9) {
                        echo '<a href="news.php?page=' . $i . '#news-content">' . $i . '</a> ';
                    }
                echo '<a class="next" href="news.php?page=' . ($actualPage + 1) . '#news-content"> Suivant </a>';
                ?>
                <form class="choose-page" action="news.php#news-content" method="GET">
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