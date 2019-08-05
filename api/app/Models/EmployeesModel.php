<?php

    namespace app\models;
    
    class EmployeesModel extends Models {

        public function getByIdEmployees($employeeNumber){
            $result = $this->db->select('employees',[
                'employeeNumber',
                'lastName',
                'firstName',
                'extension',
                'email',
                'officeCode',
                'reportsTo',
                'jobTitle'
            ],[
                "employeeNumber" => $employeeNumber
            ]
        );

        if(!is_null($this->db->error()[1])){
            return array(
                'error' => true,
                'description' => $this->db->error()[2]
            );
        } else if (empty($result)){
            return array(
                'notFound' => true,
                'description' => 'The result is empty'
            );
        }
        return array(
            'success' => true,
            'description' => 'The employee were found',
            'employees' => $result
        );
        }
        public function selectEmployees(){
            /*$result = $this->db->select('employees', ['[>]offices' => 'officeCode'],[
                'employeeNumber',
                'lastName',
                'firstName',
                'extension',
                'email',
                'offices.city',
                'reportsTo',
                'jobTitle'
            ]);*/
            $cons = $this->db->pdo->prepare('SELECT employeeNumber, lastName, firstName, extension, email, offices.city, reportsTo, jobTitle
            FROM employees
            LEFT JOIN offices ON employees.officeCode = offices.officeCode');
            $cons->execute();
            $result = $cons->fetchAll(\PDO::FETCH_ASSOC);
            if(!is_null($this->db->error()[1])){
                return array(
                    'error' => true,
                    'description' => $this->db->error()[2]
                );
            } else if (empty($result)){
                return array(
                    'notFound' => true,
                    'description' => 'The result is empty'
                );
            }
            return array(
                'success' => true,
                'description' => 'The employess were found',
                'employees' => $result
            );
        }
        public function insertEmployees($employee){
            /*$result = $this->db->insert('employees', [
                'employeeNumber' => $employee['employeeNumber'],
                'lastName' => $employee['lastName'],
                'firstName' => $employee['firstName'],
                'extension' => $employee['extension'],
                'email' => $employee['email'],
                'officeCode' => $employee['officeCode'],
                'reportsTo' => $employee['reportsTo'],
                'jobTitle' => $employee['jobTitle']
            ]);*/
            $result = $this->db->pdo->prepare('INSERT INTO employees 
            VALUES (:employeeNumber, :lastName, :firstName, :extension, :email, :officeCode, :reportsTo, :jobTitle);');
            $result->bindParam(':employeeNumber', $employee['employeeNumber'], \PDO::PARAM_INT);
            $result->bindParam(':lastName', $employee['lastName'], \PDO::PARAM_STR);
            $result->bindParam(':firstName', $employee['firstName'], \PDO::PARAM_STR);
            $result->bindParam(':extension', $employee['extension'], \PDO::PARAM_INT);
            $result->bindParam(':email', $employee['email'], \PDO::PARAM_STR);
            $result->bindParam(':officeCode', $employee['officeCode'], \PDO::PARAM_INT);
            $result->bindParam(':reportsTo', $employee['reportsTo'], \PDO::PARAM_INT);
            $result->bindParam(':jobTitle', $employee['jobTitle'], \PDO::PARAM_STR);
            $result->execute();
            //var_dump($result->execute());die();
            if(!is_null($result->errorInfo()[2])){
                return array(
                    'success' => false,
                    'description' => $result->errorInfo()[2]
                );
            }
            return array(
                'success' => true,
                'description' => 'The employee was inserted'
            );
        }
        public function updateEmployees($employee){
            /*$result = $this->db->update('employees', [
                'lastName' => $employee['lastName'],
                'firstName' => $employee['firstName'],
                'extension' => $employee['extension'],
                'email' => $employee['email'],
                'officeCode' => $employee['officeCode'],
                'reportsTo' => $employee['reportsTo'],
                'jobTitle' => $employee['jobTitle']
            ], [
                'employeeNumber[=]' => $employee['employeeNumber'],
            ]);*/
            $result = $this->db->pdo->prepare('UPDATE employees SET 
            lastName = :lastName, 
            firstName = :firstName,
            extension = :extension,
            email = :email,
            officeCode = :officeCode,
            reportsTo = :reportsTo,
            jobTitle = :jobTitle
            WHERE employeeNumber = :employeeNumber');
            
            $result->bindParam(':employeeNumber', $employee['employeeNumber'], \PDO::PARAM_INT);
            $result->bindParam(':lastName', $employee['lastName'], \PDO::PARAM_STR);
            $result->bindParam(':firstName', $employee['firstName'], \PDO::PARAM_STR);
            $result->bindParam(':extension', $employee['extension'], \PDO::PARAM_STR);
            $result->bindParam(':email', $employee['email'], \PDO::PARAM_STR);
            $result->bindParam(':officeCode', $employee['officeCode'], \PDO::PARAM_INT);
            $result->bindParam(':reportsTo', $employee['reportsTo'], \PDO::PARAM_INT);
            $result->bindParam(':jobTitle', $employee['jobTitle'], \PDO::PARAM_STR);
            $result->execute();
            
            if(!is_null($this->db->error()[1])){
                return array(
                    'success' => false,
                    'description' => $this->db->error()[2]
                );
            }
            return array(
                'success' => true,
                'description' => 'The employee was updated'
            );
        }
    }
?>