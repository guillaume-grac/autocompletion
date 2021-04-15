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
    <link rel="stylesheet" href="css/index.css">
</head>

<body>

<!--- Header --->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-between">
        <a class="navbar-brand" href="index.php"><i class="fas fa-motorcycle"></i> Motor's Search</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <form action="" method="get">
            <div class="input-group">
                <input class="search-bar form-control form-control-lg" id="search" name="search" placeholder="What motorcycle are you looking for ?">
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

    while ($i < $count){

        echo('<h1>' . $result[$i]['modele'] . '</h1><img src="' . $result[$i]['photo'] . '" class="img-thumbnail" alt="' . $result[$i]['modele'] . '">');

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
