<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
 
    <?php
    $page ='Catalogue';
    include_once "header.php";

    if ($conn) {
        if (isset($_POST["category"])) {
            $query = 'SELECT *, movies.title  as movieTitle, movies.id as movieId FROM movies INNER JOIN category ON category_id = category.id WHERE category.title = "' . $_POST["category"] . '" LIMIT 3;';
        } else {
            $query = 'SELECT *,  movies.title as movieTitle, movies.id as movieId FROM movies LIMIT 3';
        }
        $results = mysqli_query($conn, $query);

        $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
        $query = 'SELECT * FROM category';

        $results = mysqli_query($conn, $query);

        $category = mysqli_fetch_all($results, MYSQLI_ASSOC);
    }

    if (isset($_POST["playlist"])) {
        $query = "INSERT INTO playlist_content(playlist_id, movie_id) VALUES (" . $_SESSION["playlistid"] . "," . $_POST["songId"] . ");";
        echo $query;
        $result = mysqli_query($conn, $query);
    }






    ?>
    <article class="categorieBtn">
        <?php foreach ($category as $categorie) : ?>
            <div class="categorie">
                <form action="catalogue.php" method="POST">
                    <input class="categoryButton" type="submit" name="category" value="<?= $categorie['title']; ?>">
                </form>
            </div>
        <?php endforeach ?>
        <div class="categorie">
            <form action="catalogue.php" method="POST">
                <input class="categoryButton" type="submit" value="All">
            </form>
        </div>
    </article>
    <section>



        <?php foreach ($movies as $movie) : ?>
            <div class="movieDetails">
                <img src="<?= $movie['poster']; ?>" alt="">
                <div>
                    <form class="movieSelector" action="details.php" method="POST">
                        <input type="hidden" name="id" id="id" value="<?= $movie["movieId"]; ?>">
                        <input type="submit" value="<?= $movie['movieTitle']; ?>">
                    </form>
                    <p>
                        <?= $movie['synopsis']; ?>
                    </p>
                </div>
                <div class="movieActionSelector">
                    <form action="details.php" method="POST">
                        <input type="submit" value="Details">
                        <input type="hidden" name="id" id="id" value="<?= $movie["movieId"]; ?>">
                    </form>
                    <?php if (isset($_SESSION["isAdmin"])) : ?>
                        <form action="modifyFilm.php" method="POST">
                            <input type="submit" value="Modify">
                            <input type="hidden" name="id" id="id" value="<?= $movie["movieId"]; ?>">
                        </form>
                    <?php endif ?>
                    <?php if (isset($_SESSION["playlistid"])) : ?>
                        <form action="" method="POST">
                            <input type="hidden" name="songId" value="<?= $movie["movieId"]; ?>">
                            <input type="submit" name="playlist" value="Add to Playlist">
                        </form>
                    <?php endif ?>
                </div>
            </div>
        <?php endforeach ?>
    </section>
    <div class="buttons">
        <form action="" method="POST">
            <input class="nextP" type="submit" id="previous" value="previous">
            <input type="hidden" id="previousCat" name="category" value="<?php if (isset($_POST["category"])) {
                                                                                echo $_POST["category"];
                                                                            } ?>">
        </form>
        <form action="" method="POST">
            <input class="nextP" type="submit" id="next" value="next">
            <input type="hidden" id="nextCat" name="category" value="<?php if (isset($_POST["category"])) {
                                                                            echo $_POST["category"];
                                                                        } ?>">
        </form>

    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        let pageCount = 0;
        console.log(pageCount);
        $(function() {

            $('#next').click(function(e) {
                e.preventDefault();
                pageCount++;
                $.ajax({
                        url: 'pagination.php',
                        method: 'post',
                        data: {
                            pageCount: pageCount,
                            category: $("#nextCat").val(),
                        }
                    })
                    .done(function(result) {
                        $('section').html(result);
                    })
            })

            $('#previous').click(function(e) {
                e.preventDefault();

                pageCount--;
                if (pageCount < 0) {
                    pageCount = 0;
                }
                $.ajax({
                        url: 'pagination.php',
                        method: 'post',
                        data: {
                            pageCount: pageCount,
                            category: $("#previousCat").val(),
                        }
                    })
                    .done(function(result) {
                        $('section').html(result);
                    })
            })
        })
    </script>
</body>

</html>