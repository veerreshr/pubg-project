<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
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
    .details{
        padding: 20px;
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
    <div class="details">
        <center><h1><b>DUO TOURNMENT</b></h1></center><br><br>
        <div class="prizedetails"></div>
        <h2><b> Prize Details : </b></h2><br><br>
        <p>

        <!--   ALL PRIZE DETAILS HERE      -->
        </p>
        <div class="rules">
            <h2><b>Rules :</b></h2><br><br>
            <p>

        <!--   ALL RULES HERE      -->
        </p>
        </div>
        <?php

        //if total applicants are greater than 100 disable FOR PAYMNET button
       echo" <button onclick=\"location.href='duopay.php';\" style=\" width:200px; padding:10px; background-color:teal;color:white; font-weight:bold; margin:20px;\"";
       if($_SESSION['duocount']>=50)
        {echo " disabled";}   
        echo ">FOR PAYMENT</button>";
        if($_SESSION['duocount']>=50)
        {echo "<br>No places left to register";}

        ?>
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