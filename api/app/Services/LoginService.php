<?php

    namespace app\Services;
    
    class LoginService extends Services{

        public function jsWebToken($token){
            
            $passJWT= $this->jwt->encode($token, $this->settings['jwt']['key']);
            
            return $passJWT;
        }
    } 

?>        