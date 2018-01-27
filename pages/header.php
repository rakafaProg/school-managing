<?php session_start();

  include_once '../debug.php';
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <!-- css for the specific page:  -->
    <link rel="stylesheet" href="../assets/css/<?= str_replace('.php', '', basename($_SERVER['PHP_SELF'])) ?>.css">
    <title>The School</title>
  </head>
  <body>

    <header>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </nav>

      <!-- empty navbar to save space when the window's size changes -->
      <nav class="navbar navbar-inverse invisible">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
            <li><a href="#">Page 4</a></li>
          </ul>
        </div>
      </nav>
    </header>

    <script>
      function debug(msg) {
        console.log(msg);
      }
    </script>
