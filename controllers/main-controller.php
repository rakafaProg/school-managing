<?php



    if(!isset($_SESSION['user'])) {
      header('Location: login.php');
      die;
    }

    $students = BLL::getAllStudents();

    $courses = BLL::getAllCourses();



 ?>
