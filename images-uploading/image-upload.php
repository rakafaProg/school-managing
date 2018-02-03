<?php

function uploadImage() {

  $errorMassage = "";

  if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])) {
  $target_dir = __DIR__."/users-profile/";
  $target_file = $target_dir . $_POST['file-name'];
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $errorMassage = "File is not an image.";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 2000000) {
      $errorMassage .= "Sorry, your file is too large.";
      $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      $errorMassage .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      $errorMassage .= "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          debug ("The image was successfully uploaded");
      } else {
          $errorMassage .= "Sorry, there was an error uploading your file.";
      }
  }

  debug($errorMassage);


}

}





 ?>

<script>

function createObjectURL(object) {
    return (window.URL) ? window.URL.createObjectURL(object) : window.webkitURL.createObjectURL(object);
}

function revokeObjectURL(url) {
    return (window.URL) ? window.URL.revokeObjectURL(url) : window.webkitURL.revokeObjectURL(url);
}


  $(function() {
       $("input:file").change(function (){
         var src = createObjectURL(this.files[0]);
         $(".choosen-image").attr('src',src);
       });
    });


</script>

</body>
</html>
