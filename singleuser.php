<?php
require_once "dbconnect.php";
session_start();
if(isset($_POST['submit'])){
	$receiver=$_POST['receiver'];
	$amount=$_POST['amount'];
	$stmt=$pdo->prepare("SELECT * from user where user_id=:xyz");
    $stmt->execute(array(":xyz" => $_GET['user_id']));
   $row = $stmt->fetch(PDO::FETCH_ASSOC);
   $sender=$row['user_name'];
   $balance=$row['credit'];
   if($balance<$amount){
      $_SESSION['error']="Insufficient account balance";
       header("location:singleuser.php?user_id=" . $_GET["user_id"]);
    return;
   }
 

   $sql = "INSERT INTO history (sender, receiver, transaction_amount) VALUES (?,?,?)";
   $stmt= $pdo->prepare($sql);
   $stmt->execute([$sender, $receiver, $amount]);

   $sql = "UPDATE user SET credit=credit-$amount WHERE user_name='$sender'";
   $stmt= $pdo->prepare($sql);
   $stmt->execute();

   $sql = "UPDATE user SET credit=credit+$amount WHERE user_name='$receiver'";
   $stmt= $pdo->prepare($sql);
   $stmt->execute();
 
   $_SESSION['success']="Transfer Successful";
      header("location:singleuser.php?user_id=" . $_GET["user_id"]);
    return;
} 
?>



<!doctype html>
<html lang="en">
  <head>
    <title>Credit-Management System</title>
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
  background: url('img/2.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  backdrop-filter: blur(5px) saturate(45%);
  
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
                    <li class="nav-item "><a class="nav-link" href="./index.php"><span class="fa fa-home fa-lg"></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./transaction-history.php"><span class="fa fa-info fa-lg"></span> Transfer History</a></li>
                    <li class="nav-item"><a class="nav-link" href="./user.php"><span class="fa fa-address-card fa-lg"></span> Users List</a></li>
                </ul>
                 

        </div>
      </div>
    </nav>
 
<?php

$stmt = $pdo->prepare("SELECT * FROM user where user_id = :xy");
$stmt->execute(array(":xy" => $_GET['user_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$sender=$row['user_name'];
?>
    <div class="container" style=" padding-top:200px;"  >
          <div class="row">
             <div class="col-sm offset-md-3 col-md-6">
                <div class="card">
                    <h3 class="card-header bg-dark text-white">User Details</h3>
                    <div class="card-body">
                        <p>Name:<?php echo htmlentities($row['user_name']); ?></p>
            <p>Email Id:<?php echo htmlentities($row['email']); ?></p>
            <p>Credits:<?php echo htmlentities($row['credit']); ?></p>   
            <p><button class="btn btn-dark btn-xs view_data" data-toggle="modal" data-target="#transfer<?php echo $row['user_id'] ?>">Transfer Credits</button></p> 
                    </div>
                </div>
            </div>
          </div>
   </div>
  	 
 
    <div id="transfer<?php echo $row['user_id'] ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Credits/Money </h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form name="myForm" onsubmit ="return validateform()" action="#" method = "post">
                        <div class="form-group row">
                        <label for="name" name="<?php echo $row['user_id'] ?>" class="col-md-2 col-form-label">Sender:</label>
                        <div class="col-md-10" id="uname">
                           <p><?php $id=$row['user_id'];
                           echo $row['user_name'] ?></p>
                        </div>
                        </div>
                       <div class="form-group row">
                        <label for="name" class="col-md-2 col-form-label">Reciever:</label>
                        <div class="col-md-10">
                            <select name="receiver" class="form-control">
                                <?php 
                                   $stmt = $pdo->query("SELECT * FROM user WHERE user_id!=$id ");
                                   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                   if(count($rows)>0){
                                   foreach($rows as $row ) { ?>

                                     <option><?php echo $row['user_name'] ?></option>
                                  
                                  <?php }
                                       } 
                                 ?>
                            </select>
                        </div>
                        </div>
                    <div class="form-group row">
                        <label for="amount" class="col-md-2 col-form-label">Transfer Amount</label>
                        <div class="col-md-10">
                            <input type="number" class="form-control" id="amount" name="amount" placeholder=" Credits\Amount" required>
                        </div>
                    </div>   
                       <div class="form-group row">
                     <!--   <?php   echo('<a href="user.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
                ?>    
                -->  
                            <button href="singleuser.php?user_id=$id" type="submit" id="submit" name="submit" class="btn btn-primary btn-sm ml-auto" >Transfer

							</button>
                            <button type="button" class="btn btn-secondary btn-sm ml-1" data-dismiss="modal">Cancel</button>     
                        </div>

                    </form>

                </div>
            </div>
        </div>
		
    </div>
<div class="footer" style="position: fixed;">
         <div class="row justify-content-center">             
                <div class="col-auto">
                    <p style="color: #fff;">© Copyright 2020 Credit Management</p>
                </div>
          </div> 
       </div>

</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
 </body>
 
 
</html>
