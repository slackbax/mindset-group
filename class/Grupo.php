<?php


class Grupo
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

        $stmt = $db->Prepare("SELECT * FROM msg_grupo u WHERE gr_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $obj = new stdClass();
        $obj->gr_id = $row['gr_id'];
        $obj->emp_id = $row['emp_id'];
        $obj->gr_nombre = utf8_encode($row['gr_nombre']);
        $obj->gr_activo = $row['gr_activo'];

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

        $stmt = $db->Prepare("SELECT gr_id FROM msg_grupo ORDER BY gr_nombre");
        $stmt->execute();
        $result = $stmt->get_result();
        $lista = [];

        while ($row = $result->fetch_assoc()):
            $lista[] = $this->get($row['gr_id'], $db);
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

        $stmt = $db->Prepare("SELECT gr_id FROM msg_grupo WHERE gr_nombre = ?");
        $str = utf8_decode($db->clearText($str));
        $stmt->bind_param("s", $str);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $obj = $this->get($row['gr_id'], $db);

        unset($db);
        return $obj;
    }

    /**
     * @param $emp
     * @param null $db
     * @return array
     */
    public function getByEmpresa($emp, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        $stmt = $db->Prepare("SELECT gr_id FROM msg_grupo WHERE emp_id = ?");

        $stmt->bind_param("i", $emp);
        $stmt->execute();
        $result = $stmt->get_result();
        $lista = [];

        while ($row = $result->fetch_assoc()):
            $lista[] = $this->get($row['gr_id'], $db);
        endwhile;

        unset($db);
        return $lista;
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
            $stmt = $db->Prepare("INSERT INTO msg_grupo (gr_nombre) VALUES (?)");

            if (!$stmt):
                throw new Exception("La inserción del grupo falló en su preparación.");
            endif;

            $name = utf8_decode($db->clearText($name));
            $bind = $stmt->bind_param("s", $name);

            if (!$bind):
                throw new Exception("La inserción del grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La inserción del grupo falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => $stmt->insert_id);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }

    /**
     * @param $gr
     * @param $us
     * @param null $db
     * @return array
     */
    public function assignUser($gr, $us, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("INSERT INTO msg_usuario_grupo (gr_id, us_id) VALUES (?, ?)");

            if (!$stmt):
                throw new Exception("La inserción del usuario en el grupo falló en su preparación.");
            endif;

            $gr = $db->clearText($gr);
            $us = $db->clearText($us);
            $bind = $stmt->bind_param("ii", $gr, $us);

            if (!$bind):
                throw new Exception("La inserción del usuario en el grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La inserción del usuario en el grupo falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => $stmt->insert_id);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }

    /**
     * @param $gr
     * @param null $db
     * @return array
     */
    public function unassignUser($gr, $db = null): array
    {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        try {
            $stmt = $db->Prepare("DELETE FROM msg_usuario_grupo WHERE gr_id = ?");

            if (!$stmt):
                throw new Exception("La eliminación del usuario en el grupo falló en su preparación.");
            endif;

            $gr = $db->clearText($gr);
            $bind = $stmt->bind_param("i", $gr);

            if (!$bind):
                throw new Exception("La eliminación del usuario en el grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La eliminación del usuario en el grupo falló en su ejecución.");
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
            $stmt = $db->Prepare("UPDATE msg_grupo SET gr_nombre = ? WHERE gr_id = ?");

            if (!$stmt):
                throw new Exception("La edición del grupo falló en su preparación.");
            endif;

            $name = utf8_decode($db->clearText($name));
            $bind = $stmt->bind_param("si", $name, $id);

            if (!$bind):
                throw new Exception("La edición del grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La edición del grupo falló en su ejecución.");
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
            $stmt = $db->Prepare("UPDATE msg_grupo SET gr_activo = FALSE WHERE gr_id = ?");

            if (!$stmt):
                throw new Exception("La desactivación del grupo falló en su preparación.");
            endif;

            $bind = $stmt->bind_param("i", $id);
            if (!$bind):
                throw new Exception("La desactivación del grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La desactivación del grupo falló en su ejecución.");
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
            $stmt = $db->Prepare("UPDATE msg_grupo SET gr_activo = TRUE WHERE gr_id = ?");

            if (!$stmt):
                throw new Exception("La activación del grupo falló en su preparación.");
            endif;

            $bind = $stmt->bind_param("i", $id);
            if (!$bind):
                throw new Exception("La activación del grupo falló en su binding.");
            endif;

            if (!$stmt->execute()):
                throw new Exception("La activación del grupo falló en su ejecución.");
            endif;

            $result = array('estado' => true, 'msg' => true);
            $stmt->close();
            return $result;
        } catch (Exception $e) {
            return array('estado' => false, 'msg' => $e->getMessage());
        }
    }
}