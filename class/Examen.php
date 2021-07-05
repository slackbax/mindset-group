<?php

class Examen {

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
		$stmt = $db->Prepare("SELECT * FROM msg_examen
                                      WHERE exa_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->exa_id = $row['exa_id'];
		$obj->us_id = $row['us_id'];
		$obj->pru_id = $row['pru_id'];
		$obj->exa_fecha_rendicion = $row['exa_fecha_rendicion'];
        $obj->exa_nombre = $row['exa_nombre'];
        $obj->exa_ultimo = $row['exa_ultimo'];

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
		$stmt = $db->Prepare("SELECT exa_id FROM msg_examen");

		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['exa_id'], $db);
		endwhile;

		return $lista;
	}

	/**
	 * @param $id
	 * @param $db
	 * @return array
	 */
	public function getByPrueba($id, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;
		$stmt = $db->Prepare("SELECT exa_id FROM msg_examen WHERE pru_id = ?");

		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['exa_id'], $db);
		endwhile;

		return $lista;
	}

    /**
     * @param $user
     * @param $type
     * @param null $db
     * @return stdClass
     */
    public function getByUserTestType($user, $type, $db = null): stdClass
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        $stmt = $db->Prepare("SELECT exa_id FROM msg_examen WHERE pru_id = ? AND us_id = ? AND exa_ultimo IS TRUE");

        $stmt->bind_param('ii', $type, $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $this->get($row['exa_id'], $db);
    }

    /**
     * @param $us
     * @param $prueba
     * @param $nombre
     * @param null $db
     * @return array
     */
	public function set($us, $prueba, $nombre, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;

		try {
			$stmt = $db->Prepare("INSERT INTO msg_examen (us_id, pru_id, exa_nombre, exa_fecha_rendicion) 
                                        VALUES (?, ?, ?, CURRENT_TIMESTAMP)");

			if (!$stmt):
				throw new Exception("La inserción del examen falló en su preparación.");
			endif;

			$us = $db->clearText($us);
			$prueba = $db->clearText($prueba);
			$bind = $stmt->bind_param("iii", $us, $prueba, $nombre);

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
            return array('estado' => false, 'msg' => $e->getMessage());
		}
	}

	/**
	 * @param $us
	 * @param $pru
	 * @param null $db
	 * @return array
	 */
	public function setLast($us, $pru, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;

		try {
			$stmt = $db->Prepare("UPDATE msg_examen SET exa_ultimo = FALSE WHERE us_id = ? AND pru_id = ?");

			if (!$stmt):
				throw new Exception("La actualización del último examen falló en su preparación.");
			endif;

			$us = $db->clearText($us);
			$pru = $db->clearText($pru);
			$bind = $stmt->bind_param("ii", $us, $pru);

			if (!$bind):
				throw new Exception("La actualización del último examen falló en su binding.");
			endif;

			if (!$stmt->execute()):
				throw new Exception("La actualización del último examen falló en su ejecución.");
			endif;

			$result = array('estado' => true, 'msg' => $stmt->insert_id);
			$stmt->close();
			return $result;
		} catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
		}
	}
}