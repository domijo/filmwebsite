<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Film</title>
  <link rel="stylesheet" href="style/style.css">
  <style>
    .error {
      color: red;
    }
  </style>
</head>

<body>

  <?php include_once "header.php"; ?>



  <div id="results"></div>


  <?php
  $page ='Add_a_film';

  $errors = array();

  $title = '';
  $poster = '';
  $synopsis = '';
  $category = '';

  if (isset($_POST['insertBtn'])) {

    $title =  trim($_POST['title']);
    $poster =  trim($_POST['poster']);
    $synopsis =  trim($_POST['synopsis']);
    $category =  trim($_POST['category']);
    $actor =  trim($_POST['actor']);

    if (empty($_POST['title']))
      $errors['title'] = '<p style="color:red">Title is mandatory</p>';

    if (empty($_POST['poster']))
      $errors['title'] = 'Poster is mandatory</p>';

    if (empty($_POST['category']))
      $errors['category'] = 'Catagory is mandatory, please fiil the form</p>';

    if (count($errors) == 0) {

      include_once 'database.php';
      $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);


      $query = "INSERT INTO movies(title, poster, synopsis, category_id, actor_id)
    VALUES('$title', '$poster', '$synopsis', '$category', $actor);";

      $result = mysqli_query($conn, $query);

      if ($result)
        echo '<p style="color:green">Thank you for inserting!</p>';
      else
        echo '<p style="color:red">Problem with query!</p>';
    }
  }
  if ($conn) {

    $query = 'SELECT * FROM category';

    $results = mysqli_query($conn, $query);

    $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
  }
  if ($conn) {

    $query = 'SELECT * FROM actors';

    $results = mysqli_query($conn, $query);

    $actors = mysqli_fetch_all($results, MYSQLI_ASSOC);
  }


  ?>

  <div class="main-header">
    <h2>Insert movie here</h2>
    <form id="insertForm" method="post">
      <input class="input" type="text" name="title" placeholder="Title" value="<?= $title; ?>"><br>
      <span class="error"><?php if (isset($errors['title'])) echo $errors['title']; ?></span>
      <input class="input" type="text" name="poster" placeholder="Poster" value="<?= $poster; ?>"><br>
      <span class="error"><?php if (isset($errors['poster'])) echo $errors['poster']; ?></span>
      <input class="input" type="text" name="synopsis" placeholder="Synopsis" value="<?= $synopsis; ?>"><br>
      <span class="error"><?php if (isset($errors['synopsis'])) echo $errors['synopsis']; ?></span>

      <select class="input" name="actor">

        <?php foreach ($actors as $actor) : ?>
          <option value="<?= $actor['id']; ?>"><?= $actor['firstName'] . " " . $actor["lastName"]; ?>
          <?php endforeach ?>
      </select><br />
      <span class="error"><?php if (isset($errors['category'])) echo $errors['category']; ?></span>

      <select class="input" name="category">

        <?php foreach ($categories as $category) : ?>
          <option value="<?= $category['id']; ?>"><?= $category['title']; ?>
          <?php endforeach ?>
      </select><br />
      <span class="error"><?php if (isset($errors['category'])) echo $errors['category']; ?></span>

      <input class="button" type="submit" name="insertBtn" value="Insert movie" />
    </form>
  </div>





</body>

</html>