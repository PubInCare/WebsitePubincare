<?php
session_start();
session_unset();
session_destroy();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css"></li>
    <title>Homepage</title>
    <style>
      .Menu{
        display: flex;
        justify-content: space-between;
        width: 100%;
        box-sizing: border-box;
        padding-left: 70px;
        padding-right: 70px;
      }
      .menuhome{
        width: 300px;
        display: flex;
        justify-content: space-between;
      }
      .link{
        text-decoration: none;
        color:black;
        font-weight:500;
      }
      .link:hover{
        color:rgb(110, 110, 110);
      }
      .icon:hover{
        cursor: pointer;
      }
      .login{
        color: black;
      }
    </style>
  </head>
  <body>
  <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-warning Sticky-top">
    <div class="icon" style="margin-left:1300px;">
      <h5>
        <a class="login" href="./2.Login.php">
          <i class="fas fa-sign-in-alt" data-toggle="tooltip" title="Login"></i>
        </a>
      </h5>
    </div>
  </div>
</nav>
<div class="jumbotron jumbotron-fluid" style="background-image: url(infrastruktur.png);">
  <div class="container text-center" style="color: white"><br><br><br><br><br>
    <img src="web.jpg" width="150" class="rounded-circle">
    <div style="height:90px;"></div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col text-center">
      <h1 class="display-4"><b>SIPI KLU</b></h1>
      <p class="lead"><b>Sistem Informasi Pemerataan Infrastruktur Kabupaten Lombok Utara</b></p>
    </div>
  </div>
</div>
<div class="jumbotron text-center" style="margin-bottom:0">
    <p>Copyright 2020 SIPI KLU.com</p>
</div>
</div>
</div>






















    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script type="text/javascript" src="tooltip.js"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
  </body>
</html>