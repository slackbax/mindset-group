<?php

include '../../class/MyDBC.php';
include '../../class/User.php';
include '../../src/fn.php';
session_start();

$us = new User();

$table = 'msg_usuario';
$primaryKey = 'us_id';
$index = 0;

$columns = array(
	array('db' => 'us_nombres', 'dt' => $index, 'field' => 'us_nombres'),
	array('db' => 'us_ap', 'dt' => ++$index, 'field' => 'us_ap'),
	array('db' => 'us_am', 'dt' => ++$index, 'field' => 'us_am'),
	array('db' => 'us_username', 'dt' => ++$index, 'field' => 'us_username'),
	array('db' => 'us_registro', 'dt' => ++$index, 'field' => 'us_registro',
        'formatter' => function ($d, $row) {
            return getDateHourToForm($d);
        }
    ),
    array('db' => 'ses_time', 'dt' => ++$index, 'field' => 'ses_time',
		'formatter' => function ($d, $row) {
            return (!empty($d)) ? getDateHourToForm($d) : 'No registra sesiones';
		}
    ),
	array('db' => 'u.us_id', 'dt' => ++$index, 'field' => 'us_id',
		'formatter' => function ($d, $row) use ($us) {
	        $u = $us->get($d);

			$string = '<a class="userEdit btn btn-xs btn-success" href="index.php?section=users&sbs=edituser&id=' . $d . '" data-tooltip="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil"></i></a>';
			if ($u->us_activo):
			    $string .= ' <button id="del_' . $d . '" class="userDelete btn btn-xs btn-danger" data-tooltip="tooltip" data-placement="left" title="Desactivar"><i class="fa fa-times"></i></button>';
			else:
                $string .= ' <button id="act_' . $d . '" class="userActivate btn btn-xs btn-success" data-tooltip="tooltip" data-placement="left" title="Reactivar"><i class="fa fa-check"></i></button>';
			endif;

			return $string;
		}
	)
);

$joinQuery = "FROM msg_usuario u";
$joinQuery .= " JOIN msg_perfil pf ON u.perf_id = pf.perf_id";
$joinQuery .= " LEFT JOIN msg_sesion s ON u.us_id = s.us_id";
$extraWhere = " s.ses_ultima IS TRUE OR s.ses_ultima IS NULL";
$groupBy = "";
$having = "";

// SQL server connection information
$sql_details = array(
	'user' => DB_USER,
	'pass' => DB_PASSWORD,
	'db' => DB_DATABASE,
	'host' => DB_HOST
);

require '../../src/ssp2.class.php';

echo json_encode(
	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere, $groupBy, $having)
);
