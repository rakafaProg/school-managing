<?php

    include_once 'person.php';

    class Student extends Person
    {
      private $coursesAmount;

      function __construct($params) {
        parent::__construct($params);
        $this->coursesAmount = $params['course_cnt'];
      }

      public function getCourseAmount() {
        return $this->coursesAmount;
      }


    }


 ?>
