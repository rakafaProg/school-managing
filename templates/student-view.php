<?php

//$student = new Student(['name' => 'Black Star', 'id' => 6 , 'email'=>'black@gmail.com', 'image' => 'default.png', 'phone' => '42-42-564']);

?>

<div class="ui segment blue">
  <div class="ui green header">
    Student Details

    <a class="ui basic green button right floated"
      href="school.php?student=<?= $student->getId() ?>#editingArea">
      Edit <?= $student->getName() ?>
    </a>
  </div>
  <div class="ui divider"></div>



  <div class="ui two column grid">

    <div class="six wide column">
      <img class="ui fluid image choosen-image" src="<?= $student->getImageURL() ?>"  />

    </div>
    <div class="one wide column">

    </div>
   <div class="nine wide column">
     <div class="ui green header">
       <?= $student->getName() ?>
     </div>
     <div>
       <a href="tel:<?= $student->getPhone() ?>"><?= $student->getPhone() ?></a>
     </div>
     <div>
       <a href="mailto:<?= $student->getEmail() ?>"><?= $student->getEmail() ?></a>
     </div>
   </div>

 </div>

 <div class="ui tall stacked segment" style="min-height:0">
   <div class="ui green header">
     Courses:
   </div>
   <div class="ui divider"></div>

   <div class="ui two column stackable grid">

     <?php
        foreach ($viewdStdCrs as $crs) {?>

          <div class="column">
            <img class="ui circular image profile-img left floated" src="<?= $crs->getImageURL() ?>" />
            <?= $crs->getName() ?>
          </div>


    <?php      }

     ?>


   </div>

 </div>



</div>
