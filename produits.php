<?php
    session_start();
    
    require_once './php/functions.php';


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris - Produits</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/produits.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>OwlCarousel/dist/assets/owl.theme.default.min.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="title">
            <h1>TOUS NOS PRODUITS</h1>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                    <li class="active"><a href="">Produits</a></li>
                </ul>
            </div>
            <br>
            
            <br>

            <div class="products_grid">
                <?php
                        if(isset($_GET["categoriser"])){
                            
                            $categorie = $_GET["categorie"];
                            if($categorie == "Catégorie de produit"){
                                echo "<script>alert('Ajouter une categorie disponible')</script>";
                                echo '<script>window.location="https://www.phangwilly.com/PortailBelleTable/produits.php"</script>';
                            }
                            $query = $conn -> prepare('SELECT * FROM produit as p, produit_image as pi WHERE couv = 1 AND p.idp=pi.idp AND p.categorie=?');
                            $query -> bind_param('i',$categorie);
                            $query -> execute();
                            $query_result = $query -> get_result();
                            
                            while($row = $query_result->fetch_assoc()){
                            ?>
                                <div class="product_template">
                                    <a href="<?php echo $get_perma_link;?>produits/<?=$row['urlp'];?>" class="product_link-to">
                                        <div class="product_img">
                                            <img src="<?php echo $get_perma_link;?>img/uploads/<?=$row['url_image'];?>" alt="<?=$row['description_image'];?>" class="img_product">
                                        </div>
                                        <div class="product_info">
                                            <div class="product_title">
                                                <h3 class="product_title_h3"><?=$row['nomp'];?></h3>
                                            </div>
                                            <div class="product_price">
                                                <span class="price"><?=$row['prix_total'];?> €</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                }
                        }else{
                            $query = $conn -> prepare('SELECT * FROM produit as p, produit_image as pi WHERE couv = 1 AND p.idp=pi.idp');
                            $query -> execute();
                            $query_result = $query -> get_result();
                            
                            while($row = $query_result->fetch_assoc()){
                            ?>
                                <div class="product_template">
                                    <a href="<?php echo $get_perma_link;?>produits/<?=$row['urlp'];?>" class="product_link-to">
                                        <div class="product_img">
                                            <img src="<?php echo $get_perma_link;?>img/uploads/<?=$row['url_image'];?>" alt="<?=$row['description_image'];?>" class="img_product">
                                        </div>
                                        <div class="product_info">
                                            <div class="product_title">
                                                <h3 class="product_title_h3"><?=$row['nomp'];?></h3>
                                            </div>
                                            <div class="product_price">
                                                <span class="price"><?=$row['prix_total'];?> €</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                }
                        }
                    
                ?>
            </div>
        </div>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
    <script src="<?php echo $get_perma_link;?>js/quantity.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
    <script src="<?php echo $get_perma_link;?>OwlCarousel/dist/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".owl-carousel").owlCarousel();
        });

        $('.owl-carousel').owlCarousel({
            width : 300,
            height : 300,
            items : 1,
            lazyLoad:true,
            loop:true,
            margin:10,
            responsiveClass:true,
            navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
            center: true,
            dots : true,
            nav : true
        })
    </script>
</body>
</html>
