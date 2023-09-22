<?php
    session_start();
    
    $get_perma_link = "https://www.phangwilly.com/PortailBelleTable/admin";
    
    require 'functions.php';
    
    $conn = mysqli_connect('127.0.0.1', 'u716507396_APBelleTable','APBT-BelleTable.93','u716507396_PBelleTable');
    mysqli_query($conn,"SET NAMES 'utf8'");
    $niv = ($_SESSION["niv"]);
    $email_user = ($_SESSION["email_user"]);

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
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/index.css">
    <title>BelleTable - Admin</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>/img/logo_belletable.ico" type="image/x-icon">
</head>
<body>
    
    <?php 
            $activeAccueil = "active";
    
        include_once "navbar.php";
    ?>
    <div class="content">
  
        <div class="title">
            <h1>Accueil Admin</h1>
        </div>
        <br>
        <br>
        <div class="back">
            <a href="https://www.phangwilly.com/PortailBelleTable/" class="link__to">Retourner sur BelleTable</a>
        </div>
        <br>
        <br>
        <div class="nb__content">
            <div class="nb__connexion padding-trbl trsf-scale"> 
                <h4 class="nb__connexion-nb fs-h4-nb">0</h4>
                <div class="nb__connexion-content">
                    connexion(s) ajourd'hui.
                </div>
            </div>
            <div class="nb__commande padding-trbl trsf-scale"> 
                <h4 class="nb__commande-nb fs-h4-nb">0</h4>
                <div class="nb__commande-content">
                    commande(s) ajourd'hui.
                </div>
            </div>
            <div class="nb__post-today padding-trbl trsf-scale">
                <?php
                    $dtoday = new DateTime();
                    $dtoday = $dtoday->format('Y-m-d H:i:s');
                    $query = $conn -> prepare("SELECT COUNT(ido) as ido FROM offre WHERE finemis >= '$dtoday'");
                    $query -> execute();
                    $query_result = $query -> get_result();
                ?>
                <h4 class="nb__post-nb fs-h4-nb"><?php foreach($query_result as $result): echo $result["ido"]; endforeach;?></h4>
                <div class="nb__cv-content">
                    Poste(s) à pourvoir ajourd'hui.
                </div>
            </div>
            <div class="nb__post-total padding-trbl trsf-scale"> 
                <?php
                    $query = $conn -> prepare('SELECT COUNT(ido) as ido FROM offre');
                    $query -> execute();
                    $query_result = $query -> get_result();
                ?>
                <h4 class="nb__post-nb fs-h4-nb"><?php foreach($query_result as $result): echo $result["ido"]; endforeach;?></h4>
                <div class="nb__cv-content">
                    Posts à pourvoir crées.
                </div>
            </div>
            <div class="nb__cv padding-trbl trsf-scale">
                <?php
                    $dtoday = new DateTime();
                    $dtoday = $dtoday->format('Y-m-d');
                    $query = $conn -> prepare("SELECT COUNT(idc) as idc FROM candidature WHERE datec LIKE '%$dtoday%'");
                    $query -> execute();
                    $query_result = $query -> get_result();
                ?>
                <h4 class="nb__cv-nb fs-h4-nb"><?php foreach($query_result as $result): echo $result["idc"]; endforeach;?></h4>
                <div class="nb__cv-content">
                    CV(s) ajourd'hui.
                </div>
            </div>
            <div class="nb__cv_total padding-trbl trsf-scale">
                <?php
                    $query = $conn -> prepare('SELECT COUNT(idc) as idc FROM candidature');
                    $query -> execute();
                    $query_result = $query -> get_result();
                ?>
                <h4 class="nb__cv-nb fs-h4-nb"><?php foreach($query_result as $result): echo $result["idc"]; endforeach;?></h4>
                <div class="nb__cv-content">
                    CV(s) au Total.
                </div>
            </div>
        
        </div>
    </div>
    <script src="./js/admin.js"></script>
</body>
</html>