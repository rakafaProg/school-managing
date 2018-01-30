<?php

  if ($user->getRole() > 2) {
    require '../pages/permition-error.php';
    require '../pages/footer.php';
    die;
  }

  $adminsList = [];

  $adminsList = BLL::getAllAdmins();

  function editDeleteBtnsForAdmins($admin, $user) {
    $htmlResult = '<div class="ui two buttons">';
    $htmlResult .= '<div class="ui basic green button">Edit</div>';

    if ($user->getRole() == 1 && $admin->getRole() != 1) {
      $htmlResult .= '<div class="ui basic red button">Delete</div>';
    }

    $htmlResult .= '</div>';
    return $htmlResult;
  }


 ?>
