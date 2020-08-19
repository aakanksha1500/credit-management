<?php
require_once "dbconnect.php";
session_start();

echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT * FROM user");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
if(count($rows)>0){
    
foreach($rows as $row  ) {
   
    echo(htmlentities($row['id']));
    
    ?>
    <?php	echo('<a href="singleuser.php?id='.$row['id'].'">'.htmlentities($row['name']).'</a> ');
				?>
<?php
        echo(htmlentities($row['email']));
    
    echo(htmlentities($row['credit']));
    ;
    echo('<br>');
  
}

}
?>