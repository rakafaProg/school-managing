<?php
include_once '../pages/header.php';

if(isset($_POST["submit"])) {
$target_dir = "users-profile/";

debug($_FILES);
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      debug ("File is an image - " . $check["mime"] . ".");
      $uploadOk = 1;
  } else {
      debug ("File is not an image.");
      $uploadOk = 0;
  }


// Check if file already exists
if (file_exists($target_file)) {
    debug ("Sorry, file already exists.");
    $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    debug ("Sorry, your file is too large.");
    $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    debug ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    $uploadOk = 0;
}


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    debug ("Sorry, your file was not uploaded.");
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        debug ("The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.");
    } else {
        debug ("Sorry, there was an error uploading your file.");
    }
}




}







 ?>



 <!DOCTYPE html>
<html>
<body>


<h4 class="ui header">
        Image Content
        <span class="ui teal label">
          New in 2.0
        </span>
      </h4>
      <p>A modal can contain image content</p>
      <div class="ui ignored info message">
        Modals with image content must use the <code>image content</code> class in <code>2.0</code>. This is to make sure flex-box rules do not affect regular content.
      </div>
      <div class="code" data-type="html">
        <div class="ui modal">
          <div class="ui middle aligned center aligned grid">
            <div class="column">


                <form class="ui large form login-form" action="" method="POST" novalidate  enctype="multipart/form-data">

                  <div class="ui stacked segment">

                    <h2 class="ui olive image header">
                      <img src="../assets/images/logo.png" class="image">
                        <div class="content">
                          Choose your image
                        </div>
                      </h2>

                      <div class="ui divider"></div>

                      <div class="ui two column stackable grid">
                       <div class="six wide column">
                         <label for="file" class="ui icon  inverted green button">
                           Load Profile Image...
                           <i class="upload icon"></i>
                         </label>
                         <input class="invisible" type="file" id="file" accept="image/*" name="fileToUpload">
                       </div>
                       <div class="ten wide column">
                         <img class="ui fluid image choosen-image" src="<?php if(isset($editedAdmin)) echo $editedAdmin->getImage(); ?>"  />
                       </div>
                     </div>
                     File Name:
                     <div class="filename">

                     </div>
                     <div class="ui  icon fluid input center">
                       <input type='submit' name="submit" class="ui button fluid big green center" value="Save">
                       <i class="checkmark icon"></i>
                     </div>



                </form>
        </div>
        </div>
        </div>
      </div>
<button class="open-modal">open modal</button>



<script>

function createObjectURL(object) {
    return (window.URL) ? window.URL.createObjectURL(object) : window.webkitURL.createObjectURL(object);
}

function revokeObjectURL(url) {
    return (window.URL) ? window.URL.revokeObjectURL(url) : window.webkitURL.revokeObjectURL(url);
}




// open modal
        $(".open-modal").click(function(e) {

            $('.ui.modal')
            .modal('show');
        });

        $(function() {
             $("input:file").change(function (){

               var src = createObjectURL(this.files[0]);
               //var fileName = $(this).val();
               $(".choosen-image").attr('src',src);
             });
          });


</script>

</body>
</html>
