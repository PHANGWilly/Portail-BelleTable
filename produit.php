<?php
    session_start();
        $get_perma_link = 'https://www.phangwilly.com/PortailBelleTable/'; 
        $get_fs_link = 'https://kit.fontawesome.com/564f9d1433.js';

        $conn = mysqli_connect('127.0.0.1', 'u716507396_APBelleTable','APBT-BelleTable.93','u716507396_PBelleTable');
        mysqli_query($conn,"SET NAMES 'utf8'");
        $urlp = $_GET['urlp'];
        $query = $conn -> prepare('SELECT * FROM produit as p JOIN produit_image as pi ON pi.urlp = p.urlp WHERE pi.urlp = ? ORDER BY id_produit_image');
        $query -> bind_param('s',$urlp);
        $query-> execute();
        $query_result = $query -> get_result();
        $query_data = $query_result -> fetch_assoc();
        $conn = mysqli_connect('127.0.0.1', 'u716507396_APBelleTable','APBT-BelleTable.93','u716507396_PBelleTable');
        mysqli_query($conn,"SET NAMES 'utf8'");
        if($query_data['idp'] == null){
            header('Location: https://www.phangwilly.com/PortailBelleTable/produits.php');
        }
        
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris - <?php echo $query_data['nomp'];?></title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/produit.css">
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
        <div class="product_template">
            <div class="product_carousel">
                <div class="img-product owl-carousel " id="img-product_carousel">
                    <?php
                        while($row = $query_result->fetch_assoc()){
                            $descp = $row["descp"];
                            $id = $row["id_produit_image"];
                            ?>
                                <div class="item">
                                    <img src="<?php echo $get_perma_link;?>img/uploads/<?php echo $row["url_image"];?>" alt="<?php echo $descp;?>" title="<?php echo $descp;?>" class="img_product">
                                </div>
                            <?php
                        }
                    ?>
                </div>
            </div>
            <div class="product-info">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                        <li><a href="<?php echo $get_perma_link;?>produits.php">Produits</a></li>    
                    </ul>
                </div>
                <div class="description">
                                    <div class="categorie">
                    <?php
                        $idcategorie = $query_data['categorie'];
                        $query2 = $conn -> prepare('SELECT libelle_categorie FROM produit JOIN produit_categorie ON id_categorie = categorie WHERE categorie = ?');
                        $query2 -> bind_param('s',$idcategorie);
                        $query2 -> execute();
                        $query_result2 = $query2 -> get_result();
                        $query_data2 = $query_result2 -> fetch_assoc();
                        
                        $categorie = $query_data2["libelle_categorie"];
                    ?>
                    <h4><?php echo $categorie?></h4>
                </div>
                <h1 class="product_name"><?php echo $query_data['nomp'];?></h1>
                <div class="product-price">
                    <h4 class="price"><?php echo sprintf ("%.2f", $query_data["prix_total"]);?> €</h4>
                </div> 
                <div class="product_description">
                    <p><?php echo $query_data['descp']; ?></p>
                </div> 
                
                <?php 
                    if(isset($_SESSION["email_user"])){?>
                    
                        <form action="<?php echo $get_perma_link;?>panier.php?action=add&idp=<?php echo $query_data["idp"];?>" method="POST">
                            <div class="quantity-container">
                                <label for="nbArticle" class="lbl_quantity">Quantité</label>
                                <div class="quantity-wrapper">
                                    <input type="button" value="-" data-for="nbArticle" id="sub">
                                    <input type="number" name="nbArticle" id="nbArticle" min="1" value="1" class="quantity">
                                    <input type="button" value="+" data-for="nbArticle" id="add"> 
                                </div>
                                <input type="hidden" name="prix_total" value="<?php echo $query_data["prix_total"];?>">
                                <input type="hidden" name="nomp" value="<?php echo $query_data["nomp"];?>">
        
                            </div> 
                            <input type="submit" value="Ajouter au panier" name="add_to_cart" class="btn__add_to_cart">
        
                        </form>
                        
                    <?php
                    }else{?>
                        
                        <div class="error">
                            Veuillez vous connecter pour ajouter un produit au panier <br>
                            <a href="<?php echo $get_perma_link;?>seconnecter.php" class="link__to ">Se connecter</a>
                        </div>
                        
                    <?php
                        
                    }
                ?>
                
            </div>
            </div>

        </div>
        
        <?php
            $query = $conn -> prepare('SELECT * FROM produit as p, produit_image as pi WHERE couv = 1 AND p.idp=pi.idp');
            $query -> execute();
            $query_result = $query -> get_result();
        ?>
        <div class="all-products">
            <h3 class="all-products_title">VOIR TOUS NOS PRODUITS</h3>
                <div id="products" class="products owl-carousel ">
                    <?php
                        while($row = $query_result->fetch_assoc()){
                    ?>
                        <div class="product">
                            <a href="<?php echo $get_perma_link;?>produits/<?=$row['urlp'];?>" class="link-to_product">
                                <div class="product_img">
                                    <img src="<?php echo $get_perma_link;?>img/uploads/<?=$row['url_image'];?>" alt="<?=$row['descp'];?>" class="all_img_product">
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
                    ?>
                </div>
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
            $("#img-product_carousel").owlCarousel();
        });

        $('#img-product_carousel').owlCarousel({
            width : 300,
            height : 300,
            items : 1,
            lazyLoad:true,
            loop:true,
            margin:10,
            padding : 10,
            responsiveClass:true,
            navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
            center: true,
            dots : true,
            nav : true
        })
    </script>
    <script>
        $(document).ready(function(){
            $("#products").owlCarousel();
        });

        $('#products').owlCarousel({
            lazyLoad:true,
            width : 150,
            height : 150,
            autoWidth : true,
            loop:true,
            margin:10,
            padding:10,
            responsiveClass:true,
            navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
            nav : true,
            responsive : {
                0 :{
                    items : 2,
                    center : true,
                    navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
                    width:50,
                    height : 50
                },
                769:{
                    items : 2,
                    navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
                    width:100,
                    height : 100
                },
                1024:{
                    items : 2,
                    navText : ["<span class='fa-solid fa-circle-chevron-left'></span>","<span class='fa-solid fa-circle-chevron-right'></span>"],
                    width: 150,
                    height : 150
                }
            }
        })
    </script>
</body>
</html>

