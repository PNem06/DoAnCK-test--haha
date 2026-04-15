<?php
// Config/config.php - KHÔNG trùng define
if (!defined('HOST')) define("HOST", "localhost");
if (!defined('DB')) define("DB", "db_web1");
if (!defined('USER')) define("USER", "root");
if (!defined('PASSWORD')) define("PASSWORD", "");

// Export array cho class mới
return [
    'db' => [
        'host' => HOST,
        'name' => DB,
        'user' => USER,
        'pass' => PASSWORD
    ]
];
?>