<?php

extract($_POST);
include '../class/MyDBC.php';
include '../class/Examen.php';
include '../class/Respuesta.php';
include '../class/Pregunta.php';

$db = new myDBC();
$ex = new Examen();
$re = new Respuesta();
$pr = new Pregunta();

$exa = $ex->getByUserTestType($user, 4, $db);
$profile = ['Características Dominantes', 'Líder de la Organización', 'Dirección de los Colaboradores', 'Unidad Organizacional', 'Énfasis Estratégico', 'Criterios de Éxito'];
$table = [];
$table_total = [];

$total1 = $total2 = $total3 = $total4 = $total5 = $total6 = $total7 = $total8 = 0;
$index_p = 1;

foreach ($profile as $pi => $pp):
    $row = $pi + 1;
    $preg = [1, 2, 3, 4];

    foreach ($preg as $i):
        $res = $re->getByExamenNumber($exa->exa_id, $index_p);
        if ($i == 1):
            $total1 += $res->res_valor;
            $total2 += $res->res_valor_sec;
        elseif ($i == 2):
            $total3 += $res->res_valor;
            $total4 += $res->res_valor_sec;
        elseif ($i == 3):
            $total5 += $res->res_valor;
            $total6 += $res->res_valor_sec;
        else:
            $total7 += $res->res_valor;
            $total8 += $res->res_valor_sec;
        endif;

        $table[$row]['A'][] = $res->res_valor;
        $table[$row]['D'][] = $res->res_valor_sec;
        $index_p++;
    endforeach;
endforeach;

echo json_encode($table);

