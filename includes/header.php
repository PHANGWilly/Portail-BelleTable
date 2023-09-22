<?php
    require './php/functions.php';
?>
<div class="header-sticky-wrapper">
    <div class="header-wrapper header-wrapper--sticky">
        <div class="header-height">
            <div class="site-header">
                <div class="page-width">
                    <div class="header-layout header-layout--center">
                        <div class="header-item header-item--left header-item--navigation">
                            <div class="site-nav">
                                <button class="site-nav__link site-nav__link--icon button-menu" title="Menu">
                                    <img src="<?php echo $get_perma_link;?>img/hamburger-icon.svg" alt="navigation belletable">
                                    <span class="icon__fallback-text">Navigation</span>
                                </button>
                            </div>
                        </div>
                        <div class="header-item header-item--logo">
                            <h1 class="site-header__layout">
                                <a href="<?php echo $get_perma_link;?>index.php" class="site-header__logo-link logo--inverted" title="BelleTable - Accueil">
                                    <img src="<?php echo $get_perma_link;?>img/logo-belletable.svg" alt="logo belletable">
                                    <span class="visually-hidden">BelleTable - Les arts de la table</span>
                                </a>
                            </h1>
                        </div>
                        <div class="header-item header-item--icons">
                            <div class="site-nav">
                                <div class="site-nav__icons">
                                    <a href="<?php echo $get_perma_link;?>seconnecter.php" class="site-nav__link site-nav__link--icon" title="Mon compte BelleTable">
                                        <img src="<?php echo $get_perma_link;?>img/user.svg" alt="mon compte belletable">
                                        <span class="icon__fallback-text">Mon Compte</span>
                                    </a>
                                    <a href="<?php echo $get_perma_link;?>panier.php" class="site-nav__link site-nav__link--icon" title="Panier BelleTable">
                                        <span class="cart-link">
                                            <img src="<?php echo $get_perma_link;?>img/shopping-bag.svg" alt="panier belletable">
                                            <span class="icon__fallback-text">Mon Panier</span>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="drawer drawer--left">
    <div class="drawer__contents">
        <div class="drawer__fixed-header">
            <div class="drawer__header">
                <div class="drawer__title"></div>
                <div class="drawer__close">
                    <button class="drawer__close-button menu-close">
                        <img src="<?php echo $get_perma_link;?>img/close.svg" alt="fermer le menu">
                    </button>
                </div>
            </div>
        </div>
        <div class="drawer__scrollable">
            <ul class="mobile-nav">
                <li class="mobile-nav__item">
                    <a href="<?php echo $get_perma_link;?>index.php" class="mobile-nav__link mobile-nav__link--top-level">
                        ACCUEIL
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="<?php echo $get_perma_link;?>recrutement.php" class="mobile-nav__link mobile-nav__link--top-level">
                        NOUS RECRUTONS
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="<?php echo $get_perma_link;?>produits.php" class="mobile-nav__link mobile-nav__link--top-level">
                        NOS PRODUITS
                    </a>
                </li>
                <li class="mobile-nav__item">
                    <a href="<?php echo $get_perma_link;?>nous-contacter.php" class="mobile-nav__link mobile-nav__link--top-level">
                        NOUS CONTACTER
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
