<?php
    session_start();

    require 'functions.php';
    
        
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
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>/img/logo_belletable.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/commandes.css">
    <title>BelleTable - Commandes</title>
</head>
<body>
    <?php 
        include_once "navbar.php";
    ?>
    <div class="content">
        <div class="title">
            <h1>Accueil Commandes</h1>
        </div>
        <table class="table__content">
            <thead>
                <tr>
                    <th>REF SRC</th>
                    <th>Date Commande</th>
                    <th>Total HT</th>
                    <th>Total TVA</th>
                    <th>Total TTC</th>
                    <th>ID Client</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>État</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>4261212</td>
                    <td>29 mars 2022 - 9h01</td>
                    <td>177</td>
                    <td>9.75</td>
                    <td>186.5</td>
                    <td>2</td>
                    <td>Dupont</td>
                    <td>Véronique</td>
                    <td class="etat-commande">●</td>
                </tr>
                <tr>
                    <td>4261211</td>
                    <td>29 mars 2022 - 7h54</td>
                    <td>192</td>
                    <td>10.50</td>
                    <td>202.50</td>
                    <td>3</td>
                    <td>Pierre</td>
                    <td>Nathalie</td>
                    <td class="etat-commande">●</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="./js/admin.js"></script>
</body>
</html>