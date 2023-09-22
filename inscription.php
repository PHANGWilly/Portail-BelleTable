<?php
    session_start();
    require './php/functions.php';
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
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/inscription.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <?php
            if(isset($_POST['sinscrire'])){
                extract($_POST);
                date_default_timezone_set('EUROPE/Paris');
                $datec = date("Y-m-d H:i:s");
                
                $mdphash = password_hash($mdp, PASSWORD_DEFAULT);

                $query = $conn -> prepare("SELECT MAX(id_user) as 'maxUser' FROM user");
                $query-> execute();
                $query -> execute();
                $query_result = $query -> get_result();
                $query_data = $query_result -> fetch_assoc();
                $maxUser = $query_data['maxUser'];
                $maxUser = $maxUser+1;

                $query = $conn -> prepare("SELECT * FROM user WHERE email_user = ?");
                $query-> execute();
                $query -> bind_param('s', $email);
                $query -> execute();
                $query_result = $query -> get_result();
                $query_data = $query_result -> fetch_assoc();
                if(@$query_data["email_user"] != $email){
                    echo "<br><div class='congrats'>Félicitations vous êtes inscrit</div>";
                    $niv = 1;
                    $query = "INSERT INTO `user` (id_user, nom_user, prenom_user, email_user, mdp_user, checked, date_inscription, niv) VALUES (?,?,?,?,?,?,?,?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$query)){
                        echo "<br>Erreur";
                    }else{
                        mysqli_stmt_bind_param($stmt,"issssssi",$maxUser,$nom, $prenom, $email, $mdphash, $checked, $datec, $niv);
                        mysqli_stmt_execute($stmt);
                    }
                }else{
                    echo "<div class='error'>EMAIL DÉJÀ RENCONTRÉ <br> VEUILLER RECOMMANCER</div>";
                }
            }
        ?>
        <div class="form">
            <div class="title">
                <h1>CRÉER UN COMPTE</h1>
            </div>
            <form action="" method="post">
                <input type="text" name="nom" id="nom" placeholder="Nom" required>
                <input type="text" name="prenom" id="prenom" placeholder="Prénom" required>
                <input type="text" name="email" id="email" placeholder="Email" required>
                <input type="password" name="password" id="password" placeholder="Mot de passe" required>
                <div class="check">
                    <label for="checked">
                        <input type="checkbox" name="checked" id="checked" required> J'accepte les <a href="<?php echo $get_perma_link;?>cgu.php">CGU</a> et les <a href="<?php echo $get_perma_link;?>cgv.php">CGV</a>
                    </label>
                </div>
                <input type="submit" value="S'inscrire" name="sinscrire">
            </form>
            <div class="link-to to-seconnecter">
                <a href="<?php echo $get_perma_link;?>seconnecter.php">Se connecter</a>
            </div>
        </div>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>