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

    $u = $us->getByGroup($group);
    $num_us = count($u);
    $table = array(
        1 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
        2 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
        3 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
        4 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
        5 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
        6 => array(
            'A' => array(0, 0, 0, 0),
            'D' => array(0, 0, 0, 0),
        ),
    );

    foreach ($u as $ig => $vg):
        $exa = $ex->getByUserTestType($vg->us_id, 4, $db);
        $profile = ['Características Dominantes', 'Líder de la Organización', 'Dirección de los Colaboradores', 'Unidad Organizacional', 'Énfasis Estratégico', 'Criterios de Éxito'];

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

                $table[$row]['A'][$i-1] += $res->res_valor / $num_us;
                $table[$row]['D'][$i-1] += $res->res_valor_sec / $num_us;
                $index_p++;
            endforeach;
        endforeach;
    endforeach;

    echo json_encode($table);
endif;

