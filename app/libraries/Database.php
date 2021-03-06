<?php
//pdo
class Database
{
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;

    private $dbh;
    private $stmt;
    private $error;

    public function __construct()
    {
        $dsn = 'mysql:host' . $this->host . ';dbname=' . $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION

        );
        //pdo exeption
        //echo $dsn;
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            echo 'conected';
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo 'bla' . $this->error;
        }
    }

    //prepare statment with query
    public function query($sql)
    {
        //echo 'q';
        $this->stmt = $this->dbh->prepare($sql);
        //print_r($this->stmt);
        //print_r($this->dbh);
    }
    public function bind($param, $value, $type = null)
    {
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
            };
        }
        $this->stmt->bindValue($param, $value, $type);
        // print_r($this->stmt);
    }
    public function execute()
    {

        return $this->stmt->execute();
    }

    // get result set as arr of obj
    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function single()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}
