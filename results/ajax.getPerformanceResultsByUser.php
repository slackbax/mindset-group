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

    try {
        $exa = $ex->getByUserTestType($user, $test, $db);
        $response = [];

        $colaborar = [1, 17, 33, 5, 21, 37, 9, 25, 45, 13, 29, 41];
        $crear = [3, 19, 35, 7, 23, 39, 11, 27, 43, 15, 31, 47];
        $controlar = [4, 32, 40, 8, 20, 44, 12, 24, 48, 16, 28, 36];
        $competir = [2, 30, 42, 6, 18, 46, 10, 26, 34, 14, 22, 38];

        foreach ($colaborar as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $response['labels'][] = (strlen($pre->pre_descripcion) > 100) ? substr($pre->pre_descripcion, 0, 80) . '...' : $pre->pre_descripcion;
            $response['values'][] = $res->res_valor;
            $response['colors'][] = '#f56954';
        endforeach;

        foreach ($crear as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $response['labels'][] = (strlen($pre->pre_descripcion) > 80) ? substr($pre->pre_descripcion, 0, 80) . '...' : $pre->pre_descripcion;
            $response['values'][] = $res->res_valor;
            $response['colors'][] = '#00a65a';
        endforeach;

        foreach ($controlar as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $response['labels'][] = (strlen($pre->pre_descripcion) > 80) ? substr($pre->pre_descripcion, 0, 80) . '...' : $pre->pre_descripcion;
            $response['values'][] = $res->res_valor;
            $response['colors'][] = '#3c8dbc';
        endforeach;

        foreach ($competir as $i => $v):
            $res = $re->getByExamenNumber($exa->exa_id, $v);
            $pre = $pr->get($res->pre_id);
            $response['labels'][] = (strlen($pre->pre_descripcion) > 80) ? substr($pre->pre_descripcion, 0, 80) . '...' : $pre->pre_descripcion;
            $response['values'][] = $res->res_valor;
            $response['colors'][] = '#f39c12';
        endforeach;

        echo json_encode($response);
    } catch (Exception $e) {
        $db->Rollback();
        $db->autoCommit(TRUE);
        $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
        echo json_encode($response);
    }
endif;
