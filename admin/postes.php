<?php
    session_start();
    $get_perma_link_candidature = "https://Www.phangwilly.com/PortailBelleTable/uploads/candidature/";
        require 'functions.php';
    
    $host="127.0.0.1";
    $bdd = "u716507396_PBelleTable";
    $user = "u716507396_APBelleTable";
    $mdp = "APBT-BelleTable.93";
    $conn = mysqli_connect("$host","$user","$mdp","$bdd");
    mysqli_query($conn,"SET NAMES 'utf8'");

    $get_perma_link = "https://Www.phangwilly.com/PortailBelleTable/admin/";
    
    $email_user = $_SESSION["email_user"];

    $niv = $_SESSION["niv"];

    if($niv < 100){
        header('Location : https://www.phangwilly.com/PortailBelleTable/admin/connexion.php');
    }
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
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/postes.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php 
        include_once "navbar.php";
    ?>
    <div class="content">
        <div class="title">
            <h1>Recrutement</h1>
        </div>

        <div class="content_postes">
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
                    <span class="le-titre-offre"><?=$row['ido'];?> - <?=$row['titre'];?></span>
                </h3>
                <div class="btn-to-modifier">
                    <a href="#<?=$row['ido'];?>"><span class="fa-solid fa-pen"></span><span class="txt-modifier">Modifier</span></a>
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
        </div>
        
    </div>
    <script src="./js/admin.js"></script>
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