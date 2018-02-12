<?php


  if ($user->getRole() > 2) {
    require '../pages/permition-error.php';
    require '../pages/footer.php';
    die;
  }



  $formVisible = false;

  $adminsList = [];

  $adminsList = AdminBLL::getAllAdmins();



  if (isset($_GET['edit']) && isset($adminsList[$_GET['edit']])) {
    $editedAdmin = $adminsList[$_GET['edit']];
    $formVisible = true;
  }

  if (isset($_GET['edit']) && $_GET['edit'] == -1) {
    $formVisible = true;
  }

  if (isset($_POST['submit'])) {
      saveAdmin($_POST);
  }


  if (isset($_GET['delete']) && !empty($_GET['delete']) ) {
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




  function saveAdmin ($params) {
    if (isset($params['id'])) {

      $imgDir = 'users-profile';
      if($params['id'] == -1){
        if (
            isset($params['id']) && !empty($params['id'])
         && isset($params['name']) && !empty($params['name'])
         && isset($params['phone']) && !empty($params['phone'])
         && isset($params['email']) && !empty($params['email'])
         && isset($params['role']) && !empty($params['role'])
         && isset($params['file-name']) && !empty($params['file-name'])
         && isset($params['password']) && !empty($params['password'])
         && isset($params['repeat-password']) && !empty($params['repeat-password'])
         && $params['repeat-password'] == $params['password']
         ) {
           $res = '';
          $tempAdmin = new Administrator([
            'name' => $params['name'],
            'role' => $params['role'],
            'phone' => $params['phone'],
            'email' => $params['email'],
            'id' => NULL,
            'image' => 'default.png',
            'password' => md5($params['password'])]);
            $res = AdminBLL::createAdmin($tempAdmin);
            if ($res['insertResult'] == false) {
              $messageColor = 'red';
              $messageHead = 'Action aborted';
              $messageMain = 'Sorry, we could not create the user '.$params['name'] .'.<br /><br /> Please use a differnt email address and then try again. <br /><br />If you keep seeing this massage - please contact the site manager. ';

            } else {
              if(!empty($_FILES["fileToUpload"]["name"]))
                AdminBLL::updateAdmin($res['recordId'], ['image'=>$res['recordId']. $params['file-name']]);

              $messageColor = 'green';
              $messageHead = 'Success';
              $messageMain = 'The '.$tempAdmin->getRoleName().' '. $params['name']. ' was created successfully!';
              $messageMain.=uploadImage($imgDir, $res['recordId']. $params['file-name'] );
            }
              $messageURL = 'admin.php';
            include __DIR__.'/messaging.php';
        }
      } elseif ($params['id'] != 1 || $GLOBALS['user']->getId() == 1) {
        $mssgHead = "Updating....";
        $mssg = "";
        $updateder = [];
        // update password
        if (
            isset($params['password']) && !empty($params['password'])
          && isset($params['repeat-password']) && !empty($params['repeat-password'])
          && $params['repeat-password'] == $params['password']
            && $params['id'] == $GLOBALS['user']->getId()) {
              $updateder['password'] = md5($params['password']);
              $mssg .= '<br /> Password was updated.  <br />';


          }
          if (
            isset($params['role']) && !empty($params['role'])
          && ($params['role'] == 2 || $params['role'] == 3)
          && $GLOBALS['user']->getRole() == 1
          && $GLOBALS['user']->getId() != $params['id']
            ){
              $updateder['role'] = $params['role'];
            $mssg .= '<br /> Role was updated. <br />';


          }

          if (
            $GLOBALS['user']->getRole() < 3
            && isset($params['name']) && !empty($params['name'])
            && isset($params['phone']) && !empty($params['phone'])
            && isset($params['email']) && !empty($params['email'])
            && isset($params['file-name']) && !empty($params['file-name'])

          ) {

            $updateder['name'] = $params['name'];
            $updateder['phone'] = $params['phone'];
            $updateder['email'] = $params['email'];
            $updateder['image'] = $params['file-name'];

            $mssg .= '<br /> Basic user details where updated. <br />';

          }

          $result = AdminBLL::updateAdmin($params['id'], $updateder);

          if ($result['rowsEffected'] == 1){

            $messageColor = 'green';
            $messageHead = 'Updating status';
            $messageMain = 'Admin details where updated successfully.';
            if(!empty($_FILES["fileToUpload"]["name"]))
              $messageMain.=uploadImage($imgDir, $_POST['file-name']);

          } else {
            if(!empty($_FILES["fileToUpload"]["name"])){
              $messageColor = 'green';
              $messageHead = 'Updating status';
              $messageMain = 'Admin details where updated successfully.';
              $messageMain.=uploadImage($imgDir, $_POST['file-name']);
            } else {
            $messageColor = 'red';
            $messageHead = 'Update failed ';
            $messageMain = 'No data was updated. <br /> Please make sure that you have comitted changes on the user details, and that you have the permition to do so. ';
            }
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
