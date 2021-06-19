<?php
    require 'dbutil.php';
    require 'professor.php';
    /**
     * 3. Crear una clase ProfessorDAO en PHP que incluya los métodos...
     * 
     * ProfessorDAO
     * It implements the operations of additions, deletions, modifications and reading of professor data
     */
    class ProfessorDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = DBUtil::getConnection();            
        }

        /**
         * findProfessors
         * Returns the data of all professors
         */
        public function findProfessors() {
            $result = $this->pdo->query("SELECT id, first_name, last_name, city, years_experience, salary FROM professor");
            $professors =[];

            while ($row = $result->fetch()) {
                array_push($professors, new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                ));
            }
            return $professors;
        }

        /**
         * findProfessorById
         * Returns the professor data corresponding to the specified id
         * 
         * Parameters:
         * $id: Professor ID to obtain from the database
         */
        public function findProfessorById($id) {
            $stmt = $this->pdo->prepare("SELECT id, first_name, last_name, city, years_experience, salary FROM professor WHERE id = :id");
            $stmt->execute(['id'=>$id]);

            if ($row = $stmt->fetch()) {
                $professor = new Professor(
                    $row['first_name'],
                    $row['last_name'],
                    $row['city'],
                    $row['years_experience'],
                    $row['salary'],
                    $row['id']
                );
                return $professor;
            }
            return null;
        }

        /**
         * save
         * Register the data of a new professor
         * 
         * Parameters:
         * $professor: Professor instance that contains the data to be recorded
         */
        public function save($professor) {
            try {
                $sql = "INSERT INTO professor(first_name, last_name, city, years_experience, salary)".
                "VALUES(:firstName, :lastName, :city, :yearsExperience, :salary)";    
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $professor->getFirstname(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'yearsExperience'=>$professor->getYearsExperience(),
                    'salary'=>$professor->getSalary()
                ]);
                return 1;  
            } catch (Exception $e) {
                echo 'Error: '.$e->getMessage();
            }
            return 0;
        }

        /**
         * update
         * Update the data of an already registered professor
         * 
         * Parameters:
         * $professor: Professor instance containing the data to update
         */
        public function update($professor) {
            try {
                $sql = "UPDATE professor SET first_name=:firstName, last_name=:lastName, city=:city, years_experience=:yearsExperience, salary=:salary WHERE id =:id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'firstName' => $professor->getFirstname(),
                    'lastName' => $professor->getLastName(),
                    'city' => $professor->getCity(),
                    'yearsExperience'=>$professor->getYearsExperience(),
                    'salary'=>$professor->getSalary(),
                    'id'=>$professor->getId()
                ]);
                return 1;     
            } catch (Exception $e) {
                echo 'Error: '.$e->getMessage();
            }
            return 0;
        }

        /**
         * delete
         * Delete the data of an already registered professor
         * 
         * Parameters:
         * $id: id of the professor that is removed from the database
         */
        public function delete($id) {
            try {
                $sql = "DELETE FROM professor WHERE id= :id";
                $stmt = $this->pdo->prepare($sql);
                $stmt->execute([
                    'id' => $id
                ]);
                return 1;
            } catch (Exception $e) {
                echo 'Error: '.$e->getMessage();
            }
            return 0;
        }
    }
?>