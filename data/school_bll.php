<?php
    include_once 'dal.php';
    include_once '../models/student.php';
    include_once '../models/course.php';

    /*
      This class converts MySQL data into the project models (classes)
    */

    class SchoolBLL {




        public static function getAllStudents () {
          $sql =
          'SELECT `id`,`name`,`phone`,`email`,`image`,
          COUNT(`students-courses`.`course-id`) AS course_cnt
          FROM `students`
          LEFT JOIN `students-courses`
          ON `students-courses`.`student-id`=`students`.`id`
          GROUP BY `id`';

          $studentsArray = [];

          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $student) {
            $studentsArray[$student['id']] = new Student($student);
          }

          return $studentsArray;

        }

        public static function getCoursesStudents ($courseId) {
          $sql =
          'SELECT `id`,`name`,`phone`,`email`,`image`
          FROM `students`
          JOIN `students-courses`
          ON `students-courses`.`student-id`=`students`.`id` AND `students-courses`.`course-id`='.$courseId;

          $studentsArray = [];

          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $student) {
            $studentsArray[$student['id']] = new Student($student);
          }

          return $studentsArray;

        }

        public static function setCoursesToStudent($studentId, $params) {
          $sql =
          'DELETE FROM `students-courses` WHERE `student-id` = '.$studentId;
          DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

          $sql =
          'INSERT INTO `students-courses`
          (`course-id`, `student-id`) VALUES ';

          foreach ($params as $key => $value) {
            if (strpos($key, 'course-') !== false) {
              $key = str_replace('course-', '', $key);
              $sql .= '('.$key.','.$studentId.'), ';
            }
          }

          $sql = substr($sql, 0, -2);

          DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

        }

        public static function createStudent ($student) {
          $sql =
            'INSERT INTO
            `students`
            (`id`, `name`, `phone`, `email`, `image`)
            VALUES
            (NULL,
              "'.$student->getName().'",
              "'.$student->getPhone().'",
              "'.$student->getEmail().'",
              "'.$student->getImage().'"
            )';


          $result = DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

          return $result;
        }

        public static function updateStudent($id, $params) {
          $sql = 'UPDATE `students` SET `id`='.$id;
          foreach ($params as $key => $value) {
            $sql .= ', `'.$key.'`="'.$value.'"';
          }
          $sql .= ' WHERE `id`='.$id;

          return DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

        }

        public static function createCourse ($course) {
          $sql =
            'INSERT INTO
            `courses`
            (`id`, `name`, `description`, `image`)
            VALUES
            (NULL,
              "'.$course->getName().'",
              "'.$course->getDescription().'",
              "'.$course->getImage().'"
            )';


          $result = DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

          return $result;
        }


        public static function updateCourse($id, $params) {
          $sql = 'UPDATE `courses` SET `id`='.$id;
          foreach ($params as $key => $value) {
            $sql .= ', `'.$key.'`="'.$value.'"';
          }
          $sql .= ' WHERE `id`='.$id;

          return DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

        }


        public static function getAllCourses () {
          $sql =
          'SELECT `id`, `name`, `description`, `image`,
          COUNT(`students-courses`.`course-id`) AS student_cnt
          FROM `courses`
          LEFT JOIN `students-courses`
          ON `students-courses`.`course-id`=`courses`.`id`
          GROUP BY `id`';

          $coursesArray = [];

          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $course) {
            $coursesArray[$course['id']] = new Course($course);
          }

          return $coursesArray;

        }

        public static function getStudentCourses($studentId) {
          $sql =
          'SELECT `id`, `name`, `description`, `image`, `student-id`
          FROM `courses`
          LEFT JOIN `students-courses`
          ON `students-courses`.`course-id`=`courses`.`id`
          And `students-courses`.`student-id` = '.$studentId;

          $coursesArray = [];

          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $course) {
            $coursesArray[$course['id']] = new Course($course);
          }

          return $coursesArray;
        }
    }

    // // test get admin
    // BLL::getAdmin('rakkafa.prog@gmail.com', 'e19d5cd5af0378da05f63f891c7467af');


 ?>
