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

    $preg = [1, 2, 3];
    $text = ['I - Prácticas actuales de elaboración de estrategias', 'II - Percepción de su entorno empresarial', 'III - Enfoque de estrategia previsto'];
    foreach ($preg as $i => $p):
        $resp = new stdClass();
        $res = $re->getByExamenNumber($exa->exa_id, $p);
        $pre = $pr->get($res->res_valor);
        $resp->pregunta = $text[$p - 1];
        $resp->text = $pre->pre_descripcion;

        switch ($res->res_valor):
            case 248:
            case 256:
            case 259:
                $resp->valor = 'Clásica';
                $resp->color = '#000000';
                break;
            case 249:
            case 254:
            case 260:
                $resp->valor = 'Visionaria';
                $resp->color = '#b5bbc8';
                break;
            case 251:
            case 255:
            case 258:
                $resp->valor = 'Adaptativa';
                $resp->color = '#ff7701';
                break;
            case 252:
            case 257:
            case 261:
                $resp->valor = 'Formación';
                $resp->color = '#f39c12';
                break;
            case 250:
            case 253:
            case 262:
                $resp->valor = 'Renovación';
                $resp->color = '#e8897d';
                break;
            default:
                break;
        endswitch;
        $results[] = $resp;
    endforeach;

    echo json_encode($results);
endif;
