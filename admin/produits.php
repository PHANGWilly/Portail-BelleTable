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
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/produits.css">
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>/img/logo_belletable.ico" type="image/x-icon">
    <title>BelleTable - Produits</title>
</head>
<body>
    <?php 
        $activeProduits = "active";
    
        include_once "navbar.php";
    ?>
    <div class="content">
        <div class="title">
            <h1>Accueil Produits</h1>
        </div>
        <br>
        <div class="new__produit">
            <a href="<?php echo $get_perma_link;?>/nouveau-produit.php" class="link__to">Ajouter un produit</a>
        </div>
        <br>
        <div class="products_grid">
            <?php
            $query = $conn -> prepare('SELECT * FROM produit as p, produit_image as pi WHERE couv = 1 AND p.idp=pi.idp');
            $query -> execute();
            $query_result = $query -> get_result();
            while($row = $query_result->fetch_assoc()){
                ?>
                    <div class="product_template">
                        <a href="#" class="product_link-to">
                            <div class="product_img">
                                <img src="https://www.phangwilly.com/PortailBelleTable/img/uploads/<?=$row['url_image'];?>" alt="<?=$row['description_image'];?>" class="img_product">
                            </div>
                            <div class="product_info">
                                <div class="product_title">
                                    <h3 class="product_title_h3"><?=$row['nomp'];?></h3>
                                </div>
                                
                            </div>
                        </a>
                        <div class="product_details">
                            <a href="<?php echo $get_perma_link;?>/modifier-produit.php?urlp=<?php echo $row["urlp"];?>" class="link__to modifier">Modifier</a> 
                        </div>
                    </div>
                <?php
                    }
                ?>
        </div>
        
    </div>
    <script src="./js/admin.js"></script>
</body>
</html>