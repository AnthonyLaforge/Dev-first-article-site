<?php

function login($pseudo, $password)
{
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM `users` WHERE is_banned = :is_banned AND pseudo =:pseudo AND password = :password';
    $usersStatement = $db->prepare($sqlQuery);
    $usersStatement->execute(
        [
            'pseudo' => $pseudo,
            'password' => $password,
            'is_banned' => 0
        ]
    );
    $user = $usersStatement->fetch(PDO::FETCH_ASSOC);
    if (!empty($user)) {
        $_SESSION['user_id'] = $user['id_users'];
        return true;
    } else {
        return false;
    }
}
function isConnected()
{
    return !empty($_SESSION["user_id"]);
}

function isEmailExist($email)
{
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM `users` WHERE email = :email';
    $emailExistStatement = $db->prepare($sqlQuery);
    $emailExistStatement->execute(
        [
            'email' => $email
        ]
    );
    $emailExist = $emailExistStatement->fetch(PDO::FETCH_ASSOC);
    return !empty($emailExist);

    /*
    // var_dump($registereduser); die();
    if (!empty($emailExist)) {
        //$_POST['email'] = $emailExist['email'];
        return true;
    } else {
        return false;
    }*/
}
function isPseudoExist($pseudo)
{
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM `users` WHERE pseudo = :pseudo';
    $emailExistStatement = $db->prepare($sqlQuery);
    $emailExistStatement->execute(
        [
            'pseudo' => $pseudo
        ]
    );
    $emailExist = $emailExistStatement->fetch(PDO::FETCH_ASSOC);
    return !empty($emailExist);
}
?>

<?php
function getInformations()
{
    if (!empty($_SESSION['user_id'])) {
        try {
            $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'SELECT pseudo, email, password, avatar FROM `users` WHERE id_users = ' . $_SESSION['user_id'] . '';
        $usersStatementPseudo = $db->prepare($sqlQuery);
        $usersStatementPseudo->execute();
        $user = $usersStatementPseudo->fetch(PDO::FETCH_ASSOC);
        if (!empty($user)) {
            return $user;
        } else {
            return [];
        }
    }
}
function getAvatar($Articles)
{
    try {
        $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
    $sqlQuery = 'SELECT * FROM `users` WHERE id_users = :articleUser';
    $usersInformation = $db->prepare($sqlQuery);
    $usersInformation->execute([
        'articleUser' => $Articles['id_users'],
    ]);
    $userInformation = $usersInformation->fetchALL();
    foreach ($userInformation as $Avatar) {
        $avatarUser = $Avatar['avatar'];
    }
    return $avatarUser;
}

// function selectMyNew($userId, $myArticles)
// {
//     try {
//         $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
//     } catch (Exception $e) {
//         die('Erreur : ' . $e->getMessage());
//     }
//     $newsPerPage = 2;
//     $newsPosted = $db->query('SELECT id_article FROM articles WHERE id_users = ' . $userId . '');
//     $newsTotal = $newsPosted->rowCount();
//     $totalPages = ceil($newsTotal / $newsPerPage);

//     if (isset($_GET['page']) and !empty($_GET['page']) and $_GET['page'] > 0 and $_GET['page'] <= $totalPages) {
//         $_GET['page'] = intval($_GET['page']);
//         $actualPage = $_GET['page'];
//     } else {
//         $actualPage = 1;
//     }

//     $start = ($actualPage - 1) * $newsPerPage;
//     try {
//         $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
//     } catch (Exception $e) {
//         die('Erreur : ' . $e->getMessage());
//     } {
//         $myAllArticles = 'SELECT * FROM `articles` WHERE id_users = :id_user ORDER BY id_article DESC LIMIT ' . $start . ',' . $newsPerPage . '';
//         $myArticles = $db->prepare($myAllArticles);
//         $myArticles->execute(array(
//             'id_user' => $userId
//         ));
//         $myEveryArticles = $myArticles->fetchALL();
//         if (!empty($myEveryArticles)) {
//             foreach ($myEveryArticles as $myArticles) {
//                 return $myEveryArticles;
//             }
//         } else {
//             return [];
//         }
//     }
// }
