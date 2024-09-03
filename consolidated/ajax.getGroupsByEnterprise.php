<?php

include '../class/MyDBC.php';
include '../class/Grupo.php';

if (extract($_POST)):
    $g = new Grupo();
    echo json_encode($g->getByEmpresa($id));
endif;
