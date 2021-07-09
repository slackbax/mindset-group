<?php

include '../class/MyDBC.php';
include '../class/Examen.php';
include '../class/Respuesta.php';
include '../class/Pregunta.php';

if (extract($_POST)):
    $db = new myDBC();
    $ex = new Examen();
    $re = new Respuesta();
    $pr = new Pregunta();

    $exa = $ex->getByUserTestType($user, $test, $db);
    $response = [];

    // CREAR
    $factores['a'] = array(38, 60, 67, 75, 80);
    $factores['b'] = array(1, 23, 33, 42, 44);
    $factores['c'] = array(2, 3, 18, 46, 51);
    $factores['d'] = array(28, 29, 34, 50, 85);
    $factores['e'] = array(61, 78, 83, 96, 98);

    foreach ($factores as $if => $vf):
        $prom = 0;

        foreach ($vf as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $prom += $res->res_valor / 5;
        endforeach;

        $response['crear'][] = round($prom, 2);
    endforeach;

    // COMPETIR
    $factores['a'] = array(5, 9, 35, 62, 97);
    $factores['b'] = array(47, 53, 57, 72, 77);
    $factores['c'] = array(4, 32, 36, 49, 79);
    $factores['d'] = array(45, 56, 74, 81, 84);
    $factores['e'] = array(7, 11, 25, 52, 70);

    foreach ($factores as $if => $vf):
        $prom = 0;

        foreach ($vf as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $prom += $res->res_valor / 5;
        endforeach;

        $response['competir'][] = round($prom, 2);
    endforeach;

    // CONTROLAR
    $factores['a'] = array(39, 65, 69, 86, 91);
    $factores['b'] = array(64, 87, 93, 95, 99);
    $factores['c'] = array(8, 16, 21, 55, 82);
    $factores['d'] = array(19, 20, 31, 88, 94);
    $factores['e'] = array(6, 14, 22, 41, 89);

    foreach ($factores as $if => $vf):
        $prom = 0;

        foreach ($vf as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $prom += $res->res_valor / 5;
        endforeach;

        $response['controlar'][] = round($prom, 2);
    endforeach;

    // COLABORAR
    $factores['a'] = array(17,24,27,68,71);
    $factores['b'] = array(48,58,73,76,100);
    $factores['c'] = array(13,26,30,37,43);
    $factores['d'] = array(10,12,15,66,92);
    $factores['e'] = array(40,54,59,63,90);

    foreach ($factores as $if => $vf):
        $prom = 0;

        foreach ($vf as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $prom += $res->res_valor / 5;
        endforeach;

        $response['colaborar'][] = round($prom, 2);
    endforeach;

    echo json_encode($response);
endif;
