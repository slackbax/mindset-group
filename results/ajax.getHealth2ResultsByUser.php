<?php

include '../class/MyDBC.php';
include '../class/Examen.php';
include '../class/Respuesta.php';
include '../class/Pregunta.php';

function evaluateScore($v): string
{
    if ($v <= 5):
        $str = 'bg-red';
    elseif ($v > 5 and $v <= 7):
        $str = 'bg-yellow';
    else:
        $str = 'bg-green';
    endif;

    return $str;
}

function evaluateBar($v): string
{
    if ($v <= 5):
        $str = '#dd4b39';
    elseif ($v > 5 and $v <= 7):
        $str = '#f39c12';
    else:
        $str = '#00a65a';
    endif;

    return $str;
}

if (extract($_POST)):
    $db = new myDBC();
    $ex = new Examen();
    $re = new Respuesta();
    $pr = new Pregunta();

    $exa = $ex->getByUserTestType($user, $test, $db);
    $total1 = $total2 = $total3 = $total4 = $total5 = 0;
    $results = [];

    $preg = [4, 1, 3, 2, 5];
    foreach ($preg as $i => $p):
        $res = $re->getByExamenNumber($exa->exa_id, $p);
        if ($i == 0) $total1 += $res->res_valor;
        if ($i == 1) $total2 += $res->res_valor;
        if ($i == 2) $total3 += $res->res_valor;
        if ($i == 3) $total4 += $res->res_valor;
        if ($i == 4) $total5 += $res->res_valor;
        $results['A'][] = $res->res_valor;
    endforeach;

    $preg = [6, 7, 8, 11, 9];
    foreach ($preg as $i => $p):
        $res = $re->getByExamenNumber($exa->exa_id, $p);
        if ($i == 0) $total1 += $res->res_valor;
        if ($i == 1) $total2 += $res->res_valor;
        if ($i == 2) $total3 += $res->res_valor;
        if ($i == 3) $total4 += $res->res_valor;
        if ($i == 4) $total5 += $res->res_valor;
        $results['B'][] = $res->res_valor;
    endforeach;

    $preg = [12, 10, 13, 14, 15];
    foreach ($preg as $i => $p):
        $res = $re->getByExamenNumber($exa->exa_id, $p);
        if ($i == 0) $total1 += $res->res_valor;
        if ($i == 1) $total2 += $res->res_valor;
        if ($i == 2) $total3 += $res->res_valor;
        if ($i == 3) $total4 += $res->res_valor;
        if ($i == 4) $total5 += $res->res_valor;
        $results['C'][] = $res->res_valor;
    endforeach;

    $results['total'] = [$total1, $total2, $total3, $total4, $total5];
    $results['color'] = [evaluateScore($total1), evaluateScore($total2), evaluateScore($total3), evaluateScore($total4), evaluateScore($total5)];
    $results['barColor'] = [evaluateBar($total1), evaluateBar($total2), evaluateBar($total3), evaluateBar($total4), evaluateBar($total5)];

    echo json_encode($results);
endif;
