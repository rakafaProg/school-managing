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
    $htmlResult .= '<a class="ui basic green button" href="admin.php?edit='.$admin->getId().'">Edit</a>';

    if (  $admin->getRole() != 1 &&
      $user->getId() != $admin->getId() ) {
      $htmlResult .= '<div class="ui basic red button">Delete</div>';
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
  } else {
    debug('not set');
    debug($_POST);
  }



  function saveAdmin ($params) {
    debug('set');
    debug($_POST);
    if (pExist($params['admin-id'])) {
      uploadImage();

      if($params['admin-id'] == -1){
        debug('create new');
        if (
            pExist($params['admin-id'])
         && pExist($params['form-username'])
         && pExist($params['form-phone'])
         && pExist($params['form-email'])
         && pExist($params['form-role'])
         && pExist($params['file-name'])
         && pExist($params['form-password'])
         && pExist($params['form-repeat-password'])
         && $params['form-repeat-password'] == pExist($params['form-password'])
         ) {
          $tempAdmin = new Administrator([
            'name' => $params['form-username'],
            'role' => $params['form-role'],
            'phone' => $params['form-phone'],
            'email' => $params['form-email'],
            'id' => NULL,
            'image' => $params['file-name'],
            'password' => md5($params['form-password'])]);
            BLL::createAdmin($tempAdmin);
        }
      }

    }
  }

  function pExist($param) {
    return isset($param) && !empty($param);
  }



 ?>
