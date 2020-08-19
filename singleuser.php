<?php
require_once "dbconnect.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CREDIT MANAGEMENT SYSTEM</title>
<!--  Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>


<?php

$stmt = $pdo->prepare("SELECT * FROM user where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo"<li>".htmlentities($row['id'])."</li>";
	echo"<li>".htmlentities($row['name'])."</li>";
	echo"<li>".htmlentities($row['email'])."</li>";
	echo "<li>".htmlentities($row['credit'])."</li>";
?>
 <body>
 	 <button style="background: #56A49C; color: black; border-radius: 20%;padding: 1%;" ><a href='#' style="color:black;text-decoration: none;"> Transfer credits</a></button>


 </body>
</html>
