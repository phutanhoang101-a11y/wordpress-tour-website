<?php
/**
 * Tệp cấu hình kết nối cơ sở dữ liệu
 * Sử dụng mysqli để kết nối đến cơ sở dữ liệu MySQL
 */

// Thông tin kết nối cơ sở dữ liệu
$host = 'localhost';      // Địa chỉ máy chủ MySQL
$username = 'root';       // Tên đăng nhập MySQL
$password = '';           // Mật khẩu MySQL
$database = 'soleil';     // Tên cơ sở dữ liệu

// Tạo kết nối đến cơ sở dữ liệu
$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối cơ sở dữ liệu thất bại: " . $conn->connect_error);
}

// Thiết lập bảng mã UTF-8 để hỗ trợ tiếng Việt
$conn->set_charset("utf8mb4");

/**
 * Hàm escapeString để tránh SQL injection
 * @param string $string Chuỗi cần xử lý
 * @return string Chuỗi đã được làm sạch
 */
function escapeString($string) {
    global $conn;
    return $conn->real_escape_string($string);
}

/**
 * Hàm thực thi câu lệnh SQL và trả về kết quả
 * @param string $sql Câu lệnh SQL cần thực thi
 * @return mysqli_result|bool Kết quả truy vấn
 */
function executeQuery($sql) {
    global $conn;
    return $conn->query($sql);
}

/**
 * Hàm lấy tất cả các bản ghi từ một truy vấn
 * @param string $sql Câu lệnh SQL
 * @return array Mảng các bản ghi
 */
function fetchAll($sql) {
    $result = executeQuery($sql);
    $data = [];
    
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }
    
    return $data;
}

/**
 * Hàm lấy một bản ghi từ một truy vấn
 * @param string $sql Câu lệnh SQL
 * @return array|null Bản ghi hoặc null nếu không tìm thấy
 */
function fetchOne($sql) {
    $result = executeQuery($sql);
    
    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }
    
    return null;
}
?> 