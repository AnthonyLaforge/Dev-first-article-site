<?php session_start();
include 'functions.php';
if (!empty($_POST["title"]) && !empty($_POST["textarea"])) {
        try {
            $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'UPDATE articles SET title = :title, article = :article WHERE id_article = :id_article';
        $updateArticleStatement = $db->prepare($sqlQuery);
        $updateArticleStatement->execute(
            [
                'title' => $_POST["title"],
                'article' => $_POST["textarea"],
                'id_article' => $_GET['news']
            ]
        );
        $updateArticle = $updateArticleStatement->fetch(PDO::FETCH_ASSOC);
    }
 header("Location: /mynews.php");
?>