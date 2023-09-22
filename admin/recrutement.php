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

    
    $email_user = $_SESSION["email_user"];

    $niv = $_SESSION["niv"];


    if($niv < 100){
        header('Location : https://www.phangwilly.com/PortailBelleTable/admin/connexion.php');
    }
    
            setlocale(LC_TIME, 'fr_FR');
        date_default_timezone_set("Europe/Paris");
        

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/recrutement.css">
    <title>BelleTable - Recrutement</title>
        <link rel="shortcut icon" href="<?php echo $get_perma_link;?>/img/logo_belletable.ico" type="image/x-icon">
</head>
<body>
    <?php 
    
        $activeRecrutement = "active";
        
        include_once "navbar.php";
    ?>
    <div class="content">
        <div class="title">
            <h1>Accueil Recrutement</h1>
        </div>
        <br>
        <div class="new__poste">
            <a href="<?php echo $get_perma_link;?>/nouveau-poste.php" class="link__to">Nouveau Poste</a>
        </div>
        <br>
        <br>
        <div class="new__poste">
            <a href="<?php echo $get_perma_link;?>/postes.php" class="link__to">Tous les Postes</a>
        </div>
        <br>
        <div class="table__title">
            <h3>Liste des postulants</h3>
        </div>

        <table class="table__content">
            <thead>
                <tr>
                    <th>ID Poste</th>
                    <th>Titre Poste</th>
                    <th>ID Candidature</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>CV</th>
                    <th>LM</th>
                    <th>Date</th>
                    <th>Spontanée</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $query = $conn -> prepare('SELECT * FROM `candidature` JOIN offre ON candidature.ido = offre.ido');
                    $query -> execute();
                    $query_result = $query -> get_result();
                    
                    while($query_data = $query_result->fetch_assoc()){?>
                       <tr>
                            <td><?php echo $query_data["ido"];?></td>
                            <td><?php echo $query_data["titre"];?></td>
                            <td><?php echo $query_data["idc"];?></td>
                            <td><?php echo $query_data["nomc"];?></td>
                            <td><?php echo $query_data["prenomc"];?></td>
                            <td>
                                <a href="<?php echo $get_perma_link_candidature.$query_data['cvc'];?>">
                                    <img src="<?php echo $get_perma_link;?>/img/download-cv-icon.svg" class="download-icon" alt="">
                                </a>
                            </td>
                            <td>
                                <a href="<?php echo $get_perma_link_candidature.$query_data['lmc'];?>">
                                    <img src="<?php echo $get_perma_link;?>/img/download-lm-icon.svg" class="download-icon" alt="">
                                </a>
                            </td>
                            <td>
                                <?php 
                                        $d = new DateTime($query_data["datec"]);
                                        $date = $d->format('j m Y à H ').'h '.$d->format('i');
                                    echo $date;
                                ?>  
                            </td>
                            <td><?php echo $query_data["spontanee"];?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="./js/admin.js"></script>
</body>
</html>