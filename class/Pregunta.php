<?php

class Pregunta {

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
		$stmt = $db->Prepare("SELECT * FROM msg_pregunta
                                      WHERE pre_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->pre_id = $row['pre_id'];
		$obj->pru_id = $row['pru_id'];
		$obj->pre_descripcion = utf8_encode($row['pre_descripcion']);
        $obj->pre_numero = $row['pre_numero'];
		$obj->pre_vigente = $row['pre_vigente'];

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
		$stmt = $db->Prepare("SELECT pre_id FROM msg_pregunta");

		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['pre_id'], $db);
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
		$stmt = $db->Prepare("SELECT pre_id FROM msg_pregunta WHERE pru_id = ?");

		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['pre_id'], $db);
		endwhile;

		return $lista;
	}

    /**
     * @param $id
     * @param $num
     * @param null $db
     * @return stdClass
     */
    public function getByPruebaNumero($id, $num, $db = null): stdClass
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        $stmt = $db->Prepare("SELECT pre_id FROM msg_pregunta WHERE pru_id = ? AND pre_numero = ?");

        $stmt->bind_param('ii', $id, $num);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $this->get($row['pre_id'], $db);
    }

    /**
     * @param $pru
     * @param $descripcion
     * @param null $db
     * @return array
     */
	public function set($pru, $descripcion, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;

		try {
			$stmt = $db->Prepare("INSERT INTO msg_pregunta (pru_id, pre_descripcion, pre_vigente) 
                                        VALUES (?, ?, TRUE)");

			if (!$stmt):
				throw new Exception("La inserción de la pregunta falló en su preparación.");
			endif;

            $pru = $db->clearText($pru);
            $descripcion = utf8_decode($db->clearText($descripcion));
            $bind = $stmt->bind_param("is", $pru, $descripcion);

			if (!$bind):
				throw new Exception("La inserción de la pregunta falló en su binding.");
			endif;

			if (!$stmt->execute()):
				throw new Exception("La inserción de la pregunta falló en su ejecución.");
			endif;

			$result = array('estado' => true, 'msg' => $stmt->insert_id);
			$stmt->close();
			return $result;
		} catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
		}
	}
}