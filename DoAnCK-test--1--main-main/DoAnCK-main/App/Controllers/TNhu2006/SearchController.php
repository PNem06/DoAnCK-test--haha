<?php
namespace App\Controllers\TNhu2006;

require_once __DIR__ . '/../../../Config/database.php';

class SearchController {
    private $mysqli;

    public function __construct() {
        $this->mysqli = \Database::getInstance()->getMysqliConnection();
    }

    public function ajax() {
        // 🔥 CRITICAL: NO OUTPUT BEFORE JSON
        if (ob_get_level()) ob_clean(); // Xóa buffer
        
        // Set headers TRƯỚC BẤT KỲ OUTPUT NÀO
        header('Content-Type: application/json; charset=utf-8');
        header('Access-Control-Allow-Origin: *');
        
        $context = $_GET['context'] ?? 'global';
        $keyword = trim($_GET['keyword'] ?? '');

        // 🔥 VALIDATE INPUT
        if (empty($keyword)) {
            echo json_encode([]);
            exit;
        }

        $like = '%' . $keyword . '%';
        $results = [];

        try {
            // GLOBAL SEARCH (ưu tiên)
            if ($context === 'global') {
                // Movies
                $sql = "SELECT Movie_ID, Movie_Title FROM tbl_movie WHERE Movie_Title LIKE ? LIMIT 5";
                $results = $this->searchMovies($sql, $like);
                
                // Actors  
                $sql = "SELECT Actor_ID, Actor_Name FROM tbl_actor WHERE Actor_Name LIKE ? LIMIT 4";
                $results = array_merge($results, $this->searchActors($sql, $like));
                
                // News
                $sql = "SELECT New_ID, New_Title FROM tbl_new WHERE New_Title LIKE ? LIMIT 3";
                $results = array_merge($results, $this->searchNews($sql, $like));
            }
            // Context cụ thể...
            elseif ($context === 'movie') {
                $sql = "SELECT Movie_ID, Movie_Title FROM tbl_movie WHERE Movie_Title LIKE ? LIMIT 10";
                $results = $this->searchMovies($sql, $like);
            }
            elseif ($context === 'actor') {
                $sql = "SELECT Actor_ID, Actor_Name FROM tbl_actor WHERE Actor_Name LIKE ? LIMIT 10";
                $results = $this->searchActors($sql, $like);
            }
            elseif ($context === 'news') {
                $sql = "SELECT New_ID, New_Title FROM tbl_new WHERE New_Title LIKE ? LIMIT 10";
                $results = $this->searchNews($sql, $like);
            }

            // 🔥 CHỈ ECHO JSON - KHÔNG CÓ GÌ KHÁC!
            echo json_encode($results, JSON_UNESCAPED_UNICODE);
            
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
        exit; // QUAN TRỌNG!
    }

    private function searchMovies($sql, $like) {
        $results = [];
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $results[] = [
                "title" => $row['Movie_Title'],
                "type" => "🎬 Phim", 
                "link" => "index.php?controller=movie&action=showDetail&id=" . $row['Movie_ID']
            ];
        }
        return $results;
    }

    private function searchActors($sql, $like) {
        $results = [];
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $results[] = [
                "title" => $row['Actor_Name'],
                "type" => "👤 Diễn viên",
                "link" => "index.php?controller=actor&action=showProfile&id=" . $row['Actor_ID']
            ];
        }
        return $results;
    }

    private function searchNews($sql, $like) {
        $results = [];
        $stmt = $this->mysqli->prepare($sql);
        $stmt->bind_param("s", $like);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $results[] = [
                "title" => $row['New_Title'],
                "type" => "📰 Tin tức", 
                "link" => "index.php?controller=news&action=showDetail&id=" . $row['New_ID']
            ];
        }
        return $results;
    }
}
?>