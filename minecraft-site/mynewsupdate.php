<?php session_start();
include 'functions.php'; ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
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
            <h1>Modifier mon article</h1>
                <form class="modify-article" action="mynewsupdate.php" method="POST">
                    <input type="text" id="page" name="page" placeholder="<?php echo $actualPage; ?>" required>
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