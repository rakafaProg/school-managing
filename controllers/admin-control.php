<?php

    // Check for user permition in this page
    if ($user->getRole() > 2) {
      require '../pages/permition-error.php';
      require '../pages/footer.php';
      die;
    }

    // Get the list of all adming
    $adminsList = AdminBLL::getAllAdmins();

    // Set flag for view
    $notAlowed = false;
    $formVisible = false;

    // ---------- ADMIN FORM ----------
    if (isset($_GET['edit'])) {

      if ($_GET['edit'] == -1) // Create new admin
        $formVisible = true;

      elseif (!empty($adminsList[$_GET['edit']])) {

        // Check for permition
        if ($user->getRole() > $adminsList[$_GET['edit']]->getRole())
          $notAlowed = true;

        else { // Edit admin
          $editedAdmin = $adminsList[$_GET['edit']];
          $formVisible = true;
        }
      }
    }


    // ---------- SUBMIT FORM ----------
    if (isset($_POST['submit'])
      // check for repeated params:
      && !empty($_POST['id']) && !empty($_POST['name'])
      && !empty($_POST['email']) && !empty($_POST['phone'])
      && !empty($_POST['file-name'])
      ) {

        $_POST['image'] = 'default.png';
        $imgName = '';
        $imgDir = 'users-profile';
        $res = false;
        $mssg = 'Please make sure to fill all the fields before clicking on save.';

        // ---------- CREATE NEW ADMIN ----------
        if ($_POST['id'] == -1
            && !empty($_POST['role']) && $_POST['role'] != 1
            && !empty($_POST['password']) && !empty($_POST['repeat-password'])
            && $_POST['password'] === $_POST['repeat-password']
          ) {

          $_POST['password'] = md5($_POST['password']);
          $tempAdmin = new Administrator($_POST);
          $res = AdminBLL::createAdmin($tempAdmin);

          if ($res['insertResult'] == false) {
            // error
            $mssg = 'Sorry, we could not create the admin '.$_POST['name'] .'.
            <br /><br /> Please use a differnt email and then try again.
            <br /><br />If you keep seeing this massage - please contact the site manager. ';
            $res = false;
          } else {
            // admin successfully created
            $mssg = 'The admin '.$_POST['name'].' was created successfully.';
            $_POST['id'] = $res['recordId'];
            $imgName = $res['recordId']. $_POST['file-name'];
          }
        }


        // ---------- EDIT ADMIN ----------
        elseif (!empty($adminsList[$_POST['id']])) {

          $editedAdmin = $adminsList[$_POST['id']];

          // Edit basic details:
          $updatingList = [
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'phone' => $_POST['phone']
          ];

          // Role editing:
          if (!empty($_POST['role'])
              && $_POST['role'] > 1
              && $editedAdmin->getRole() >= $user->getRole()
              && $editedAdmin->getId() != $user->getId()
              ) {
              $updatingList['role'] = $_POST['role'];
          }

          // Password editing
          if ($user->getId() == $editedAdmin->getId()
                && !empty($_POST['password']) && !empty($_POST['repeat-password'])
                && $_POST['password'] === $_POST['repeat-password']
            )   {
              $updatingList['password'] = md5($_POST['password']);
          }

          $res = AdminBLL::updateAdmin($_POST['id'], $updatingList);

          if ($res['insertResult'] == false) {
            $mssg = 'Sorry, we could not update this admininstrator.';
            $res = false;
          } else {
            $mssg = 'The admininstrator '.$_POST['name'].' was updated successfully.';
            $imgName = $_POST['file-name'];
          }

        }


        // ---------- UPLOAD IMAGE ----------
        if ($res != false && !empty($_FILES["fileToUpload"]["name"])) {
          $upRes = uploadImage($imgDir, $imgName );

          if ($upRes === true)
            AdminBLL::updateAdmin($_POST['id'], ['image'=> $imgName ]);
          else
            $mssg .= $upRes;
        }

        // ---------- SEND MESSAGE TO USER ----------
        $messageColor = ($res == false) ? 'red' : 'green';
        $messageHead = ($res == false) ? 'Action Failed' : 'Action Success';
        $messageMain = $mssg;
        $messageURL = 'admin.php';
        include __DIR__.'/messaging.php';
    }


    // ---------- DELETE ADMIN ----------
    if (!empty($_GET['delete']) ) {
      $messageURL = 'admin.php';

      if (isset($_GET['aprooved'])) {
        $res = AdminBLL::deleteAdminById($_GET['delete']);
        if($res['rowsEffected'] == 1){
          $messageColor = 'green';
          $messageHead = 'Success';
          $messageMain = 'The user was successfuly deleted. ';

      } else {
        $messageColor = 'red';
        $messageHead = 'Action aborted';
        $messageMain = 'Sorry, we could not delete this user.<br /><br /> Please make sure the user exist, and that you are permitted to do this action. ';

      }}
      else {
        $messageColor = 'red';
        $messageHead = 'Confirm Action';
        $messageMain = 'Are you sure that you want to delete this user? <br /><br />This action cannot be canceld!';
        $messageOK = "Yes";
        $cancelURL = 'admin.php';
        $messageURL = 'admin.php?delete='.$_GET['delete'].'&aprooved';
      }

      include __DIR__.'/messaging.php';
    }












 ?>
