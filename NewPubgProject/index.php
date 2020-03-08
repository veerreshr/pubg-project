<?php

session_start();
$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg');
$date = date("Y-m-d");

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
$username= $_SESSION['username'];
$query = "select * from registration where username='$username'";
$result = mysqli_query($db, $query) ;
$user = mysqli_fetch_assoc($result);
if ($user['cheat'] === TRUE) {
    echo " U cannot participate in further tournments as found cheating ";
    return;
}
$query="select * from registration where username='".$_SESSION['username']."'";
$result=mysqli_query($db,$query);
while($row=mysqli_fetch_assoc($result)){
    $kills=$row['solokills'];
    $_SESSION['soloclaimed']=$row['soloclaimed'];
    $_SESSION['soloavailable']=($kills/40)-$_SESSION['soloclaimed'];
    $kills=$row['duokills'];
    $_SESSION['duoclaimed']=$row['duoclaimed'];
    $_SESSION['duoavailable']=($kills/50)- $_SESSION['duoclaimed'];
    $kills=$row['squadkills'];
    $_SESSION['squadclaimed']=$row['squadclaimed'];
    $_SESSION['squadavailable']=($kills/100)- $_SESSION['squadclaimed'];

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <link rel="stylesheet" href="bower_components/aos/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
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
            <a href="#">Home<i class="fa fa-home"></i></a>
            <a href="stats.php">Stats<i class="fa fa-bar-chart"></i></a>
            <!--<a href="#">Feedback<i class="fa fa-comment-o"></i></a>-->
            <a href="index.php?logout='1'">Logout<i class="fa fa-sign-out"></i></a>
        </div>
    </div>
    <nav>
        <a href="#page1">
            <div id="pg1"> </div>
        </a>
        <a href="#page2">
            <div id="pg2"> </div>
        </a>
        <a href="#page3">
            <div id="pg3"> </div>
        </a>
        <a href="#page4">
            <div id="pg4"> </div>
        </a>
    </nav>
    <div class="main">



        <div class="page1" id="page1">

            <div class="scene"></div>
            <div class="sceneback"></div>
            <h1 id="quote">Lets Start World War 3
            </h1>
        </div>
        <div class="room">
            <div class="soloroom">

                <?php
                $query = "select * from solo where paid=TRUE and date='$date' and username='".$_SESSION['username']. "'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) == 1) {
                    echo " <h3>Payment complete for Solo <i class='fa fa-check' aria-hidden='true'></i></h3><br>";
                    $query = "select roomid,roompass from solo where paid=TRUE and date='$date' and username='" . $_SESSION['username'] . "'";
                    $result = mysqli_query($db, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        echo "<br><h4>Room id : " . $row['roomid'] . " <br> Room Password : " . $row['roompass'] . "</h4>";
                    }
                }
                ?>
            </div>
            <div class="duoroom">
                <?php
                $query = "select * from duo where paid=TRUE and date='$date' and username='".$_SESSION['username'] . "'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) == 1) {
                    echo " <h3>Payment complete for Duo <i class='fa fa-check' aria-hidden='true'></i></h3><br>";
                    $query = "select roomid,roompass from duo where paid=TRUE and date='$date' and username='" . $_SESSION['username'] . "'";
                    $result = mysqli_query($db, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        echo "<br><h4>Room id : " . $row['roomid'] . " <br> Room Password : " . $row['roompass'] . "</h4>";
                    }
                }
                ?>
            </div>
            <div class="squadroom">
                <?php
                $query = "select * from squad where paid=TRUE and date='$date' and username='" . $_SESSION['username'] . "'";
                $result = mysqli_query($db, $query);
                if (mysqli_num_rows($result) == 1) {
                    echo " <h3>Payment complete for Squad <i class='fa fa-check' aria-hidden='true'></i></h3><br>";
                    $query = "select roomid,roompass from squad where paid=TRUE and date='$date' and username='" . $_SESSION['username'] . "'";
                    $result = mysqli_query($db, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        echo "<br><h4>Room id : " . $row['roomid'] . " <br> Room Password : " . $row['roompass'] . "</h4>";
                    }
                }
                ?>
            </div>

        </div>
        <div class="page2" id="page2">
            <div class="box">
                <a href="solodetails.php">
                    <div class="card">
                        <div class="imgBx">
                            <img src="solo.jpg" alt="images">
                        </div>
                        <div class="details">
                            <h2>Solo Tournament<br>
                                <span>
                                    <?php
                                    $user_check_query = "SELECT * FROM solo where date='" . date('Y-m-d') . "'";
                                    $result = mysqli_query($db, $user_check_query);
                                    if ($result) {
                                        // it return number of rows in the table. 
                                        $row = mysqli_num_rows($result);

                                        echo $row . "/100 occupied";
                                        $_SESSION['solocount'] = $row;

                                        // close the result. 
                                        mysqli_free_result($result);
                                    }
                                    if($_SESSION['soloavailable']>0)
                                    {
                                        echo "<h4 style='color:red'><b>Avail for free!</b></h4>";
                                    }
                                    ?>
                                </span></h2>
                        </div>
                    </div>
                </a>
                <a href="duodetails.php">
                    <div class="card">
                        <div class="imgBx">
                            <img src="duo.jpg" alt="images">
                        </div>
                        <div class="details">
                            <h2>Duo Tournament<br>
                                <span> <?php
                                        $user_check_query = "SELECT * FROM duo where date='" . date('Y-m-d') . "' ";
                                        $result = mysqli_query($db, $user_check_query);
                                        if ($result) {
                                            // it return number of rows in the table. 
                                            $row = mysqli_num_rows($result);

                                            echo $row . "/50 occupied";
                                            $_SESSION['duocount'] = $row;

                                            // close the result. 
                                            mysqli_free_result($result);
                                        }
                                        if($_SESSION['duoavailable']>0)
                                        {
                                            echo "<h4 style='color:red'><b>Avail for free!</b></h4>";
                                        }
                                        ?>
                                </span></h2>
                        </div>
                    </div>
                </a>
                <a href="squaddetails.php">
                    <div class="card">
                        <div class="imgBx">
                            <img src="squad.jpg" alt="images">
                        </div>
                        <div class="details">
                            <h2>Squad Tournament<br>
                                <span> <?php
                                        $user_check_query = "SELECT * FROM squad where date='" . date('Y-m-d') . "'";
                                        $result = mysqli_query($db, $user_check_query);
                                        if ($result) {
                                            // it return number of rows in the table. 
                                            $row = mysqli_num_rows($result);

                                            echo $row . "/25 occupied";
                                            $_SESSION['squadcount'] = $row;
                                            // close the result. 
                                            mysqli_free_result($result);
                                        }
                                        if($_SESSION['squadavailable']>0)
                                        {
                                            echo "<h4 style='color:red'><b>Avail for free!</b></h4>";
                                        }
                                        ?>
                                </span></h2>
                        </div>
                    </div>
                </a>

            </div>

        </div>
        <div class="page3" id="page3">
            <div class="solo-winner winner">
                <div class="teamname">
                    <h2><b>Team Name </b></h2><br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5>&nbsp;&nbsp;&nbsp; teamname </h5> <br><br>";
                    }
                    ?>
                </div>
                <div class="position">
                    <h2><b>Position</b></h2> <br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5>&nbsp; &nbsp;&nbsp;" . ($i + 1) . " </h5> <br><br>";
                    }
                    ?>
                </div>
            </div>
            <div class="duo-winner winner">
                <div class="teamname">
                    <h2><b>Team Name </b></h2><br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5> &nbsp;&nbsp;&nbsp;teamname </h5> <br><br>";
                    }
                    ?>
                </div>
                <div class="position">
                    <h2><b>Position</b></h2> <br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5>&nbsp;&nbsp;&nbsp; " . ($i + 1) . " </h5> <br><br>";
                    }
                    ?>
                </div>
            </div>
            <div class="squad-winner winner">
                <div class="teamname">
                    <h2><b>Team Name </b></h2><br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5> &nbsp;&nbsp;&nbsp;teamname </h5> <br><br>";
                    }
                    ?>
                </div>
                <div class="position">
                    <h2><b>Position</b></h2> <br><br>
                    <?php

                    for ($i = 0; $i < 10; $i++) {
                        echo "<h5>&nbsp;&nbsp;&nbsp; " . ($i + 1) . " </h5> <br><br>";
                    }
                    ?>
                </div>
            </div>
        </div>
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
                    <input type="submit" id="submit">
                </form>
            </div>

        </div>
        <div class="stripped"></div>
        <div class="sec3">TERMS | Made with &nbsp;<span style="color: red; font-size:40px;">&#10084;</span> &nbsp;from POCHINKI</div>
    </div>


    <script src="navbar.js"></script>
    <script src="bower_components/aos/dist/aos.js"></script>
    <script src="aos.js"></script>
    <script>
        AOS.init({
            offset: 200,
            duration: 600,
            easing: 'ease-in-sine',
            delay: 100,

        });
    </script>
    <script src="./three.min.js"></script>
    <script src="./GLTFLoader.js"></script>
    <script src="./app.js"></script>
</body>

</html>