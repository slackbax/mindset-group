<?php

class Empresa
{
    public function __construct()
    {
    }

    /**
     * @param $id
     * @param null $db
     * @return stdClass
     */
    public function get($id, $db = null): stdClass
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        $stmt = $db->Prepare("SELECT * FROM msg_empresa u WHERE emp_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $obj = new stdClass();
        $obj->emp_id = $row['emp_id'];
        $obj->emp_nombre = utf8_encode($row['emp_nombre']);
        $obj->emp_activo = $row['emp_activo'];

        unset($db);
        return $obj;
    }

    /**
     * @param null $db
     * @return array
     */
    public function getAll($db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        $stmt = $db->Prepare("SELECT emp_id FROM msg_empresa ORDER BY emp_nombre");
        $stmt->execute();
        $result = $stmt->get_result();
        $lista = [];

        while ($row = $result->fetch_assoc()):
            $lista[] = $this->get($row['emp_id'], $db);
        endwhile;

        unset($db);
        return $lista;
    }

    /**
     * @param $str
     * @param null $db
     * @return stdClass
     */
    public function getByName($str, $db = null): stdClass
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        $stmt = $db->Prepare("SELECT emp_id FROM msg_empresa WHERE emp_nombre = ?");
        $str = utf8_decode($db->clearText($str));
        $stmt->bind_param("s", $str);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $obj = $this->get($row['emp_id'], $db);

        unset($db);
        return $obj;
    }

    /**
     * @param $name
     * @param null $db
     * @return array
     */
    public function set($name, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("INSERT INTO msg_empresa (emp_nombre) VALUES (?)");

            if (!$stmt):
                throw new Exception("La inserción de la empresa falló en su preparación.");
            endif;

            $name = utf8_decode($db->clearText($name));
            $bind = $stmt->bind_param("s", $name);

            if (!$bind):
                throw new Exception("La inserción de la empresa falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La inserción de la empresa falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => $stmt->insert_id);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }

    /**
     * @param $id
     * @param $name
     * @param null $db
     * @return array
     */
    public function mod($id, $name, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("UPDATE msg_empresa SET emp_nombre = ? WHERE emp_id = ?");

            if (!$stmt):
                throw new Exception("La edición de la empresa falló en su preparación.");
            endif;

            $name = utf8_decode($db->clearText($name));
            $bind = $stmt->bind_param("si", $name, $id);

            if (!$bind):
                throw new Exception("La edición de la empresa falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La edición de la empresa falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => $stmt->insert_id);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }

    /**
     * @param $id
     * @param null $db
     * @return array
     */
    public function del($id, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("UPDATE msg_empresa SET emp_activo = FALSE WHERE emp_id = ?");

            if (!$stmt):
                throw new Exception("La desactivación de la empresa falló en su preparación.");
            endif;

            $bind = $stmt->bind_param("i", $id);
            if (!$bind):
                throw new Exception("La desactivación de la empresa falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La desactivación de la empresa falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => true);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }

    /**
     * @param $id
     * @param null $db
     * @return array
     */
    public function activate($id, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("UPDATE msg_empresa SET emp_activo = TRUE WHERE emp_id = ?");

            if (!$stmt):
                throw new Exception("La activación de la empresa falló en su preparación.");
            endif;

            $bind = $stmt->bind_param("i", $id);
            if (!$bind):
                throw new Exception("La activación de la empresa falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La activación de la empresa falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => true);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }
}