<?php

include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/fn.php';
include '../../src/sessionControl.ajax.php';
$_BASEDIR = explode('admin', dirname(__FILE__));

if (extract($_POST)):
    $db = new myDBC();
    $user = new User();
    $idate = setDateBD($idate);

    try {
        $db->autoCommit(FALSE);
        $ins = $user->set($iprofile, $irut, $iname, $ilastnamep, $ilastnamem, $iemail, $iphone, $iusername, $ipassword, $db);

        if ($ins['estado'] == false):
            throw new Exception('Error al guardar los datos de usuario. ' . $ins['msg'], 0);
        endif;

        if (!empty($_FILES)):
            $targetFolder = 'dist/img/users/';
            $targetPath = $_BASEDIR[0] . $targetFolder;

            foreach ($_FILES as $aux => $file):
                $tempFile = $file['tmp_name'][0];
                $fileName = removeAccents(str_replace(' ', '_', $file['name'][0]));
                $targetFile = rtrim($targetPath, '/') . '/' . $ins['msg'] . '_' . $fileName;
                move_uploaded_file($tempFile, $targetFile);
                $pic_route = 'users/' . $ins['msg'] . '_' . $fileName;
            endforeach;
        else:
            $pic_route = 'users/no-photo.png';
        endif;

        $ins_p = $user->setPicture($ins['msg'], $pic_route, $db);

        if (!$ins_p['estado']):
            throw new Exception('Error al guardar la imagen. ' . $ins_p['msg'], 0);
        endif;

        foreach ($iprueba as $i => $pru):
            $ins_in = $user->setInstruments($ins['msg'], $pru, $db);

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
