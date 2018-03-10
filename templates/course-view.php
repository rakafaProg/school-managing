<!-- This template recive a course, and makes view for it -->

  <div class="ui green header">
    Course Details

    <?php if($user->getRole() < 3) { ?>
    <a class="ui basic green button right floated"
      href="school.php?course=<?= $course->getId() ?>#editingArea">
      Edit <?= $course->getName() ?>
    </a>
    <?php } ?>
  </div>
  <div class="ui divider"></div>



  <div class="ui two column stackable grid">

    <div class="six wide column">
      <img class="ui fluid image choosen-image" src="<?= $course->getImageURL() ?>"  />

    </div>
    <div class="one wide column">

    </div>
   <div class="nine wide column">
     <div class="ui green header">
       <?= $course->getName() ?> , <?= $course->getStudentsCount() ?> Students
     </div>
     <div>
       <?= nl2br ( $course->getDescription()) ?>
     </div>
   </div>

 </div>

 <div class="ui tall stacked segment" style="min-height:0; max-height: 500px;">
   <div class="ui green header">
     <?php  if ($course->getStudentsCount() > 0) echo "Students:"; else  echo "There are no students listed to this course"; ?>
   </div>
   <div class="ui divider"></div>

   <div class="ui two column stackable grid">

     <?php
        foreach ($viewdCrsStd as $std) {

          ?>

          <div class="column">
            <img class="ui circular image profile-img left floated" src="<?= $std->getImageURL() ?>" />
            <?= $std->getName() ?>
          </div>


    <?php     }

     ?>


   </div>

 </div>
