<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edition</title>
</head>

<body>

    
    <!-------------------- HEADER -------------------->
    <header>
        <div>
            <ul>
                <li><a href="http://localhost/Ampoule/index.php">Historique</a></li>
                <li><a href="http://localhost/Ampoule/gestion.php">Gestion</a></li>
            </ul>
        </div>
    </header>


    <!-------------------- FORM -------------------->
    <main>
        <div class="form">
            <form action="" method="post">
                <input type="date" name="date_change" value="<?=htmlspecialchars($_GET['date_change']);?>">
                <select name="floor" id="">
                    <option value="" selected><?='Etage n° '.htmlspecialchars($_GET['floor']);?></option>
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
                    <option value="" selected><?='Côté '.htmlspecialchars($_GET['position']);?></option>
                    <option value="gauche">Côté gauche</option>
                    <option value="droit">Côté droit</option>
                    <option value="Fond">Fond</option>
                </select>
                <input type="text" name="price" value="<?=htmlspecialchars($_GET['price']);?>" placeholder="Prix">€
                <input type="submit" value="Modifier" name="submit">
            </form>
        </div>
        
        
        <!-------------------- PHP UPDATE QUERY -------------------->
        <?php
        try {
            $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
        } catch (PDOException $e) {
            echo 'Echec de la connexion : ' . $e->getMessage();
        }
        if (isset($_POST['submit']) && !empty($_GET['id_gestion'])) {
            try {
                $edit = $bdd->prepare('UPDATE `gestion` SET `date_change`=:date_change, `floor`=:floor, `position`=:position, `price`=:price WHERE `gestion`.`id_gestion` = ' . $_GET['id_gestion'] . '');
                $edit->bindParam(':date_change', $_POST['date_change']);
                $edit->bindParam(':floor', $_POST['floor']);
                $edit->bindParam(':position', $_POST['position']);
                $edit->bindParam(':price', $_POST['price']);
                $edit->execute();
            } catch (PDOException $e) {
                echo 'Echec query : ' . $e->getMessage();
            }
            header("Location: index.php");
        }
        ?>
    </main>

</body>

</html>