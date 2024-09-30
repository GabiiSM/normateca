<?php
class DB
{
    private $servername;
    private $dbname;
    private $username;
    private $password;
    public $connection;

    public function __construct($servername, $dbname, $username, $password)
    {
        $this->servername = $servername;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
    }

    public function start_connection()
    {
        $this->connection = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->connection->connect_error) {
            print "Coneccion fallida: " . $this->connection->connect_error . "";
        }

        $this->run_query("SET NAMES 'utf8'");
    }

    public function run_query($query)
    {
        return mysqli_query($this->connection, $query);
    }
}
