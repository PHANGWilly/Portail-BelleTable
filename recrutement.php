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
    <title>BelleTable Paris</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/recrutement.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="title">
            <h1>Recrutement</h1>
        </div>
        <div class="breadcrumbs">
            <ul>
                <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                <li class="active">Recrutement</li>
            </ul>
        </div>
        <div class="nb-offre">
            <h3 class="h3 h3-colored">
                <?php 
                $query = $conn -> prepare('SELECT COUNT(ido) AS `ido` FROM offre');
                $query -> execute();
                $query_result = $query -> get_result();
                
                while($query_data = $query_result->fetch_assoc()){
                    echo "Il y a ".$query_data["ido"]." offre.s d'emploi disponible.s";
                }
                ?>
            </h3>
        </div>
        <?php
            $query = $conn -> prepare('SELECT * FROM offre ORDER BY ido');
            $query -> execute();
            $query_result = $query -> get_result();
            setlocale(LC_TIME, 'fr');
            date_default_timezone_set('Europe/Paris');
            while($row = $query_result->fetch_assoc()){
            ?>
            <div class="offre">
                <h3 class="h3 h3-offre">
                    <span class="le-titre-offre"><?=$row['titre'];?></span>
                </h3>
                <div class="btn-to-postuler">
                    <a href="<?php echo $get_perma_link;?>offre.php?ido=<?=$row['ido'];?>"><span class="fa-solid fa-envelope enveloppe"></span>postuler</a>
                </div>
            </div>
            <div class="offrepanel">
                <div class="description-offre">
                    <span class="titre">Vos missions</span>
                    <?=$row['description'];?>
                </div>
                <div class="qualite">
                    <span class="titre">Vos Qualités</span>
                    <?=$row['qualite'];?>
                </div>
                <div class="experience">
                    <span class="titre">Expériences</span>
                    <?=$row['experience'];?>
                </div>
                <div class="type-contrat">
                    <span class="titre">Contrat</span>
                    <?=$row['type'];?>
                </div>
                <div class="duree-contrat">
                    <span class="titre">Durée</span>
                    <?=$row['duree'];?>
                </div>
                <div class="debut">
                    <span class="titre">Début</span>
                    <?=$row['debut'];?>
                </div>
                <div class="remuneration">
                    <span class="titre">Rémunération</span>
                    <?=$row['remuneration'];?>
                </div>
                <div class="emis">
                    <span class="titre">Émis le</span>
                    <?= utf8_encode(strftime("%A %d %B %Y",strtotime($row['emis'])));?>
                </div>
                <div class="fin">
                    <span class="titre">Jusqu'au</span>
                    <?= utf8_encode(strftime("%A %d %B %Y",strtotime($row['finemis'])));?>
                </div>
            </div>
        <?php
        }
        ?>
    <div class="candidature-spontanee">
        <h3 class="h3 h3-colored h3-candidature-spontanee">Candidature spontanée</h3>
        <div class="description-candidature-spontanee">
            Vous souhaitez rejoindre notre équipe ? <br>
            N’hésitez pas à déposer vos candidatures spontanées, demandes de stage ou d’apprentissage. <br>
            Remplissez notre formulaire, joignez votre CV et votre lettre de motivation, nous étudierons votre candidature. <br>
        </div>
            <a href="<?php echo $get_perma_link;?>offre.php?ido=spontanee"><span class="fa-solid fa-envelope enveloppe"></span>postuler</a>
    </div> 
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
    <script>
        var acc = document.getElementsByClassName("offre");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var offrepanel = this.nextElementSibling;
                if (offrepanel.style.display === "block") {
                    offrepanel.style.display = "none";
                } else {
                    offrepanel.style.display = "block";
                    offrepanel.style.borderBottom = "1px solid black";
                }
            });
        }
</script>
</body>
</html>