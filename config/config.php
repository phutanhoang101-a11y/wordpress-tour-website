<?php
/**
 * Tệp cấu hình chung cho ứng dụng Soleil
 * Chứa các hằng số và thiết lập chung
 */

// Đường dẫn tuyệt đối đến thư mục gốc của ứng dụng
define('ROOT_PATH', dirname(__DIR__));

// URL cơ sở của trang web
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$domainName = $_SERVER['HTTP_HOST'];
define('BASE_URL', $protocol . $domainName. '/soleil/');

// Cấu hình hiển thị lỗi (đặt thành false trong môi trường sản xuất)
define('DISPLAY_ERRORS', true);

if (DISPLAY_ERRORS) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Thông tin về trang web
define('SITE_NAME', 'Soleil - Khu Du Lịch Nghỉ Dưỡng');
define('SITE_DESCRIPTION', 'Khám phá thiên nhiên tuyệt đẹp, văn hóa độc đáo và những giây phút thư giãn tuyệt vời tại Soleil');

// Số lượng mục hiển thị trên mỗi trang (phân trang)
define('ITEMS_PER_PAGE', 6);

// Thiết lập session
session_start();

// Kết nối cơ sở dữ liệu
require_once ROOT_PATH . '/config/database.php';

/**
 * Hàm chuyển hướng đến một URL khác
 * @param string $url URL đích
 * @return void
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Hàm lấy URL đầy đủ từ đường dẫn tương đối
 * @param string $path Đường dẫn tương đối
 * @return string URL đầy đủ
 */
function url($path = '') {
    if (empty($path)) {
        return BASE_URL;
    }
    return BASE_URL . '/' . ltrim($path, '/');
}

/**
 * Hàm hiển thị thông báo
 * @param string $message Nội dung thông báo
 * @param string $type Loại thông báo (success, error, warning, info)
 * @return void
 */
function setMessage($message, $type = 'success') {
    $_SESSION['message'] = [
        'text' => $message,
        'type' => $type
    ];
}

/**
 * Hàm lấy và xóa thông báo
 * @return array|null Thông báo hoặc null nếu không có
 */
function getMessage() {
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
        return $message;
    }
    return null;
}

/**
 * Hàm làm sạch đầu vào
 * @param string $data Dữ liệu cần làm sạch
 * @return string Dữ liệu đã được làm sạch
 */
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 