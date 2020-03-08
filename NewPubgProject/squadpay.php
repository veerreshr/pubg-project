<?php
session_start(); $date=date("Y-m-d");
$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
$user_check_query = "SELECT * FROM squad WHERE username='".$_SESSION['username']."' and  date='$date'";
$result = mysqli_query($db, $user_check_query)  or die("connection failed at retrive");

if( mysqli_num_rows($result)){
    header("location: index.php");
}
$query="select cheat from registration where username='".$_SESSION['username']."'";
$result = mysqli_query($db, $query);
$user=mysqli_fetch_assoc($result);
if($user['cheat']===TRUE){
    echo " U cannot participate in further tournments as found cheating ";
    return;
}

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
if ($_SESSION['squadcount'] >= 25) {
    header('location: login.php');
}
if(isset($_POST['submit']))
{
    if(isset($_POST['free'])){
        $db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin for free");
        $user_check_query = "INSERT INTO squad(username,paid,date) values('".$_SESSION['username']."',TRUE,'$date')";
     mysqli_query($db, $user_check_query) ; 
     $_SESSION['squadclaimed']+=1;
          $query="update registration set squadclaimed=". $_SESSION['squadclaimed']." where username='".$_SESSION['username']."'";
        header("location: index.php");
    }
     if($_SESSION['correct']){

        $db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
    $user_check_query = "INSERT INTO squad(username,player2,player3,player4,paid,date) values('".$_SESSION['username']."','".$_POST['player2']."','".$_POST['player3']."','".$_POST['player4']."',FALSE,'$date')";
    if (!mysqli_query($db,$user_check_query )) {
        echo("Error description: " . mysqli_error($db));
        return;
      } 
 
    header("location: index.php");}
}
//validate session
//calculate total participants
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="./style.css" />

    <title>Document</title>
    <style>
        body {
            align-content: center;
            margin: auto;
        }

        .container {
            margin-left: 20px;
        }

        input {
            width: 300px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="navbar" id="navbar">
        <div class="menu" id="hamburger">
            <span class="burger "></span>
        </div>
        <div class="brand" id="brand">
            RedMealey<sub>.com</sub>
        </div>
        <div class="menulinks">
            <a href="index.php">Home<i class="fa fa-home"></i></a>
            <a href="#">Stats<i class="fa fa-bar-chart"></i></a>
            <!--<a href="#">Feedback<i class="fa fa-comment-o"></i></a>-->
            <a href="index.php?logout='1'">Logout<i class="fa fa-sign-out"></i></a>
        </div>
    </div>
    <div class="container">
        <form action="squadpay.php" method="POST">
       
        <label for="player2">Player 2 ID :&nbsp;</label><br><input type="text" name="player2" required><br><br>
        <label for="player3">Player 3 ID :&nbsp;</label><br><input type="text" name="player3" required><br><br>
        <label for="player4">Player 4 ID :&nbsp;</label><br><input type="text" name="player4" required><br><br>
        <span style="color: blue;">
            <h2>Amount to be paid : &#8377;80</h2>
        </span>
        <br>
        <span style="color: crimson">
            <h2><b>PAY TO : <?php
                            //generate phone number from data base which needs to be username for that person
                            echo 1234567890;
                            ?></b></h2><br><br>
        </span>
        <p>*only google pay and phonepay are accepted <br>Confirmation message will be sent within 30min of payment <br>payment need to be done within 15min of acknowledging
            </p><br>
            <b>Acknowledge the above details are recognized and will be paid accordingly by clicking below button</b><br><br>
            <?php
             if(($_SESSION['squadcount']<=25)and $_SESSION['squadavailable']>0 ){
                echo"<br> <input type='submit' name='free' value='claim free entry'>";
            }
            else{
                echo "<input type='submit' name='submit' value='correct'";
                if($_SESSION['squadcount']>=25){echo "disabled";$_SESSION['correct']=FALSE;}else {$_SESSION['correct']=TRUE;} echo">";
            }
                if($_SESSION['squadcount']>=25){
                echo "<br> No places left to register";
            } 
           
            ?> 
        </form>
    </div>
    <div class="footer" id="page4">
        <div class="sec1">
            <h3>KEEP CALM AND PLAY &nbsp;</h3><span id="highlight">PUBG</span>

        </div>
        <div class="stripped"></div>
        <div class="sec2">
            <div class="about">
                <h1>About</h1>
                <div class="stripped"></div>
                <br>
                <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We are group of students who love playing pubg,This site is made from lot of efforts and we take only 5% of money from tournament that money also accounts for webpage host and all fellow supporters
                    Want to support us ? Please watch a <b>ad</b> below, this encurages us to do work more effectively </p>
                <h2 style="padding: 10px"><b>THANK YOU</b></h2>
            </div>
            <div class="social">
                <h1>Follow us at:</h1>
                <div class="stripped"></div>
                <br>
                <a href="#" class="fa fa-facebook fa-lg"></a>
                <a href="#" class="fa fa-twitter fa-lg"></a>
                <a href="#" class="fa fa-instagram fa-lg"></a>
            </div>

            <div class="writeus">
                <h1>Write to Us:</h1>
                <div class="stripped"></div>
                <br>
                <form action="writeus.php" method="POST">
                <input type="email" placeholder="YOUR EMAIL ADDRESS" name="email" id="email" title="Enter valid Email address" oninvalid="setCustomValidity('Enter valid Email address')" required>
                <textarea rows="4" cols="50" id="message" placeholder="YOUR MESSAGE" required name="message"></textarea>
                <input type="submit" id="submit" >
                </form>
            </div>

        </div>
        <div class="stripped"></div>
        <div class="sec3">TERMS | Made with &nbsp;<span style="color: red; font-size:40px;">&#10084;</span> &nbsp;from POCHINKI</div>
    </div>
    <script src="navbar.js"></script>
</body>

</html>