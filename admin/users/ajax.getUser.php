<?php

include("../../class/MyDBC.php");
include("../../class/User.php");

if (extract($_POST)):
    $u = new User();
    echo json_encode($u->getByRut($rut));
endif;