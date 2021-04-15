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

$term = htmlspecialchars(trim($_GET['search']));

$query = $pdo -> prepare("SELECT * FROM moto WHERE modele LIKE :term");
$query -> execute([
    "term" => '%' . $term . '%'
]);

$i = 0;
$tab = array();

while( $result = $query -> fetch(PDO::FETCH_ASSOC)){

    $tab[$i][] = $result;
    $i++;
}

$bikeJSON = json_encode($tab);

echo $bikeJSON;