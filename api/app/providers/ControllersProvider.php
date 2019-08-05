<?php 
    //Se agregan los controllers al contexto de la app (container)
    $container['UserController'] = function($container) {
        return new app\controllers\UserController($container);
    };
        
    $container['EmployeesController'] = function($container){
        return new app\Controllers\EmployeesController($container);
    };

    $container['ProductsController'] = function($container){
        return new app\Controllers\ProductsController($container);
    };

    $container['CustomersController'] = function($container){
        return new app\Controllers\CustomersController($container);
    };

    $container['OfficesController'] = function($container){
        return new app\Controllers\OfficesController($container);
    };

    $container['OrderController'] = function($container){
        return new app\controllers\OrderController($container);
    };
   
    $container['LoginController'] = function($container){
        return new app\controllers\LoginController($container);
    };

?>