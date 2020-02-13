<?php
/* create db connection  */
require "config.php";

if (isset($_POST['submit'])) { /* extract user data sent in form */

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $user =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "email"     => $_POST['email'],
      "age"       => $_POST['age']
    ];

    /*edit the selected user based on their id */
    $sql = "UPDATE users
            SET id = :id,
              firstname = :firstname, 
              lastname = :lastname, 
              email = :email, 
              age = :age
            WHERE id = :id";
  
  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();
    
    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Could not modify an error occurred";
    exit;
}
?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Read</title>

	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class= "container">
	<h2 class="my-5 text-primary"><strong>Edit item</strong></h2>

<?php if (isset($_POST['submit']) && $statement) : ?><!-- feedback based on form status -->
      <script type='text/javascript'>alert('success <?php echo $_POST['firstname']; ?>  updated!!!');</script>
      <h4 class="mb-5 text-success">success <strong class=""><?php echo $_POST['firstname']; ?></strong> updated!!!</h4>
<?php endif; ?>

<form class="form w-50" method="post">

    <?php foreach ($user as $key => $value) : ?><!-- loop through user data and place them accordingly -->

    <div class="form-group">
      <label class="h4" for="<?php echo $key; ?>"><strong><?php echo ucfirst($key); ?></strong></label>
	    <input class="form-control form-control-lg" type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo $value; ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
   </div>
    <?php endforeach; ?>
  <input class="btn btn-primary btn-lg w-100" type="submit" name="submit" value="update" data-toggle="modal" data-target="#exampleModal">
</form>


  <a class = "btn btn-danger btn-lg w-25 my-3" href="index.php">menu</a>
  </div>
</body>
</html>
