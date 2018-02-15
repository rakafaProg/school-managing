<?php



    if(!isset($_SESSION['user'])) {
      header('Location: login.php');
      die;
    }

    $students = SchoolBLL::getAllStudents();

    $courses = SchoolBLL::getAllCourses();

    $viewStdFlag = false;

    $courseFormVisible = false;

    if (!empty($_GET['course']) && $_GET['course'] == -1) {
      $courseFormVisible = true;
    }

    $studentFormVisible = false;

    if (!empty($_GET['student']) && $_GET['student'] == -1) {
      $studentFormVisible = true;
      $coursesList = $courses;
    }

    if (!empty($_GET['student']) && !empty($students[$_GET['student']])) {

      $coursesList = SchoolBLL::getStudentCourses($_GET['student']);
      $editedStd = $students[$_GET['student']];
      $studentFormVisible = true;
    }

    if(!empty($_GET['viewstudent']) && !empty($students[$_GET['viewstudent']])) {
      //debug('view student');
      $viewdStdCrs = SchoolBLL::getStudentCourses($_GET['viewstudent']);
      $viewdStd = $students[$_GET['viewstudent']];
      $viewStdFlag = true;
    }


    if (isset($_POST['submit'])) {
      $res = NULL;
      $imgDir = 'courses';
      if (isset($_POST['description']) && !empty($_POST['description'])
        && isset($_POST['id']) && !empty($_POST['id'])
        && isset($_POST['name']) && !empty($_POST['name'])
        && isset($_POST['file-name']) && !empty($_POST['file-name'])

        ) {
          $_POST['image'] = $_POST['file-name'];
          $tempCourse = new Course($_POST);

          if($_POST['id'] == -1) {
            $res = SchoolBLL::createCourse($tempCourse);

            if ($res['insertResult'] == false) {
              $messageColor = 'red';
              $messageHead = 'Action aborted';
              $messageMain = 'Sorry, we could not create the course '.$_POST['name'] .'.<br /><br /> Please use a differnt name and then try again. <br /><br />If you keep seeing this massage - please contact the site manager. ';

            } else {
              if(!empty($_FILES["fileToUpload"]["name"]))
                SchoolBLL::updateCourse($res['recordId'], ['image'=>$res['recordId']. $_POST['file-name']]);

              $messageColor = 'green';
              $messageHead = 'Success';
              $messageMain = 'The course '. $_POST['name']. ' was created successfully!';
              $messageMain.=uploadImage($imgDir, $res['recordId']. $_POST['file-name'] );
            }
              $messageURL = 'school.php';
            include __DIR__.'/messaging.php';

          }
          debug($tempCourse);

        debug($_POST);

      } elseif (
        

        isset($_POST['email']) && !empty($_POST['email'])
        && !empty($_POST['name'])
        && !empty($_POST['phone'])
        && !empty($_POST['file-name'])
        ) {
          $imgDir = 'students-profile';
          $_POST['image'] = $_POST['file-name'];
          if  ($_POST['id'] == -1) {
            $tempStudent = new Student($_POST);

            // debug($tempStudent);

            $res = SchoolBLL::createStudent($tempStudent);
            if ($res['recordId'] >= 0){
              SchoolBLL::setCoursesToStudent($res['recordId'], $_POST);

              if(!empty($_FILES["fileToUpload"]["name"]))
                SchoolBLL::updateStudent($res['recordId'], ['image'=>$res['recordId']. $_POST['file-name']]);

              $messageColor = 'green';
              $messageHead = 'Success';
              $messageMain = 'The student '. $params['name']. ' was created successfully!';
              $messageMain.=uploadImage($imgDir, $res['recordId']. $_POST['file-name'] );
              $messageURL = 'school.php';
              include __DIR__.'/messaging.php';
            }
          }
        
      }
      else {
        debug ('not set');
      }
    }



 ?>
