<?php include_once 'header.php';




?>


<div class="ui cards">

  <?php

  $params = [
      'image-url' => 'https://twimgs.com/nojitter/gama/image/dT4Azx7Te.gif',
      'name' => 'Fun',
      'meta' => 'This is a try to have fun',
      'description' => ['<a href="#">Click here to have fun</a>'],
      'buttons' => [
          [
              'color' => 'green',
              'href' => '#',
              'text' => 'edit'
          ],
          [
              'color' => 'red',
              'href' => '#',
              'text' => 'delete'
          ]
      ]
  ];

  include '../templates/card.php';

  $params = [
      'image-url' => 'https://www.askideas.com/wp-content/uploads/2016/11/Eating-Watermelon-Like-A-Boss-Funny-Imaeg.jpg',
      'name' => 'Funy',
      'meta' => 'Eat water melon',
      'description' => [
        '<a href="#">Click here</a> to eat water melon',
        'try not to chock on it'
      ],
      'buttons' => [
          [
              'color' => 'red',
              'href' => '#',
              'text' => 'delete'
          ]
      ]
  ];

  include '../templates/card.php';

  $params = [
      'image-url' => '',
      'name' => 'No buttons',
      'meta' => 'lol',
      'description' => [
        '<a href="#">Click here</a> to eat water melon',
        'try not to chock on it'
      ],
      'buttons' => []
  ];

  include '../templates/card.php';


  ?>
</div>




<?php
 include_once 'footer.php';

 ?>
