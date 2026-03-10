<?php
/**
 * Trang tra cứu thông tin đặt vé
 */

 // Thiết lập tiêu đề trang
$pageTitle = "Tra cứu vé";

// Import file header
require_once 'includes/header.php';
require_once 'includes/navbar.php';

$errors = [];
$bookings = [];
$hasSearched = false;

// Xử lý tra cứu vé khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = $_POST['fullname'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $hasSearched = true;
    
    // Kiểm tra dữ liệu nhập vào
    if (empty($fullname) && empty($email) && empty($phone)) {
        $errors[] = 'Vui lòng nhập ít nhất một thông tin để tra cứu';
    } else {
        // Tạo truy vấn SQL an toàn
        $conditions = [];
        $params = [];
        
        if (!empty($fullname)) {
            $conditions[] = "fullname = ?";
            $params[] = $fullname;
        }
        
        if (!empty($email)) {
            $conditions[] = "email = ?";
            $params[] = $email;
        }
        
        if (!empty($phone)) {
            $conditions[] = "phone = ?";
            $params[] = $phone;
        }
        
        $sql = "SELECT * FROM booking WHERE " . implode(" OR ", $conditions);
        
        // Chuẩn bị câu truy vấn
        $stmt = $conn->prepare($sql);
        
        // Bind tham số
        if ($stmt) {
            $types = str_repeat('s', count($params)); // Giả sử tất cả là string
            if ($params) {
                $stmt->bind_param($types, ...$params);
                $stmt->execute();
                $result = $stmt->get_result();
                if ($result) {
                    $bookings = $result->fetch_all(MYSQLI_ASSOC);
                }
                $stmt->close();
            }
        }
    }
}

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mt-2">Tra cứu vé</h1>
            <div class="card shadow-sm">
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Họ và tên</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" 
                                value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Tra cứu</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <?php if ($hasSearched): ?>
                <?php if ($errors): ?>
                    <div class="alert alert-danger mt-4">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php elseif (empty($bookings)): ?>
                    <div class="alert alert-info mt-4">
                        Không tìm thấy thông tin đặt vé với thông tin bạn cung cấp.
                    </div>
                <?php else: ?>
                    <h2 class="mt-5 mb-3">Kết quả tra cứu</h2>
                    
                    <?php foreach ($bookings as $booking): ?>
                        <div class="card shadow-sm mb-4">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Mã đặt vé: #<?php echo $booking['id']; ?></h5>
                                <span class="badge <?php echo getStatusBadgeClass($booking['status']); ?>">
                                    <?php echo getStatusText($booking['status']); ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Họ và tên:</strong> <?php echo htmlspecialchars($booking['fullname']); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Số điện thoại:</strong> <?php echo htmlspecialchars($booking['phone']); ?>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Số người:</strong> <?php echo $booking['people_count']; ?>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <strong>Ngày bắt đầu:</strong> <?php echo date('d/m/Y', strtotime($booking['visit_date'])); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>Ngày kết thúc:</strong> <?php echo date('d/m/Y', strtotime($booking['visit_end_date'])); ?>
                                    </div>
                                </div>
                                <?php if (!empty($booking['note'])): ?>
                                    <div class="mt-2">
                                        <strong>Ghi chú:</strong> <?php echo htmlspecialchars($booking['note']); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer text-muted">
                                Đặt vé lúc: <?php echo date('d/m/Y H:i', strtotime($booking['created_at'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
// Hàm lấy class badge cho trạng thái đặt vé
function getStatusBadgeClass($status) {
    switch ($status) {
        case 'confirmed':
            return 'bg-success';
        case 'canceled':
            return 'bg-danger';
        default:
            return 'bg-warning';
    }
}

// Hàm lấy text tiếng việt cho trạng thái
function getStatusText($status) {
    switch ($status) {
        case 'confirmed':
            return 'Đã xác nhận';
        case 'canceled':
            return 'Đã hủy';
        default:
            return 'Chờ xác nhận';
    }
}

include 'includes/footer.php';
?> 