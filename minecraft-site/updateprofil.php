<?php
session_start();
include 'functions.php';
include 'header.php';
if (!isConnected()) {
    header("Location: /index.php");
    die();
}
$user = getInformations();
$error = "";
if (!empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    if ($_POST['email'] != $user['email'] && isEmailExist($_POST['email'])) {
        $error = "Email déjà utilisé, veuillez insérer une autre adresse mail ";
    } elseif ($_POST['pseudo'] != $user['pseudo'] && isPseudoExist($_POST["pseudo"])) {
        $error = "Pseudo déjà utilisé, veuillez insérer un nouveau Pseudo ";
    } elseif ($_POST["password"] != $_POST["passwordconfirmed"] && ($_POST['password']) != $user['password']) {
        $error = "Veuillez indiquer un mot de passe identique";
    } else {
        try {
            $db = new PDO('mysql:host=localhost:3306;dbname=minecraft_site;charset=utf8', 'root', '',);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'UPDATE users SET pseudo = :pseudo, email = :email, password = :password WHERE id_users = :id_user ';
        $usersStatement = $db->prepare($sqlQuery);
        $usersStatement->execute(
            [
                'pseudo' => $_POST["pseudo"],
                'email' => $_POST["email"],
                'password' => $_POST["password"],
                'id_user' => $_SESSION['user_id']
            ]
        );
        $user = $usersStatement->fetch(PDO::FETCH_ASSOC);
    }
}
$idUser = $_SESSION['user_id'];
if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $FormatValides = array('jpg', 'jpeg', 'gif', 'png');
    if ($_FILES['avatar']['size'] <= $tailleMax) {
        $FormatUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if (in_array($FormatUpload, $FormatValides)) {
            $way = "C:\\laragon\\www\\minecraft-site\\users\\avatar\\" . $_SESSION['user_id'] . "." . $FormatUpload;
            $oldFile_way = "users/avatar/$idUser.*"; #Get the old avatar
            array_map('unlink', glob($oldFile_way)); #Del the old avatar
            $result = move_uploaded_file($_FILES['avatar']['tmp_name'], $way);
            if ($result) {
                $sqlQuery = 'UPDATE users SET avatar = :avatar WHERE id_users = :id_user';
                $updateavatar = $db->prepare($sqlQuery);
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['user_id'] . "." . $FormatUpload,
                    'id_user' => $_SESSION['user_id']
                ));
                $user = $updateavatar->fetch(PDO::FETCH_ASSOC);
                header('Location: updateprofil.php');
            } else {
                $error = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $error = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
        }
    } else {
        $error = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
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
    <link rel='stylesheet' type='text/css' href='css/updateprofil.css'>
</head>

<body>
    <div class="content-profil">
        <h1>Modifier mes informations</h1>
        <div id="informations">
            <form action="updateprofil.php" method="POST" enctype="multipart/form-data">
                <div class="avatar">
                    <?php if (!empty($user['avatar'])) : ?>
                        <img src="users/avatar/<?php echo $user['avatar'] ?>" width="150">
                    <?php endif; ?>
                    <p> Photo de profil </p>
                    <input type="file" name="avatar">
                </div>
                <p>Pseudo</p>
                <input type="pseudo" name="pseudo" value="<?php echo $user['pseudo'] ?? "" ?>">
                <p>Adresse Mail</p>
                <input type="email" name="email" value="<?php echo $user['email'] ?? "" ?>">
                <p>Mot de passe</p>
                <input type="password" name="password" value="<?php echo $user['password'] ?? "" ?>">
                <p>Confirmer Mot de passe</p>
                <input type="password" name="passwordconfirmed" value="<?php echo $user['password'] ?? "" ?>">
                <input type="submit" value="Enregistrer les modifications">
            </form>
            <?php if (!empty($error)) : ?>
                <div class="errors-message">
                    <?php echo $error ?>
                </div>
            <?php endif; ?>
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