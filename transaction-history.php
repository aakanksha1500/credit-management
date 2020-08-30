<?php
require_once "dbconnect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Credit-Management</title>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/5.1.1/bootstrap-social.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
        <style type="text/css">
            body{ 
  background: url('img/3.png') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  backdrop-filter: blur(5px) saturate(45%);
  
}
h2{
  margin-top: 25px;
  text-align: center;
}
/*.box {
    background: rgba(255,255,255,.5);
}*/


    </style>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand-sm  fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="./index.php">Credit Management System</a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="./index.php"><span class="fa fa-home fa-lg"></span> Home</a></li>
                    <li class="nav-item active"><a class="nav-link" href="#"><span class="fa fa-info fa-lg"></span> Transactin History</a></li>
                    <li class="nav-item"><a class="nav-link" href="./user.php"><span class="fa fa-address-card fa-lg"></span> Users List</a></li>
                </ul>
                 

        </div>
      </div>
    </nav>

    <div>
        <h2>TRANSACTION HISTORY</h2>
        <table class="table table-striped">
                    <thead class="thead-dark">
                      <tr>
                      <th>FROM</th>
                      <th>TO</th>
                      <th>CREDITS TRANSFERED</th>
                      </tr>
                    </thead>
                    <tbody>  
                        <tr>
                             <?php 
                              $stmt = $pdo->query("SELECT * FROM history");
                              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              if(count($rows)>0){
                             foreach($rows as $row ) { ?>
                             <td><?php echo htmlentities($row['sender']); ?></td>
                                     <td><?php echo htmlentities($row['receiver']); ?></td>         
                                   <td><?php echo htmlentities($row['transaction_amount']); ?></td>
                                   </tr>
                           <?php }
                                }
                             ?>
                              </tbody>
                </table>
    </div>
 
<!--then Popper.js, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
