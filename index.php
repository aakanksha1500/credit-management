<?php
require_once "dbconnect.php";
session_start();
?>
<!DOCTYPE html>
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
 
body { 
  background: url('img/7.jpg') no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  backdrop-filter:blur(5px);
}
.pad{
  margin-top: 350px;
}
    </style>
</head>
<body>
    
    <nav class="navbar navbar-dark navbar-expand-sm  fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#Navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand mr-auto" href="#">CREDIT MANAGEMENT SYSTEM</a>
            <div class="collapse navbar-collapse" id="Navbar">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active"><a class="nav-link" href="#"><span class="fa fa-home fa-lg"></span> Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./transaction-history.php"><span class="fa fa-info fa-lg"></span> Transfer History</a></li>
                    <li class="nav-item"><a class="nav-link" href="./user.php"><span class="fa fa-address-card fa-lg"></span> Users List</a></li>
                </ul>
                 

        </div>
      </div>
    </nav>
    <div id="transModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" role="content">
           
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Transfer Credits</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default" style="padding: 10px;">
                       <h2>Choose an user</h2>
                           <hr>
                           <?php 
                              $stmt = $pdo->query("SELECT * FROM user");
                              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              if(count($rows)>0){
                                 foreach($rows as $row ) { ?>

                                <div class="panel panel-default">
                                   <div class="panel-body">
                                      <div class="row">
      
                                        <?php echo('<a href="singleuser.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
                                         ?>   
                                      </div> 
                                      <p>Email Id:<?php echo htmlentities($row['email']);?></p>
                                      <p>Credits:<?php echo htmlentities($row['credit']);?></p>
                                   </div>
                                </div>
                            <?php
                             }
                            }
                          ?>
                  </div>  
                </div>
            </div>
        </div>
    </div>
    
    <div class="align-self-center abc">
   <div class="row row-content ">
    <div class="col-12 col-sm-6"></div>
            <div class="col col-sm col-md order-sm-last ">
                <h2>TO VIEW ALL USERS</h2>
            </div>
            <div class="col-12 col-sm-4 col-md-3 align-self-center">
                <a href="user.php"><button class="btn btn-block " role="button"> USERS LIST</button></a>             
            </div>
        </div>
    <div class="row row-content ">
    <div class="col-12 col-sm-6"></div>
            <div class="col col-sm col-md order-sm-middle ">
                <h2>TO TRANSFER CREDITS FROM ONE USER TO OTHER</h2>
            </div>
            <div class="col-12 col-sm-4 col-md-3 align-self-center">
                <button type="submit" data-toggle="modal" data-target="#transModal" class="btn btn-block " role="button">TRANSFER CREDITS</button>
            </div>
        </div>
    <div class="row row-content ">
    <div class="col-12 col-sm-6"></div>
            <div class="col col-sm col-md order-sm-last ">
                <h2>TO VIEW TRANSACTION HISTORY</h2>
            </div>
            <div class="col-12 col-sm-4 col-md-3 align-self-center">
                <a href="transaction-history.php"><button id="hist" class="btn btn-block " role="button">TRANSFER HISTORY</button></a>             
            </div>
        </div> 
       </div>

    

  
       <div class="footer">
         <div class="row justify-content-center">             
                <div class="col-auto">
                    <p style="color: #fff;">© Copyright 2020 Credit Management</p>
                </div>
          </div> 
       </div>

</div>

<!-- jQuery first, then Popper.js, then Bootstrap JS. -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>


    
           
  