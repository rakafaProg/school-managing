<?php
  require_once 'administrator.php';
  require_once 'student.php';

  $admin = new Administrator ([
    'name' => 'y',
    'role' => 1,
    'phone' => '1800-800-800',
    'email' => 'rakkafa@gmail.com',
    'password' => '1234'
  ]);

  $student = new Student([
    'name' => 'y',
    'phone' => '1800-800-800',
    'email' => 'rakkafa@gmail.com',
    'image' => 'imagesrc.png'
  ]);

  echo "<pre>";
  var_dump($admin);
  var_dump($student);
  echo "</pre>";
 ?>
