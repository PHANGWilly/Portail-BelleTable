<?php
    $get_perma_link_admin = "https://www.phangwilly.com/PortailBelleTable/admin/";
    ?>
    <nav class="nav nav-is-open">
         <button class="button-menu user-icon" title="Menu">
             <img src="<?php echo $get_perma_link_admin;?>/img/hamburger-icon.svg" alt="">
         </button>
        <ul>
            <li title="Accueil" <?php if(isset($activeAccueil)){echo "class='$activeAccueil'";}?>> 
                <a href="<?php echo $get_perma_link_admin;?>index.php" class="link-to">
                    <img src="<?php echo $get_perma_link;?>/img/dashboard.svg" alt="" class="user-icon">
                    Acceuil
                </a>
            </li>
            <li title="Produits" <?php if(isset($activeProduits)){echo "class='$activeProduits'";}?>> 
                <a href="<?php echo $get_perma_link_admin;?>produits.php" class="link-to">
                    <img src="<?php echo $get_perma_link;?>/img/icon-belletable.svg" alt="" class="user-icon">
                    Produits
                </a>
            </li>
            <li title="Recrutement" <?php if(isset($activeRecrutement)){echo "class='$activeRecrutement'";}?>> 
                <a href="<?php echo $get_perma_link_admin;?>recrutement.php" class="link-to">
                    <img src="<?php echo $get_perma_link;?>/img/recrutement-icon.svg" alt="" class="user-icon">
                    Recrutement
                </a>
            </li>
            <li title="Mon compte" <?php if(isset($activeAccount)){echo "class='$activeAccount'";}?>>
                <a href="<?php echo $get_perma_link_admin;?>account.php" class="link-to">
                    <img src="<?php echo $get_perma_link;?>/img/user.svg" alt="" class="user-icon">
                    Compte
                </a>
            </li>
            <li title="Se déconnecter" class="deconnexion">
                <a href="<?php echo $get_perma_link_admin;?>deconnexion.php" class="link-to">
                    <img src="<?php echo $get_perma_link;?>/img/log-out-icon.svg" alt="" class="user-icon">
                    Déconnexion
                </a>
            </li>
        </ul>
    </nav>
<?php
?>