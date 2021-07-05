<?php

session_start();
$_SESSION = [];

if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();
setcookie('logged_in', false, -1, '/');
unset($_COOKIE['logged_in']);

if (isset($_POST['src'])):
    echo "true";
    die();
else:
    header("Location: ../index.php?timeout=1");
endif;