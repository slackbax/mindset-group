<?php

session_start();
include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/fn.php';
include '../../src/sessionControl.ajax.php';
$_BASEDIR = explode('admin', dirname(__FILE__));

if (extract($_POST)):
	$db = new myDBC();
	$user = new User();
	$_islog = false;
	$_default = false;

	if (isset($iactive)):
		$iactive = 1;
	else:
		$iactive = 0;
	endif;

	if ($_SESSION['msg_userid'] == $id):
		$_islog = true;
	endif;

	try {
		$db->autoCommit(FALSE);

		$ins = $user->mod($id, $iprofile, $irut, $iname, $ilastnamep, $ilastnamem, $iemail, $iphone, $ipassword, $iactive, $db);

		if (!$ins['estado']):
			throw new Exception('Error al guardar los datos de usuario. ' . $ins['msg'], 0);
		endif;

		if ($_islog):
			$_SESSION['msg_userfname'] = $iname;
			$_SESSION['msg_userlnamep'] = $ilastnamep;
			$_SESSION['msg_userlnamem'] = $ilastnamem;
			$_SESSION['msg_useremail'] = $iemail;
		endif;

		if (!empty($_FILES)):
			$targetFolder = 'dist/img/users/';
			$targetPath = $_BASEDIR[0] . $targetFolder;

			$u = $user->get($id);

			if ($u->us_pic == 'users/no-photo.png'):
				$_default = true;
			endif;

			$img_old = $_BASEDIR[0] . 'dist/img/' . $u->us_pic;

			if (!is_readable($img_old)):
				throw new Exception('El archivo solicitado no existe.');
			endif;

			if (!$_default):
				if (!unlink($img_old)):
					throw new Exception('Error al eliminar la imagen antigua.');
				endif;
			endif;

			foreach ($_FILES as $aux => $file):
				$tempFile = $file['tmp_name'][0];
				$targetFile = rtrim($targetPath, '/') . '/' . $id . '_' . $file['name'][0];
				move_uploaded_file($tempFile, $targetFile);
			endforeach;

			$pic_route = 'users/' . $id . '_' . $file['name'][0];

			$ins = $user->setPicture($id, $pic_route, $db);

			if (!$ins['estado']):
				throw new Exception('Error al guardar la imagen. ' . $ins['msg'], 0);
			endif;

			$_SESSION['msg_userpic'] = 'users/' . $id . '_' . $file['name'][0];
		endif;

		$del_ins = $user->delInstruments($id, $db);

        if (!$del_ins['estado'])
            throw new Exception('Error al eliminar el instrumento. ' . $del_ins['msg'], 0);

        foreach ($iprueba as $i => $pru):
            $ins_in = $user->setInstruments($id, $pru, $db);

            if (!$ins_in['estado'])
                throw new Exception('Error al guardar el instrumento. ' . $ins_p['msg'], 0);
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
