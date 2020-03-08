<?php
session_start();
require 'group.php';

$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
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
        /* Set height of body and the document to 100% to enable "full page tabs" */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial;
        }



        /* Style tab links */
        .tablink {
            background-color: #555;
            color: white;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            font-size: 17px;
            width: 25%;
        }

        .tablink:hover {
            background-color: #777;
        }

        /* Style the tab content (and add height:100% for full page content) */
        .tabcontent {
            color: white;

            display: none;
            padding: 100px 20px;
            height: 100%;
            /* animation: fadeEffect 1s;*/
        }

        #Solo {
            background-color: #D84242;
        }

        #Duo {
            background-color: #E5CB90;
        }

        #Squad {
            background-color: #40e0d0;
        }

        #MVP {
            background-color: #FFCC5C;
        }

        .collapsible {
            background-color: #777;
            color: white;
            cursor: pointer;
            padding: 18px;
            width: 100%;
            border: none;
            text-align: left;
            outline: none;
            font-size: 15px;
        }

        .active,
        .collapsible:hover {
            background-color: #555;
        }

        .content {

            padding: 0 18px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.2s ease-out;
            background-color: #f1f1f1;
        }

        .collapsible:after {
            content: '\2228';
            /* Unicode character for "plus" sign (+) */
            font-size: 13px;
            color: white;
            float: right;
            margin-left: 5px;
            padding-right: 10px;
        }

        .active:after {
            content: "\2227";
            /* Unicode character for "minus" sign (-) */
        }

        .solocontent {
            color: #D84242;
        }

        .duocontent {
            color: #E5CB90;
        }

        .squadcontent {
            color: #40e0d0;
        }

        table {
            min-width: 50vw;

        }

        th {
            color: #D84242;
        }

        td {
            color: #555;
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
    <div class="stats">
        <button class="tablink" onclick="openPage('Solo', this, '#D84242')" id="defaultOpen">Solo</button>
        <button class="tablink" onclick="openPage('Duo', this, '#E5CB90')">Duo</button>
        <button class="tablink" onclick="openPage('Squad', this, '#40e0d0')">Squad</button>
        <button class="tablink" onclick="openPage('MVP', this, '#FFCC5C')">MVP</button>

        <div id="Solo" class="tabcontent">
            <?php
            stats("solo");
            ?>
        </div>

        <div id="Duo" class="tabcontent">
            <?php
            stats("duo");
            ?>
        </div>
        <div id="Squad" class="tabcontent">
            <?php
            stats("squad");
            ?>
        </div>

        <div id="MVP" class="tabcontent">
            <button class='collapsible'>Players with Most Kills in Solo</button>
            <div class='content solocontent'>
                <table>
                    <tr>
                        <th>Player Name</th>
                        <th>Kills</th>
                    </tr>
                    <?php
                    $query = "select * from registration where solokills>0 order by solokills desc";
                    $result = mysqli_query($db, $query);

                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        $username = $row['username'];
                        $kills = $row['solokills'];
                        echo "<tr>";
                        echo "<td>" . $username . "</td>";
                        echo "<td> $kills</td>";
                        echo "</tr>";
                        if ($i == 10) {
                            break;
                        }
                    }
                    ?>
                </table>

            </div>
            <button class='collapsible'>Players with Most Kills in Duo </button>
            <div class='content duocontent'>
                <table>
                    <tr>
                        <th>Duo Name</th>
                        <th>Kills</th>
                    </tr>
                    <?php
                    $query = "select * from registration where duokills>0 order by duokills desc";
                    $result = mysqli_query($db, $query);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        $username = $row['username'];
                        $kills = $row['duokills'];
                        echo "<tr>";
                        echo "<td>" . $username . "</td>";
                        echo "<td> $kills</td>";
                        echo "</tr>";
                        if ($i == 10) {
                            break;
                        }
                    }
                    ?>
                </table>
            </div>
            <button class='collapsible'>Players with Most Kills in Squad </button>
            <div class='content squadcontent'>
                <table>
                    <tr>
                        <th>Squad Name</th>
                        <th>Kills</th>
                    </tr>
                    <?php
                    $query = "select * from registration where squadkills>0 order by squadkills desc";
                    $result = mysqli_query($db, $query);
                    $i = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i++;
                        $username = $row['username'];
                        $kills = $row['squadkills'];
                        echo "<tr>";
                        echo "<td>" . $username . "</td>";
                        echo "<td> $kills</td>";
                        echo "</tr>";
                        if ($i == 10) {
                            break;
                        }
                    }
                    ?>
                </table>
            </div>
            <button class='collapsible'>My Kills</button>
            <div class='content mycontent'>
                <table>
                    <tr>
                        <th>Solo</th>
                        <th>Duo</th>
                        <th>Squad</th>
                    </tr>
                    <?php
                    $query = "select * from registration where username='" . $_SESSION['username'] . "'";
                    $result = mysqli_query($db, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['solokills'] . "</td>";
                        echo "<td>" . $row['duokills'] . "</td>";
                        echo "<td>" . $row['squadkills'] . "</td>";

                        echo "</tr>";
                    }
                    ?>
                </table>

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
    <script>
        function openPage(pageName, elmnt, color) {
            // Hide all elements with class="tabcontent" by default */
            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Remove the background color of all tablinks/buttons
            tablinks = document.getElementsByClassName("tablink");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].style.backgroundColor = "";
            }

            // Show the specific tab content
            document.getElementById(pageName).style.display = "block";

            // Add the specific color to the button used to open the tab content
            elmnt.style.backgroundColor = color;
        }

        // Get the element with id="defaultOpen" and click on it
        document.getElementById("defaultOpen").click();
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                } else {
                    content.style.maxHeight = content.scrollHeight + "px";

                }
            });
        }
    </script>
</body>

</html>