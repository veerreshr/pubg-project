<?php include('server.php');
 ?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./register.css" />


</head>

<body>
   
    <div class="content ">
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>
      <div class="slides fade"></div>   
        <button class="button-left" onclick="plusDivs(-1)">&#10094;</button>
        <button class="button-right" onclick="plusDivs(1)">&#10095;</button>
    </div>
    <div class="container">
        <form action="login.php" method="post">
            <centre>
                <h2 style="color: black;">Enter Login Details!</h2>
            </centre><br>
            <?php include('error.php'); ?><br>
            <label for="email">
                Email
            </label><br>
            <input type="text" placeholder="Email" name="email" id="email" required><br>
            <label for="psw">
                PASSWORD
            </label><br>
            <input type="password" placeholder="password" name="password" required><br>



            <input type="submit" id="submit" name="login_user" value="Login"><br>
            <p>
                Not yet a member? <a href="register.php">Sign up</a>
            </p>

        </form>
        </container>
        <script>
            var slideIndex = 1;
           showDivs(slideIndex);
        
           var v=setInterval( ()=>{
                showDivs(slideIndex =slideIndex+1); },5000);
            function plusDivs(n) {
                showDivs(slideIndex += n);
               clearInterval(window.v)
            }
           

            function showDivs(n) {
                var i;
                var x = document.getElementsByClassName("slides");
                if (n > x.length) {
                    slideIndex = 1
                }
                if (n < 1) {
                    slideIndex = x.length
                };
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }
                x[slideIndex - 1].style.display = "block";
              
                
               
            }
        </script>
</body>

</html>