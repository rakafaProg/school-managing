<?php
    include_once "../data/bll.php";

    if( isset($_SESSION['user-id']) && !empty($_SESSION['user-id'])
        && isset($_SESSION['user-role']) && !empty($_SESSION['user-role']) ) {
          header('Location: school.php');
          die;
        } else {
            debug($_SESSION);
        }

    if (isset($_POST['form-password']) && isset($_POST['form-username'])) {
      $user = BLL::getAdmin($_POST['form-username'], MD5($_POST['form-password']));
      if (isset($user[0]) && !empty($user[0])){
        $_SESSION['user-id'] = $user[0]->getId();
        $_SESSION['user-name'] = $user[0]->getName();
        $_SESSION['user-role'] = $user[0]->getRole();
        header('Location: school.php');
        die;
      } else {
        $errorMsg = 'Invalid username or password<br />Please try again';
        $_SESSION = [];
      }
    }



 ?>
