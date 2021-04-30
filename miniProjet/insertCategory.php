<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Category</title>
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
  $page ='Manage_Categorie';
  include_once "database.php";
  $errors = array();

  $title = '';

  if (isset($_POST['insertBtn'])) {
    $title =  trim($_POST['title']);


    if (empty($_POST['title']))
      $errors['title'] = '<p style="color:red">Title is mandatory</p>';

    if (count($errors) == 0) {
      $query = "SELECT * FROM category WHERE title = '" . $_POST["title"] . "';";
      $result = mysqli_query($conn, $query);
      if (empty($_POST["category"]) && mysqli_num_rows($result) < 1) {
        include_once 'database.php';


        $query = "INSERT INTO category(title)
        VALUES('$title');";


        if ($result)
          echo '<p style="color:green">Thank you for inserting!</p>';
        else
          echo '<p style="color:red">Problem with query!</p>';
      } else {
        echo "NEW QUERY";
        if (mysqli_num_rows($result) < 1) {
          $query = "UPDATE category SET title='" .  $_POST['title'] .  "' WHERE title =  '" . $_POST['category'] . "';";
        }
      }
      $result = mysqli_query($conn, $query);
    }
  }

  if ($conn) {

    $query = 'SELECT * FROM category';

    $results = mysqli_query($conn, $query);

    $categories = mysqli_fetch_all($results, MYSQLI_ASSOC);
  }


  ?>
  <div class="main-header">
    <h2>Insert category here</h2>
    <form id="insertForm" method="POST">
      <input class="input" type="text" name="title" placeholder="Title" value="<?= $title; ?>"><br>
      <span class="error"><?php if (isset($errors['title'])) echo $errors['title']; ?></span>


      <select class="input" name="category">
        <option> </option>
        <?php foreach ($categories as $category) : ?>
          <option value="<?= $category['title']; ?>"><?= $category['title']; ?>
          <?php endforeach ?>
      </select><br />
      <span class="error"><?php if (isset($errors['category'])) echo $errors['category']; ?></span>

      <input class="button" type="submit" name="insertBtn" value="Insert category" />
    </form>

  </div>



</body>

</html>