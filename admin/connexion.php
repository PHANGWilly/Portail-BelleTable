<?php
    session_start();
    $get_perma_link = 'https://www.phangwilly.com/PortailBelleTable/admin'; 
    $get_fs_link = 'https://kit.fontawesome.com/564f9d1433.js';
    function getBdd() {
        $host="127.0.0.1";
        $bdd = "u716507396_PBelleTable";
        $user = "u716507396_APBelleTable";
        $mdp = "APBT-BelleTable.93";
    
        return new PDO("mysql:host=$host;dbname=$bdd;charset=utf8","$user", "$mdp", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Connexion</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>/img/logo_belletable.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>/css/connexion.css">
</head>
<body>
    <div class="content">
        <div class="form">
            <div class="title">
                <h1>ADMIN - CONNEXION</h1>
            </div>
            <form action="" method="post">
                <input type="text" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <input type="submit" value="Se connecter" name="seconnecter" required>
            </form>
            <div class="link-to to-inscription">
                <a href="https://www.phangwilly.com/PortailBelleTable">Retourner à l'accueil</a>
            </div>
        </div>
        <?php
            if(isset($_POST["seconnecter"])){
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
                            ?><script>window.location = "https://www.phangwilly.com/PortailBelleTable/admin/account.php";</script><?php
                        }
                        else {
                            ?><script>window.location = "https://www.phangwilly.com/PortailBelleTable/admin/seconnecter.php";</script><?php
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert"> ! Cette identifiant ou mot de passe nexiste pas! </div>
                        <a href="connexion.php">Retour à la page de connexion</a>';
                    }
                }else{
                        echo '<div class="alert alert-danger" role="alert"> @ Cette identifiant ou mot de passe nexiste pas! </div>
                        <a href="connexion.php">Retour à la page de connexion</a>';
                }
            
            }
            
        ?>
    </div>

</body>
</html>