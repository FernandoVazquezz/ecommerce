<?php
    //configuracion de la base de datos
    $db = require $contexto_app . '/app/database/config.php';

    //key de encriptacion
    $jwt = array ('key' => '22X:[dR#,7p?@77=', 'algorithms' => array('HS256'));

    //configuracion de la app
    $settings = array (
        'displayErrorDetails' => true,
        'determineRouteBeforeAppMiddleware' => true,
        'db' => $db,
        'jwt' => $jwt
    );

    //se agraga el contexto de la app
    $settings['contexto'] = $contexto_app;

    return $settings;


?>
