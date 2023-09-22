<?php
    session_start();
    require './php/functions.php';
    
    if(!isset($_SESSION["email_user"])){
        echo "<script>alert('Connectez-vous pour voir afficher votre panier')</script>";
        echo '<script>window.location="https://www.phangwilly.com/PortailBelleTable/seconnecter.php"</script>';

    }
    
    if(isset($_GET["action"])){
        if($_GET["action"] == "delete"){
            foreach($_SESSION["shopping_cart"] as $keys => $values){
                if($values["idp"] == $_GET["idp"]){
                    unset($_SESSION["shopping_cart"][$keys]);
                    echo "<script>alert('L'article a été supprimé' !)</script>";
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - BelleTable</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/panier.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="title">
            <h1>PANIER</h1>
            <br>
        </div>
        
       <?php
      
            if(isset($_POST["add_to_cart"])){
            
                if(isset($_SESSION["shopping_cart"])){
                    
                    $item_array_id = array_column($_SESSION["shopping_cart"], "idp");
                    if(!in_array($_GET["idp"], $item_array_id)){
                        $count = count($_SESSION["shopping_cart"]);
                        $item_array = array(
                            'idp' => $_GET["idp"],
                            'nomp' => $_POST["nomp"],
                            'prix_total' => $_POST["prix_total"],
                            'nbArticle' => $_POST["nbArticle"]
                        );
                        $_SESSION["shopping_cart"][$count] = $item_array;
                    }else{
                        echo '<script>alert("Produit déjà ajouté !")</script>';
                        echo '<script>window.location="https://www.phangwilly.com/PortailBelleTable/produits.php"</script>';
                    }
                    
                    
                }
                else{
                    $item_array = array(
                        'idp' => $_GET["idp"],
                        'nomp' => $_POST["nomp"],
                        'prix_total' => $_POST["prix_total"],
                        'nbArticle' => $_POST["nbArticle"]
                    );
                    
                    $_SESSION["shopping_cart"][0] = $item_array;
                }

            }
       ?>

                <table>
                    <thead>
                        <tr>
                            <th width="40%">Produit</th>
                            <th width="10%">Quantité</th>
                            <th width="10%">Prix</th>
                            <th width="15%">Total</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        
                        if(!empty($_SESSION["shopping_cart"])){
                            $total = 0;
                            foreach($_SESSION["shopping_cart"] as $keys => $values){
                                ?>
                                
                                    <tr>
                                        <td><?php echo $values["nomp"];?></td>
                                        <td><?php echo $values["nbArticle"];?></td>
                                        <td><?php echo $values["prix_total"];?></td>
                                        <td><?php echo number_format($values["nbArticle"] * $values["prix_total"], 2);?></td>
                                        <td title="SUPPRIMER L'ARTICLE" class="action"><a href="https://www.phangwilly.com/PortailBelleTable/panier.php?action=delete&idp=<?php echo $values["idp"];?>" class="link__to delete_item"><span class="fa-solid fa-trash"></span><span>SUPPRIMER</span></a></td>
                                    </tr>
                                
                                <?php
                                
                                $total = $total + ($values["nbArticle"] * $values["prix_total"]);
                            }
                            ?>
                       
                            
                        
                            <tr class="recap">
                                <td class="td_invisible" colspan="3"></td>
                                <td><?php echo number_format($total, 2);?></td>
                                <td title="PAIEMENT" class="action"><a href="#" class="link__to payment" ><span class="fa-solid fa-credit-card"></span><span>PAIEMENT</span></a></td>
                            </tr>
                        </tbody>
                        <?php
                        }
                        
                        ?>
                </table>        
       
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>