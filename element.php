<?php

try
{
    $pdo = new PDO('mysql:host=localhost; dbname=autocompletion; charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
catch (PDOException $e)
{
    die("Erreur : " . $e -> getMessage());
}

if (isset($_GET['modele']))
{
    $idBike = htmlspecialchars(trim($_GET['modele']));

    $query = $pdo -> prepare("SELECT * FROM moto WHERE id = :id");
    $query -> execute([
        "id" => $idBike
    ]);
    $result = $query -> fetchAll(PDO::FETCH_ASSOC);
    $count = $query -> rowCount();
}

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Grac Guillaume">
    <title>autocompletion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/element.css">
</head>

<body>

<!--- Header --->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary ">
        <a class="navbar-brand" href="index.php" title="Retour à l'accueil"><i class="fas fa-motorcycle"></i> Motor's Search</a>
        <form class="mr-5" action="" method="get">
            <div>
                <input class="search-bar form-control form-control" id="search" name="search" placeholder="Another search ?">
                <div id="matchList"></div>
            </div>
        </form>
    </nav>
    <?php

    if (isset($_GET['search']))
    {
        $count = "";
        $term = htmlspecialchars(trim($_GET['search']));

        $query = $pdo -> prepare("SELECT * FROM moto WHERE modele LIKE :modele");
        $query -> execute([
            "modele" => '%' . $term . '%'
        ]);
        header('location:result.php?search=' . $term);
    }

    ?>
</header>

<!--- Main content --->
<main>
    <?php

    $i = 0;

    while ($i < $count)
    {

        echo'<div class="container mt-3">
                <div class="row">
                    <div class="col-md-7 m-auto">
                        <h1 class="text-center mt-2">' .$result[$i]['modele']. '</h1>
                        <figure class="figure">
                            <img class=" img-fluid figure-img" src="'.$result[$i]['photo']. '" alt="' . $result[$i]['modele'] . '">
                        </figure>
                    </div>
                </div>
            </div>';

        $i++;
    }

    ?>
</main>

<!--- Footer --->
<footer>
    <p class="text-center"><i class="far fa-copyright"></i> Made by Grac Guillaume</p>
</footer>

<!--- Script --->
<script src="js/jquery-3.6.0.js"></script>
<script src="js/script.js"></script>

</body>
</html>
