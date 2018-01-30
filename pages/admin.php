<?php require_once 'header.php';

require_once '../controllers/admin-control.php';

?>


<div class="ui two column stackable grid">

  <div class="six wide column">
    <div class="ui segment blue">
      <div class="ui green header">
        Administrators
      </div>
      <div class="ui divider">

      </div>

        <div class="ui cards">

          <?php foreach ($adminsList as $admin) { ?>

            <div class="card">

              <div class="content">
                <img class="ui circular image profile-img right floated" src="<?= $admin->getImage() ?>">
                <div class="header">
                  <?= $admin->getName() ?>
                </div>
                <div class="meta">
                  <?= $admin->getRoleName() ?>
                </div>
                <div class="description">
                  Phone Number: <a href="tel:<?= $admin->getPhone() ?>"><?= $admin->getPhone() ?></a>
                </div>
                <div class="description">
                  Eamil Adress: <a href="mailto:<?= $admin->getEmail() ?>"><?= $admin->getEmail() ?></a>
                </div>
              </div>

              <div class="extra content">
                <?= editDeleteBtnsForAdmins($admin, $user) ?>
              </div>

            </div>

          <?php } ?>

        </div>



    </div>
  </div>

  <div class="ten wide column">
    <div class="ui segment blue">
      <div class="ui green header">
        Add or Edit Administrator
      </div>
      <div class="ui divider">

      </div>
    </div>
  </div>


</div>
