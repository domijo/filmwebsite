<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Home page</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <div id="categorie">
    </div>

</body>

</html>



<?php
$page ='Homepage'; 
include_once "header.php";
include_once "database.php";






$query = 'SELECT * FROM category';

$results = mysqli_query($conn, $query);

$category = mysqli_fetch_all($results, MYSQLI_ASSOC);

?>
<div class="content">

    <p class="text">Eodem tempore etiam Hymetii praeclarae indolis viri negotium est
        actitatum, cuius hunc novimus esse textum. cum Africam pro consule
        regeret Carthaginiensibus victus inopia iam lassatis, ex horreis
        Romano populo destinatis frumentum dedit, pauloque postea cum
        provenisset segetum copia, integre sine ulla restituit mora.
    </p>


    <div class="form">
        <form id="site-search action=" details.php" method="post">
            <input id="site-search" list="movie" name="search" id="movies">
            <datalist id="movie">
                <?php foreach ($movies as $movie) : ?>
                    <option value="<?= $movie["title"]; ?>">
                    <?php endforeach; ?>
            </datalist>
            <input type="submit" id="send" value="ok">
        </form>
    </div>


    <article class="categorieBtn">
        <?php foreach ($category as $categorie) : ?>
            <div class="categorie">
                <form action="catalogue.php" method="POST">
                    <input class="categoryButton" type="submit" name="category" value="<?= $categorie['title']; ?>">
                </form>
            </div>
        <?php endforeach ?>
    </article>

    <?php
    $query = 'SELECT * FROM movies LIMIT 3';

    $results = mysqli_query($conn, $query);

    $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
    ?>
    <br>
    <section class="homepageFilms">
        <?php foreach ($movies as $movie) : ?>
            <div class="movies">
                <img class="img" src="<?= $movie['poster']; ?>" alt="">
                <p><?= $movie['title']; ?></p>
            </div>
        <?php endforeach ?>
    </section>
</div>