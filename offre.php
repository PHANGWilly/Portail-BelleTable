<?php
    session_start();
    require './php/functions.php';


    $host="127.0.0.1";
    $bdd = "u716507396_PBelleTable";
    $user = "u716507396_APBelleTable";
    $mdp = "APBT-BelleTable.93";
    $conn = mysqli_connect("$host","$user","$mdp","$bdd");
    mysqli_query($conn,"SET NAMES 'utf8'");

    if(!$_GET["ido"]){
        header('Location:recrutement.php');
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris - Offre - </title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/offre.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="title">
            <h1>Offre</h1>
        </div>
        <?php
        if(isset($_GET['ido'])){
            if($_GET['ido'] == "spontanee"){?>
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                        <li><a href="<?php echo $get_perma_link;?>recrutement.php">Recrutement</a></li>
                        <li class="active">Offre Spontanée</li>
                    </ul>
                </div>    
                <form action="candidature.php" method="POST" enctype="multipart/form-data">
                    <div class="data">
                        <input type="text" name="nom" id="nom" placeholder="Nom">
                    </div>
                    <div class="data">
                        <input type="text" name="prenom" id="prenom" placeholder="Prénom">
                    </div>
                    <div class="data">
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div class="data">
                        <input type="tel" name="tel" id="tel" placeholder="tel">
                    </div>
                    <div class="data">
                        <select name="offre" id="offre">
                            <option disabled selected="selected">Poste à pourvoir</option>
                            <?php
                            $query = $conn -> prepare('SELECT ido, titre FROM offre');
                            $query -> execute();
                            $query_result = $query -> get_result();
                            while($row = $query_result->fetch_assoc()){?>
                                <option value="<?php echo $row['ido'];?>"><?php echo $row['titre'];?></option>
                            <?php
                            }
                            ?>
                        </select>
                        <input type="hidden" name="spontanee" id="spontanee" value="1">
                    </div>
                    <div class="data data-file">
                        <span>CV</span> <input type="file" name="cv" id="cv">
                    </div>
                    <div class="data data-file">
                        <span>LM</span> <input type="file" name="lm" id="lm">
                    </div>
                    <div class="data">
                        <textarea name="infos" id="infos" placeholder="Informations complémentaires"></textarea>
                    </div>
                    <input type="submit" value="Candidater" name="candidater">
                </form>
            <?php
            }else{?>
            <div class="breadcrumbs">
                <ul>
                    <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                    <li><a href="<?php echo $get_perma_link;?>recrutement.php">Recrutement</a></li>
                    <li class="active">
                        <?php 
                            $ido = $_GET['ido'];
                            $query = $conn -> prepare('SELECT * FROM offre WHERE ido = ?');
                            $query -> bind_param('s', $ido);
                            $query -> execute();
                            $query_result = $query -> get_result();
                            $query_data = $query_result -> fetch_assoc();
                            echo $query_data['titre'];
                        ?>
                    </li>
                </ul>
            </div>

            <form action="candidature.php" method="POST" enctype="multipart/form-data">
                <div class="data">
                    <input type="text" name="nom" id="nom" placeholder="Nom" value="">
                </div>
                <div class="data">
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" value="">
                </div>
                <div class="data">
                    <input type="email" name="email" id="email" placeholder="Email" value="">
                </div>
                <div class="data">
                    <input type="tel" name="tel" id="tel" placeholder="tel" value="">
                </div>
                <div class="data">
                    <input type="text" name="poste" id="poste" placeholder="<?php echo $query_data['titre'];?>" value="<?php echo $query_data['titre'];?>" readonly class="offre">          
                    <input type="hidden" name="offre" id="offre" value="<?php echo $query_data['ido'];?>">    
                    <input type="hidden" name="spontanee" id="spontanee" value="0">      
                </div>
                <div class="data data-file">
                    <span>CV</span> <input type="file" name="cv" id="cv">
                </div>
                <div class="data data-file">
                    <span>LM</span> <input type="file" name="lm" id="lm">
                </div>
                <div class="data">
                    <textarea name="infos" id="infos" placeholder="Informations complémentaires"></textarea>
                </div>
                <input type="submit" value="Candidater" name="candidater">
            </form><?php
            }
        }?>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>