<?php require_once 'header.php';

include_once '../images-uploading/image-upload.php';

require_once '../controllers/admin-control.php';

include_once '../templates/templatesHandler.php'

?>



<div class="ui two column stackable grid">

  <div class="six wide column">
    <div class="ui segment blue">

      <div class="ui green header">
        Administrators
        <a class="ui image  right floated " href="admin.php?edit=-1#editingArea">
          <i class="add user green large icon" title="create new administrator"></i>

        </a>
      </div>




      <div class="ui divider"></div>

        <div class="ui cards">

          <?php
          $card = new Card();
          foreach ($adminsList as $admin) {
            $card->getAdminCardView($admin, $user);
           }
           ?>

        </div>



    </div>
  </div>

  <div class="ten wide column" id="editingArea">
    <div class="ui segment blue">
      <?php

        if ($notAlowed) {
          include "permition-error.php";
        }

        elseif ($formVisible) {
          $form = new Form();
          if (isset($editedAdmin))
             $form->createAdminEditForm($editedAdmin, $user);
          else
            $form->createNewAdminForm();
        } else {

          echo '<div class="ui green huge header center">
            There are '.count($adminsList). ' admins in the school.
          </div>';
        }
      ?>



    </div>
  </div>


</div>
