<?php

include '../../class/MyDBC.php';
include '../../class/User.php';

if (extract($_POST)):
	$user = new User();
	echo json_encode($user->existsUser($username));
endif;
