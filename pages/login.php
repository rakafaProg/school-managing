<?php include_once 'header.php';
  include_once '../controllers/login-control.php';
?>

<main>

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
              <input type="text" placeholder="Password" name="form-password" required>
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

        <!-- <div class="errorMsg" id="errorMsg">

        </div> -->








<!--
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3 form-box">

                <div class="form-top">
                    <div class="form-top-left">
                        <h3>Login to our site</h3>
                        <p>Enter your username and password to log on:</p>
                    </div>
                    <div class="form-top-right">
                        <i class="fa fa-lock"></i>
                    </div>
                </div>

                <div class="form-bottom">
                    <form role="form" action="login.php" method="post" class="login-form" novalidate>
                        <div class="form-group input-error">
                            <label class="sr-only" for="form-username">Username</label>
                            <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="form-password">Password</label>
                            <input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password" required>
                        </div>
                        <div id='errorMsg' class="error-massage">
                            <?php if(isset($errorMsg)){echo $errorMsg;} ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in!</button>
                    </form>
                </div>

            </div>
        </div>
    </div> -->

</main>

<style type="text/css">
   .column {
     max-width: 450px;
   }
 </style>

<script src="../assets/js/form-validation.js"></script>

<?php include_once 'footer.php'; ?>
