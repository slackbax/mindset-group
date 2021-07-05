<?php

include '../../class/MyDBC.php';
include '../../class/Grupo.php';
include '../../src/sessionControl.ajax.php';

if (extract($_POST)):
	$db = new myDBC();
	$gr = new Grupo();

	try {
		$db->autoCommit(FALSE);
		$gru = $gr->del($id, $db);

		if (!$gru['estado']):
			throw new Exception('Error al desactivar el grupo. ' . $gru['msg'], 0);
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