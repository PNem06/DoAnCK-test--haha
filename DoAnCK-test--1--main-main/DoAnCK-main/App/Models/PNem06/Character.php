<?php
class Character {
    private $conn;
    private $id;
    private $name;
    public function __construct($conn){
        $this->conn = $conn;
    }
    public function setCharacter($id,$name){
        $this->id = $id;
        $this->name = $name;
    }
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getCharInfo($char_id){
        $sql = "
        SELECT 
            c.Character_Name,
            a.Actor_Name
        FROM tbl_character c
        JOIN tbl_actor a 
        ON c.Actor_ID = a.Actor_ID
        WHERE c.Character_ID = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$char_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>
