<?php
    session_start();
    require 'functions.php';
    
    $host="127.0.0.1";
    $bdd = "u716507396_PBelleTable";
    $user = "u716507396_APBelleTable";
    $mdp = "APBT-BelleTable.93";
    $conn = mysqli_connect("$host","$user","$mdp","$bdd");
    mysqli_query($conn,"SET NAMES 'utf8'");

    
    $email_user = $_SESSION["email_user"];

    $niv = $_SESSION["niv"];
    date_default_timezone_set('EUROPE/Paris');


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
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/nouveau-poste.css">
    <title>Nouveau Poste</title>
</head>
<body>
    <?php 
        include_once "navbar.php";
    ?>
    <div class="content">
        <div class="title">
            <h1>Nouveau Poste</h1>
        </div>
        <br>
        
        <?php
            if(isset($_POST["enregistrer"])){
                extract($_POST);
                $query = $conn -> prepare("SELECT MAX(ido) as 'maxIdo' FROM offre");
                $query -> execute();
                $query_result = $query -> get_result();
                $query_data = $query_result -> fetch_assoc();
                $maxIdo = $query_data['maxIdo'];
                $maxIdo = $maxIdo+1;
                $emis = date('Y-m-d H:i:s');
                echo "<br><div class='congrats'>Félicitations vous avez ajouté un poste à BelleTable</div>";
                $query = "INSERT INTO `offre` (ido, titre, description, qualite, experience, type, duree, debut, remuneration, emis, finemis) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt,$query)){
                    echo "<br>Erreur";
                }else{
                    mysqli_stmt_bind_param($stmt,"issssssssii",$maxIdo,$titre, $description, $qualite, $experience, $type, $duree, $debut, $remuneration, $emis, $finemis);
                    mysqli_stmt_execute($stmt);
                }

                
            }
        ?>
        <span>•</span> liste <br>
        <span>< br ></span> saut de ligne 
        <form action="" method="POST">
            
            <label for="titre">Titre</label><br>
            <input type="text" name="titre">
            <br><br>
            <label for="description">Description</label><br>
            <textarea name="description"></textarea>
            <br><br>
            <label for="qualite">Qualités</label><br>   
            <textarea name="qualite"></textarea>
            <br><br>
            <label for="experiences">Expériences</label><br>   
            <textarea name="experience"></textarea>
            <br><br>
            <label for="type">Type de contrat</label><br>
            <input type="text" name="type">
            <br><br>
            <label for="duree">Durée</label><br>
            <input type="text" name="duree">
            <br><br>
            <label for="debut">Début</label><br>
            <input type="text" name="debut">
            <br><br>
            <label for="remuneration">Rémunération</label><br>
            <input type="text" name="remuneration">
            <br><br>
            <label for="finemis">Fin émission</label><br>
            <input type="date" name="finemis" id="">
            <br><br>
            <input type="submit" value="Enregistrer" name="enregistrer">
        </form>
    </div>
</body>
</html>