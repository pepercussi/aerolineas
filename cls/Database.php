<?php
/**
 * Lacuna PDO Data Class
 * @autor Miguel Barocchi
 * @param bool $auto_connect can be ommited: default value = true
 *
 *
 * Usage:
 * $db = new Database();
 * $db->call('sp_test_update',array((string)'6'));
 * $db->query('insert into table(a,b) values(8,9)');
 * $res = $db->query('select * from kek');
 * $res = $db->call('sp_test_get',array((string)'6'));
 **/

class Database {

    private $dbh;
    public $lastID;

    public function __construct($auto_connect = true){
        if(!defined('DB_DBNAME')){
            require_once(PATH_CFG.'connection.php');
        }
        if($auto_connect){$this->connect();}
    }

/**
 * Connect to the database
 *
 * @return void
 */
    public function connect(){
        try {
            $dsn = 'mysql:dbname=' . DB_DBNAME . ';host=' . DB_HOST;
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo  $e->getMessage();
        }
    }

/**
 * Query database and return fetched query result
 *
 * @return Array
 * @param string $sql_query SQL query
 */
    public function query($sql_query){
        try{
            $smh = $this->dbh->query($sql_query);
            return $smh->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            /*if error code = HY000 means that fetchall() returned no result*/
            if($e->getCode()!='HY000'){
                echo $e->getMessage();
            }
        }
    }

/**
 * Call procedure from database
 *
 * @return Array
 * @param string $procedure_name procedure name
 * @param Array $arr_values array of values (ordered like procedure params)
 * 
 */
    public function call($procedure_name,$arr_values = array(), $hasResult = true){
        $count = count($arr_values);
        //values are empty?
        for ($i = 0; $i < $count-1; $i++) {
            $arr_values[$i] = (empty($arr_values[$i])) ? null : $arr_values[$i];
        }
        $stmt = $this->_prepareCallString($procedure_name,$count);
        try{
            $this->dbh->query('SET CHARACTER SET utf8');
            $smh = $this->dbh->prepare($stmt);
            $smh->execute($arr_values);
            if($hasResult){
                $result = $smh->fetchAll(PDO::FETCH_ASSOC);
                if(isset($result[0]["LAST_INSERT_ID()"])){
                    return $result[0]["LAST_INSERT_ID()"];
                }else{
                    return $result;
                }
            }
        }catch (PDOException $e){
            //if error code = HY000 means that fetchall() returned no result
            if($e->getCode()!='HY000'){
                echo $e->getMessage();
            }
        }
    }

/*******************
 * Private methods *
 *******************/
/**
 * Prepares the call string for the execution of the procedure
 *
 * @return string
 * @param string $procedure_name procedure name
 * @param integer $param_count number of procedure's params
 */
    private function _prepareCallString($procedure_name,$param_count){
        $call_string = '';
        for ($t=1;$t<=$param_count;$t++) {$call_string .= '?,';}
        $call_string = substr($call_string, 0, strlen($call_string)-1);
        $call_string = 'CALL ' . $procedure_name . '(' . $call_string . ')';
        return $call_string;
    }
}