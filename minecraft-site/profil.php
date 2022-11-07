<?php session_start();
include 'functions.php';
include('header.php');

$user = getInformations();
// if ($user['avatar'] == '') {
//     try {
//         $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
//     } catch (Exception $e) {
//         die('Erreur : ' . $e->getMessage());
//     }
//     $updateavatar = $db->prepare('UPDATE users SET avatar = :avatar WHERE id_users = :id_user');
//     $updateavatar->execute(array(
//         'avatar' =>  '0.png',
//         'id_user' => $_SESSION['user_id']
//     ));
//     $user = $updateavatar->fetch(PDO::FETCH_ASSOC);
// };


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
    <link rel='stylesheet' type='text/css' href='css/profil.css'>
</head>
<body>
    <div class="content-profil">
        <h1>Mes informations</h1>
        <div id="informations">
            <form action="updateprofil.php#informations" method="POST">
                <div class="avatar"><img src="users/avatar/<?php echo $user['avatar'] ?>" width="150">
                    <p> Photo de profil </p>
                </div>
                <p>Pseudo</p>
                <input type="pseudo" name="pseudo" value="<?php echo $user['pseudo'] ?? "" ?>" readonly>
                <p>Adresse Mail</p>
                <input type="email" name="email" value="<?php echo $user['email'] ?? "" ?>" readonly>
                <p>Mot de passe</p>
                <input type="password" name="paswword" value="<?php echo $user['password'] ?? "" ?>" readonly>
                <input type="submit" value="Modifier mes informations">
            </form>
        </div>
        <div class="avatar"></div>
    </div>
    <div class="footer">
        <footer>
            <p>
                <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
            </p>
        </footer>
    </div>
</body>

</html>