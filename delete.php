<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
}
if (isset($_GET['id_gestion']) && (!empty($_GET['id_gestion']))) {
    try {
        $delete = $bdd->prepare('DELETE FROM `gestion` WHERE `id_gestion` = :id_gestion');
        $delete->bindParam(':id_gestion', $_GET['id_gestion']);
        $delete->execute();
    } catch (PDOException $e) {
        echo 'Echec query : ' . $e->getMessage();
    }
    header("Location: index.php");
} else {
    $erreur = 'ID inexistant';
}