<?php
/* create database connection  */
$host       = "localhost";
$username   = "phpmyadmin";
$password   = "phpmyadmin";
$dbname     = "test";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );

if (isset($_POST['submit'])) { /* check for form submission */

  try  { /* fetch information from database */
    $connection = new PDO($dsn, $username, $password, $options);

    $sql = "SELECT *
            FROM users
            WHERE firstname = :firstname";

    $firstname = $_POST['firstname'];
    $statement = $connection->prepare($sql);
    $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $statement->execute();

    /* return results of querry back here */
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<!-- markup to display output -->
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Read</title>

	<link rel="stylesheet" href="css/bootstrap.css"> <!-- link to bootstrap file for styling -->
</head>
<body>

<div class= "container">
	<h2 class="my-5 text-primary"><strong>Read items</strong></h2>


<?php
if (isset($_POST['submit'])) { /* loop through returned results and place in tables */
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>search results </h2>

    <table class="table">
      <thead>
        <tr>
          <th>id</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Email Address</th>
          <th>Age</th>
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

        </tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <?php } else { ?>  <!-- display an error if no match is found -->
    <script type='text/javascript'>alert('sorry no match for <?php echo $_POST['firstname']; ?>');</script>
      
      <h4 class="mb-5">Sorry no match for <strong class="text-danger"><?php echo $_POST['firstname']; ?></strong></h4>

    <?php }
} ?>

<!-- form used to collect information to be searched -->
<form class="form w-50" method="post">
<div class="form-group">
  <label class="h4" for="firstname"><strong>Enter firstname</strong></label>
  <input class="form-control form-control-lg" type="text" id="firstname" name="firstname">
  </div>
  <input class="btn btn-primary btn-lg w-100" type="submit" name="submit" value="search">
</form>
  <a class = "btn btn-danger btn-lg w-25 my-3" href="index.php">menu</a>


</div>
</body>
</html>