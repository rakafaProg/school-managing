<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="..\node_modules\bootstrap\dist\css\bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/form-elements.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <title>The School - Login</title>
  </head>
  <body>

    <main class="bg-grey">
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
            <a class="navbar-brand" href="#">WebSiteName</a>
          </div>
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Page 1</a></li>
            <li><a href="#">Page 2</a></li>
            <li><a href="#">Page 3</a></li>
          </ul>
        </div>
      </nav>

      <!-- Top content -->
          <div class="top-content">

              <div class="inner-bg">
                  <div class="container">
                      <div class="row">
                          <div class="col-sm-6 col-sm-offset-3 form-box">
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
  			                    <form role="form" action="" method="post" class="login-form">
  			                    	<div class="form-group">
  			                    		<label class="sr-only" for="form-username">Username</label>
  			                        	<input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
  			                        </div>
  			                        <div class="form-group">
  			                        	<label class="sr-only" for="form-password">Password</label>
  			                        	<input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
  			                        </div>
  			                        <button type="button" class="btn btn-primary">Sign in!</button>
  			                    </form>
  		                    </div>
                          </div>
                      </div>

                  </div>
              </div>

          </div>

    </main>


        <!-- Javascript -->
        <script src="..\node_modules\jquery\dist\jquery.min.js"></script>
        <script src="..\node_modules\bootstrap\dist\js\bootstrap.min.js"></script>
        <script src="../assets/js/form-validation.js"></script>


  </body>
</html>
