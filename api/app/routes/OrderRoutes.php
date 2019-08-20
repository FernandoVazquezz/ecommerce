<?php 
    $app->post('/orders', 'OrderController:insertOrder');
    $app->get('/orders', 'OrderController:selectOrders');
?>