<?php
class Comment {
    private $id;
    private $data;
    private $date;

    private $account_id;
    private $news_id;

    private $conn;

    public function __construct(mysqli $db){
        $this->conn = $db;
    }

    //Getter, Setter

    public function setId($id)              { $this->id = $id; }
    public function setData($data)          { $this->data = $data; }
    public function setDate($date)          { $this->date = $date; }
    public function setAccount($account)    { $this->account_id = $account; }
    public function setNews($news)          { $this->news_id = $news; }
    
    public function getId()         { return $this->id; }
    public function getData()       { return $this->data; }
    public function getDate()       { return $this->date; }
    public function getAccount()    { return $this->account_id; }
    public function getNews()       { return $this->news_id; }

    //writeComment()
    public function writeComment(){

        $sql = "INSERT INTO tbl_comment
                (Comment_Data, Comment_Date, Account_ID, New_ID)
                VALUES (?,?,?,?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bind_param(
            "ssii",
            $this->data,
            $this->date,
            $this->account_id,
            $this->news_id
        );

        return $stmt->execute();
    }

    //delete()
    public function delete(){

        $sql = "DELETE FROM tbl_comment WHERE Comment_ID=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$this->id);

        return $stmt->execute();
    }

    //Lấy comment theo bài viết
    public function getCommentsByNews(){

        $sql = "SELECT c.*, a.Username
                FROM tbl_comment c
                JOIN tbl_account a
                ON c.Account_ID = a.Account_ID
                WHERE c.New_ID=?
                ORDER BY Comment_Date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i",$this->news_id);

        $stmt->execute();

        return $stmt->get_result();
    }
}
?>
