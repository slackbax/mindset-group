<?php

include '../class/MyDBC.php';
include '../class/User.php';
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
    $us = new User();
    $ex = new Examen();
    $re = new Respuesta();
    $pr = new Pregunta();

    $u = $us->getByGroup($group);
    $num_us = count($u);
    $total1 = $total2 = $total3 = $total4 = $total5 = 0;
    $results = array('A' => array(0, 0, 0, 0, 0), 'B' => array(0, 0, 0, 0, 0), 'C' => array(0, 0, 0, 0, 0));

    foreach ($u as $ig => $vg):
        $exa = $ex->getByUserTestType($vg->us_id, 3, $db);

        $preg = [4, 1, 3, 2, 5];
        foreach ($preg as $i => $p):
            $res = $re->getByExamenNumber($exa->exa_id, $p);
            if ($i == 0) $total1 += $res->res_valor / $num_us;
            if ($i == 1) $total2 += $res->res_valor / $num_us;
            if ($i == 2) $total3 += $res->res_valor / $num_us;
            if ($i == 3) $total4 += $res->res_valor / $num_us;
            if ($i == 4) $total5 += $res->res_valor / $num_us;
            $results['A'][$i] += $res->res_valor / $num_us;
        endforeach;

        $preg = [6, 7, 8, 11, 9];
        foreach ($preg as $i => $p):
            $res = $re->getByExamenNumber($exa->exa_id, $p);
            if ($i == 0) $total1 += $res->res_valor / $num_us;
            if ($i == 1) $total2 += $res->res_valor / $num_us;
            if ($i == 2) $total3 += $res->res_valor / $num_us;
            if ($i == 3) $total4 += $res->res_valor / $num_us;
            if ($i == 4) $total5 += $res->res_valor / $num_us;
            $results['B'][$i] += $res->res_valor / $num_us;
        endforeach;

        $preg = [12, 10, 13, 14, 15];
        foreach ($preg as $i => $p):
            $res = $re->getByExamenNumber($exa->exa_id, $p);
            if ($i == 0) $total1 += $res->res_valor / $num_us;
            if ($i == 1) $total2 += $res->res_valor / $num_us;
            if ($i == 2) $total3 += $res->res_valor / $num_us;
            if ($i == 3) $total4 += $res->res_valor / $num_us;
            if ($i == 4) $total5 += $res->res_valor / $num_us;
            $results['C'][$i] += $res->res_valor / $num_us;
        endforeach;
    endforeach;

    $results['total'] = [$total1, $total2, $total3, $total4, $total5];
    $results['color'] = [evaluateScore($total1), evaluateScore($total2), evaluateScore($total3), evaluateScore($total4), evaluateScore($total5)];
    $results['barColor'] = [evaluateBar($total1), evaluateBar($total2), evaluateBar($total3), evaluateBar($total4), evaluateBar($total5)];

    echo json_encode($results);
endif;
