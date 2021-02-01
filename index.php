<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=ampoule','root');
        }
        catch(PDOException $e){
            echo 'Echec de la connexion : ' .$e->getMessage();
        }

        $table = $bdd->query('SELECT date_change, floor, position, price FROM gestion');
        foreach ($table as $donnee){
            $date_change= $donnee['date_change'];
            $floor= $donnee['floor'];
            $position= $donnee['position'];
            $price= $donnee['price'];
        }        
    ?>
    <header>
        <div>
            <ul>
                <li><a href="http://localhost/Ampoule/index.php">Historique</a></li>
                <li><a href="http://localhost/Ampoule/gestion.php">Gestion</a></li>
            </ul>
        </div>
    </header>
    
    <main>
        <section>
            <div class="colonne">
                <article>Date de changement</article>
                <article>Etage</article>
                <article>Position</article>
                <article>Prix</article>
            </div>
            <?php
                try{
                    $bdd = new PDO('mysql:host=localhost;dbname=ampoule','root');
                }
                catch(PDOException $e){
                    echo 'Echec de la connexion : ' .$e->getMessage();
                }

                $table = $bdd->query('SELECT date_change, floor, position, price FROM gestion');
                foreach ($table as $donnee){
                    $date_change= $donnee['date_change'];
                    $floor= $donnee['floor'];
                    $position= $donnee['position'];
                    $price= $donnee['price'];

                    echo '<div><article> '.$date_change.'</article>
                               <article>Etage n°'.$floor.'</article>
                               <article> '.$position.'</article>
                               <article> '.$price.' €</article>
                        </div>';
                }   
            ?>
        </section>
    </main>
    
</body>
</html>