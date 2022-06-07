<?php
class Database{
    private $host = "localhost";
    private $name = "ajax_in_crud";
    private $user = "root";
    private $password = "";
    public $dbStore;
    public function database_function()
    { $this->dbStore = null;
        try {
            $dbSteatment = new PDO("mysql:host=".$this->host.";dbname=".$this->name,$this->user,$this->password);
            $dbSteatment->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $this->dbStore = $dbSteatment;
        } catch (PDOException $err) {
            echo "database connection failed". $err->getMessage();
        }
       return $this->dbStore;
    }
}
?>