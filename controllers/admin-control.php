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



 ?>
