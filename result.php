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
    <link rel="stylesheet" href="css/result.css">
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
</header>

<!--- Main content --->
<main>
    <h1 class="text-center mt-5">Résultat de votre recherche</h1>
    <div class="container mt-5">
        <div class="content d-flex flex-wrap">
    <?php
    
    if (isset($_GET['search']))
    {
        $term = htmlspecialchars(trim($_GET['search']));

        $query = $pdo -> prepare("SELECT * FROM moto WHERE modele LIKE :modele");
        $query -> execute([
            "modele" => '%' . $term . '%'
        ]);
        $result = $query -> fetchAll();

        foreach ($result as $key => $value)
        {
            echo '<div class="card">
                    <img class="img-fluid" src="' . $value['photo'] . '" alt="' . $value['modele'] . '">
                    <div class="card-body">
                        <a href="element.php?modele=' . $value['id'] . '"><p class="card-text"><h1>' . $value['modele'] . '</h1></p></a>
                    </div>
                </div>';
        }
    }
    ?>
        </div>
    </div>
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
