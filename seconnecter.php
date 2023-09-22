<?php
    session_start();
    if(isset($_SESSION['email_user'])){
        header('Location: https://www.phangwilly.com/PortailBelleTable/moncompte.php');
    }
    require './php/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/seconnecter.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="form">
            <div class="title">
                <h1>CONNEXION</h1>
            </div>
            <form action="connect.php" method="post">
                <input type="text" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <input type="submit" value="Se connecter" name="seconnecter" required>
            </form>
            <div class="link-to to-inscription">
                <a href="<?php echo $get_perma_link;?>inscription.php">Créer un compte</a>
            </div>
        </div>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>