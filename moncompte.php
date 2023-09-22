<?php
    session_start();

    $get_perma_link = 'https://www.phangwilly.com/PortailBelleTable/'; 
    $get_fs_link = 'https://kit.fontawesome.com/564f9d1433.js';

    $conn = mysqli_connect('127.0.0.1', 'u716507396_APBelleTable','APBT-BelleTable.93','u716507396_PBelleTable');
    mysqli_query($conn,"SET NAMES 'utf8'");
    
    if(isset($_SESSION['email_user'])){
        $email_user = $_SESSION['email_user'];
        $query = $conn -> prepare('SELECT * FROM user WHERE email_user = ?');
        $query -> bind_param('s',$email_user);
        $query-> execute();
        $query_result = $query -> get_result();
        $query_data = $query_result -> fetch_assoc();
    }
        
    
    if(!isset($_SESSION['email_user'])){
        echo "<a href='https://www.phangwilly.com/PortailBelleTable/seconnecter.php'>Veuillez vous connecter</a>";
        echo "<br><br>";
        echo "<a href='https://www.phangwilly.com/PortailBelleTable/'>Aller à l'accueil r</a>";
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
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/moncompte.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <?php
            echo "<h1>Bonjour ".$query_data["nom_user"]." ".$query_data["prenom_user"]."</h1>" ;
        ?>
        <br>
        <br>
        <div class="informations">
            <button class="btn modify">Modifier mon compte</button>
            <br><br>
            <?php 
                $id_user = $query_data["id_user"];
                if(isset($_POST['modifier'])){
                    extract($_POST);
                    $mdphash = password_hash($password, PASSWORD_DEFAULT);
                    if($password == ""){
                        echo "<br>Mot de passe requis";
                    }else{
                        echo "<br><div class='congrats'>Félicitations vous avez modifié votre compte BelleTable</div>";
                        $query = "UPDATE user SET nom_user=?, prenom_user=?, email_user=?, mdp_user=? WHERE id_user=?";
                        $stmt = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt,$query)){
                            echo "<br>Erreur";
                        }else{
                            mysqli_stmt_bind_param($stmt,'ssssi', $nom, $prenom, $email, $mdphash, $id_user);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                    
                }
            ?>
            <form action="" method="post" class="form notVisible"  >
                <label for="nom">Nom</label><br>
                <input type="text" name="nom" id="nom" value="<?php echo $query_data["nom_user"]?>"><br><br>
                <label for="prenom">Prénom</label><br>
                <input type="text" name="prenom" id="prenom" value="<?php echo $query_data["prenom_user"]?>"><br><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="<?php echo $query_data["email_user"]?>"><br><br>
                <label for="password">Mot de passe</label><br>
                <input type="password" name="password" id="password" placeholder="Mot de passe que vous avez défini"><br><br>
                
                <input type="submit" value="Modifier" name="modifier">
            </form>
        </div>  
        <br>
        <br>
        <?php
            if($query_data['niv'] >= 100){
                echo "<br><a href='https://www.phangwilly.com/PortailBelleTable/admin/' class='link__to'>Admin</a>";
            }
             echo "<br><br><a href='https://www.phangwilly.com/PortailBelleTable/' class='link__to'>Accueil</a><br>";
            echo "<br><a href='https://www.phangwilly.com/PortailBelleTable/sedeconnecter.php' class='link__to'>Se déconnecter</a>";
           
        ?>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
    <script src="<?php echo $get_perma_link;?>js/moncompte.js"></script>

</body>
</html>

