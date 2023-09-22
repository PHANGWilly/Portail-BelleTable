<?php
    session_start();
    require './php/bdd.php';
    require './php/function.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/login.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <?php
        
        $email  = $_POST['email'];
        $pass  = $_POST['password'];
        
        $connexion = getBdd();
        
        $requete = "SELECT * FROM user WHERE email_user = '$email' ";
        $resultat = $connexion->query($requete);
        if($resultat->rowCount() > 0){
    
            $user = $resultat->fetch();
            $emailbdd = $user["email_user"];
            $passbdd = $user["mdp_user"];
        
            $passverify = PASSWORD_VERIFY($pass, $passbdd);

            $requete = "SELECT * FROM user WHERE email_user = '" . $email . "' AND mdp_user = '" . $passbdd . "'";
        
            $resultat = $connexion->query($requete);
            if($resultat->rowCount() > 0){
                $user = $resultat->fetch();
                $_SESSION["email_user"] = $user["email_user"];
                $_SESSION["niv"] = $user["niv"];
                if($user["niv"] == 200 || $user["niv"] == 100){
                    ?><script>window.location = "https://www.phangwilly.com/PortailBelleTable/moncompte.php";</script><?php
                }
                else {
                    ?><script>window.location = "https://www.phangwilly.com/PortailBelleTable/seconnecter.php";</script><?php
                }
            }else{
                echo '<div class="alert alert-danger" role="alert"> ! Cette identifiant ou mot de passe nexiste pas! </div>
                <a href="seconnecter.php">Retour à la page de connexion</a>';
            }
        }else{
                echo '<div class="alert alert-danger" role="alert"> @ Cette identifiant ou mot de passe nexiste pas! </div>
                <a href="seconnecter.php">Retour à la page de connexion</a>';
        }
        
        ?>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>