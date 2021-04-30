<?php
include_once "header.php";
include_once "database.php";
?>
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
    <p id="message"></p>
    <div class="main-header">
        <form action="update" method="POST">
            <input class="input" type="text" name="title" placeholder="title"><br>
            <input class="input" type="text" name="poster" placeholder="poster"><br>
            <input class="input" type="text" name="synopsis" placeholder="synopsis"><br>
            <input class="button" type="submit" name="update" placeholder="update">
            <input type="hidden" name="id" value="<?= $_POST["id"] ?>">
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).submit(function(e) {
            e.preventDefault();
            $.ajax({
                    url: "updateFilm.php",
                    method: "post",
                    data: $('form').serialize(),
                    $
                })
                .done(function(result) {
                    $('#message').html(strmessage);
                })
                .fail(function(result) {
                    console.log("Ajax Failure");
                })

        });
    </script>
</body>

</html>