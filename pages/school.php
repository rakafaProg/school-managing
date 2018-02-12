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


      <div class="ui two column grid">
        <div class="eleven wide column center">
          <div class="ui green header center">
            Courses
          </div>
        </div>
        <div class="five wide column">
          <a href="school.php?course=-1#editingArea">
            <i class="add  green big icon" title="create new course"></i>
          </a>
        </div>
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
      <div class="ui two column grid">
        <div class="eleven wide column center">
          <div class="ui green header center">
            Students
          </div>
        </div>
        <div class="five wide column">
          <a href="school.php?student=-1#editingArea">
            <i class="add user green big icon" title="create new student"></i>
          </a>
        </div>
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

      if ($courseFormVisible) {
        $form = new Form();
        if (isset($editedAdmin))
           $form->createAdminEditForm($editedAdmin, $user);
        else
          $form->createNewCourseForm();

      } elseif ($studentFormVisible) {
        $form = new Form();
        $form->createNewStudentForm($coursesList);
      }   else {

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
