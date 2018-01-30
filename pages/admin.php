<?php require_once 'header.php';

require_once '../controllers/admin-control.php';

?>


<div class="ui two column stackable grid">

  <div class="six wide column">
    <div class="ui segment blue">

      <div class="ui two column grid">
        <div class="eleven wide column center">
          <div class="ui green header center">
            Administrators
          </div>
        </div>
        <div class="five wide column">
          <a href="admin.php?edit=-1">
            <i class="add user green big icon" title="create new administrator"></i>

          </a>

        </div>

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


      <form class="ui large form <?php if(!$formVisible) echo 'invisible';?>" action="admin.php" method="GET">

        <div class="ui left icon fluid input">
          <input type="text" placeholder="Name" name="form-username" value="<?php if(isset($editedAdmin)) echo $editedAdmin->getName(); ?>" required>
          <i class="user icon"></i>
        </div>

        <div class="ui left icon fluid input">
          <input type="text" placeholder="Phone" name="form-phone" value="<?php if(isset($editedAdmin)) echo $editedAdmin->getPhone(); ?>" required>
          <i class="call icon"></i>
        </div>

        <div class="ui left icon fluid input">
          <input type="text" placeholder="E-mail address" name="form-email" value="<?php if(isset($editedAdmin)) echo $editedAdmin->getEmail(); ?>" required>
          <i class="mail icon"></i>
        </div>


        <div class="ui left icon fluid input <?php if(!$roleVisible) echo 'invisible';?>">
          <select class="ui dropdown" name="form-role">
            <option value="" disabled <?php if(!isset($editedAdmin)) echo 'selected'; ?> >Select Role</option>
            <option value="1" disabled <?php if(isset($editedAdmin) && $editedAdmin->getRole()==1) echo 'selected'; ?>>Owner</option>
            <option value="2" <?php if(isset($editedAdmin) && $editedAdmin->getRole()==2) echo 'selected'; ?>>Manager</option>
            <option value="3" <?php if(isset($editedAdmin) && $editedAdmin->getRole()==3) echo 'selected'; ?>>Sales</option>
          </select>
          <i class="privacy icon"></i>
        </div>

           <div class="ui two column stackable grid">
            <div class="six wide column">
              <label for="file" class="ui icon  inverted green button">
                Load Profile Image...
                <i class="upload icon"></i>
              </label>
              <input class="invisible" type="file" id="file" accept="image/*" name="form-image">
            </div>
            <div class="ten wide column">
              <img class="ui fluid image" src="<?php if(isset($editedAdmin)) echo $editedAdmin->getImage(); ?>"  />
            </div>
          </div>


          <div>
            <button class="ui button fluid big green">
              Save
              <i class="checkmark icon"></i>
            </button>
          </div>



      </form>
    </div>
  </div>


</div>


<style>
  form {
    width: 90%;
    margin: auto;
  }

  select {
    padding-left: 2.67142857em!important;
  }

</style>

</script>