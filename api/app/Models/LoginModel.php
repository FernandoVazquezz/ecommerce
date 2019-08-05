<?php

    namespace app\models;
    
    class LoginModel extends Models { 

        public function autentication($user){
            $email = $user['email'];
            $pass = md5($user['password']);

            $resultEmail = $this->db->pdo->prepare('SELECT * FROM employees WHERE email = :email');
            $resultEmail->bindParam(':email', $email, \PDO::PARAM_STR);
            $resultEmail->execute();
            $result = $resultEmail->fetchAll(\PDO::FETCH_ASSOC);

            if(empty($result)){
                return array(
                    'error' => true,
                    'description' => 'Email incorrect'
                );
            }

            $resultPass = $this->db->pdo->prepare('SELECT * FROM employees WHERE email = :email and password = :password');
            $resultPass->bindParam(':password', $pass, \PDO::PARAM_STR);
            $resultPass->bindParam(':email', $email, \PDO::PARAM_STR);
            $resultPass->execute();
            $result = $resultPass->fetchAll(\PDO::FETCH_ASSOC);
            if(empty($result)){
                return array(
                    'error' => true,
                    'description' => 'Password incorrect'
                );
            }

            $token = $this->LoginService->jsWebToken($email);
            return array(
                'success' => true,
                'description' => 'The user were found',
                'token' => $token
            );
        }
       
    }