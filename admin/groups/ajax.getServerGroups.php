<?php

include '../../class/MyDBC.php';
include '../../class/Grupo.php';
include '../../class/User.php';
include '../../src/fn.php';
session_start();

$gr = new Grupo();
$us = new User();

$table = 'msg_grupo';
$primaryKey = 'gr_id';
$index = 0;

$columns = array(
    array('db' => 'gr_id', 'dt' => $index, 'field' => 'gr_id'),
	array('db' => 'gr_nombre', 'dt' => ++$index, 'field' => 'gr_nombre'),
    array('db' => 'gr_id', 'dt' => ++$index, 'field' => 'gr_id',
        'formatter' => function ($d) use ($us) {
            $users = $us->getByGroup($d);
            return count($users);
        }
    ),
	array('db' => 'gr_id', 'dt' => ++$index, 'field' => 'gr_id',
		'formatter' => function ($d) use ($gr) {
	        $g = $gr->get($d);

			$string = '<a class="groupEdit btn btn-xs btn-success" href="index.php?section=groups&sbs=editgroup&id=' . $d . '" data-tooltip="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil"></i></a>';
			if ($g->gr_activo):
			    $string .= ' <button id="del_' . $d . '" class="groupDelete btn btn-xs btn-danger" data-tooltip="tooltip" data-placement="left" title="Desactivar"><i class="fa fa-times"></i></button>';
			else:
                $string .= ' <button id="act_' . $d . '" class="groupActivate btn btn-xs btn-success" data-tooltip="tooltip" data-placement="left" title="Reactivar"><i class="fa fa-check"></i></button>';
			endif;

			return $string;
		}
	)
);

$joinQuery = "";
$extraWhere = "";
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
