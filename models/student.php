<?php

    include_once 'person.php';

    class Student extends Person
    {
      private $image;

      function __construct($params) {
        parent::__construct($params);

        $this->setImage($params['image']);
      }

      function getImage() {
          return $this->image;
      }

      function setImage($image) {
          $this->image = $image;
      }

    }


 ?>
