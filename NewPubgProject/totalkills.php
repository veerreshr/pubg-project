<?php
function totalkills($type,$username){
    $db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
    $kills=0;
    $query="select * from $type where username='$username'";
    $result=mysqli_query($db,$query);
    while($row=mysqli_fetch_assoc($result)){
        $kills=$kills+$row['kills'];
    }
    return $kills;
}
?>