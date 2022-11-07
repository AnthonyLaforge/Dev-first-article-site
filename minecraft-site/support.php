<?php session_start();
include 'functions.php';
$user = getInformations()
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minecraft WebSite</title>
    <link rel='stylesheet' type='text/css' href='css/header.css'>
    <link rel='stylesheet' type='text/css' href='css/top-page.css'>
    <link rel='stylesheet' type='text/css' href='css/support.css'>
</head>

<body>
    <?php include_once('header.php'); ?>
    <?php if (isConnected()) : ?>
        <div class="formulaire">
            <form method="POST" action="support.php#form">
                <label for="email">Mon adresse mail</label>
                <input type="email" name="email" id="email" value="<?php echo $user['email'] ?>" required readonly>
                <div class="reason">
                    <label for="reason">Raison</label>
                    <input type="text" name="reason" id="reason" required>
                </div>
                <textarea name="message" id="message" cols="150" rows="10" placeholder="Message" required></textarea>
                <input type="submit" name="submit" id="submit" value="Envoyer">
                <input type="reset" name="effacer" id="reset" value="Effacer">
            </form>
        <?php endif; ?>
        <?php if (!isConnected()) : ?>
            <div class="formulaire">
                <form method="POST" action="support.php#form">
                    <label for="email">Mon adresse mail</label>
                    <input type="email" name="email" id="email" required>
                    <div class="reason">
                        <label for="reason">Raison</label>
                        <input type="text" name="reason" id="reason" required>
                    </div>
                    <textarea name="message" id="message" cols="150" rows="10" placeholder="Message" required></textarea>
                    <input type="submit" name="submit" id="submit" value="Envoyer">
                    <input type="reset" name="effacer" id="reset" value="Effacer">
                </form>
            <?php endif; ?>
            <div id="form"></div>
            </div>
            <?php if (isConnected() && isset($_POST['submit'])) : ?>
                <div class="mailmessage">
                    <?php $email = $_POST['email'];
                    $message = $_POST['message']; ?>


                    <?php if (!empty($email) && !empty($message) && (isset($_POST['reason']))) {
                        mail('titigremc@gmail.com', $_POST['reason'], $_POST['message'], 'De:' . $_POST['email']);
                        echo "Merci " . $user['pseudo'] . " votre message a bien été envoyé" . "<br>";
                        echo "Vous recevrez une réponse dans les plus bref délai à l'email suivante : " . $_POST['email'];
                    } else {
                        echo "Merci de remplir tout les champs";
                    } ?>

                <?php endif; ?>
                </div>
                <?php if (!isConnected() && isset($_POST['submit'])) : ?>
                    <div class="mailmessage">
                        <?php $email = $_POST['email'];
                        $message = $_POST['message']; ?>


                        <?php if (!empty($email) && !empty($message) && (isset($_POST['reason'])) && !isEmailExist($email)) {
                            mail('titigremc@gmail.com', $_POST['reason'], $_POST['message'], 'De:' . $_POST['email']);
                            echo "Merci votre message a bien été envoyé" . "<br>";
                            echo "Vous recevrez une réponse dans les plus bref délai à l'email suivante : " . $_POST['email'];
                        } elseif (isEmailExist($email)) {
                            echo "Adresse email déja utilisé, si vous êtes le titulaire du compte, merci de vous connecter";
                        } else {
                            echo "Merci de remplir tout les champs";
                        }
                        ?>
                    <?php endif; ?>
                    </div>
                    <footer>
                        <p>
                            <strong> &copy; 2022 Anthony Laforge - Tous Droit Réservés </strong>
                        </p>
                    </footer>
</body>

</html>