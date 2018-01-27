<?php
include_once 'header.php';
  include_once '../controllers/login-control.php';
?>

<main>

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
    </div>

</main>

<script src="../assets/js/form-validation.js"></script>

<?php include_once 'footer.php'; ?>
