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
    <title>Historique</title>
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

    <!-------------------- MAIN -------------------->
    <main>
        <section class="responsive">
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
            $rowNbr = 5;
            $table = $bdd->query('SELECT id_gestion FROM gestion');
            $rowTotal = $table->rowcount();
            $totalPage = ceil($rowTotal/$rowNbr);

            if (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0 && $_GET['page'] <= $totalPage) {
                $_GET['page'] = intval($_GET['page']);
                $currentPage = $_GET['page'];
            } else{
                $currentPage = 1;
            }
            
            $depart = ($currentPage-1)*$rowNbr;

            $table = $bdd->query('SELECT * FROM gestion ORDER BY date_change LIMIT '.$depart.','.$rowNbr.'');
            foreach ($table as $donnee) {
                $id_gestion = htmlspecialchars($donnee['id_gestion']);
                $date_change = htmlspecialchars($donnee['date_change']);
                $floor = htmlspecialchars($donnee['floor']);
                $position = htmlspecialchars($donnee['position']);
                $price = htmlspecialchars($donnee['price']);

                echo '<div class="history"><article> ' . $date_change . '</article>
                               <article>Etage n°' . $floor . '</article>
                               <article>Côté ' . $position . '</article>
                               <article> ' . $price . '€</article>
                                    <a href="http://localhost/Ampoule/edit.php?id_gestion=' . $id_gestion . '&date_change=' . $date_change . '&floor=' . $floor . '&position=' . $position . '&price=' . $price . '"><img src="../Ampoule/media/edit.svg" alt="" class="image"></a>
                                    <a href="http://localhost/Ampoule/delete.php?id_gestion=' . $id_gestion . '" onclick="return confirm(\'Etes-vous sûr de vouloir supprimer cette entrée ?\');"><img src="../Ampoule/media/poubelle.svg" alt="" class="image"></a>
                          </div>';
            }
            ?>
            <div class="pagination">
                <?php
                for($i=1;$i<=$totalPage;$i++){
                    if($i == $currentPage){
                        echo $i.' ';
                    } else {
                        echo '<a href="index.php?page='.$i.'">'.$i.'</a> ';
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>