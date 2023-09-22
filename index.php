<?php
    session_start();
    require './php/functions.php';
    $query = $conn -> prepare('SELECT * FROM slideshow as ss, description_slideshow as descss WHERE showss = 1 AND ss.idss=descss.idss');
    $query -> execute();
    $query_result = $query -> get_result();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <title>BelleTable Paris</title>
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/index.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>OwlCarousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>OwlCarousel/dist/assets/owl.theme.default.min.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content_slideshow">
        <div class="slideshow">
            <div class="carousel owl-carousel" id="sscarousel">
                <?php
                    while($row = $query_result->fetch_assoc()){
                        ?>
                            <div class="image">
                                <div class="image_infos">
                                    <h2 class="h2-title"><?php echo $row["titredesc"];?></h2>
                                    <h4 class="h4-title"><?php echo $row["stitredesc"];?></h4>
                                    <a href="<?php echo $get_perma_link;?><?php echo $row["liendesc"];?>" class="link-to"><?php echo $row["titreliendesc"];?></a>
                                </div>
                                <img src="<?php echo $get_perma_link;?>uploads/slideshow/<?php echo $row["urlss"];?>" alt="<?php echo $row["altss"];?>" class="slideshow_image">
                            </div>
                        <?php
                    }
                ?>
            </div>
        </div>
    </div>
    <div class="content">
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
    <script src="<?php echo $get_perma_link;?>OwlCarousel/dist/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#sscarousel").owlCarousel();
        });

        $('#sscarousel').owlCarousel({
            autoWidth : true, 
            items : 1,
            lazyLoad:true,
            loop:true,
            responsiveClass:true,
            nav:true,
            autoWidth:true,
            navText : ["<span class='fa-solid fa-chevron-left'></span>","<span class='fa-solid fa-chevron-right'></span>"],
            center: true,
            autoplayTimeout:5000,
            autoplay:true
        })
    </script>
</body>
</html>