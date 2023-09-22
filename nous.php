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
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <title>BelleTable Paris - Notre histoire</title>
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/nous.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <h1 class="title">Notre histoire</h1> <br>
        <div class="historique">
            Belle Table, fondée en 2016 par Pierre Bartholi et Marc Bartholi, est une jeune entreprise proposant un service de l'art de la table à la française, installée dans la capitale mondiale de la haute couture Paris.<br>
            Notre savoir faire unique nous démarque de toute la concurrence et montre la qualité des services proposé par Belle Table Paris.
        </div>

        <br><br>
        <div class="histoire">
            <p>
                <div class="freres" >
                    <img src="<?php echo $get_perma_link;?>img/freres.jpg" alt="Pierre Bartholi et Marc Bartholi" title="Pierre Bartholi et Marc Bartholi" class="deux-freres">
                    <img src="<?php echo $get_perma_link;?>img/Martine.jpg" alt="Martine Bartholi" title="Martine Bartholi" class="martine"> 
                    <img src="<?php echo $get_perma_link;?>img/Laurence.jpg" alt="Laurence Bartholi" title="Laurence Bartholi" class="laurence">
                </div>
                <div class="freresTetxe">Deux frères (<b>Pierre et Marc Bartholi</b>), passionnés des arts de la table, ont décidé de créer leur société il y a quelques années, en
                    2010. <br>C'est tout naturellement que <b>Martine et Laurence</b> (femmes respectives de Pierre et Marc) rejoignent le projet de leurs maris.
                </div>
            </p>
        </div>
        <br>
        <div class="situation"> 
            <p>C'est au <b>20 rue de la gare à Paris 75010</b> qu'est situé Belle Table Paris.</p>
            <div class="map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14844.020321149046!2d2.3494567459209645!3d48.87581136960179!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66e0cad24b34d%3A0x50b82c368941ae0!2s10e%20Arrondissement%20de%20Paris%2C%2075010%20Paris!5e0!3m2!1sfr!2sfr!4v1609778046686!5m2!1sfr!2sfr" width="400" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
        </div>
    
        <div class="nous">
            <p>La société a démarré avec seulement <b>4 salariés : 2 commerciaux, 1 comptable, 1 préparateur de commandes. </b></p> 
            <p> Après la première année, la société est passée à <b>10 salariés. </b></p> 
            <p><b>6 autres salariés</b> ont rejoint <b>Belle Table Paris</b> l'année suivante. </p>
            <p>Depuis la société compte plus de <b>40 salariés</b> car les bénéfices et commandes ont augmenté. </p>
        </div>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>