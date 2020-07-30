<?php
                                             
class Database                   
{
    private static $dbHost = "localhost";
    private static $dbName = "139140";
    private static $dbUsername ="139140";
    private static $dbUserpassword ="jourdain2016";
    
    private static $connection = null;

    public static function connect()  
    {
        if(self::$connection == null)
        {
            try
            {
              self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName.";charset=utf8" , self::$dbUsername, self::$dbUserpassword);


            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }

}

?>