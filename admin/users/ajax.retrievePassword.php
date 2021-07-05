<?php

include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/Random/random.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../bower_components/phpmailer/src/Exception.php';
require '../../bower_components/phpmailer/src/PHPMailer.php';
require '../../bower_components/phpmailer/src/SMTP.php';

if (extract($_POST)):
	$db = new myDBC();
	$us = new User();

	try {
		$db->autoCommit(FALSE);
		$usr = $us->getByUsername($iusername);

		if (is_null($usr->us_id)):
			throw new Exception('El usuario ingresado no existe.');
		endif;

		$keyspace = '0123456789';
		$length = 4;
		$str = '';
		$max = mb_strlen($keyspace, '8bit') - 1;

		for ($i = 0; $i < $length; ++$i):
			$str .= $keyspace[random_int(0, $max)];
		endfor;

		$pmod = $us->modPass($usr->us_id, $str, $db);

		if (!$pmod['estado']):
			throw new Exception('Error al modificar la contraseña. ' . $pmod['msg']);
		endif;

		$db->Commit();
		$db->autoCommit(TRUE);
/*
		$mail = new PHPMailer(true);

		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "ti.hggb@gmail.com";  // GMAIL username
		$mail->Password   = "svr1503_root";            // GMAIL password

		$mail->SetFrom('soportedesarrollo@ssconcepcion.cl', 'Plataforma SISGDOC');

		$mail->Subject = "Sus nuevos datos de acceso";
		$mail->AltBody = "Para visualizar el mensaje, por favor utilice un visor de correos compatible con HTML!"; // optional, comment out and test

		$html = "Estimado usuario:<br><br>Has solicitado un cambio de contraseña con fecha " . date('d-m-Y') . ". Tu nueva contraseña es <strong>" . $str . "</strong>";
		$html .= "<br>Te recordamos que puede modificar esta contraseña en el menú de usuario de la plataforma, ubicado en la barra superior bajo tu nombre.";
		$html .= "<br><br>Saludos!";
		$html .= "<br>Soporte Plataforma ByeBro";
		$mail->MsgHTML(utf8_decode($html));

		$mail->AddAddress($usr->us_email, utf8_decode($usr->us_nombres . ' ' . $usr->us_ap));

		if (!$mail->Send()):
			throw new Exception('Error al enviar correo de confirmación. ' . $mail->ErrorInfo);
		endif;
*/
		$response = array('type' => true, 'msg' => 'OK');
		echo json_encode($response);
	} catch (Exception $e) {
		$db->Rollback();
		$db->autoCommit(TRUE);
		$response = array('type' => false, 'msg' => $e->getMessage());
		echo json_encode($response);
	}
endif;