<?php

    include_once 'person.php';

    class Student extends Person {
      private $coursesAmount;

      function __construct($params) {
        parent::__construct($params);
        $this->coursesAmount = isset($params['course_cnt']) ? $params['course_cnt'] : 0;
      }

      public function getCourseAmount() {
        return $this->coursesAmount;
      }


    }


 ?>
