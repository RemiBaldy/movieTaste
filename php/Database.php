<?php

class Database
{
    private $dbHost = "51.38.69.145:63306";
    private $dbUser = "remi";
    private $dbPass = "DBimer";
    private $dbName = "movieWebsite";

    private $connection;


    /**
     * Connect to the specified database and store this connection in $connection
     */
    function openCon()
    {
        $this->connection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    /**
     * close the connection $connection
     */
    function closeCon()
    {
        $this->connection -> close();
    }


    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }



}?>