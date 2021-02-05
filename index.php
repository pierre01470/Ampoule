<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
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

            <!-------------------- PHP SELECT QUERY -------------------->
            <?php
            try {
                $bdd = new PDO('mysql:host=localhost;dbname=ampoule', 'root');
            } catch (PDOException $e) {
                echo 'Echec de la connexion : ' . $e->getMessage();
            }
            $table = $bdd->query('SELECT * FROM gestion ORDER BY date_change LIMIT 0,5');
            foreach ($table as $donnee) {
                $id_gestion = htmlspecialchars($donnee['id_gestion']);
                $date_change = htmlspecialchars($donnee['date_change']);
                $floor = htmlspecialchars($donnee['floor']);
                $position = htmlspecialchars($donnee['position']);
                $price = htmlspecialchars($donnee['price']);

                echo '<div><article> ' . $date_change . '</article>
                               <article>Etage n°' . $floor . '</article>
                               <article>Côté ' . $position . '</article>
                               <article> ' . $price . '€</article>
                                    <a href="http://localhost/Ampoule/edit.php?id_gestion=' . $id_gestion . '&date_change=' . $date_change . '&floor=' . $floor . '&position=' . $position . '&price=' . $price . '"><img src="../Ampoule/edit.svg" alt="" class="image"></a>
                                    <a href="http://localhost/Ampoule/delete.php?id_gestion=' . $id_gestion . '" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette entrée ?\');"><img src="../Ampoule/poubelle.svg" alt="" class="image"></a>
                          </div>';
            }
            ?>
            <div class="pagination">
                <a href="#"><< Previous</a>
                <a href="#" title="Algorithm">1</a>
                <a href="#" title="DataStructure">2</a>
                <a href="#" title="Languages">3</a>
                <a href="#" title="Interview" class="active">4</a>
                <a href="#" title="practice">5</a>
                <a href="#">Next >></a>
            </div>
        </section>
    </main>
</body>

</html>