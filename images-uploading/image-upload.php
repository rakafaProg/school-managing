<?php

function uploadImage($imgDir, $imgName) {

  $errorMassage = "";

  if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])) {
  $target_dir = __DIR__."/".$imgDir."/";
  $target_file = $target_dir . $imgName; // $_POST['file-name'];
  $uploadOk = 1;

  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $errorMassage .= "<br /><br />Cannot read this file as an image. <br /><br />Please make sure your image is less than 2 Mb.";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 2097152) {
      $errorMassage .= "<br /><br />Sorry, your file is too large.";

      $uploadOk = 0;
  }



  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif"
  && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG"
  && $imageFileType != "GIF" ) {
      $errorMassage .= "<br /><br />Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }


  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {

  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
          $errorMassage = true;
      } else {
          $errorMassage .= "<br /><br />Sorry, there was an error uploading your file.";
      }
  }

  return $errorMassage;

}

}





 ?>



</body>
</html>
