<?php
    header("Content-Type: application/json");

    /**
     * 4. Crear el controlador professors_controller.php que realice los llamados respectivos a los métodos del DAO...
     * 
     * professors_controller.php
     * Implement the services to make registrations, cancellations, modifications and reading of professor data
     */
    require 'professor_dao.php';
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $professorDAO = new ProfessorDAO();

    switch ($requestMethod) {
        case 'GET':
            if (empty($_GET['id'])) {
                echo json_encode($professorDAO->findProfessors());
            } else {
                echo json_encode($professorDAO->findProfessorById($_GET['id']));
            }
            break;
        case 'POST':
                $jsonProfessor = json_decode(file_get_contents("php://input"), true);
                $professor = new Professor(
                    $jsonProfessor['firstName'],
                    $jsonProfessor['lastName'],
                    $jsonProfessor['city'],
                    $jsonProfessor['yearsExperience'],
                    $jsonProfessor['salary']
                );
                echo json_encode(['result'=>$professorDAO->save($professor)]);
                break;
        case 'PUT':
                $jsonProfessor = json_decode(file_get_contents('php://input'), true);
                $professor = new Professor(
                    $jsonProfessor['firstName'],
                    $jsonProfessor['lastName'],
                    $jsonProfessor['city'],
                    $jsonProfessor['yearsExperience'],
                    $jsonProfessor['salary'],
                    $jsonProfessor['id'],
                );
                echo json_encode(['result'=>$professorDAO->update($value)]);
                break;        
        case 'DELETE':
                $query = $_SERVER['QUERY_STRING'];
                list($key, $value) = explode('=', $query);
                echo json_encode(['result'=>$professorDAO->delete($value)]);
                break;
        
        
    }
?>