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

        switch ($graph):
            case 1:
                $init = 1;
                $end = 16;
                $color = '#00a65a';
                break;
            case 2:
                $init = 16;
                $end = 31;
                $color = '#3c8dbc';
                break;
            case 3:
                $init = 31;
                $end = 46;
                $color = '#f56954';
                break;
            case 4:
                $init = 46;
                $end = 61;
                $color = '#f39c12';
                break;
            default:
                $init = $end = 0;
                $color = '';
                break;
        endswitch;

        for ($i = $init; $i < $end; $i++):
            $res = $re->getByExamenNumber($exa->exa_id, $i);
            $pre = $pr->get($res->pre_id);
            $label = substr($pre->pre_descripcion, 0, 40) . '...';
            $response['labels'][] = $label;
            $response['values'][] = $res->res_valor;
            $response['colors'][] = $color;
        endfor;

        echo json_encode($response);
    } catch (Exception $e) {
        $db->Rollback();
        $db->autoCommit(TRUE);
        $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
        echo json_encode($response);
    }
endif;
