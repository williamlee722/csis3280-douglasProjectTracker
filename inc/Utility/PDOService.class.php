<?php

class PDOService {

    private  $_host = DB_HOST;
    private  $_user = DB_USER;  
    private  $_pass = DB_PASS;  
    private  $_dbname = DB_NAME;  
    private  $_dbport = DB_PORT;  

    private  $_dbh;

    private $_className;

    private  $_pstmt;

    public function __construct(string $className) {
        
        $this->_className = $className;

        $dsn = 'mysql:host='.$this->_host.';dbname='.$this->_dbname.';port='.$this->_dbport; 

        $options = array (
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );

        try {
            $this->_dbh = new PDO($dsn, $this->_user, $this->_pass, $options);
        } catch (PDOException $pe)   {
            $this->_error = $pe->getMessage();
        }

    }

    public function query(string $query)    {
        $this->_pstmt = $this->_dbh->prepare($query);
    }

    public function bind($param, $value, $type=null)    {

        if (is_null($type)) {  
            switch (true) {
                case is_int($value):  
                $type = PDO::PARAM_INT;  
                break;  
                case is_bool($value):  
                $type = PDO::PARAM_BOOL;  
                break;  
                case is_null($value):  
                $type = PDO::PARAM_NULL;  
                break;  
                default:  
                $type = PDO::PARAM_STR;  
                break;
                }  
            }
            
        $this->_pstmt->bindValue($param, $value, $type);  

    }

    public function execute()   {
        return $this->_pstmt->execute();
    }

    public function resultSet() {
        return $this->_pstmt->fetchAll(PDO::FETCH_CLASS, $this->_className);
    }

    public function singleResult()  {
        $this->_pstmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        return $this->_pstmt->fetch(PDO::FETCH_CLASS);
    }

    public function rowCount()  {
        return $this->_pstmt->rowCount();
    }

    public function lastInsertedId()  {
        return $this->_dbh->lastInsertId();
    }

}
?>