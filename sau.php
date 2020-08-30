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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap-social.css"> 
    <link rel="stylesheet" href="css/style.css">
 </head>

<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-sm fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button">
                <span class="navbar-toggler-icon"> </span>   
            </button>
            <a class="navbar-brand mr-auto" href="#">CREDIT MANAGEMENT SYSTEM</a>
            <div class="collapse navbar-collapse" id="Navbar">
               <ul class="navbar-nav ml-auto">
                  <li class="nav-item active"><a class="nav-link" href="index.php"><span class="fa fa-home fa-lg"></span> Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="./allusers.php"><span class="fa fa-address-card fa-lg"></span> View Users</a></li>
                  <li class="nav-item"><a class="nav-link" href="./history.php"><span class="fa fa-info fa-lg"></span> Transaction History</a></li>   
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
                       <h2>Choose an account</h2>
                           <hr>
                           <?php 
                              $stmt = $pdo->query("SELECT * FROM user");
                              $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                              if(count($rows)>0){
                                 foreach($rows as $row ) { ?>

                                <div class="panel panel-default">
                                   <div class="panel-body">
                                      <div class="row" style="padding-left: 10px;">
      
                                        <?php echo('<a href="singleuser.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
                                         ?>   
                                      </div> 
                                   </div>
                                </div>
                            <?php }
                              }
                          ?>
                  </div>  
                </div>
            </div>
        </div>
    </div>

<div class="container-fluid"> 
  <div class="vertical-center">
        <div class="row row-content  ">
            <div class="offset-5 col-4 ">
              <a href="allusers.php"><button>VIEW USERS</button></a>
            </div>
       </div>
       <div class="row row-content">
            <div class="offset-5 col-4 ">
              <button id="trans">TRANSFER CREDITS</button>
            </div>
       </div> 
       <div class="row row-content">
            <div class="offset-5 col-4 ">
              <a href="transaction-history.php"><button id="hist">TRANSACTION HISTORY</button></a> 
            </div>
       </div>   
  </div>        
</div>
<footer class="footer">
    <div class="container">    
         <div class="row justify-content-center">             
                <div class="col-auto">
                    <p>© Copyright 2020 Credit Management</p>
                </div>
          </div> 
    </div>
</footer>

  <!-- jQuery first, then Popper.js, then Bootstrap JS. -->
   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>  
    <script>
      $(document).ready(function(){
        $('#trans').click(function(){
                $('#transModal').modal('show');
            });
      });
    </script> 
</body>
</html>