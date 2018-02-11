<?php
    include_once "../data/admin_bll.php";

    if( isset($_SESSION['user']) && !empty($_SESSION['user'])) {
          header('Location: school.php');
          die;
        }

    if (isset($_POST['form-password']) && isset($_POST['form-username'])) {
      $user = array_values(AdminBLL::getAdmin($_POST['form-username'], MD5($_POST['form-password'])));
      if (isset($user[0]) && !empty($user[0])){
        $_SESSION['user'] = $user[0]->getAsArray();
        header('Location: school.php');
        die;
      } else {
        $errorMsg = 'Invalid username or password<br />Please try again';
        $_SESSION = [];
      }
    }



 ?>
