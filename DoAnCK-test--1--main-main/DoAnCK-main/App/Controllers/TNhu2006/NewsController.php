<?php
require_once __DIR__ . '/../../../Config/database.php';
require_once __DIR__ . '/../../Models/TNhu2006/News.php';
require_once __DIR__ . '/../../Models/TNhu2006/Comment.php';

class NewsController {
    private $mysqli;

    public function __construct() {
        $this->mysqli = Database::getInstance()->getMysqliConnection();
    }

    // =========================
    // LIST
    // =========================
    public function index() {
        $model = new News($this->mysqli);
        $result = $model->getLatest(12);

        $GLOBALS['newsList'] = [];

        while ($row = $result->fetch_assoc()) {
            $row['short_content'] = substr(strip_tags($row['New_Content'] ?? ''), 0, 120) . '...';
            $row['category_label'] = ($row['New_Category'] === 'Actor')
                ? '👥 Diễn viên'
                : '🎬 Phim ảnh';

            $GLOBALS['newsList'][] = $row;
        }

        $GLOBALS['pageTitle'] = 'Tin tức điện ảnh';
        $GLOBALS['totalPages'] = 1;
        $GLOBALS['pageNum'] = 1;

        include __DIR__ . '/../../../App/Views/member/home.php';
    }

    // =========================
    // DETAIL
    // =========================
    public function showDetail($news_id) {
        $model = new News($this->mysqli);

        $news = $model->getById($news_id);

        if (!$news) {
            $_SESSION['error'] = 'Tin tức không tồn tại!';
            header('Location: index.php');
            exit;
        }

        // tăng view
        $model->increaseView($news_id);

        // comments (SAFE FIX)
        $commentsResult = $model->getComments($news_id);
        $comments = [];

        if ($commentsResult) {
            while ($row = $commentsResult->fetch_assoc()) {
                $comments[] = $row;
            }
        }

        // related (IMPORTANT FIX - 3 PARAMS)
        $relatedResult = $model->getRelated(
            $news_id,
            $news['New_Category'],
            4
        );

        $relatedNews = [];

        if ($relatedResult) {
            while ($row = $relatedResult->fetch_assoc()) {
                $relatedNews[] = $row;
            }
        }

        $GLOBALS['news'] = $news;
        $GLOBALS['comments'] = $comments;
        $GLOBALS['relatedNews'] = $relatedNews;
        $GLOBALS['pageTitle'] = $news['New_Title'];

        include __DIR__ . '/../../../App/Views/member/news-detail.php';
    }
}
?>