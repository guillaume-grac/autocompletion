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
                <div class="Matchlist"></div>
            </div>
        </form>
    </nav>
</header>

<!--- Main content --->
<main>
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
            echo ('<a href="element.php?modele=' . $value['id'] . '"><h1>' . $value['modele'] . '</h1><img src="' . $value['photo'] . '" alt="' . $value['modele'] . '"></a>');
        }
    }
    ?>
</main>

<!--- Footer --->
<footer>
    <p class="text-center"><i class="far fa-copyright"></i> Made by Grac Guillaume</p>
</footer>

<!--- Script --->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="js/script.js"></script>

</body>
</html>
