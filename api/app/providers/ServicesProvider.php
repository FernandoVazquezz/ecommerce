<?php 
    //Se agregan los services al contexto de la app (container)
    $container['LoginService'] = function($container) {
        return new app\Services\LoginService($container);
    };
        
?>