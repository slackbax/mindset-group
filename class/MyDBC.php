<?php

$_BASEDIR = explode('class', dirname(__FILE__));
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_NOTICE);

if (file_exists($_BASEDIR[0] . 'src/settings.php')):
    require($_BASEDIR[0] . 'src/settings.php');
endif;

class myDBC
{
    public $mysqli = null;

    /**
     * conectar
     * Metodo para conexion a base de datos
     * Se deben completar los parametros para conexion
     */
    function __construct()
    {
        $Host = DB_HOST;
        $Db = DB_DATABASE;
        $User = DB_USER;
        $Pass = DB_PASSWORD;

        $this->mysqli = new mysqli("p:$Host", "$User", "$Pass", "$Db");

        if ($this->mysqli->connect_errno):
            echo "Fallo al conectar a MySQL: (" . $this->mysqli->connect_errno . ") " . $this->mysqli->connect_error;
        endif;
    }

    // Class deconstructor override
    public function __destruct()
    {
        $this->CloseDB();
    }

    // Prepares a SQL query
    public function Prepare($qry)
    {
        return $this->mysqli->prepare($qry);
    }

    // Runs a sql query
    public function runQuery($qry)
    {
        return $this->mysqli->query($qry);
    }

    // Turns autocommit on/off for transactions
    public function autoCommit($mode)
    {
        $this->mysqli->autocommit($mode);
    }

    // Commits transaction
    public function Commit()
    {
        $this->mysqli->commit();
    }

    // Rollbacks transaction
    public function Rollback()
    {
        $this->mysqli->rollback();
    }

    // Close database connection
    public function CloseDB()
    {
        $this->mysqli->close();
    }

    // Escape the string get ready to insert or update
    public function clearText($text): string
    {
        return $this->mysqli->real_escape_string(trim($text));
    }

    // Get the last insert id
    public function lastID()
    {
        return $this->mysqli->insert_id;
    }
}