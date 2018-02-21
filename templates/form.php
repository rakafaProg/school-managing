

<?php

 // $params = [
 //    'id' => '1',
 //    'header' => 'header',
 //    'inputs' => [
 //        [
 //          'type' => 'text',
 //          'placeholder' => 'Name',
 //          'name' => 'name',
 //          'value' => '',
 //          'icon' => 'user'
 //        ],
 //        [
 //          'type' => 'password',
 //          'placeholder' => 'Password',
 //          'name' => 'password',
 //          'value' => '',
 //          'icon' => 'user'
 //        ],
 //        [
 //          'type' => 'text',
 //          'placeholder' => 'Phone Number',
 //          'name' => 'phone',
 //          'value' => '',
 //          'icon' => 'user'
 //        ],
 //        [
 //          'type' => 'email',
 //          'placeholder' => 'Email Adress',
 //          'name' => 'email',
 //          'value' => '',
 //          'icon' => 'user'
 //        ]
 //    ],
 //    'dropdwon' => [
 //      'name' => 'name',
 //      'placeholder' => 'Select Role',
 //      'icon' => 'privacy',
 //      'options' => [
 //        ['value'=>1, 'extra' => 'disabled', 'text'=>'Owner'],
 //        ['value'=>2, 'extra' => '', 'text'=>'Manager'],
 //        ['value'=>3, 'extra' => '', 'text'=>'Sales'],
 //      ]
 //    ],
 //    'imageUrl' => '../images-uploading/users-profile/default.png',
 //    'imageName' => 'default.png'
 //
 // ];


?>






<div class="ui green header">
  <?= $params['header'] ?>
</div>
<div class="ui divider">

</div>


<form class="ui large form" action="" method="POST" enctype="multipart/form-data">

  <input name="id" class="invisible" type="text" id='form-id' value="<?= $params['id'] ?>" />

  <?php foreach ($params['inputs'] as $input) { ?>

    <div class="ui left icon fluid input">
      <input type="<?= $input['type'] ?>" placeholder="<?= $input['placeholder'] ?>" name="<?= $input['name'] ?>" value="<?= $input['value'] ?>" >
      <i class="<?= $input['icon'] ?> icon"></i>
    </div>

  <?php }


    if (isset($params['textarea'])) {
      echo '
      <div class"ui label">'.$params['textarea']['placeholder'].':</div>
      <div class="ui fluid input">
        <textarea name="'.$params['textarea']['name'].'" >'.$params['textarea']['value'].'</textarea>
      </div>';
    }

      if (isset($params['dropdwon'])) {
        echo '<div class="ui left icon fluid input">';
        echo '<select class="ui dropdown" name="'.$params['dropdwon']['name'].'">';
        if (isset($params['dropdwon']['placeholder']))
          echo '<option value="" disabled selected>'.$params['dropdwon']['placeholder'].'</option>';
        foreach ($params['dropdwon']['options'] as $option) {
          echo '<option value="'.$option['value'].'" '.$option['extra'].'>'.$option['text'].'</option>';
        }
        echo '</select>';
        echo '<i class="'.$params['dropdwon']['icon'].' icon"></i>';
        echo '</div>';
      }

  ?>




       <div class="ui two column stackable grid">
        <div class="six wide column">
          <label for="file" class="ui icon  inverted green button">
            Load Image...
            <i class="upload icon"></i>
          </label>
          <input class="invisible" type="file" id="file" accept="image/*" name="fileToUpload">
        </div>
        <div class="ten wide column">
          <img class="ui fluid image choosen-image" src="<?= $params['imageUrl'] ?>"  />
          <input name="file-name" class="invisible" type="text" id='fileName' value="<?= $params['imageName'] ?>" />
        </div>
      </div>

      <div>
        <?php if(isset($params['aditional']))
                  echo $params['aditional'];
        ?>
      </div>


       <div class="ui two buttons">

           <input type="submit" name="submit" class="ui inverted green button" value="Save">

       <?php
         if (!empty($params['deletable'])) { ?>
         <a class="ui inverted red button" href="<?= $params['deletable'] ?>">
           Delete
         </a>

       <?php } ?>

       </div>


  </form>







  <style>
    form {
      width: 90%;
      margin: auto;
    }

    select {
      padding-left: 2.67142857em!important;
    }

  </style>


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



  $(function() {
       $("input:file").change(function (){
         //debug($("#fileName").val());
         var fileName = $(this).val().split('/').pop().split('\\').pop();
         var fileExtention = fileName.split('.').pop();
         debug(fileExtention);
         $("#fileName").val(
           $("#form-id").val().replace(/[^a-zA-Z0-9]/g,'_') + "." + fileExtention
         );

         if ($('#form-id').val() == -1)
            $("#fileName").val("." + fileExtention);

         debug($("#fileName").val());

       });
    });

  </script>
