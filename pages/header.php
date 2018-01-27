<?php session_start();

  include_once '../debug.php';
  include_once '../models/administrator.php';

  if (isset($_SESSION['user'])) {
    $user = new Administrator($_SESSION['user']);
  } else {
    $user = new Administrator([
      'name' => '',
      'role' => 99,
      'phone' => '',
      'email' => '',
      'id' => '',
      'password' => ''
    ]);

  }

  function viewToRole ($role, $user) {
    if ($user->getRole() <= $role)
      return;
    return 'invisible';
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="../assets/images/logo.png" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <!-- css for the specific page:  -->
    <link rel="stylesheet" href="../assets/css/<?= str_replace('.php', '', basename($_SERVER['PHP_SELF'])) ?>.css">
    <title>The School</title>
  </head>
  <body>




    <header>

    <nav class="navbar navbar-inverse navbar-fixed-top ">
      <div class="container-fluid">
        <div class="navbar-header">
          <span class="logo pull-left">
            <img src="../assets/images/logo.png" title="Learning is Fun" />
          </span>
          <a class="navbar-brand pull-left" href="school.php">The-School</a>
        </div>
        <ul class="nav navbar-nav <?= viewToRole (3, $user) ?>">
          <li><a href="school.php?courses">Courses</a></li>
          <li><a href="school.php?students">Students</a></li>
          <li class="<?= viewToRole (2, $user) ?>"><a href="school.php?admin">Administration</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right <?= viewToRole (3, $user) ?>">
          <li><a><?= $user->getName() ?> - <?= $user->getRoleName() ?></a></li>
          <li>
            <a href="logout.php">Log-out</a>
          </li>
          <li>
            <img class="user-img" src="https://www.fg-a.com/smileys/monster-smiley.jpg" title="Your Image" />
          </li>
        </ul>
      </div>
    </nav>

      <style>
      .logo {
        padding: 10px 10px 0 10px;
        }

        .user-img {
          height: 50px;
          width: 60px;
        }



      </style>

      <!-- empty navbar to save space when the window's size changes -->
      <nav class="navbar navbar-inverse invisible">
        <div class="container-fluid">
          <div class="navbar-header">
            <span class="logo pull-left">
              <img src="../assets/images/logo.png" title="Learning is Fun" />
            </span>
            <a class="navbar-brand pull-left" href="school.php">The-School</a>
          </div>
          <ul class="nav navbar-nav">
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
            <li><a href="#">Page 4</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a>User Name - Role</a></li>
            <li>
              <a href="logout.php">Log-out</a>
            </li>
            <li>
              <img class="user-img" src="https://www.fg-a.com/smileys/monster-smiley.jpg" title="Your Image" />
            </li>
          </ul>
        </div>
      </nav>




    </header>

    <script>
      function debug(msg) {
        console.log(msg);
      }
    </script>
