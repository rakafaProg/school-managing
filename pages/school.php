<?php include_once 'header.php';
      include_once '../controllers/main-controller.php';
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
          <a href="school.php?edit=-1#editingArea">
            <i class="add  green big icon" title="create new student"></i>
          </a>
        </div>
      </div>
<div class="ui divider">

</div>

      <div class="ui cards">

        <?php foreach ($courses as $course) { ?>

          <div class="card">

            <div class="content">
              <img class="ui circular image profile-img right floated" src="<?= $course->getImageURL() ?>">
              <div class="header">
                <?= $course->getName() ?>
              </div>
              <div class="meta">
                <?= $course->getStudentsCount() ?> students in the course
              </div>
              <div class="description">
                <?= $course->getDescription() ?>
              </div>
            </div>

            <div class="extra content">
              <div class="ui two buttons">
                <a class="ui basic green button" href="school.php?viewcourse=<?= $course->getId() ?>#editingArea">View Details</a>
              </div>
            </div>

          </div>

        <?php } ?>

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
          <a href="school.php?edit=-1#editingArea">
            <i class="add user green big icon" title="create new student"></i>
          </a>
        </div>
      </div>
<div class="ui divider">
  
</div>

        <div class="ui cards">

          <?php foreach ($students as $student) { ?>

            <div class="card">

              <div class="content">
                <img class="ui circular image profile-img right floated" src="<?= $student->getImageURL() ?>">
                <div class="header">
                  <?= $student->getName() ?>
                </div>
                <div class="meta">
                  Listed to <?= $student->getCourseAmount() ?> courses
                </div>
                <div class="description">
                  Phone Number: <a href="tel:<?= $student->getPhone() ?>"><?= $student->getPhone() ?></a>
                </div>
                <div class="description">
                  Eamil Adress: <a href="mailto:<?= $student->getEmail() ?>"><?= $student->getEmail() ?></a>
                </div>
              </div>

              <div class="extra content">
                <div class="ui two buttons">
                  <a class="ui basic green button" href="school.php?viewstudent=<?= $student->getId() ?>#editingArea">View Details</a>
                </div>
              </div>

            </div>

          <?php } ?>

        </div>










      </div>




  </div>
  <div class="eight wide column">
    <div class="ui segment blue" id="editingArea">

      <div class="ui grid">
        <div class="eight wide column center">
          <div class="ui circular segment">
            <h2 class="ui header">
              Students:
              <div class="sub header">
                <?= count($students) ?> in total
              </div>
            </h2>

          </div>
        </div>
        <div class="eight wide column center" >
          <div class="ui inverted circular segment">
            <h2 class="ui inverted header">
              Courses:
              <div class="sub header"><?= count($courses) ?> in total</div>
            </h2>

          </div>
        </div>
      </div>










    </div>
  </div>

</div>
