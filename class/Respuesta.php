<?php

class Respuesta {

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
		$stmt = $db->Prepare("SELECT * FROM msg_respuesta
                                      WHERE res_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->res_id = $row['res_id'];
		$obj->exa_id = $row['exa_id'];
		$obj->pre_id = $row['pre_id'];
        $obj->res_valor = $row['res_valor'];
        $obj->res_valor_sec = $row['res_valor_sec'];

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
		$stmt = $db->Prepare("SELECT res_id FROM msg_respuesta");

		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['res_id'], $db);
		endwhile;

		return $lista;
	}

	/**
	 * @param $id
	 * @param $db
	 * @return array
	 */
	public function getByExamen($id, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;
		$stmt = $db->Prepare("SELECT res_id FROM msg_respuesta WHERE exa_id = ?");

		$stmt->bind_param('i', $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$lista = [];

		while ($row = $result->fetch_assoc()):
			$lista[] = $this->get($row['res_id'], $db);
		endwhile;

		return $lista;
	}

    /**
     * @param $id
     * @param $num
     * @param null $db
     * @return stdClass
     */
    public function getByExamenNumber($id, $num, $db = null): stdClass
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        $stmt = $db->Prepare("SELECT res_id FROM msg_respuesta r
                                    JOIN msg_pregunta mp on mp.pre_id = r.pre_id
                                    WHERE exa_id = ? AND pre_numero = ? AND pre_vigente IS TRUE");

        $stmt->bind_param("ii", $id, $num);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $this->get($row['res_id']);
    }

    /**
     * @param $exa
     * @param $pre
     * @param $valor
     * @param null $valor_sec
     * @param null $db
     * @return array
     */
	public function set($exa, $pre, $valor, $valor_sec = null, $db = null): array
    {
		if (is_null($db)):
			$db = new myDBC();
		endif;

		try {
			$stmt = $db->Prepare("INSERT INTO msg_respuesta (exa_id, pre_id, res_valor, res_valor_sec) 
                                        VALUES (?, ?, ?, ?)");

			if (!$stmt):
				throw new Exception("La inserción de la respuesta falló en su preparación.");
			endif;

			$valor_sec = !is_null($valor_sec) ? $db->clearText($valor_sec) : 'NULL';

			$exa = $db->clearText($exa);
			$pre = $db->clearText($pre);
            $valor = $db->clearText($valor);
			$bind = $stmt->bind_param("iiii", $exa, $pre, $valor, $valor_sec);

			if (!$bind):
				throw new Exception("La inserción de la respuesta falló en su binding.");
			endif;

			if (!$stmt->execute()):
				throw new Exception("La inserción de la respuesta falló en su ejecución.");
			endif;

			$result = array('estado' => true, 'msg' => $stmt->insert_id);
			$stmt->close();
			return $result;
		} catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
		}
	}
}