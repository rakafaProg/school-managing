<?php


    // Check for user permition in this page
    if(!isset($_SESSION['user'])) {
      header('Location: login.php');
      die;
    }

    // Get students and courses for the left lists
    $students = SchoolBLL::getAllStudents();
    $courses = SchoolBLL::getAllCourses();

    // Set flags for view
    $notAlowed = false;
    $viewStdFlag = false;
    $viewCrsFlag = false;
    $courseFormVisible = false;
    $studentFormVisible = false;


    // ---------- COURSE VIEW ----------
    if(!empty($_GET['viewcourse']) && !empty($courses[$_GET['viewcourse']])) {

      $viewdCrsStd = SchoolBLL::getCoursesStudents($_GET['viewcourse']);
      $viewdCrs = $courses[$_GET['viewcourse']];
      $viewCrsFlag = true;
    } // ---------- END COURSE VIEW ----------


    // ---------- COURSE FORM ----------
    if (!empty($_GET['course'])) {

      // Check for permition
      if ($user->getRole() > 2)
        $notAlowed = true;

      else {
        if ($_GET['course'] == -1) // Create new course
          $courseFormVisible = true;

        elseif (!empty($courses[$_GET['course']])) { // Edit existing course
          $editedCrs = $courses[$_GET['course']];
          $courseFormVisible = true;
        }
      }
    } // ---------- END COURSE FORM ----------


    // ---------- STUDENT VIEW ----------
    if(!empty($_GET['viewstudent']) && !empty($students[$_GET['viewstudent']])) {

      $viewdStdCrs = SchoolBLL::getStudentCourses($_GET['viewstudent']);
      $viewdStd = $students[$_GET['viewstudent']];
      $viewStdFlag = true;
    } // ---------- END STUDENT VIEW ----------


    // ---------- STUDENT FORM ----------
    if (!empty($_GET['student'])) {

        if ($_GET['student'] == -1) { // Create new student
          $studentFormVisible = true;
          $coursesList = $courses;

        } elseif (!empty($students[$_GET['student']])) { // Edit existing student
          $coursesList = SchoolBLL::getStudentCourses($_GET['student']);
          $editedStd = $students[$_GET['student']];
          $studentFormVisible = true;
        }

    } // ---------- END STUDENT FORM ----------


    // ---------- SUBMIT FORM ----------
    if (isset($_POST['submit'])
      // check for repeated params:
      && !empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['file-name'])) {

        $_POST['image'] = 'default.png';
        $imgName = '';
        $res = false;
        $mssg = 'Please make sure to fill all the fields before clicking on save.';
        $link = '';

        // ---------- COURSE SUBMIT ----------
        if ( $user->getRole() < 3 && !empty($_POST['description'])) {
          $imgDir = 'courses';

          // ---------- COURSE NEW ----------
          if ($_POST['id'] == -1) {
            $tempCourse = new Course($_POST);
            $res = SchoolBLL::createCourse($tempCourse);

            if ($res['insertResult'] == false) {
              // error
              $mssg = 'Sorry, we could not create the course '.$_POST['name'] .'.
              <br /><br /> Please use a differnt name and then try again.
              <br /><br />If you keep seeing this massage - please contact the site manager. ';
              $res = false;
            } else {
              // course successfully created
              $mssg = 'The course '.$_POST['name'].' was created successfully.';
              $_POST['id'] = $res['recordId'];
              $imgName = $res['recordId']. $_POST['file-name'];
            }
          }

          // ---------- COURSE UPDATE ----------
          elseif (!empty($courses[$_POST['id']])) {

            $res = SchoolBLL::updateCourse(
              $_POST['id'], [
                'name'=>$_POST['name'],
                'description'=>$_POST['description']
              ]);

            if ($res['insertResult'] == false) {
              $mssg = 'Sorry, we could not update this course.';
              $res = false;
            } else {
              $mssg = 'The course '.$_POST['name'].' was updated successfully.';
              $imgName = $_POST['file-name'];
            }
          }

          // ---------- UPLOAD IMAGE ----------
          if ($res != false && !empty($_FILES["fileToUpload"]["name"])) {
            $upRes = uploadImage($imgDir, $imgName );

            if ($upRes === true)
              SchoolBLL::updateCourse($_POST['id'], ['image'=> $imgName ]);
            else
              $mssg .= $upRes;
          }

          $link = $res ? 'school.php?viewcourse='.$_POST['id'].'#editingArea' : '';

        } // ---------- END COURSE SUBMIT ----------


        // ---------- STUDENT SUBMIT ----------
        elseif (!empty($_POST['email']) && !empty($_POST['phone'])) {
          $imgDir = 'students-profile';

          // ---------- STUDENT NEW ----------
          if ($_POST['id'] == -1) {
            $tempStudent = new Student($_POST);
            $res = SchoolBLL::createStudent($tempStudent);

            if ($res['insertResult'] == false) {
              // error
              $mssg = 'Sorry, we could not create the student '.$_POST['name'] .'.
              <br /><br /> Please use a differnt email and then try again.
              <br /><br />If you keep seeing this massage - please contact the site manager. ';
              $res = false;
            } else {
              // student successfully created
              $mssg = 'The student '.$_POST['name'].' was created successfully.';
              $_POST['id'] = $res['recordId'];
              $imgName = $res['recordId']. $_POST['file-name'];
            }
          }

          // ---------- STUDENT UPDATE ----------
          elseif (!empty($students[$_POST['id']])) {
            $res = SchoolBLL::updateStudent(
              $_POST['id'],
              [
                'name'=>$_POST['name'],
                'email'=>$_POST['email'],
                'phone'=>$_POST['phone']
              ]
            );

            if ($res['insertResult'] == false) {
              $mssg = 'Sorry, we could not update this student.';
              $res = false;
            } else {
              $mssg = 'The student '.$_POST['name'].' was updated successfully.';
              $imgName = $_POST['file-name'];
            }
          }

          // ---------- UPLOAD IMAGE ----------
          if ($res != false && !empty($_FILES["fileToUpload"]["name"])) {
            $upRes = uploadImage($imgDir, $imgName );

            if ($upRes === true)
              SchoolBLL::updateStudent($_POST['id'], ['image'=> $imgName ]);
            else
              $mssg .= $upRes;
          }

          // sign student to courses
          if ($res != false) {
            SchoolBLL::setCoursesToStudent($_POST['id'], $_POST);
            $link = 'school.php?viewstudent='.$_POST['id'].'#editingArea';
          }

        } // ---------- END STUDENT SUBMIT ----------


        // ---------- SEND MESSAGE TO USER ----------
        $messageColor = ($res == false) ? 'red' : 'green';
        $messageHead = ($res == false) ? 'Action Failed' : 'Action Success';
        $messageMain = $mssg;
        $messageURL = $link;
        include __DIR__.'/messaging.php';

    }  // ---------- END SUBMIT FORM ----------

    // ---------- DELETE STUDENT ----------
    if (!empty($_GET['delstd'])) {
      $messageURL = 'school.php';

      if (isset($_GET['aprooved'])) {
        $res = SchoolBLL::deleteStudent($_GET['delstd']);
        if($res['rowsEffected'] == 1){
          $messageColor = 'green';
          $messageHead = 'Success';
          $messageMain = 'The student was successfuly deleted. ';

      } else {
        $messageColor = 'red';
        $messageHead = 'Action aborted';
        $messageMain = 'Sorry, we could not delete this student.<br /><br /> Please make sure the student exist, and that you are permitted to do this action. ';

      }}
      else {
        $messageColor = 'red';
        $messageHead = 'Confirm Action';
        $messageMain = 'Are you sure that you want to delete this student? <br /><br />This action cannot be canceld!';
        $messageOK = "Yes";
        $cancelURL = 'school.php';
        $messageURL = 'school.php?delstd='.$_GET['delstd'].'&aprooved';
      }

      include __DIR__.'/messaging.php';
    }


    // ---------- DELETE COURSE ----------
    if (!empty($_GET['delcrs']) && $user->getRole() < 3) {
      $messageURL = 'school.php';

      if (isset($_GET['aprooved'])) {
        $res = SchoolBLL::deleteCourse($_GET['delcrs']);
        if($res['rowsEffected'] == 1){
          $messageColor = 'green';
          $messageHead = 'Success';
          $messageMain = 'The course was successfuly deleted. ';

      } else {
        $messageColor = 'red';
        $messageHead = 'Action aborted';
        $messageMain = 'Sorry, we could not delete this course.<br /><br /> Please make sure the course exist, and that you are permitted to do this action. ';

      }}
      else {
        $messageColor = 'red';
        $messageHead = 'Confirm Action';
        $messageMain = 'Are you sure that you want to delete this course? <br /><br />This action cannot be canceld!';
        $messageOK = "Yes";
        $cancelURL = 'school.php';
        $messageURL = 'school.php?delcrs='.$_GET['delcrs'].'&aprooved';
      }

      include __DIR__.'/messaging.php';
    }


 ?>
