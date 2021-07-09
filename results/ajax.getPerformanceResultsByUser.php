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
    $response = [-30];

    $crear = [3, 19, 35, 7, 23, 39, 11, 27, 43, 15, 31, 47];
    $competir = [2, 30, 42, 6, 18, 46, 10, 26, 34, 14, 22, 38];
    $controlar = [4, 32, 40, 8, 20, 44, 12, 24, 48, 16, 28, 36];
    $colaborar = [1, 17, 33, 5, 21, 37, 9, 25, 45, 13, 29, 41];

    $asp = 0;
    $total = 0;
    foreach ($crear as $i => $v):
        $res = $re->getByExamenNumber($exa->exa_id, $v);
        $pre = $pr->get($res->pre_id);
        $total += $res->res_valor;
        $asp++;

        if ($asp == 3):
            $response[] = $total;
            $asp = 0;
            $total = 0;
        endif;
    endforeach;
    $response[] = -30;

    $asp = 0;
    $total = 0;
    foreach ($competir as $i => $v):
        $res = $re->getByExamenNumber($exa->exa_id, $v);
        $pre = $pr->get($res->pre_id);
        $total += $res->res_valor;
        $asp++;

        if ($asp == 3):
            $response[] = $total;
            $asp = 0;
            $total = 0;
        endif;
    endforeach;
    $response[] = -30;

    $asp = 0;
    $total = 0;
    foreach ($controlar as $i => $v):
        $res = $re->getByExamenNumber($exa->exa_id, $v);
        $pre = $pr->get($res->pre_id);
        $total += $res->res_valor;
        $asp++;

        if ($asp == 3):
            $response[] = $total;
            $asp = 0;
            $total = 0;
        endif;
    endforeach;
    $response[] = -30;

    $asp = 0;
    $total = 0;
    foreach ($colaborar as $i => $v):
        $res = $re->getByExamenNumber($exa->exa_id, $v);
        $pre = $pr->get($res->pre_id);
        $total += $res->res_valor;
        $asp++;

        if ($asp == 3):
            $response[] = $total;
            $asp = 0;
            $total = 0;
        endif;
    endforeach;

    echo json_encode($response);
endif;
