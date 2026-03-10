<?php
/**
 * Trang đặt vé Soleil
 * Cho phép người dùng đặt vé tham quan khu du lịch
 */

// Thiết lập tiêu đề trang
$pageTitle = "Đặt vé";

// Import file header
require_once 'includes/header.php';
require_once 'includes/navbar.php';

// Khởi tạo biến lỗi và thành công
$errors = [];
$success = false;

// Xử lý khi form được gửi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $fullname = isset($_POST['fullname']) ? sanitize($_POST['fullname']) : '';
    $email = isset($_POST['email']) ? sanitize($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize($_POST['phone']) : '';
    $people_count = isset($_POST['people_count']) && is_numeric($_POST['people_count']) ? (int)$_POST['people_count'] : 0;
    $visit_date = isset($_POST['visit_date']) ? sanitize($_POST['visit_date']) : '';
    $visit_end_date = isset($_POST['visit_end_date']) ? sanitize($_POST['visit_end_date']) : '';
    $note = isset($_POST['note']) ? sanitize($_POST['note']) : '';
    
    // Kiểm tra lỗi
    if (empty($fullname)) {
        $errors[] = 'Vui lòng nhập họ và tên';
    }
    
    if (empty($email)) {
        $errors[] = 'Vui lòng nhập email';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email không hợp lệ';
    }
    
    if (empty($phone)) {
        $errors[] = 'Vui lòng nhập số điện thoại';
    } elseif (!preg_match('/^[0-9]{10,11}$/', $phone)) {
        $errors[] = 'Số điện thoại không hợp lệ (phải có 10-11 số)';
    }
    
    if ($people_count <= 0) {
        $errors[] = 'Vui lòng chọn số người dự kiến';
    }
    
    if (empty($visit_date)) {
        $errors[] = 'Vui lòng chọn ngày tham quan';
    }
    
    if (empty($visit_end_date)) {
        $errors[] = 'Vui lòng chọn ngày kết thúc';
    }
    
    // Kiểm tra ngày bắt đầu phải nhỏ hơn ngày kết thúc
    if (!empty($visit_date) && !empty($visit_end_date)) {
        $start = new DateTime($visit_date);
        $end = new DateTime($visit_end_date);
        if ($start > $end) {
            $errors[] = 'Ngày kết thúc phải sau ngày bắt đầu';
        }
    }
    
    // Nếu không có lỗi, lưu dữ liệu vào cơ sở dữ liệu
    if (empty($errors)) {
        // Tạo câu lệnh SQL để chèn dữ liệu
        $sql = "INSERT INTO booking (fullname, email, phone, people_count, visit_date, visit_end_date, note) VALUES (
            '" . escapeString($fullname) . "', 
            '" . escapeString($email) . "', 
            '" . escapeString($phone) . "', 
            $people_count, 
            '" . escapeString($visit_date) . "', 
            '" . escapeString($visit_end_date) . "', 
            '" . escapeString($note) . "'
        )";
        
        // Thực thi câu lệnh SQL
        if (executeQuery($sql)) {
            $success = true;
            
            // Đặt thông báo thành công
            setMessage('Đặt vé thành công! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.', 'success');
            
            // Chuyển hướng về trang chủ
            redirect(url('index.php'));
        } else {
            $errors[] = 'Có lỗi xảy ra khi lưu dữ liệu. Vui lòng thử lại sau.';
        }
    }
}

// Lấy thông tin loại và ID nếu được truyền từ trang chi tiết
$type = isset($_GET['type']) ? sanitize($_GET['type']) : '';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

// Lấy thông tin mục nếu có
$item = null;
if (!empty($type) && $id > 0) {
    switch ($type) {
        case 'resort':
            $item = fetchOne("SELECT * FROM resort WHERE id = $id");
            break;
        case 'amusement':
            $item = fetchOne("SELECT * FROM amusement WHERE id = $id");
            break;
        case 'service':
            $item = fetchOne("SELECT * FROM service WHERE id = $id");
            break;
    }
}
?>

<!-- Banner đặt vé -->
<section class="hero-banner" style="background-image: url('<?php echo url('assets/images/banners/booking-banner.png'); ?>'); height: 50vh;">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title animate__animated animate__fadeInUp">Đặt vé Soleil</h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">Đặt vé trực tuyến nhanh chóng và dễ dàng</p>
        </div>
    </div>
</section>

