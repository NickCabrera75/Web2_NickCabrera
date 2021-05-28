<?php
    require 'dbutil.php';
    require 'student.php';

    /**
     * StudentDAO
     * 
     * Implementa las operaciones de altas, bajas, modificaciones y lectura
     * de datos de estudiantes
     */

    class StudentDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = DBUtil::getConnection();
        }

        /**
         * findStudents
         * 
         * Retorna los datos de todos los estudiantes
         */
        public function findStudents() {
            $result = $this->pdo->query("SELECT id, first_name, last_name, city, semester FROM student");
            $students = [];

            while ($row = $result->fetch()) {
                array_push($students, new Student(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['semester'],
                    $row['id']
                ));
            }

            return $students;
        }

        /**
         * findStudentById
         * Retorna los datos del estudiante que le corresponden al id especificado
         * 
         * Parámetros:
         * $id: Id del estudiante a obtener de la base de datos
         */
        public function findStudentById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name, last_name, city, semester FROM student WHERE id = :id");
            $stmt->execute(['id' => $id]);

            if ($row = $stmt->fetch()) {
                $student = new Student(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['semester'],
                    $row['id']
                );

                return $student;
            }

            return null;
        }

        /**
         * save
         * Registra los datos de un nuevo estudiante.
         * 
         * Parámetros:
         * $student: Instancia de Student que contiene los datos a registrar
         */
        public function save($student) {
            try {
                $sql = "INSERT INTO student(first_name, last_name, city, semester) " .
                       "VALUES (:firstName, :lastName, :city, :semester)";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $student->getFirstName(),
                    'lastName' => $student->getLastName(),
                    'city' => $student->getCity(),
                    'semester' => $student->getSemester()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }

        /**
         * update
         * Actualiza los datos de un estudiante ya registrado.
         * 
         * Parámetros:
         * $student: Instancia de Student que contiene los datos a actualizar
         */
        public function update($student) {
            try {
                $sql = "UPDATE student SET first_name=:firstName, last_name=:lastName, city=:city, semester=:semester " .
                       "WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $student->getFirstName(),
                    'lastName' => $student->getLastName(),
                    'city' => $student->getCity(),
                    'semester' => $student->getSemester(),
                    'id' => $student->getId()
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }

        /**
         * delete
         * Elimina los datos de un estudiante ya registrado.
         * 
         * Parámetros:
         * $id: id del estudiante que se elimina de la base de datos
         */
        public function delete($id) {
            try {
                $sql = "DELETE FROM student WHERE id = :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id' => $id
                ]);

                return 1;
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

            return 0;
        }
    }