<?php
include_once ("MySQLDatabase.class.php");
/**
 *
 */
class DatabaseSessionHandler {
    private $db;
 
    public function _open($save_path, $session_name) {
        $this -> db = new MySQLDatabase();
        return true;
    }
 
    public function _close() {
        $this -> db -> close();
    }
 
    function _read($id) {
 
        $id = mysql_real_escape_string($id);
 
        $query = "SELECT data
                FROM SESSION
                WHERE id = '$id'";
 
        if ($result = $this -> db -> executeQuery($query)) {
            if (mysql_num_rows($result)) {
                $record = mysql_fetch_assoc($result);
                return $record['data'];
            }
        }
 
        return '';
    }
 
    function _write($id, $data) {
        $access = time();
 
        $id = mysql_real_escape_string($id);
        $access = mysql_real_escape_string($access);
        $data = mysql_real_escape_string($data);
 
        $query = "REPLACE
                INTO SESSION
                VALUES ('$id', '$access', '$data')";
 
        return $this -> db -> executeQuery($query);
    }
 
    function _destroy($id) {
 
        $id = mysql_real_escape_string($id);
 
        $query = "DELETE
                FROM SESSION
                WHERE id = '$id'";
 
        return $this -> db -> executeQuery($query);
    }
 
    function _clean($max) {
        $old = time() - $max;
        $old = mysql_real_escape_string($old);
 
        $query = "DELETE
                FROM SESSION
                WHERE access < '$old'";
 
        return $this -> db -> executeQuery($query);
    }
     
    public function killUserSession($username){
        $query = "delete from SESSION where data like('%userID|s:%\"". mysql_real_escape_string($username) ."%\";first_name|s:%')";
        $this->db->executeQuery($query);
    }
 
}
?>
