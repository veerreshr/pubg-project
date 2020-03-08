<?php
session_start();
require 'totalkills.php';
if(isset($_GET['updatesolokills'])){
    $query = "select * from registration";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $username=$row['username'];
        $kills=totalkills('solo','$username');
        $query="update registration set solokills=$kills where username='$username'";
    }
}
if(isset($_GET['updateduokills'])){
    $query = "select * from registration";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $username=$row['username'];
        $kills=totalkills('duo','$username');
        $query="update registration set duokills=$kills where username='$username'";
    }
}
if(isset($_GET['updatesquadkills'])){
    $query = "select * from registration";
    $result = mysqli_query($db, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $username=$row['username'];
        $kills=totalkills('squad','$username');
        $query="update registration set squadkills=$kills where username='$username'";
    }
}
$db = mysqli_connect('localhost', 'id12487386_redmealey', 'WctVNUAp@$EuCzqw^Lrg', 'id12487386_pubg') or die("connection failed at begin");
$date = date("Y-m-d");
if (isset($_POST['solopaid'])) {
    $query = "select * from registration where phonenumber='" . $_POST['phonenumber'] . "'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $query = "UPDATE solo set paid=TRUE where username='$username' and date='$date'";
    mysqli_query($db, $query);
}
if (isset($_POST['duopaid'])) {
    $query = "select * from registration where phonenumber='" . $_POST['phonenumber'] . "'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $query = "UPDATE duo set paid=TRUE  where username='" . $username . "' and date='$date'";
    mysqli_query($db, $query);
}
if (isset($_POST['squadpaid'])) {
    $query = "select * from registration where phonenumber='" . $_POST['phonenumber'] . "'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $email = $row['email'];
    $query = "UPDATE squad set paid=TRUE  where username='" . $username . "' and date='$date'";
    mysqli_query($db, $query);
}
if (isset($_POST['solokill'])) {
    $query = "select * from solo where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $kill = "solokill" . $i;
        $query = "update solo set kills=" . $_POST[$kill] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_POST['soloposition'])) {
    $query = "select * from solo where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $position = "soloposition" . $i;
        $query = "update solo set position=" . $_POST[$position] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_POST['duokill'])) {
    $query = "select * from duo where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $kill = "duokill" . $i;
        $query = "update duo set kills=" . $_POST[$kill] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_POST['duoposition'])) {
    $query = "select * from duo where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $position = "duoposition" . $i;
        $query = "update duo set position=" . $_POST[$position] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_POST['squadkill'])) {
    $query = "select * from squad where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $kill = "squadkill" . $i;
        $query = "update squad set kills=" . $_POST[$kill] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_POST['squadposition'])) {
    $query = "select * from squad where paid=TRUE and date='$date'";
    $result = mysqli_query($db, $query);

    $i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        $position = "squadposition" . $i;
        $query = "update squad set position=" . $_POST[$position] . " where username='" . $row['username'] . "' and date='$date'";
    }
}
if (isset($_GET['clear'])) {
    $query = "delete from solo where paid=FALSE ";
    mysqli_query($db, $query);
    $query = "delete from duo where paid=FALSE ";
    mysqli_query($db, $query);
    $query = "delete from squad where paid=FALSE ";
    mysqli_query($db, $query);
}
if (isset($_POST['cheater'])) {
    $query = "update registration set cheat=TRUE where username='" . $_POST['cheater'] . "'";
    mysqli_query($db, $query);
}
if (isset($_POST['soloroomid'])) {
    $query = "update solo set roomid='" . $_POST['soloroomid'] . "',roompass='" . $_POST['soloroompassword'] . "' where date=$date and paid=TRUE";
    mysqli_query($db, $query);
}
if (isset($_POST['duoroomid'])) {
    $query = "update duo set roomid='" . $_POST['duoroomid'] . "',roompass='" . $_POST['duoroompassword'] . "' where date=$date and paid=TRUE";
    mysqli_query($db, $query);
}
if (isset($_POST['squadroomid'])) {
    $query = "update squad set roomid='" . $_POST['squadroomid'] . "',roompass='" . $_POST['squadroompassword'] . "' where date=$date and paid=TRUE";
    mysqli_query($db, $query);
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .room {

            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .cheater-container {
            min-height: 10vh;
            width: 100%;

        }

        input {
            width: 200px;
            height: 30px;
            margin: 10px;
            padding: 10px;
        }

        .stats {
            display: block;
            min-height: 100vh;
            width: 100%;

        }

        .username,
        .kills,
        .position {
            flex-grow: 1;
        }

        .solowinner,
        .duowinner,
        .squadwinner {
            min-height: 100vh;
            display: flex;
            flex-wrap: nowrap;
        }

        .payment {
            display: flex;
            flex-wrap: wrap;

        }
    </style>
</head>

<body>
    <div class="clear">
        <a href="admin.php?clear='1'">Remove invalid users</a>
    </div>
    <div class="room">
        <div class="soloroom">
            <form action="admin.php" method="post">
                <input type="text" name="soloroomid" placeholder="SOLO ROOM ID"><br>
                <input type="text" name="soloroompassword" placeholder="ROOM PASSWORD"><br>
                <input type="submit" value="send"><br>
            </form>
        </div>
        <div class="duoroom">
            <form action="admin.php" method="post">
                <input type="text" name="duoroomid" placeholder="DUO ROOM ID"><br>
                <input type="text" name="duoroompassword" placeholder="ROOM PASSWORD"> <br>
                <input type="submit" value="send"><br>
            </form>
        </div>
        <div class="squadroom">
            <form action="admin.php" method="post">
                <input type="text" name="squadroomid" placeholder="SQUAD ROOM ID"><br>
                <input type="text" name="squadroompassword" placeholder="ROOM PASSWORD"> <br>
                <input type="submit" value="send"><br>
            </form>
        </div>
    </div>
    <div class="cheater-container">
        <form action="admin.php" method="post">
            <label for="cheater">
                <input type="text" name="cheater" id="cheater" placeholder="cheater game id">
                <input type="submit" value="Report">
            </label>
        </form>
    </div>
    <div class="payment">
        <div class="solopayment">
            <form action="admin.php" method="post">
                <input type="text" name="phonenumber" placeholder="solo paid user phonenumber"><br>
                <input type="submit" name="solopaid">
            </form>
        </div>
        <div class="duopayment">
            <form action="admin.php" method="post">
                <input type="text" name="phonenumber" placeholder="duo paid user phonenumber"><br>
                <input type="submit" name="duopaid">
            </form>
        </div>
        <div class="squadpayment">
            <form action="admin.php" method="post">
                <input type="text" name="phonenumber" placeholder="squad paid user phonenumber"><br>
                <input type="submit" name="squadpaid">
            </form>
        </div>
    </div>
    <div class="upadtereg">
        click this after entering the kills of winners for <a href="admin.php?updatesolokills='1'">solo</a>a
        <a href="admin.php?updateduokills='1'">duo</a>
        <a href="admin.php?updatesquadkills='1'">squad</a>
    </div>
    <div class="stats">
        <div class="solostats">
            <h3>solo</h3><br>
            <div class="solowinner" id="solowinner">
                <div class="username">
                    <?php
                    $result = mysqli_query($db, "Select username from solo where paid=TRUE and date='$date'");

                    $count = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>" . $row['username'] . "</h3><br>";
                    }

                    echo "</div>";
                    echo " <div class='kills'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='solokill" . $i . "' placeholder='kills' ><br>";
                    }
                    echo "<input type='submit' name='solokill'>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='position'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='soloposition" . $i . "' placeholder='position' ><br>";
                    }
                    echo "<input type='submit' name='soloposition'>";
                    echo "</form>";
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <div class="duostats">
            <h3>duo</h3><br>
            <div class="duowinner">
                <div class="username">
                    <?php
                    $result = mysqli_query($db, "Select username from duo where paid=TRUE and date='$date'");

                    $count = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>" . $row['username'] . "</h3><br>";
                    }

                    echo "</div>";
                    echo " <div class='kills'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='duokill" . $i . "' placeholder='kills' ><br>";
                    }
                    echo "<input type='submit' name='duokill'>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='position'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='duoposition" . $i . "' placeholder='position' ><br>";
                    }
                    echo "<input type='submit' name='duoposition'>";
                    echo "</form>";
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
        <div class="squadstats">
            <h3>squad</h3><br>
            <div class="squadwinner">
                <div class="username">
                    <?php
                    $result = mysqli_query($db, "Select username from squad where paid=TRUE and date='$date'");

                    $count = mysqli_num_rows($result);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<h3>" . $row['username'] . "</h3><br>";
                    }

                    echo "</div>";
                    echo " <div class='kills'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='squadkill" . $i . "' placeholder='kills' ><br>";
                    }
                    echo "<input type='submit' name='squadkill'>";
                    echo "</form>";
                    echo "</div>";
                    echo "<div class='position'>";
                    echo "<form action='admin.php' method='post'>";
                    for ($i = 1; $i <= $count; $i++) {
                        echo "<input type='text' name='squadposition" . $i . "' placeholder='position' ><br>";
                    }
                    echo "<input type='submit' name='squadposition'>";
                    echo "</form>";
                    echo "</div>";
                    ?>
                </div>
            </div>
        </div>
    </div>


</body>

</html>