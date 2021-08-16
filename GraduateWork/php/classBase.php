
<?php
class Base{
    protected $location;
    protected $username;
    protected $password;
    protected $base;
    protected $db;

    public function __construct(){
        $this->location="localhost";
        $this->username="root";
        $this->password="";
        $this->base="anterija";
    }
    public function __destruct(){
        return mysqli_close($this->db);
    }
    public function connect(){
        $this->db=@mysqli_connect( $this->location, $this->username, $this->password, $this->base);
        if(!$this->db){
            echo "Neuspela konekcija na bazu.";
            echo mysqli_connect_error();
            echo mysqli_connect_errno();
            return false;
        }
        return true;
    }
    public function query($query){
        return mysqli_query($this->db, $query);
    }
    public function num_rows($result){
        return mysqli_num_rows($result);
    }
    public function fetch_object($result){
        return mysqli_fetch_object($result);
    }
    public function error(){
        return mysqli_error($this->db);
    }
    public function errno(){
        return mysqli_errno($this->db);
    }
    public function insert_id(){
        return mysqli_insert_id($this->db);
    }
    public function escape_string($check){
        return mysqli_real_escape_string($this->db, $check);
    }
}

?> 
