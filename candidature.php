<?php
    session_start();
    require_once './php/functions.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BelleTable Paris - Candidature</title>
    <link rel="shortcut icon" href="<?php echo $get_perma_link;?>img/logo_belletable.ico" type="image/x-icon">
    <meta name="description" content="BelleTable - les arts de la table, location, achat de matériaux et salles de fêtes ou mariages">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/main.css">
    <link rel="stylesheet" href="<?php echo $get_perma_link;?>css/candidature.css">
    <script src="<?php echo $get_fs_link;?>"></script>
</head>
<body>
    <?php
        include_once './includes/header.php';
    ?>
    <div class="content">
        <div class="title">
            <h1>Candidature</h1>
        </div>
        <div class="breadcrumbs">
            <ul>
                <li><a href="<?php echo $get_perma_link;?>">Accueil</a></li>
                <li>Candidature</li>
                <?php
                    if(isset($_POST['candidater'])){
                        extract($_POST);?>
                        <li class="active"><?php echo $offre ;?></li>
                    <?php
                    }
                ?>
            </ul>
        </div> 
        <div class="candidature">
            <?php
                if(isset($_POST['candidater'])){
                    //var_dump($_FILES);
                    extract($_POST);
                    //var_dump($_POST);
                    date_default_timezone_set('EUROPE/Paris');
                    $datec = date("Y-m-d H:i:s");
                   
                    $query = $conn -> prepare("SELECT MAX(idc) as 'maxIdc' FROM candidature");
                    $query-> execute();
                    $query_result = $query -> get_result();
                    $query_data = $query_result -> fetch_assoc();
                    $maxIdc = $query_data['maxIdc'];
                    $maxIdc = $maxIdc+1;
                    
                    $null = "";
                    
                    $query = "INSERT INTO `candidature` (idc, nomc, prenomc, emailc, telc, cvc, lmc, infoc, datec, spontanee, ido) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
                    $stmt = mysqli_stmt_init($conn);
                    if(!mysqli_stmt_prepare($stmt,$query)){
                        echo "<br>Erreur query";
                    }else{
                        mysqli_stmt_bind_param($stmt,"issssssssii", $maxIdc, $nom, $prenom, $email, $tel, $null, $null, $infos, $datec, $spontanee, $offre);
                        mysqli_stmt_execute($stmt);
                    }
                   
                    $cvFile = $_FILES['cv'];
                    $cvFileName = $_FILES['cv']['name'];
                    $cvFileTmp = $_FILES['cv']['tmp_name'];
                    $cvFileSize = $_FILES['cv']['size'];
                    $cvFileError = $_FILES['cv']['error'];
                    $cvFileType = $_FILES['cv']['type'];

                    $cvFileExt = explode(".", $cvFileName); //recuperation de l'extension
                    $cvFileActualExt = strtolower(end($cvFileExt)); //recuperation de l'extension du fichier uploadé

                    $allowed = array('jpeg', 'jpg', 'png', 'pdf');

                    if(in_array($cvFileActualExt, $allowed)){
                        if($cvFileError === 0){
                            if($cvFileSize < 1000000){
                                $cvFileNameNew = "cv_".$maxIdc.".".$cvFileActualExt;
                                $cvFileDestination = 'uploads/candidature/'.$cvFileNameNew;
                                move_uploaded_file($cvFileTmp, $cvFileDestination);
                                $query = "UPDATE candidature SET `cvc` = ? WHERE idc = $maxIdc;";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $query)){
                                    echo "ERREUR SQL";
                                }else{
                                    mysqli_stmt_bind_param($stmt, "s", $cvFileNameNew);
                                    mysqli_stmt_execute($stmt);
                                }
                            }else{  
                                echo "<div class='error'>Votre Fichier de CV est trop lourd</div>";
                            }
                        }else{
                            echo "<div class='error'>Une erreur est survenue lors de l'upload de votre fichier de CV</div>";
                        }
                    }else{
                        echo "<div class='error'>Vous devez utiliser des fichiers en jpeg, jpg, png ou pdf pour votre CV</div>";
                    }

                    $lmFile = $_FILES['lm'];
                    $lmFileName = $_FILES['lm']['name'];
                    $lmFileTmp = $_FILES['lm']['tmp_name'];
                    $lmFileSize = $_FILES['lm']['size'];
                    $lmFileError = $_FILES['lm']['error'];
                    $lmFileType = $_FILES['lm']['type'];

                    $lmFileExt = explode(".", $lmFileName); //recuperation de l'extension
                    $lmFileActualExt = strtolower(end($lmFileExt)); //recuperation de l'extension du fichier uploadé

                    $allowed = array('jpeg', 'jpg', 'png', 'pdf');

                    if(in_array($lmFileActualExt, $allowed)){
                        if($lmFileError === 0){
                            if($lmFileSize < 1000000){
                                $lmFileNameNew = "lm_".$maxIdc.".".$lmFileActualExt;
                                $lmFileDestination = 'uploads/candidature/'.$lmFileNameNew;
                                move_uploaded_file($lmFileTmp, $lmFileDestination);
                                $query = "UPDATE candidature SET `lmc` = ? WHERE idc = $maxIdc;";
                                $stmt = mysqli_stmt_init($conn);
                                if(!mysqli_stmt_prepare($stmt, $query)){
                                    echo "ERREUR SQL";
                                }else{
                                    mysqli_stmt_bind_param($stmt, "s", $lmFileNameNew);
                                    mysqli_stmt_execute($stmt);
                                }
                            }else{  
                                echo "<div class='error'>Le fichier de votre lettre de motivation est trop lourd</div>";
                            }
                        }else{
                            echo "<div class='error'>Une erreur est survenue lors du téléchargement de votre fichier de lettre de motivation</div>";
                        }
                    }else{
                        echo "<div class='error'>Vous devez utiliser des fichiers en jpeg, jpg, png ou pdf pour votre lettre de motivation</div>";
                    }
                }else{
                    echo '<script language="Javascript">
                    
                    document.location.replace("https://www.phangwilly.com/PortailBelleTable/recrutement.php");
                    
                    </script>';
                }
            ?>
        </div>
    </div>
    <?php
        include_once './includes/footer.php';
    ?>
    <script src="<?php echo $get_perma_link;?>js/header.js"></script>
</body>
</html>