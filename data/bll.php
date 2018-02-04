<?php
    include_once 'dal.php';
    include_once '../models/administrator.php';
    include_once '../models/student.php';
    include_once '../models/course.php';

    /*
      This class converts MySQL data into the project models (classes)
    */

    class BLL {

        public static function createAdmin($admin) {

          $sql =
            'INSERT INTO
            `administrators`
            (`id`, `name`, `role`, `phone`, `email`, `password`, `image`)
            VALUES
            (NULL,
              "'.$admin->getName().'",
              '.$admin->getRole().',
              "'.$admin->getPhone().'",
              "'.$admin->getEmail().'",
              "'.$admin->getPassword().'",
              "'.$admin->getImage().'"
            )';


          $result = DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

          return $result['insertResult'];
        }

        public static function getAllAdmins () {
          $whereSql = "";
          return self::getAdminWhere($whereSql);
        }

        public static function getAdminsByRole ($role) {
          $whereSql = " WHERE `role`>=".$role;
          return self::getAdminWhere($whereSql);
        }

        public static function getAdmin ($email, $password) {
          $whereSql = " WHERE `email`='".$email."' AND `password`='".$password."'";
          return self::getAdminWhere($whereSql);
        }

        public static function deleteAdminById($id) {
          $sql = "DELETE FROM `administrators` WHERE `id`=".$id;
          return DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);
        }

        private static function getAdminWhere ($whereSql) {
          $sql = 'SELECT * FROM `administrators`'.$whereSql;

          $adminsArray = [];
          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $admin) {
            $adminsArray[$admin['id']] = new Administrator($admin);
          }

          return $adminsArray;
        }

        public static function updateAdmin($id, $params) {
            $sql = 'UPDATE `administrators` SET `id`='.$id;
            foreach ($params as $key => $value) {
              $sql .= ', `'.$key.'`="'.$value.'"';
            }
            $sql .= ' WHERE `id`='.$id;

            return DAL::getInstance($GLOBALS['dbDetails'])->insertData($sql);

        }


        public static function getAllStudents () {
          $sql =
          'SELECT `id`,`name`,`phone`,`email`,`image`,
          COUNT(`students-courses`.`course-id`) AS course_cnt
          FROM `students`
          JOIN `students-courses`
          ON `students-courses`.`student-id`=`students`.`id`
          GROUP BY `id`';

          $studentsArray = [];

          foreach (DAL::getInstance($GLOBALS['dbDetails'])->fetch($sql) as $student) {
            $studentsArray[$student['id']] = new Student($student);
          }

          return $studentsArray;

        }


        public static function getAllCourses () {
          $sql =
          'SELECT `id`, `name`, `description`, `image`,
          COUNT(`students-courses`.`course-id`) AS student_cnt
          FROM `courses`
          JOIN `students-courses`
          ON `students-courses`.`course-id`=`courses`.`id`
          GROUP BY `id`';

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
