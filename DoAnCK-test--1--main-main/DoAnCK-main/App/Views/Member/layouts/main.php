<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 🔥 LOAD MODEL TRƯỚC (FIX lỗi incomplete object)
require_once __DIR__ . '/../../../Models/MonUkou/Account.php';

// 🔥 CHẶN CHƯA LOGIN
if (!isset($_SESSION['user_obj'])) {
    $controller = $_GET['controller'] ?? '';

    if ($controller !== 'account') {
        header("Location: index.php?controller=account&action=login");
exit;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điện ảnh & Sao</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand { font-family: 'Georgia', serif; }
        .search-form .form-control { 
            border-radius: 25px 0 0 25px; 
            width: 300px;
        }
        .search-form .btn { border-radius: 0 25px 25px 0; }
        .user-avatar { width: 40px; height: 40px; border-radius: 50%; }
        
        /* 🔥 FIX CHÍNH - Padding cho navbar fixed */
        body { padding-top: 80px; }
        @media (max-width: 992px) { body { padding-top: 70px; } }
        @media (max-width: 768px) { body { padding-top: 65px; } }
        
        /* Content chính */
        main { 
            min-height: calc(100vh - 80px);
            padding: 2rem 0;
        }
        
        /* Title fix */
        .news-title { 
            margin-top: 1rem !important; 
            padding-top: 1rem !important;
        }

        /* 🔥 HIỆU ỨNG HOVER CHO CARD - PHÌNH TO */
    .card {
        transition: all 0.3s ease-in-out !important;
        border: none;
        border-radius: 15px !important;
        overflow: hidden;
    }
    
    .card:hover {
        transform: translateY(-10px) scale(1.02) !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3) !important;
        z-index: 10;
    }
    
    /* Hover shadow cho img */
    .card-img-top:hover {
        transform: scale(1.1);
        transition: transform 0.3s ease;
    }
    
    /* Hover cho link title */
    .card-title a:hover {
        color: #667eea !important;
        text-decoration: none;
    }
    
    /* Smooth animation cho toàn bộ */
    .hover-shadow {
        transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .card:hover {
            transform: translateY(-5px) scale(1.01) !important;
        }
    }
    .navbar {
    z-index: 99999 !important;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
}

main {
    position: relative;
    z-index: 1;
}

.gradient-overlay {
    pointer-events: none;
}
nav.navbar {
    z-index: 999999 !important;
}
    </style>
</head>
<body style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
    
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="index.php">
                <i class="fas fa-film me-2 text-warning"></i>Điện ảnh & Sao
            </a>
            
              <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    Trang chủ
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=home&action=movies">
                    Tin phim
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=movie">
                    Phim
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=home&action=actors">
                    Tin sao
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?controller=actor">
                    Diễn viên
                </a>
            </li>
            </ul>

            <!-- Search Form -->
            <form class="search-form d-flex me-3 position-relative" id="searchForm">
                <input class="form-control me-1"
                    type="search"
                    id="searchInput"
                    placeholder="Tìm phim, tin, diễn viên..."
                    autocomplete="off">

                <button class="btn btn-warning" type="submit">
                    <i class="fas fa-search"></i>
                </button>

                <div id="searchBox"
                    style="position:absolute; top:100%; left:0; right:0; background:white; z-index:9999; display:none; border-radius:10px;">
                </div>
            </form>

            <!-- User Menu -->
            <ul class="navbar-nav">
                <?php if (isset($_SESSION['user_obj'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" 
                           role="button" data-bs-toggle="dropdown">
                            <img src="/uploads/Account_Img/<?= htmlspecialchars($_SESSION['user_obj']->getImg()) ?>"
                                class="user-avatar me-2"
                                alt="Avatar">
                            <span><?= $_SESSION['user_obj']->getUser() ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="index.php?controller=account&action=profile">
                                <i class="fas fa-user me-2"></i>Tài khoản
                            </a></li>
                            <li><a class="dropdown-item" href="index.php?controller=account&action=watchlist">
                                <i class="fas fa-list me-2"></i>Danh sách xem sau
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="index.php?controller=account&action=logout">
                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                            </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?controller=account&action=login">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-outline-light ms-2" href="index.php?controller=account&action=register">
                            Đăng ký
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- 🔥 MAIN CONTENT - ĐÃ FIX -->
    <main class="container">
        <?= $content ?? '' ?>
    </main>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
            $(document).ready(function() {
                // Fix Search Form Submit
                $('#searchForm').submit(function(e) {
                    e.preventDefault();
                    let keyword = $('#searchInput').val().trim();
                    if (keyword) {
                        window.location.href = `index.php?controller=search&keyword=${encodeURIComponent(keyword)}`;
                    }
                    return false;
                });
            });
            </script>
    
</body>
</html>
<script>
const input = document.getElementById("searchInput");
const box = document.getElementById("searchBox");
let timer = null;

// 🔥 DÙNG window.location.origin thay vì hardcode
const baseUrl = window.location.origin + window.location.pathname.replace(/\/[^\/]*$/, '/');

input.addEventListener("input", function () {  // ✅ DÙNG "input" thay "keyup"
    clearTimeout(timer);
    let keyword = this.value.trim();

    if (keyword.length < 2) {
        box.style.display = "none";
        return;
    }

    timer = setTimeout(() => {
        let context = getCurrentContext();
        
        // ✅ DÙNG DYNAMIC URL
        fetch(`${window.location.origin}${window.location.pathname}?controller=search&action=ajax&keyword=${encodeURIComponent(keyword)}&context=${context}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('Network response was not ok');
            return res.json();
        })
        .then(data => {
            console.log("✅ Search data:", data); // Debug
            
            if (!data || data.length === 0) {
                box.innerHTML = `<div style="padding:12px;color:#666;font-style:italic">Không tìm thấy "${keyword}"</div>`;
                box.style.display = "block";
                return;
            }

            let html = "";
            data.forEach((item, index) => {
                html += `
                    <a href="${item.link}" 
                       class="search-result-item"
                       style="display:block;padding:12px;border-bottom:1px solid #eee;text-decoration:none;color:#333;">
                        <div style="font-weight:500;font-size:14px">${item.title}</div>
                        <small style="color:#666">${item.type}</small>
                    </a>
                `;
            });

            box.innerHTML = html;
            box.style.display = "block";
        })
        .catch(error => {
            console.error("❌ Search error:", error);
            box.innerHTML = `<div style="padding:12px;color:#e74c3c">Lỗi tìm kiếm, thử lại!</div>`;
            box.style.display = "block";
        });
    }, 300);
});

// Ẩn search box khi click outside
document.addEventListener("click", function (e) {
    if (!document.getElementById("searchForm").contains(e.target)) {
        box.style.display = "none";
    }
});

function getCurrentContext() {
    const params = new URLSearchParams(window.location.search);
    const controller = params.get("controller");

    // ✅ FIX: Kiểm tra chính xác hơn
    if (controller === "actor" || controller === "home" && params.get("action") === "actors") return "actor";
    if (controller === "movie") return "movie";
    if (controller === "news") return "news";
    
    return "movie"; // Default
}

// CSS cho search box đẹp hơn
const style = document.createElement('style');
style.textContent = `
    #searchBox {
        position: absolute !important;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        max-height: 400px;
        overflow-y: auto;
        z-index: 99999;
        margin-top: 5px;
    }
    .search-result-item:hover {
        background: #f8f9fa !important;
    }
`;
document.head.appendChild(style);
</script>