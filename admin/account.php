<?php
    session_start();
    
    $get_perma_link = 'https://www.phangwilly.com/PortailBelleTable/admin/'; 
    $get_fs_link = 'https://kit.fontawesome.com/564f9d1433.js';

    $conn = mysqli_connect('127.0.0.1', 'u716507396_APBelleTable','APBT-BelleTable.93','u716507396_PBelleTable');
    mysqli_query($conn,"SET NAMES 'utf8'");
    $niv = ($_SESSION["niv"]);
    
    if(isset($_SESSION['email_user'])){
        $email_user = $_SESSION['email_user'];
        $query = $conn -> prepare('SELECT * FROM user WHERE email_user = ?');
        $query -> bind_param('s',$email_user);
        $query-> execute();
        $query_result = $query -> get_result();
        $query_data = $query_result -> fetch_assoc();
    }

    if($niv < 100){
        header('Location : https://www.phangwilly.com/PortailBelleTable/');
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris - Mon Compte</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/account.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/ajout-employe.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php 
        $activeAccount = "active";

        include_once "navbar.php";

    ?>
    <div class="content">
        <div class="title">MON COMPTE</div>
        
        <div class="hello_msg">Bonjour <?php echo $query_data["prenom_user"];?> <?php echo $query_data["nom_user"];?></div>
        <br>
        <div class="align-center">
            <a href="https://www.phangwilly.com/PortailBelleTable/moncompte.php" class="link__to">Mon compte Belletable</a>
        </div>
        <?php
            if($niv >= 150){
                if(isset($_POST['ajouter'])){
                    extract($_POST);
                    date_default_timezone_set('EUROPE/Paris');
                    $datec = date("Y-m-d H:i:s");
                    
                    $mdphash = password_hash($password, PASSWORD_DEFAULT);
    
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
                        @$checked = " ";
                        echo "<br><div class='congrats'>Félicitations vous avez ajouté un employé à BelleTable</div>";
                        $query = "INSERT INTO `user` (id_user, nom_user, prenom_user, email_user, mdp_user, checked, date_inscription, niv) VALUES (?,?,?,?,?,?,?,?);";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$query)){
                            echo "<br>Erreur";
                        }else{
                            mysqli_stmt_bind_param($stmt,"issssssi",$maxUser,$nom, $prenom, $email, $mdphash, $checked, $datec, $niv);
                            mysqli_stmt_execute($stmt);
                        }
                    }else{
                        echo "<div class='error is_visible'>EMAIL DÉJÀ RENCONTRÉ <br> VEUILLEZ RECOMMANCER</div>";
                    }
                }
                ?>
                <div class="form">
                    <div class="title">
                        <button class="btn__add_employe">
                            <h1>AJOUTER UN.E EMPLOYÉ.E</h1>
                        </button>
                    </div>
                    <form action="" method="post" class="form__ajout_employe not_visible">
                        <input type="text" name="nom" id="nom" placeholder="Nom" required> <br>
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom" required> <br>
                        <input type="text" name="email" id="email" placeholder="Email" required> <br>
                        <input type="password" name="password" id="password" placeholder="Mot de passe" required> <br>
                        <select name="niv" id="niv">
                            <option selected="selected" disabled>Choisir le type d'employé</option>
                            <?php
                                $query = $conn -> prepare("SELECT * FROM niv_user");
                                $query-> execute();
                                $query -> execute();
                                $query_result = $query -> get_result();
                                $query_data = $query_result -> fetch_assoc();
                                while($query_data = $query_result->fetch_assoc()){?>
                                    <option value="<?php echo $query_data['id'];?>"><?php echo $query_data['libelle'];?></option>
                                <?php    
                                }
                            ?>
                            
                        </select>
                        <br>
                        <input type="submit" value="Ajouter" name="ajouter">
                    </form>
                </div>
            <?php
            }
            ?>
    </div>
    <script src="./js/ajout-employe.js"></script>
    <script src="./js/admin.js"></script>
</body>
</html>

