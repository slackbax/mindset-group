<?php

session_start();
$_BASEDIR = explode('src', dirname(__FILE__));
include_once $_BASEDIR[0] . 'src/settings.php';
$logout = false;

try {
    if (isset($_SESSION['msg_logintime'])):
        $timeout = !((time() - $_SESSION['msg_logintime']) >= SESSION_TIME);

        if (!$timeout):
            $logout = true;
            throw new Exception('Tu sesión ha cerrado por inactividad, debes iniciar sesión nuevamente. Redirigiendo a página de inicio...', 1);
        else:
            $_SESSION['msg_logintime'] = time();
        endif;
    else:
        throw new Exception('Su sesión ha cerrado por inactividad, debe iniciar sesión nuevamente. Redirigiendo a página de inicio...', 1);
    endif;
} catch (Exception $e) {
    $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
    echo json_encode($response);
    die();
}