<?php

include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/sessionControl.ajax.php';

if (extract($_POST)):
    $db = new myDBC();
    $user = new User();

    try {
        $db->autoCommit(FALSE);
        $us = $user->activate($id, $db);

        if (!$us['estado']):
            throw new Exception('Error al activar el usuario. ' . $us['msg'], 0);
        endif;

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