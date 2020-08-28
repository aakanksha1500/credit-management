<?php
require_once "dbconnect.php";
session_start();


$stmt = $pdo->query("SELECT * FROM user");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(count($rows)>0){
    
foreach($rows as $row  ) {
   
    echo(htmlentities($row['user_id']));
    
    ?>
    <?php	echo('<a href="singleuser.php?user_id='.$row['user_id'].'">'.htmlentities($row['user_name']).'</a> ');
				?>
<?php
        echo(htmlentities($row['email']));
    
    echo(htmlentities($row['credit']));
    ;
    echo('<br>');
  
}

}
?>