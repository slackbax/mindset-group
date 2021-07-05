<?php

include '../../class/MyDBC.php';
include '../../class/Grupo.php';
include '../../src/fn.php';
include '../../src/sessionControl.ajax.php';

if (extract($_POST)):
    $db = new myDBC();
    $gr = new Grupo();

    try {
        $db->autoCommit(FALSE);

        $ins = $gr->mod($iid, $iname, $db);

        if (!$ins['estado']):
            throw new Exception('Error al editar los datos del grupo. ' . $ins['msg'], 0);
        endif;

        $del_u = $gr->unassignUser($iid, $db);

        if (!$del_u['estado']):
            throw new Exception('Error al eliminar los datos del usuario. ' . $del_u['msg'], 0);
        endif;

        foreach ($ius as $k => $t):
            $ins_t = $gr->assignUser($iid, $t, $db);

            if (!$ins_t['estado']):
                throw new Exception('Error al editar los datos del usuario. ' . $ins_t['msg'], 0);
            endif;
        endforeach;

        $db->Commit();
        $db->autoCommit(TRUE);

        $response = array('type' => true, 'msg' => 'OK');
        echo json_encode($response);
    } catch (Exception $e) {
        $db->Rollback();
        $db->autoCommit(TRUE);
        $response = array('type' => false, 'msg' => $e->getMessage(), 'code' => $e->getCode());
        echo json_encode($response);
    }
endif;
