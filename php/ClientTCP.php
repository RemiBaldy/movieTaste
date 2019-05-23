<?php

class ClientTCP
{
    private $hostName, $port, $timeout;

    /**
     * file pointer which will be used to retrieve datas from the socket with fgets()
     */
    private $filePointer;

    /**
     * ClientTCP constructor.
     * @param $hostName
     * @param $port
     * @param $timeout
     */
    public function __construct($hostName, $port, $timeout)
    {
        $this->hostName = $hostName;
        $this->port = $port;
        $this->timeout = $timeout;
    }


    /**
     * Open a domain socket connection
     */
    function connectToServer(){
     $this->filePointer = fsockopen($this->hostName, $this->port, $errno, $errstr, $this->timeout);
    }

    /**
     * Ask the python server to execute a script on the given userId
     * @param $userId
     */
    function sendRequestMovies($userId){
         fwrite($this->filePointer, "userId:".$userId);
     }

    /**
     * @return array
     */
    function getServerResponseArrayFormat(){
         $msg = $this->getServerResponseStringFormat();

         return $this->convertStringToArray($msg);
     }

    /**
     * While buffer doesn't reach end of file, retrieve the data inside it and concat them into a string
     * @return string result of concatened buffers
     */
    function getServerResponseStringFormat(){
         $msg ="";
         while (!feof($this->filePointer)) {
             $msg .= fgets($this->filePointer, 128);
         }
         fclose($this->filePointer);
         return $msg;
     }

    /**
     * @param $msg
     * @return array of strings
     */
    function convertStringToArray($msg){
         return explode(',', $msg);
     }

}
?>
