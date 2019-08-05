<?php
namespace app\Controllers;

    class LoginController extends Controllers{

        function login($request, $response){
            $user = $request->getParsedBody();
            $message = $this->LoginModel->autentication($user);
            return json_encode($message);
        }

    }
?>