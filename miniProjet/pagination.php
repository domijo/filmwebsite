<?php
session_start();
include_once "database.php";
if ($conn) {
    $page = 3 * $_POST["pageCount"];
    if ($page < 0) {
        $page = 0;
    }
    if (!empty($_POST["category"])) {
        $query = 'SELECT *, movies.title as movieTitle, movies.id as movieId FROM movies INNER JOIN category ON category_id = category.id WHERE category.title = "' . $_POST["category"] . '" LIMIT 3 OFFSET ' . $page . ';';
    } else {
        $query = 'SELECT *, movies.title as movieTitle,  movies.id as movieId FROM movies LIMIT 3 OFFSET ' . $page . ';';
    }
    $results = mysqli_query($conn, $query);

    $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
if (isset($_POST["playlist"])) {
    $query = "INSERT INTO playlist_content(playlist_id, movie_id) VALUES (" . $_SESSION["playlistid"] . "," . $_POST["songId"] . ");";
    echo $query;
    $result = mysqli_query($conn, $query);
}
?>
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
                <form action="" method="POST">
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