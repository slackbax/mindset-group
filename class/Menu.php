<?php

class Menu {

	public function __construct() {
	}

	/**
	 * @param $id
	 * @return stdClass
	 */
	public function get($id): stdClass
    {
		$db = new myDBC();
		$stmt = $db->Prepare("SELECT * FROM msg_menu WHERE men_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->men_id = $row['men_id'];
		$obj->men_tipo = $row['tmen_id'];
		$obj->men_parent = $row['men_parent_id'];
		$obj->men_descripcion = utf8_encode($row['men_descripcion']);
		$obj->men_icon = $row['men_icon'];
		$obj->men_link = $row['men_link'];
		$obj->men_section = $row['men_section'];

		unset($db);
		return $obj;
	}

	/**
	 * @return array
	 */
	public function getAll(): array
    {
		$db = new myDBC();
		$stmt = $db->Prepare("SELECT * FROM msg_menu WHERE men_publicado = TRUE ORDER BY men_id");

		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['men_id']);
		endwhile;

		unset($db);
		return $lista;
	}

	/**
	 * @param $pro
	 * @return array
	 */
	public function getByProfile($pro): array
    {
		$db = new myDBC();
		$stmt = $db->Prepare("SELECT * FROM msg_menu m 
                                    JOIN msg_menu_perfil mp ON m.men_id = mp.men_id 
                                    WHERE perf_id = ? AND men_publicado = TRUE");

		$stmt->bind_param("i", $pro);
		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['men_id']);
		endwhile;

		unset($db);
		return $lista;
	}

	/**
	 * @param $id
	 * @param $pro
	 * @return array
	 */
	public function getChildByProfile($id, $pro): array
    {
		$db = new myDBC();
		$stmt = $db->Prepare("SELECT * FROM msg_menu m
                                    JOIN msg_menu_perfil mp ON m.men_id = mp.men_id 
                                    WHERE perf_id = ? AND men_parent_id = ? AND men_publicado = TRUE");

		$stmt->bind_param("ii", $pro, $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$obj = new stdClass();
			$obj->men_id = $row['men_id'];
			$obj->men_descripcion = utf8_encode($row['men_descripcion']);
			$obj->men_icon = $row['men_icon'];
			$obj->men_link = $row['men_link'];
			$obj->men_section = $row['men_section'];
			$lista[] = $obj;
		endwhile;

		unset($db);
		return $lista;
	}
}