<!-- Phần đặt vé -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Hiển thị các bước đặt vé -->
                <div class="booking-steps">
                    <div class="booking-step active">
                        <div class="step-number">1</div>
                        <div class="step-text">Đặt chỗ</div>
                    </div>
                    <div class="booking-step">
                        <div class="step-number">2</div>
                        <div class="step-text">Thông tin</div>
                    </div>
                    <div class="booking-step">
                        <div class="step-number">3</div>
                        <div class="step-text">Xác nhận</div>
                    </div>
                </div>
                
                <!-- Hiển thị lỗi nếu có -->
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                
                <!-- Form đặt vé -->
                <div class="booking-form" data-aos="fade-up">
                    <h2 class="text-center mb-4">Thông tin khách hàng</h2>
                    
                    <form action="<?php echo url('booking.php'); ?>" method="POST" class="needs-validation" novalidate>
                        <!-- Nếu đang đặt từ trang chi tiết, hiển thị thông tin đó -->
                        <?php if ($item): ?>
                            <div class="alert alert-info mb-4">
                                <strong>Bạn đang đặt vé cho:</strong> <?php echo $item['name']; ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="row">
                            <!-- Họ và tên -->
                            <div class="col-md-6 mb-3">
                                <label for="fullname" class="form-label">Họ và Tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo isset($fullname) ? $fullname : ''; ?>" required>
                                <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                            </div>
                            
                            <!-- Email -->
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($email) ? $email : ''; ?>" required>
                                <div class="invalid-feedback">Vui lòng nhập email hợp lệ</div>
                            </div>
                            
                            <!-- Số điện thoại -->
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo isset($phone) ? $phone : ''; ?>" required>
                                <div class="invalid-feedback">Vui lòng nhập số điện thoại hợp lệ (10-11 số)</div>
                            </div>
                            
                            <!-- Số người -->
                            <div class="col-md-6 mb-3">
                                <label for="people_count" class="form-label">Số người dự kiến <span class="text-danger">*</span></label>
                                <select class="form-select" id="people_count" name="people_count" required>
                                    <option value="">Chọn số người</option>
                                    <?php for ($i = 1; $i <= 10; $i++): ?>
                                        <option value="<?php echo $i; ?>" <?php echo (isset($people_count) && $people_count == $i) ? 'selected' : ''; ?>>
                                            <?php echo $i; ?> người
                                        </option>
                                    <?php endfor; ?>
                                    <option value="15" <?php echo (isset($people_count) && $people_count == 15) ? 'selected' : ''; ?>>15 người</option>
                                    <option value="20" <?php echo (isset($people_count) && $people_count == 20) ? 'selected' : ''; ?>>20 người</option>
                                    <option value="30" <?php echo (isset($people_count) && $people_count == 30) ? 'selected' : ''; ?>>30 người</option>
                                </select>
                                <div class="invalid-feedback">Vui lòng chọn số người dự kiến</div>
                            </div>
                            
                            <!-- Thời gian -->
                            <div class="col-md-6 mb-3">
                                <label for="visit_date" class="form-label">Từ ngày <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="visit_date" name="visit_date" value="<?php echo isset($visit_date) ? $visit_date : ''; ?>" min="<?php echo date('Y-m-d'); ?>" required>
                                <div class="invalid-feedback">Vui lòng chọn ngày tham quan</div>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="visit_end_date" class="form-label">Đến ngày <span class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="visit_end_date" name="visit_end_date" value="<?php echo isset($visit_end_date) ? $visit_end_date : ''; ?>" min="<?php echo date('Y-m-d'); ?>" required>
                                <div class="invalid-feedback">Vui lòng chọn ngày kết thúc</div>
                            </div>
                            
                            <!-- Ghi chú -->
                            <div class="col-12 mb-3">
                                <label for="note" class="form-label">Ghi chú</label>
                                <textarea class="form-control" id="note" name="note" rows="4"><?php echo isset($note) ? $note : ''; ?></textarea>
                            </div>
                            
                            <!-- Nút đặt vé -->
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 py-3">Xác nhận đặt vé</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Phần thông tin bổ sung -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Thông tin bổ sung</h2>
        
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-info-circle fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title text-center">Chính sách đặt vé</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Đặt vé trước ít nhất 24 giờ</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Miễn phí hủy trước 48 giờ</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Thanh toán tại quầy hoặc online</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Xuất trình mã đặt vé khi đến</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-tag fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title text-center">Ưu đãi đặc biệt</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Giảm 10% cho nhóm từ 10 người</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Miễn phí cho trẻ em dưới 5 tuổi</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Giảm 15% cho khách hàng thân thiết</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Tặng voucher ăn uống khi đặt vé online</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="text-center mb-3">
                            <i class="fas fa-phone-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title text-center">Hỗ trợ đặt vé</h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Hotline: (84) 123 456 789</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Email: booking@soleil.com</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Giờ làm việc: 8:00 - 20:00</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i> Hỗ trợ qua Zalo, Facebook Messenger</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Import file footer
require_once 'includes/footer.php';
?> 