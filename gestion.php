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
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
</head>

<body>

    <!-------------------- HEADER -------------------->
    <header>
        <div>
            <ul>
                <li><a href="historic.php">Historique</a></li>
                <li><a href="gestion.php">Gestion</a></li>
            </ul>
            <a href="index.php?logout=true" class="logout"><img src="../Ampoule/media/off.png" alt=""></a>
        </div>
    </header>

    <!-------------------- FORMULAIRE -------------------->
    <main>
        <div class="form">
            <form class="formresp" action="" method="post">
                <input type="date" name="date_change">
                <select name="floor" id="">
                    <option value="0">Rez-de-chaussée</option>
                    <option value="1">Etage 1</option>
                    <option value="2">Etage 2</option>
                    <option value="3">Etage 3</option>
                    <option value="4">Etage 4</option>
                    <option value="5">Etage 5</option>
                    <option value="6">Etage 6</option>
                    <option value="7">Etage 7</option>
                    <option value="8">Etage 8</option>
                    <option value="9">Etage 9</option>
                    <option value="10">Etage 10</option>
                    <option value="11">Etage 11</option>
                </select>
                <select name="position" id="">
                    <option value="gauche">Côté gauche</option>
                    <option value="droit">Côté droit</option>
                    <option value="Fond">Fond</option>
                </select>
                <input type="text" name="price" placeholder="Prix">€
                <input type="submit" value="Ajouter" name="submit">
            </form>
        </div>

        <!-------------------- PHP QUERY INSERT-------------------->
        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
        } catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
        }

        if (isset($_POST['submit'])) {
            if (!empty($_POST['date_change']) && !empty($_POST['price'])) {
                $date_change = htmlspecialchars($_POST['date_change']);
                $floor = htmlspecialchars($_POST['floor']);
                $position = htmlspecialchars($_POST['position']);
                $price = htmlspecialchars($_POST['price']);

                $insert = $bdd->prepare("INSERT INTO `gestion` (`date_change`, `floor`, `position`, `price`)
                                            VALUES (:date_change, :floor, :position, :price)");
                $insert->bindParam(':date_change', $date_change);
                $insert->bindParam(':floor', $floor);
                $insert->bindParam(':position', $position);
                $insert->bindParam(':price', $price);
                $insert->execute();
            } else {
                echo 'remplissez tous les champs!';
            }
        }
        ?>
    </main>

</body>

</html>