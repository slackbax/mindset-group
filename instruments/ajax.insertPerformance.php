<?php

include '../class/MyDBC.php';
include '../class/Examen.php';
include '../class/Respuesta.php';
include '../src/sessionControl.ajax.php';

if (extract($_POST)):
    $db = new myDBC();
    $e = new Examen();
    $r = new Respuesta();

    try {
        $db->autoCommit(FALSE);

        $ins_ex = $e->set($_SESSION['msg_userid'], $ipid, 1, $db);

        if (!$ins_ex['estado']):
            throw new Exception('Error al guardar el examen. ' . $ins_ex['msg'], 0);
        endif;

        foreach ($pr as $p => $v):
            $ins_r = $r->set($ins_ex['msg'], $p, $v, null, $db);

            if (!$ins_r['estado']):
                throw new Exception('Error al guardar las respuestas. ' . $ins_r['msg'], 0);
            endif;
        endforeach;

        $db->Commit();
        $db->autoCommit(TRUE);

        $response = array('type' => true, 'msg' => 'OK');
    } catch (Exception $e) {
        $db->Rollback();
        $db->autoCommit(TRUE);
        $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
    }

    echo json_encode($response);
endif;