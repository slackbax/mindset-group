<?php

class Prueba {

	public function __construct()
	{
	}

	/**
	 * @param $id
	 * @param $db
	 * @return stdClass
	 */
	public function get($id, $db = null): stdClass
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;
		$stmt = $db->Prepare("SELECT * FROM msg_prueba
                                      WHERE pru_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->pru_id = $row['pru_id'];
		$obj->pru_nombre = utf8_encode($row['pru_nombre']);
		$obj->pru_introduccion = utf8_encode($row['pru_introduccion']);
		$obj->pru_duracion = $row['pru_duracion'];
		$obj->pru_vigente = $row['pru_vigente'];

		return $obj;
	}

	/**
	 * @param $db
	 * @return array
	 */
	public function getAll($db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;
		$stmt = $db->Prepare("SELECT pru_id FROM msg_prueba");

		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['pru_id'], $db);
		endwhile;

		return $lista;
	}

	/**
	 * @param $name
	 * @param $intro
	 * @param $puntaje
	 * @param $duracion
	 * @param $db
	 * @return array
	 */
	public function set($name, $intro, $puntaje, $duracion, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;

		try {
			$stmt = $db->Prepare("INSERT INTO msg_prueba (pru_nombre, pru_introduccion, pru_duracion, pru_vigente) 
                                        VALUES (?, ?, ?, TRUE)");

			if (!$stmt):
				throw new Exception("La inserción del examen falló en su preparación.");
			endif;

			$name = utf8_decode($db->clearText($name));
			$intro = utf8_decode($intro);
			$duracion = $db->clearText($duracion);
			$bind = $stmt->bind_param("ssii", $name, $intro, $puntaje, $duracion);

			if (!$bind):
				throw new Exception("La inserción del examen falló en su binding.");
			endif;

			if (!$stmt->execute()):
				throw new Exception("La inserción del examen falló en su ejecución.");
			endif;

			$result = array('estado' => true, 'msg' => $stmt->insert_id);
			$stmt->close();
			return $result;
		} catch (Exception $e) {
			$result = array('estado' => false, 'msg' => $e->getMessage());
			return $result;
		}
	}
}