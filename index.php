<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    
    <!-------------------- MAIN -------------------->
    <main>
        <section>
            <div class="colonne">
                <article>Date de changement</article>
                <article>Etage</article>
                <article>Position</article>
                <article>Prix</article>
            </div>

    <!-------------------- PHP -------------------->
            <?php
                try{$bdd = new PDO('mysql:host=localhost;dbname=ampoule','root');}
                
                catch(PDOException $e){
                    echo 'Echec de la connexion : ' .$e->getMessage();
                }

                $table = $bdd->query('SELECT id_gestion, date_change, floor, position, price FROM gestion');
                foreach($table as $donnee){
                    $id_gestion= $donnee['id_gestion'];
                    $date_change= $donnee['date_change'];
                    $floor= $donnee['floor'];
                    $position= $donnee['position'];
                    $price= $donnee['price'];

                    echo '<div><article> '.$date_change.'</article>
                               <article>Etage n°'.$floor.'</article>
                               <article>Côté '.$position.'</article>
                               <article> '.$price.'€</article>
                                <form action="http://localhost/Ampoule/gestion.php" method="get">
                                    <input type="image" name="edit" class="image" src="../Ampoule/edit.svg">
                                    <input type="image" name="trash" class="image" src="../Ampoule/poubelle.svg">
                                </form>
                          </div>';
                }
            ?>
        </section>
    </main>
    
</body>
</html>