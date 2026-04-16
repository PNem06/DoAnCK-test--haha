

 <?php
class News {
    private $conn;


    public function __construct(mysqli $db){
        $this->conn = $db;
    }


    // =========================
    // LATEST NEWS
    // =========================
    public function getLatest($limit){
        $stmt = $this->conn->prepare("CALL sp_GetLatestNews(?)");
        $stmt->bind_param("i", $limit);
        $stmt->execute();


        $result = $stmt->get_result();


        $stmt->close();
        $this->conn->next_result();


        return $result;
    }


    // =========================
    // GET BY ID
    // =========================
    public function getById($id){
        $stmt = $this->conn->prepare("CALL sp_GetNewsById(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();


        $result = $stmt->get_result()->fetch_assoc();


        $stmt->close();
        $this->conn->next_result();


        return $result;
    }


    // =========================
    // INCREASE VIEW (✔ CHỈ 1 HÀM)
    // =========================
    public function increaseView($id){
        $stmt = $this->conn->prepare("CALL sp_IncrementNewsView(?)");
        $stmt->bind_param("i", $id);
        $stmt->execute();


        $stmt->close();
        $this->conn->next_result();


        return true;
    }


    // =========================
    // COMMENTS
    // =========================
    public function getComments($news_id){
        $stmt = $this->conn->prepare("CALL sp_GetCommentsByNews(?)");
        $stmt->bind_param("i", $news_id);
        $stmt->execute();


        $result = $stmt->get_result();


        $stmt->close();
        $this->conn->next_result();


        return $result;
    }


    // =========================
    // RELATED NEWS
    // =========================
    public function getRelated($newsId, $category, $limitNum){
        $stmt = $this->conn->prepare("CALL sp_GetRelatedNews(?, ?, ?)");
        $stmt->bind_param("isi", $newsId, $category, $limitNum);
        $stmt->execute();


        $result = $stmt->get_result();


        $stmt->close();
        $this->conn->next_result();


        return $result;
    }
}
?>


