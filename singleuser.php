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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>CREDIT MANAGEMENT SYSTEM</title>
<!--  Bootstrap -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	 <script type="text/javascript">
	 	//function validateform()
    	//{
    	 //var z=document.forms["myForm"]["amount"].value;
    	 
    	  //  }
    	//if(z<0)
    		//{alert("Credit cannot be a negative value");
    	    //return false;
    	  //  }
		//$(document).ready(function(){
			//$('#submit').click(function(){
				
			//alert("Credits transferred successfully")
			//});
		//});
		
		
			//function myFunction() { 
 // document.getElementById("transfer<?php echo $row['user_id']?>").showModal(); 
//}
				
           
       
	</script>
</head>



 <body>
 
 <?php

$stm = $pdo->prepare("SELECT * FROM user where user_id = :xy");
$stm->execute(array(":xy" => $_GET['user_id']));
$row = $stm->fetch(PDO::FETCH_ASSOC);
echo"<li>".htmlentities($row['user_id'])."</li>";
	echo"<li>".htmlentities($row['user_name'])."</li>";
	echo"<li>".htmlentities($row['email'])."</li>";
	echo "<li>".htmlentities($row['credit'])."</li>";
?>
  	 <button  type="submit" class=" btn btn-primary" data-toggle="modal" data-target="#transfer<?php echo $row['user_id']?>" > Transfer credits</button>
 
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




<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
 
 </body>
 
 
</html>
