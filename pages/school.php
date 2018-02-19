<?php include_once 'header.php';
      include_once '../images-uploading/image-upload.php';
      include_once '../data/school_bll.php';
      include_once '../controllers/main-controller.php';
      include_once '../templates/templatesHandler.php';

      $card = new Card();
?>


<div class="ui two column stackable grid">
  <div class="four wide column">
    <div class="ui segment blue">


          <div class="ui green header">
            Courses
            <?php if ($user->getRole() < 3) { ?>
            <a class="ui image  right floated " href="school.php?course=-1#editingArea">
              <i class="large icons">
                <i class="student green icon"></i>
                <i class="corner green add icon"></i>
              </i>
            </a>
            <?php } ?>
          </div>


<div class="ui divider">

</div>

      <div class="ui cards">

        <?php

        foreach ($courses as $course) {
           $card->getCourseCardView($course);
         }
         ?>

      </div>






    </div>
  </div>


  <div class="four wide column">
    <div class="ui segment blue">




      <div class="ui green header">
        Students
        <a class="ui image  right floated " href="school.php?student=-1#editingArea">
          <i class="add user green large icon" title="create new student"></i>
        </a>
      </div>


      <div class="ui divider"> </div>

        <div class="ui cards">

          <?php foreach ($students as $student) {
            $card->getStudentCardView($student);
           } ?>

        </div>



      </div>




  </div>
  <div class="eight wide column"  id="editingArea">
    <div class="ui segment blue">


      <?php
      // $coursesList = SchoolBLL::getStudentCourses($_GET['student']);
      // $editedStd = $students[$_GET['viewstudent']];
      if ($courseFormVisible) {
        $form = new Form();
        if (isset($editedCrs))
           $form->editCourseForm($editedCrs);
        else
          $form->createNewCourseForm();

      } elseif ($studentFormVisible) {

        $form = new Form();
        if(!empty($editedStd))
          $form->editStudentForm($coursesList, $editedStd);
        else
          $form->createNewStudentForm($coursesList);
      } elseif($viewStdFlag) {
        $student = $viewdStd;
        include_once '../templates/student-view.php';
        //sdebug ('view student');

      } elseif($viewCrsFlag) {
        $course = $viewdCrs;
        include_once '../templates/course-view.php';
        //sdebug ('view student');

      }  else {

        echo '<div class="ui green huge header center">
          There are '.count($students). ' students,
        </div>';

        echo '<div class="ui green huge header center">
          and '.count($courses). ' courses in the school.
        </div>';
      }




      ?>



    </div>
  </div>

</div>
