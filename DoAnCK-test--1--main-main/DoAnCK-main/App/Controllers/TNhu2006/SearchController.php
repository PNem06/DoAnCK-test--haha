<?php
require_once __DIR__ . '/../../../Config/database.php';

class SearchController {

    private $mysqli;

    public function __construct() {
        $this->mysqli = Database::getInstance()->getMysqliConnection();
    }

    public function ajax() {

        header('Content-Type: application/json; charset=utf-8');

        $context = $_GET['context'] ?? 'global';
        $keyword = trim($_GET['keyword'] ?? '');

        if ($keyword === '') {
            echo json_encode([]);
            exit;
        }

        $like1 = $keyword . '%';
        $like2 = '%' . $keyword . '%';

        $results = [];

        // ================= ACTOR =================
        if ($context === 'actor') {

            $sql = "SELECT Actor_ID, Actor_Name
                    FROM tbl_actor
                    WHERE Actor_Name LIKE ? OR Actor_Name LIKE ?
                    ORDER BY CASE WHEN Actor_Name LIKE ? THEN 1 ELSE 2 END
                    LIMIT 10";

            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("sss", $like1, $like2, $like1);
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()) {
                $results[] = [
                    "title" => $row['Actor_Name'],
                    "type"  => "Diễn viên",
                    "link"  => "index.php?controller=actor&action=showProfile&id=" . $row['Actor_ID']
                ];
            }
        }

        // ================= MOVIE =================
        elseif ($context === 'movie') {

            $sql = "SELECT Movie_ID, Movie_Title
                    FROM tbl_movie
                    WHERE Movie_Title LIKE ? OR Movie_Title LIKE ?
                    ORDER BY CASE WHEN Movie_Title LIKE ? THEN 1 ELSE 2 END
                    LIMIT 10";

            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("sss", $like1, $like2, $like1);
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()) {
                $results[] = [
                    "title" => $row['Movie_Title'],
                    "type"  => "Phim",
                    "link"  => "index.php?controller=movie&action=showDetail&id=" . $row['Movie_ID']
                ];
            }
        }

        // ================= NEWS =================
        elseif ($context === 'news') {

            $sql = "SELECT New_ID, New_Title
                    FROM tbl_new
                    WHERE New_Title LIKE ? OR New_Title LIKE ?
                    ORDER BY CASE WHEN New_Title LIKE ? THEN 1 ELSE 2 END
                    LIMIT 10";

            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("sss", $like1, $like2, $like1);
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()) {
                $results[] = [
                    "title" => $row['New_Title'],
                    "type"  => "Tin tức",
                    "link"  => "index.php?controller=news&action=showDetail&id=" . $row['New_ID']
                ];
            }
        }

        // ================= GLOBAL (CHO FILE MỚI) =================
        else {

            $sql = "SELECT New_ID, New_Title
                    FROM tbl_new
                    WHERE New_Title LIKE ? OR New_Title LIKE ?
                    LIMIT 8";

            $stmt = $this->mysqli->prepare($sql);
            $stmt->bind_param("ss", $like1, $like2);
            $stmt->execute();
            $res = $stmt->get_result();

            while ($row = $res->fetch_assoc()) {
                $results[] = [
                    "title" => $row['New_Title'],
                    "type"  => "Tin tức",
                    "link"  => "index.php?controller=news&action=showDetail&id=" . $row['New_ID']
                ];
            }
        }

        echo json_encode($results);
        exit;
    }
}