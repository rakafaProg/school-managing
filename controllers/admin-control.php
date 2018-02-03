<?php

  if ($user->getRole() > 2) {
    require '../pages/permition-error.php';
    require '../pages/footer.php';
    die;
  }



  $formVisible = false;
  $roleVisible = false;

  $adminsList = [];

  $adminsList = BLL::getAdminsByRole($user->getRole());

  function editDeleteBtnsForAdmins($admin, $user) {
    $htmlResult = '<div class="ui two buttons">';
    $htmlResult .= '<a class="ui basic green button" href="admin.php?edit='.$admin->getId().'#editingArea">Edit</a>';

    if (  $admin->getRole() != 1 &&
      $user->getId() != $admin->getId() ) {
      $htmlResult .= '<a class="ui basic red button delete" href="admin.php?delete='.$admin->getId().'">Delete</a>';
    }

    $htmlResult .= '</div>';
    return $htmlResult;
  }

  if (isset($_GET['edit']) && isset($adminsList[$_GET['edit']])) {
    $editedAdmin = $adminsList[$_GET['edit']];
    $formVisible = true;
  }

  if (isset($_GET['edit']) && $_GET['edit'] == -1) {
    $formVisible = true;
    $roleVisible = true;
  }

  if ($user->getRole() == 1) {
    $roleVisible = true;
  }

  if (isset($_POST['submit'])) {
      saveAdmin($_POST);

  }


  if (isset($_GET['delete']) && !empty($_GET['delete']) ) {
    $messageURL = 'admin.php';
    if (isset($_GET['aprooved'])) {
    if((BLL::deleteAdminById($_GET['delete']))['rowsEffected'] == 1){
      $messageColor = 'green';
      $messageHead = 'Success';
      $messageMain = 'The user was successfuly created. ';

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




  function saveAdmin ($params) {
    if (isset($params['admin-id'])) {


      if($params['admin-id'] == -1){
        if (
            isset($params['admin-id']) && !empty($params['adminid'])
         && isset($params['form-username']) && !empty($params['form-username'])
         && isset($params['form-phone']) && !empty($params['form-phone'])
         && isset($params['form-email']) && !empty($params['form-email'])
         && isset($params['form-role']) && !empty($params['form-role'])
         && isset($params['file-name']) && !empty($params['file-name'])
         && isset($params['form-password']) && !empty($params['form-password'])
         && isset($params['form-repeat-password']) && !empty($params['form-repeat-password'])
         && $params['form-repeat-password'] == $params['form-password']
         ) {
          $tempAdmin = new Administrator([
            'name' => $params['form-username'],
            'role' => $params['form-role'],
            'phone' => $params['form-phone'],
            'email' => $params['form-email'],
            'id' => NULL,
            'image' => $params['file-name'],
            'password' => md5($params['form-password'])]);
            $res = BLL::createAdmin($tempAdmin);
            if ($res == false) {
              $messageColor = 'red';
              $messageHead = 'Action aborted';
              $messageMain = 'Sorry, we could not create the user '.$params['form-username'] .'.<br /><br /> Please use a differnt email address and then try again. <br /><br />If you keep seeing this massage - please contact the site manager. ';

            } else {
              uploadImage();
              $messageColor = 'green';
              $messageHead = 'Success';
              $messageMain = 'The '.$tempAdmin->getRoleName().' '. $params['form-username']. ' was created successfully!';

            }
              $messageURL = 'admin.php';
            include __DIR__.'/messaging.php';
        }
      } elseif ($params['admin-id'] != 1 || $GLOBALS['user']->getId() == 1) {
        $mssgHead = "Updating....";
        $mssg = "";
        $updateder = [];
        // update password
        if (
            isset($params['form-password']) && !empty($params['form-password'])
          && isset($params['form-repeat-password']) && !empty($params['form-repeat-password'])
          && $params['form-repeat-password'] == $params['form-password']
            && $params['admin-id'] == $GLOBALS['user']->getId()) {
              $updateder['password'] = $params['form-password'];
              $mssg .= '<br /> Password was updated.  <br />';


          }
          if (
            isset($params['form-role']) && !empty($params['form-role'])
          && ($params['form-role'] == 2 || $params['form-role'] == 3)
          && $GLOBALS['user']->getRole() == 1
          && $GLOBALS['user']->getId() != $params['admin-id']
            ){
              $updateder['role'] = $params['form-role'];
            $mssg .= '<br /> Role was updated. <br />';


          }

          if (
            $GLOBALS['user']->getRole() < 3
            && isset($params['form-username']) && !empty($params['form-username'])
            && isset($params['form-phone']) && !empty($params['form-phone'])
            && isset($params['form-email']) && !empty($params['form-email'])
            && isset($params['file-name']) && !empty($params['file-name'])

          ) {

            $updateder['name'] = $params['form-username'];
            $updateder['phone'] = $params['form-phone'];
            $updateder['email'] = $params['form-email'];
            $updateder['image'] = $params['file-name'];

            $mssg .= '<br /> Basic user details where updated. <br />';

          }

          $result = BLL::updateAdmin($params['admin-id'], $updateder);

          if ($result['rowsEffected'] == 1){
            uploadImage();
            $messageColor = 'green';
            $messageHead = 'Updating status';
            $messageMain = 'Admin details where updated successfully.';

          } else {
            $messageColor = 'red';
            $messageHead = 'Update failed ';
            $messageMain = 'No data was updated. <br /> Please make sure that you have comitted changes on the user details, and that you have the permition to do so. ';
          }

          $messageURL = 'admin.php';
          include __DIR__.'/messaging.php';

      }

    }

    if (!isset($messageHead)) {
      $messageColor = 'red';
      $messageHead = 'Update failed ';
      $messageMain = 'No data was updated.';
      $messageURL = 'admin.php';
      include __DIR__.'/messaging.php';
    }
  }







 ?>
