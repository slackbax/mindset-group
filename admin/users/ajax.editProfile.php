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
    $_default = false;

    try {
        $db->autoCommit(FALSE);
        $ins = $user->modProfile($_SESSION['msg_userid'], $iname, $ilastnamep, $ilastnamem, $iemail, $db);

        if (!$ins['estado']):
            throw new Exception('Error al guardar los datos del usuario. ' . $ins['msg'], 0);
        endif;

        $_SESSION['msg_userfname'] = $iname;
        $_SESSION['msg_userlnamep'] = $ilastnamep;
        $_SESSION['msg_userlnamem'] = $ilastnamem;
        $_SESSION['msg_useremail'] = $iemail;

        if (!empty($_FILES)):
            $targetFolder = 'dist/img/users/';
            $targetPath = $_BASEDIR[0] . $targetFolder;

            $u = $user->get($_SESSION['msg_userid']);

            if ($u->us_pic == 'users/no-photo.png'):
                $_default = true;
            endif;

            $img_old = $_BASEDIR[0] . '/dist/img/' . $u->us_pic;

            if (!is_readable($img_old)):
                throw new Exception('El archivo solicitado no existe.');
            endif;

            if (!$_default):
                if (!unlink($img_old)):
                    throw new Exception('Error al eliminar la imagen antigua.', 0);
                endif;
            endif;

            foreach ($_FILES as $aux => $file):
                $tempFile = $file['tmp_name'][0];
                $targetFile = rtrim($targetPath, '/') . '/' . $_SESSION['msg_userid'] . '_' . $file['name'][0];
                move_uploaded_file($tempFile, $targetFile);
            endforeach;

            $pic_route = 'users/' . $_SESSION['msg_userid'] . '_' . $file['name'][0];

            $ins = $user->setPicture($_SESSION['msg_userid'], $pic_route, $db);

            if (!$ins):
                throw new Exception('Error al guardar la imagen. ' . $ins['msg'], 0);
            endif;

            $_SESSION['msg_userpic'] = 'users/' . $_SESSION['msg_userid'] . '_' . $file['name'][0];
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
