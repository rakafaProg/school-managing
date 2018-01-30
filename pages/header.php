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

    <!-- semantic ui -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/components/icon.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.14/semantic.min.js"></script>


    <link rel="stylesheet" href="../assets/css/main.css" />
    <script>function debug(msg) { console.log(msg); }</script>

    <title>The School</title>
  </head>

  <body class="ui header blue">

    <header>

      <div class="ui stackable inverted menu">

        <a class="item ui header green" href="school.php">
          <i class="student icon"></i>
          The School
        </a>

        <a class="item ui header olive <?= viewToRole (3, $user) ?>" href="#">Courses</a>
        <a class="item ui header olive <?= viewToRole (3, $user) ?>" href="#">Students</a>
        <a class="item ui header olive <?= viewToRole (2, $user) ?>" href="#">Administration</a>

        <div class="right menu <?= viewToRole (4, $user) ?>">
          <a class="item ui header olive" href="logout.php">Log-Out</a>
          <div class="item ui header green">
            <span><?= $user->getName() ?> - <?= $user->getRoleName() ?></span>
          </div>
          <div class="item ui">
            <img class="ui circular image profile-img" src="https://www.fg-a.com/smileys/monster-smiley.jpg" />
          </div>
        </div>

      </div>

    </header>

    <p></p>
