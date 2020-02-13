<?php

require "config.php";

/* check for a submitted for using a try catch err block standard php rules */
if (isset($_POST["submit"])) {

  try {
    $connection = new PDO($dsn, $username, $password, $options); //create connection to db using predefined variables above
  
    $id = $_POST["submit"]; //extract id from submitted form data

    $sql = "DELETE FROM users WHERE id = :id";  //sql query to delete item based on its id

    $statement = $connection->prepare($sql);  //sending the sql statement to the database through a PDO connection
    $statement->bindValue(':id', $id);
    $statement->execute();

  } catch(PDOException $error) {  /* catch any errors that occur and display them */
    echo $sql . "<br>" . $error->getMessage();
  }
}

try {

   /* on successful connection to database return all records in it */

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<!-- html code to be processed by php 
     all elements styled using bootstrap -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Delete</title>

	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class= "container">
<h2 class="my-5 text-primary"><strong>Delete items</strong></h2>

 <?php if (isset($_POST['submit']) && $statement) : ?>

    <script type='text/javascript'>alert('success item  <?php echo $_POST['submit']; ?>  Has been deleted');</script>
    <h4 class="mb-5">success item <strong class="text-danger"><?php echo $_POST['submit']; ?></strong> Has been deleted.</h4>
  <?php endif; ?>



<form class="form" method="post"> <!-- wrap form with table -->
  <table class="table ">
    <thead>
      <tr>
        <th>id</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email Address</th>
        <th>Age</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?>
      <tr>
        <td><?php echo $row["id"]; ?></td>
        <td><?php echo $row["firstname"]; ?></td>
        <td><?php echo $row["lastname"]; ?></td>
        <td><?php echo $row["email"]; ?></td>
        <td><?php echo $row["age"]; ?></td>
        <td><button class = "btn btn-danger px-4 py-1" type="submit" name="submit" value="<?php echo $row["id"]; ?>">Delete</button></td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</form>

  <a class = "btn btn-danger btn-lg w-25 my-3" href="index.php">menu</a> <!-- nav button to return to main menu -->


</body>
</html>