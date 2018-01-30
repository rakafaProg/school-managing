<?php include_once 'header.php';
  include_once '../controllers/login-control.php';
?>


  <div class="ui middle aligned center aligned grid">
    <div class="column">


        <form class="ui large form login-form" action="login.php" method="POST" novalidate>

          <div class="ui stacked segment">

            <h2 class="ui olive image header">
              <img src="../assets/images/logo.png" class="image">
                <div class="content">
                  Log-in to your account
                </div>
              </h2>

              <div class="ui divider"></div>

            <div class="ui left icon fluid input">
              <input type="text" placeholder="E-mail address" name="form-username" required>
              <i class="user icon"></i>
            </div>

            <div class="ui left icon fluid input">
              <input type="password" placeholder="Password" name="form-password" required>
              <i class="lock icon"></i>
            </div>

            <div>
              <button class="ui fluid large blue submit button">Login</button>
            </div>

            <div class="ui header red errorMsg" id="errorMsg">
              <?php if(isset($errorMsg)){echo $errorMsg;} ?>
            </div>

          </div>



        </form>


<style type="text/css">
   .column {
     max-width: 450px;
   }
 </style>

<script src="../assets/js/form-validation.js"></script>

<?php include_once 'footer.php'; ?>
