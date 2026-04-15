<?php
require_once __DIR__ . '/../Models/Award.php';
require_once __DIR__ . '/../Config/database.php';

class AwardController {
    private $awardModel;
    
    public function __construct() {
        $mysqli = $this->getMysqliConnection();
        $this->awardModel = new Award($mysqli);
    }
    
    /**
     * Hiển thị danh sách các giải thưởng
     */
    public function showAwards() {
        // Lấy danh sách tất cả giải thưởng
        $result = $this->awardModel->getAll();
        
        $awards = [];
        while ($row = $result->fetch_assoc()) {
            $awards[] = $row;
        }
        
        // Lấy top diễn viên theo giải thưởng (dùng stored procedure)
        $topActorsResult = $this->awardModel->getTopActors();
        $topActors = [];
        while ($row = $topActorsResult->fetch_assoc()) {
            $topActors[] = $row;
        }
        
        include_once __DIR__ . '/../Views/award/list.php';
    }
    
    /**
     * Chi tiết giải thưởng
     * @param int $award_id
     */
    public function showDetail($award_id) {
        $this->awardModel->setId($award_id);
        $award = $this->awardModel->getDetails();
        
        if (!$award) {
            die('Giải thưởng không tồn tại');
        }
        
        include_once __DIR__ . '/../Views/award/detail.php';
    }
    
    /**
     * Tạo giải thưởng mới (Admin)
     */
    public function createAward() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            include_once __DIR__ . '/../Views/award/create.php';
            return;
        }
        
        // Lấy dữ liệu từ form
        $name = $_POST['name'] ?? '';
        $info = $_POST['info'] ?? '';
        $date = $_POST['date'] ?? date('Y-m-d');
        
        if (empty($name)) {
            die('Tên giải thưởng không được để trống');
        }
        
        // Tạo giải thưởng
        $this->awardModel->setName($name);
        $this->awardModel->setInfo($info);
        $this->awardModel->setDate($date);
        
        $award_id = $this->awardModel->createAward();
        
        // Gán giải thưởng cho Actor, Director, Studio nếu có
        if (isset($_POST['actor_id']) && !empty($_POST['actor_id'])) {
            $this->awardModel->setId($award_id);
            $this->awardModel->setActor($_POST['actor_id']);
            $this->awardModel->assignAwardToActor();
        }
        
        if (isset($_POST['director_id']) && !empty($_POST['director_id'])) {
            $this->awardModel->setId($award_id);
            $this->awardModel->setDirector($_POST['director_id']);
            $this->awardModel->assignAwardToDirector();
        }
        
        header("Location: index.php?controller=award&action=showAwards");
        exit();
    }
    
    /**
     * Lấy kết nối MySQLi
     */
    private function getMysqliConnection() {
        $config = require __DIR__ . '/../../Config/config.php';
        $mysqli = new mysqli(
            $config['db']['host'],
            $config['db']['user'],
            $config['db']['pass'],
            $config['db']['name']
        );
        
        if ($mysqli->connect_error) {
            die("Kết nối MySQLi thất bại: " . $mysqli->connect_error);
        }
        
        return $mysqli;
    }
}
