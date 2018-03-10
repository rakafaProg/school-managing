<?php include_once 'session.php'; // Start session only once.
    include_once "../data/admin_bll.php";


    // If user already logged in - Send to main page.
    if( isset($_SESSION['user']) && !empty($_SESSION['user'])) {
          header('Location: school.php');
          die;
        }

    // User Sent log-in Form:
    // Check name and password
    if (isset($_POST['form-password']) && isset($_POST['form-username'])) {

      $user = array_values(AdminBLL::getAdmin($_POST['form-username'], MD5($_POST['form-password'])));
      if (!empty($user[0])){
        $_SESSION['user'] = $user[0]->getAsArray();
        header('Location: school.php');
        die;
      } else {
        // Wrong password - send error massage to user.
        $errorMsg = 'Invalid username or password<br />Please try again';
        $_SESSION = [];
      }
    }



 ?>
