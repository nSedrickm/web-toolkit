<?php
/* setup database connection */

require "config.php";

if (isset($_POST['submit'])) { /* check to see if any form has been submitted */

  try  {
    $connection = new PDO($dsn, $username, $password, $options);

    /*fill the data acquired into an array */
    $new_user = array(
      "id" => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age']
    );

   /* use sprintf function to piece query together due to issues with php 7 php version */
    $sql = sprintf(
      "INSERT INTO %s (%s) values (%s)",
      "users",
      implode(", ", array_keys($new_user)),
      ":" . implode(", :", array_keys($new_user))
    );

    $statement = $connection->prepare($sql);
    $statement-> execute($new_user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

?>

<!-- html markup -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>create</title>

	<link rel="stylesheet" href="css/bootstrap.css">
</head>

<body>
<div class= "container">
	<h2 class="my-5 text-primary"><strong>create new item</strong></h2>

 <!-- alert message for status of form submission -->
  <?php if (isset($_POST['submit']) && $statement) : ?>

    <script type='text/javascript'>alert('success <?php echo $_POST['firstname']; ?>  Has been added to Database');</script>
    <h4 class="mb-5 text-danger"><strong><?php echo $_POST['firstname']; ?></strong> Has been added to Database.</h4>
  <?php endif; ?>

  <form class="form w-50" method="post">
   <div class="form-group">
   <label class="h5 font-weight-bold" for="id">id</label>
    <input class="form-control form-control-lg" type="text" name="id" id="id">
    </div>

    <div class="form-group">
    <label class="h5 font-weight-bold" for="firstname">First Name</label>
    <input class="form-control form-control-lg" type="text" name="firstname" id="firstname">
    </div>

    <div class="form-group">
    <label class="h5 font-weight-bold" for="lastname">Last Name</label>
    <input class="form-control form-control-lg" type="text" name="lastname" id="lastname">
    </div>

    <div class="form-group">
    <label class="h5 font-weight-bold" for="email">Email Address</label>
    <input class="form-control form-control-lg" type="text" name="email" id="email">
    </div>

    <div class="form-group">
    <label class="h5 font-weight-bold" for="age">Age</label>
    <input class="form-control form-control-lg" type="text" name="age" id="age">
    </div>

    <input class="btn btn-primary btn-lg w-100" type="submit" name="submit" value="create">
  </form>

  <a class = "btn btn-danger btn-lg w-25 my-3" href="index.php">menu</a>
  </div>
</body>

</html>
