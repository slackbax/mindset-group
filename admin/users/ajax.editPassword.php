<?php

include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/sessionControl.ajax.php';

if (extract($_POST)):
	$db = new myDBC();
	$us = new User();

	try {
		$db->autoCommit(FALSE);

		if (!empty($inewpass)):
			$pmod = $us->modPass($uid, $inewpass, $db);

			if (!$pmod['estado']):
				throw new Exception('Error al modificar la contraseña de acceso. ' . $pmod['msg'], 0);
			endif;
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