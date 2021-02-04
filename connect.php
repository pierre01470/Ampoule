<?php
try{$bdd = new PDO('mysql:host=localhost;dbname=ampoule','root');
}
catch(PDOException $e){
    echo 'Echec de la connexion : ' .$e->getMessage();
}
?>