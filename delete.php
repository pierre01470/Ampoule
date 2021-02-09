<?php
// On prolonge la session
session_start();
// On teste si la variable de session existe et contient une valeur
if(empty($_SESSION['username'])) 
{
  // Si inexistante ou nulle, on redirige vers le formulaire de login
  header('Location: index.php');
  exit();
}
?>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
} catch (PDOException $e) {
    echo 'Echec de la connexion : ' . $e->getMessage();
}


        //<!-------------------- PHP DELETE QUERY -------------------->
        if (isset($_GET['id_gestion']) && (!empty($_GET['id_gestion']))) {
            try {
                $delete = $bdd->prepare('DELETE FROM `gestion` WHERE `id_gestion` = :id_gestion');
                $delete->bindParam(':id_gestion', $_GET['id_gestion']);
                $delete->execute();
            } catch (PDOException $e) {
                echo 'Echec query : ' . $e->getMessage();
            }
        }
        header("Location: historic.php");
