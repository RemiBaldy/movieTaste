<?php

/**
 * Created by PhpStorm.
 * User: moi
 * Date: 13/05/2019
 * Time: 09:19
 */
class SqlRequest
{
    /**
     * @var String of the sql query to execute
     */
    private $request;

    /**
     * @var Object class Database
     */
    private $Database;

    /**
     * SqlRequest constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }


    /**
     * Realise the mySql request associated to a database connection and return the result of this request.
     * Function called in connectAndRequest()
     *
     * @param $connection
     * @return bool|mysqli_result
     */
    public function execute()
    {
        include_once("Database.php");
        //$this->request = $request;
        $result = mysqli_query($this->Database->getConnection(),$this->request);
        if (!$result) {
            return false;
        }
        $this->Database->closeCon();
        return $result;
    }

    /**
     * Connect to the database specified in Database object
     */
    function connectToDatabase (){
        include_once("Database.php");
        $this->Database = new Database();
        $this->Database->openCon();
    }

    /**
     * Connect to the database specified in Database object, then call the method execute() and return the result of this call.
     *
     * @return bool|mysqli_result
     */
    public function connectAndRequest(){
        $this->connectToDatabase();

        return $this->execute();
    }

    /**
     * Not used anymore...
     * Trick to store a mySq request result in a Javascript array.
     * Given a mySql request result, Iterate on every row/data of this result and echo " " them.
     * This way, you can declare a Javascript array with a structure like this : 'jsArray = [<?php resultToJavascriptVar($result)?>]'
     *
     * @param $requestResult
     */
    public function resultToJavasciptVar ($requestResult){
        while ($row = mysqli_fetch_row($requestResult)) {
            for ($i = 0; $i < count($row); $i++) {
                $data = $row[$i]; ;
                echo "'$data',";
            }
        }
    }



}?>