<?php
    session_start();
    require './php/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable - Nous Contacter</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="Contacter BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/nous-contacter.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include './includes/header.php';
    ?>
    <div class="content">
        <div class="layer-content">
            <div class="title">
                <h1>NOUS CONTACTER</h1>
            </div>
            <div class="form-content">
                <form action="" method="post">
                    <input type="text" name="nom" id="nom" placeholder="Nom">
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                    <input type="tel" name="tel" id="tel" placeholder="Numéro de Téléphone">
                    <input type="email" name="email" id="email" placeholder="Email">
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                    <input type="submit" value="Nous Contacter">
                </form>
            </div>
        </div>
    </div>
    <?php
        include './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>