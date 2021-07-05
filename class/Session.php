<?php

class Session {

	public function __construct() {
	}

    /**
     * @param $id
     * @param null $db
     * @return stdClass
     */
	public function get($id, $db = null) {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        
		$stmt = $db->Prepare("SELECT * FROM msg_sesion WHERE ses_id = ?");

		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$obj = new stdClass();

		$row = $result->fetch_assoc();
		$obj->ses_id = $row['ses_id'];
		$obj->us_id = $row['us_id'];
		$obj->us_time = $row['ses_time'];
		$obj->us_ip = $row['ses_ip'];

		unset($db);
		return $obj;
	}

    /**
     * @param $user
     * @param null $db
     * @return mixed
     */
	public function getCount($user, $db = null) {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        
		$stmt = $db->Prepare("SELECT COUNT(ses_id) AS ses FROM msg_sesion WHERE us_id = ?");

		$stmt->bind_param("i", $user);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		return $row['ses'];
	}

    /**
     * @param $user
     * @param $ip
     * @param null $db
     * @return mixed
     */
	public function getCountIP($user, $ip, $db = null) {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        
		$stmt = $db->Prepare("SELECT COUNT(ses_id) AS ses FROM msg_sesion WHERE us_id = ? AND ses_ip = ?");

		$stmt->bind_param("is", $user, $ip);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		return $row['ses'];
	}

    /**
     * @param $user
     * @param $ip
     * @param null $db
     * @return bool
     */
	public function set($user, $ip, $db = null) {
        if (is_null($db)):
            $db = new myDBC();
        endif;
        
		$stmt = $db->Prepare("INSERT INTO msg_sesion (us_id, ses_ip, ses_ultima) VALUES (?, ?, TRUE)");

		$stmt->bind_param("is", $user, $ip);

		if ($stmt->execute()):
			unset($db);
			return true;
		else:
			return false;
		endif;
	}

    /**
     * @param $user
     * @param null $db
     * @return bool
     */
	public function setLast($user, $db = null) {
        if (is_null($db)):
            $db = new myDBC();
        endif;

        $stmt = $db->Prepare("UPDATE msg_sesion SET ses_ultima = FALSE WHERE us_id = ?");

        $stmt->bind_param("i", $user);

        if ($stmt->execute()):
            unset($db);
            return true;
        else:
            return false;
        endif;
    }
}