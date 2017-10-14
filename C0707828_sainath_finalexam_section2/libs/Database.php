<?php



class Database extends PDO {

    function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS) {
        parent::__construct($DB_TYPE . ':host' . $DB_HOST . ';dbname=' . $DB_NAME, $DB_USER, $DB_PASS);
    }

    /**
     * @param String $sql la consulta
     * @param Array $array parametro para hacer el Bind
     * @param constant $fetchMode el fetch mode de PDO
     * @return mixed 
     */
    public function select($sql, $array = array(), $fetchMode = PDO::FETCH_ASSOC) {
        $sth = $this->prepare($sql);
        foreach ($array as $key => $value) {
            $sth->bindValue("$key", $value);
        }
        
        $sth->execute();
        return $sth->fetchAll($fetchMode);
    }

    public function insert() {
        
    }

    public function update() {
        
    }

    public function delete() {
        
    }

}
