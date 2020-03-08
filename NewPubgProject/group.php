<?php

function stats($type){
    $db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
$query="select * from $type group by date ";
$result=mysqli_query($db,$query);
while($row=mysqli_fetch_assoc($result)){
   $date=$row['date'];
   $query="select * from $type where date='$date' order by position asc";
   $result2=mysqli_query($db,$query);
   echo "<button class='collapsible'>$date</button>";
   echo " <div class='content $type"."content'>";
   while($row=mysqli_fetch_assoc($result2)){
      
       echo $row['username']." " .$row['position']." ".$row['kills']."<br>";
       
   }
   echo "</div>";
}
}
?>
