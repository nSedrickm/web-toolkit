<?php

/* database connection */
require "config.php";

/* get information form database based on query */
try {
  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM users";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();
} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>update</title>

	<link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>

<div class= "container">
<h2 class="my-5 text-primary"><strong>Update items</strong></h2>

<table class="table">
    <thead>
        <tr>
            <th>#id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email Address</th>
            <th>Age</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($result as $row) : ?> <!-- loop through information and display them in table -->
        <tr>
            <td><?php echo $row["id"]; ?></td>
            <td><?php echo $row["firstname"]; ?></td>
            <td><?php echo $row["lastname"]; ?></td>
            <td><?php echo $row["email"]; ?></td>
            <td><?php echo $row["age"]; ?></td>
            <td><a class = "btn btn-success px-4 py-1" href="update-single.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a class = "btn btn-danger btn-lg w-25 my-3" href="index.php">menu</a> <!-- back to main menu -->

</body>
</html>