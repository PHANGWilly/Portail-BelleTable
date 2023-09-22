<?php
    function getBdd() {
        $host="127.0.0.1";
        $bdd = "u716507396_PBelleTable";
        $user = "u716507396_APBelleTable";
        $mdp = "APBT-BelleTable.93";
    
        return new PDO("mysql:host=$host;dbname=$bdd;charset=utf8","$user", "$mdp", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

?>