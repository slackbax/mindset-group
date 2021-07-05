<?php

$logout = false;

if (isset($_SESSION['msg_logintime']) and !empty($_SESSION['msg_logintime'])):
    $timeout = (time() - $_SESSION['msg_logintime']) >= SESSION_TIME;

    if ($timeout):
        $logout = true;
    else:
        $time = time();
        setcookie(session_name(), session_id(), $time + SESSION_TIME);
        $_SESSION['msg_logintime'] = $time;
    endif;
elseif (isset($_COOKIE['logged_in'])):
    $logout = true;
endif;

if ($logout and !isset($_GET['timeout'])):
    header("Location: src/logout.php");
endif;