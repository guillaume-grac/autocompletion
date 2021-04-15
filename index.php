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

<video autoplay loop id="myVideo">
    <source src="images/moto.mp4" type="video/mp4">
</video>

<!--- Header --->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary justify-content-between">
        <a class="navbar-brand" href="index.php"><i class="fas fa-motorcycle"></i> Motor's Search</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>
</header>

<!--- Main content --->
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <h1 class="text-center mt-5"><i class="fas fa-motorcycle"></i> Motor's Search</h1>
                <div class="form-group">
                    <form action="result.php" method="get">
                        <div class="input-group">
                            <input class="search-bar form-control form-control-lg" id="search" name="search" placeholder="What motorcycle are you looking for ?">
                            <div id="matchList"></div>
                        </div>
                    </form>
                </div>
            </div>
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
