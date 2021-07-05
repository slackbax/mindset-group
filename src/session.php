<?php

session_start();
include '../class/MyDBC.php';
include '../class/Session.php';

$qr = new myDBC();
$ses = new Session();

extract($_POST);
$isActive = false;

try {
    $stmt = $qr->Prepare("SELECT COUNT(*) AS num FROM msg_usuario WHERE us_username = ?");

    if (!$stmt):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la preparación de la consulta de usuario.");
    endif;

    $cl_user = $qr->clearText(strtolower($user));
    $bind = $stmt->bind_param("s", $cl_user);

    if (!$bind):
        throw new Exception("El usuario ingresado no es correcto. Fallo en el binding de los parámetros de usuario.");
    endif;

    if (!$stmt->execute()):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la ejecución de la consulta de usuario.");
    endif;

    $query = $stmt->get_result();
    $q_user = $query->fetch_assoc();

    if ($q_user['num'] == 0):
        throw new Exception("El usuario ingresado no existe.");
    endif;

    $stmt = $qr->Prepare("SELECT us_password FROM msg_usuario WHERE us_username = ?");

    if (!$stmt):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la preparación de la consulta de contraseña.");
    endif;

    $cl_user = $qr->clearText($user);
    $bind = $stmt->bind_param("s", $cl_user);

    if (!$bind):
        throw new Exception("El usuario ingresado no es correcto. Fallo en el binding de los parámetros de contraseña.");
    endif;

    if (!$stmt->execute()):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la ejecución de la consulta de contraseña.");
    endif;

    $query = $stmt->get_result();
    $q_pass = $query->fetch_assoc();

    if (md5($passwd) !== $q_pass['us_password']):
        throw new Exception("La contraseña ingresada no es correcta.");
    endif;

    $stmt = $qr->Prepare("SELECT us_activo FROM msg_usuario WHERE us_username = ?");

    if (!$stmt):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la preparación de la consulta de activación.");
    endif;

    $cl_user = $qr->clearText($user);
    $bind = $stmt->bind_param("s", $cl_user);

    if (!$bind):
        throw new Exception("El usuario ingresado no es correcto. Fallo en el binding de los parámetros de activación.");
    endif;

    if (!$stmt->execute()):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la ejecución de la consulta de activación.");
    endif;

    $query = $stmt->get_result();
    $q_active = $query->fetch_assoc();

    if ($q_active['us_activo'] !== 1):
        throw new Exception("El usuario ingresado no tiene permisos de acceso.");
    endif;

    $stmt = $qr->Prepare("SELECT * FROM msg_usuario u JOIN msg_perfil p ON u.perf_id = p.perf_id WHERE us_username = ?");

    if (!$stmt):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la preparación de la consulta de datos de usuario.");
    endif;

    $cl_user = $qr->clearText($user);
    $bind = $stmt->bind_param("s", $cl_user);

    if (!$bind):
        throw new Exception("El usuario ingresado no es correcto. Fallo en el binding de los parámetros de datos de usuario.");
    endif;

    if (!$stmt->execute()):
        throw new Exception("El usuario ingresado no es correcto. Fallo en la ejecución de la consulta de datos de usuario.");
    endif;

    $query = $stmt->get_result();
    $q_data = $query->fetch_assoc();

    setcookie('logged_in', 'msg', 0, '/');
    $_SESSION['msg_logintime'] = time();
    $_SESSION['msg_userid'] = $q_data['us_id'];
    $_SESSION['msg_username'] = $user;
    $_SESSION['msg_userfname'] = utf8_encode($q_data['us_nombres']);
    $_SESSION['msg_userlnamep'] = utf8_encode($q_data['us_ap']);
    $_SESSION['msg_userlnamem'] = utf8_encode($q_data['us_am']);
    $_SESSION['msg_useremail'] = $q_data['us_email'];
    $_SESSION['msg_userpic'] = utf8_encode($q_data['us_pic']);
    $_SESSION['msg_userprofile'] = $q_data['perf_id'];
    $_SESSION['msg_usergroup'] = $q_data['perf_descripcion'];

    switch ($q_data['perf_id']):
        case 1:
            $_SESSION['msg_useradmin'] = true;
            break;
        case 2:
            $_SESSION['msg_usersuperv'] = true;
            break;
        default:
            break;
    endswitch;

    $set_last = $ses->setLast($q_data['us_id'], $qr);
    $set_session = $ses->set($q_data['us_id'], $_SERVER['REMOTE_ADDR'], $qr);

    if ($set_session):
        echo "true";
        return;
    else:
        throw new Exception("Hubo un problema al guardar la sesión.");
    endif;

} catch (Exception $e) {
    echo $e->getMessage();
    return;
}
