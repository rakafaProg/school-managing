<?php



    if(!isset($_SESSION['user'])) {
      header('Location: login.php');
      die;
    }

    $students = SchoolBLL::getAllStudents();

    $courses = SchoolBLL::getAllCourses();

    $courseFormVisible = false;

    if (isset($_GET['course']) && isset($_GET['course']) == -1) {
      $courseFormVisible = true;
    }

    $studentFormVisible = false;

    if (isset($_GET['student']) && isset($_GET['student']) == -1) {
      $studentFormVisible = true;
    }


    if (isset($_POST['submit'])) {
      if (isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['file-name']) && !empty($_POST['file-name'])

        ) {
          $_POST['image'] = $_POST['file-name'];
          $tempCourse = new Course($_POST);

          if($_POST['id'] == -1) {
            $res = SchoolBLL::createCourse($tempCourse);
            debug('course created');
            debug($res);
          }
          debug($tempCourse);

        debug($_POST);

      } elseif (isset($_POST['email']) && !empty($_POST['email'])) {
        debug('student');
        debug($_POST);
      }
      else {
        debug ('not set');
      }
    }



 ?>
