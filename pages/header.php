<?php include_once 'session.php'; // Start session only once.

  include_once '../debug.php';
  include_once "../data/admin_bll.php";

  if (isset($_SESSION['user'])) {
    $user = new Administrator($_SESSION['user']);
  } else {
    $user = new Administrator([
      'name' => '',
      'role' => 99,
      'phone' => '',
      'email' => '',
      'id' => '',
      'image' => '',
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="../assets/images/logo.png" />

    <!-- semantic ui -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/components/icon.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

    <link href='https://fonts.googleapis.com/css?family=Acme' rel='stylesheet'>


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

        <a class="item ui header olive invisible <?= viewToRole (3, $user) ?>" href="school.php?courses">Courses</a>
        <a class="item ui header olive invisible <?= viewToRole (3, $user) ?>" href="school.php?students">Students</a>
        <a class="item ui header olive <?= viewToRole (3, $user) ?>" href="school.php">School</a>
        <a class="item ui header olive <?= viewToRole (2, $user) ?>" href="admin.php">Administration</a>

        <div class="right menu"> </div>


        <a class="item ui header olive <?= viewToRole (4, $user) ?>" href="logout.php">Log-Out</a>
        <div class="item ui header green <?= viewToRole (4, $user) ?>">
          <span><?= $user->getName() ?> - <?= $user->getRoleName() ?></span>
        </div>
        <div class="item ui <?= viewToRole (4, $user) ?>">
          <img class="ui circular image profile-img" src="<?= $user->getImageURL() ?>" />
        </div>


      </div>

    </header>

    <p></p>

    <main>
