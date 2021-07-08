<?php

include '../class/MyDBC.php';
include '../class/User.php';
include '../class/Examen.php';
include '../class/Respuesta.php';
include '../class/Pregunta.php';

if (extract($_POST)):
    $db = new myDBC();
    $us = new User();
    $ex = new Examen();
    $re = new Respuesta();
    $pr = new Pregunta();

    try {
        $u = $us->getByGroup($group);
        $num_us = count($u);
        $temp = [];
        $cli = [];

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

        $response['values'] = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        foreach ($u as $ig => $vg):
            $exa = $ex->getByUserTestType($vg->us_id, $test, $db);
            $ind = 0;

            for ($i = $init; $i < $end; $i++):
                $res = $re->getByExamenNumber($exa->exa_id, $i);
                $pre = $pr->get($res->pre_id);
                $response['labels'][$ind] = substr($pre->pre_descripcion, 0, 40) . '...';
                $response['values'][$ind] += $res->res_valor / $num_us;
                $response['colors'][$ind] = $color;
                $ind++;
            endfor;
        endforeach;

        echo json_encode($response);
    } catch (Exception $e) {
        $db->Rollback();
        $db->autoCommit(TRUE);
        $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
        echo json_encode($response);
    }
endif;
