<?php

session_start();
include_once "header.php";
include_once "database.php";



$id = $_POST['id'];
$title = $_POST['title'];
$poster = $_POST['poster'];
$synopsis = $_POST['synopsis'];

$data = "SELECT * FROM movies LIMIT 3 WHERE id = $id";
$results = mysqli_query($conn, $data);

if (!isset($_POST["title"])) {
    $title = $data["title"];
}
if (!isset($_POST["poster"])) {
    $poster = $data["poster"];
}

if (!isset($_POST["synopsis"])) {
    $synopsis = $data["synopsis"];
}


$query = "UPDATE movies SET title = '$title', poster = '$poster', synopsis = '$synopsis' WHERE id = $id";
$results = mysqli_query($conn, $query);
if ($results) {
    echo 'Movie Successfully updated';
} else {
    echo 'Error Updating';
}
varDump($_POST);
