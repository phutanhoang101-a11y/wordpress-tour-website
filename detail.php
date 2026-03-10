
<?php
/**
 * Trang chi tiết Soleil
 * Hiển thị thông tin chi tiết về khu nghỉ dưỡng, khu vui chơi, dịch vụ
 */

// Import file header
require_once 'includes/header.php';

// Kiểm tra tham số
if (!isset($_GET['type']) || !isset($_GET['id'])) {
    redirect(url('explore.php'));
}

$type = sanitize($_GET['type']);
$id = (int)$_GET['id'];

// Kiểm tra loại và lấy dữ liệu tương ứng
switch ($type) {
    case 'resort':
        $typeName = "Khu nghỉ dưỡng";
        $item = fetchOne("SELECT * FROM resort WHERE id = $id");
        break;
    case 'amusement':
        $typeName = "Khu vui chơi";
        $item = fetchOne("SELECT * FROM amusement WHERE id = $id");
        break;
    case 'service':
        $typeName = "Dịch vụ";
        $item = fetchOne("SELECT * FROM service WHERE id = $id");
        break;
    default:
        redirect(url('explore.php'));
        break;
}

// Nếu không tìm thấy dữ liệu, chuyển hướng về trang khám phá
if (!$item) {
    redirect(url('explore.php'));
}

// Thiết lập tiêu đề trang
$pageTitle = $item['name'] . ' - ' . $typeName;

// Import navbar
require_once 'includes/navbar.php';

// Lấy 3 mục liên quan cùng loại
$relatedItems = fetchAll("SELECT * FROM $type WHERE id != $id ORDER BY star DESC LIMIT 3");
?>

<!-- Banner chi tiết -->
<section class="detail-banner" style="background-image: url('<?php echo url($item['image']); ?>');">
    <div class="container">
        <div class="detail-title">
            <h1 class="animate__animated animate__fadeInUp"><?php echo $item['name']; ?></h1>
            <div class="rating animate__animated animate__fadeInUp animate__delay-1s">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <?php if ($i <= $item['star']): ?>
                        <i class="fas fa-star"></i>
                    <?php elseif ($i - 0.5 <= $item['star']): ?>
                        <i class="fas fa-star-half-alt"></i>
                    <?php else: ?>
                        <i class="far fa-star"></i>
                    <?php endif; ?>
                <?php endfor; ?>
                <span class="ms-2 text-white">(<?php echo $item['review_number']; ?> đánh giá)</span>
            </div>
            <div class="mt-3 animate__animated animate__fadeInUp animate__delay-2s">
                <i class="fas fa-map-marker-alt me-2"></i>
                <?php echo $item['location']; ?>
            </div>
            <div class="mt-3 animate__animated animate__fadeInUp animate__delay-2s">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo $item['small_description']; ?>
            </div>
        </div>
    </div>
</section>

<!-- Nội dung chi tiết -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Chi tiết chính -->
            <div class="col-lg-8" data-aos="fade-up">
                <div class="detail-info">
                    <h3>Giới thiệu</h3>
                    <div class="detail-description">
                        <?php echo nl2br($item['detail_description']); ?>
                    </div>
                </div>
                
                <!-- Gallery ảnh -->
                <div class="detail-info">
                    <h3>Hình ảnh</h3>
                    <div class="detail-gallery">
                        <div class="gallery-item">
                            <img src="<?php echo url($item['image']); ?>" alt="<?php echo $item['name']; ?> 1">
                        </div>
                        <div class="gallery-item">
                            <img src="<?php echo url($item['image']); ?>" alt="<?php echo $item['name']; ?> 2">
                        </div>
                        <div class="gallery-item">
                            <img src="<?php echo url($item['image']); ?>" alt="<?php echo $item['name']; ?> 3">
                        </div>
                        <div class="gallery-item">
                            <img src="<?php echo url($item['image']); ?>" alt="<?php echo $item['name']; ?> 4">
                        </div>
                    </div>
                </div>
                
                <!-- Đặc điểm -->
                <div class="detail-info">
                    <h3>Đặc điểm</h3>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="features">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Wifi miễn phí
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="features">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <?php if ($type == 'resort'): ?>
                                    Bữa sáng miễn phí
                                <?php elseif ($type == 'amusement'): ?>
                                    Trẻ em dưới 3 tuổi miễn phí
                                <?php else: ?>
                                    Phục vụ 24/7
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="features">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <?php if ($type == 'resort'): ?>
                                    Đón tiễn sân bay
                                <?php elseif ($type == 'amusement'): ?>
                                    Có khu vực ẩm thực
                                <?php else: ?>
                                    Đội ngũ nhân viên chuyên nghiệp
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="features">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                <?php if ($type == 'resort'): ?>
                                    Hồ bơi riêng
                                <?php elseif ($type == 'amusement'): ?>
                                    Có chỗ để xe
                                <?php else: ?>
                                    Giá cả hợp lý
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Widget đặt vé -->
                <div class="detail-info mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h3>Đặt vé</h3>
                    <p class="mb-4">Đặt vé ngay để trải nghiệm dịch vụ tuyệt vời của chúng tôi!</p>
                    <a href="<?php echo url('booking.php?type=' . $type . '&id=' . $id); ?>" class="btn btn-primary w-100 py-3">Đặt vé ngay</a>
                </div>
                
                <!-- Widget vị trí -->
                <div class="detail-info mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h3>Vị trí</h3>
                    <div class="location-map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d251289.9826666464!2d108.18091389999999!3d11.940408!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317112fef20988b1%3A0xad5f228b672bf930!2zxJDDoCBM4bqhdCwgTMOibSDEkOG7k25nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1600000000000!5m2!1svi!2s" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
                
                <!-- Widget chia sẻ -->
                <div class="detail-info" data-aos="fade-up" data-aos-delay="300">
                    <h3>Chia sẻ</h3>
                    <div class="social-share">
                        <a href="#" class="btn btn-outline-primary me-2"><i class="fab fa-facebook-f"></i> Facebook</a>
                        <a href="#" class="btn btn-outline-info me-2"><i class="fab fa-twitter"></i> Twitter</a>
                        <a href="#" class="btn btn-outline-danger"><i class="fab fa-pinterest"></i> Pinterest</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Phần các mục liên quan -->
<?php if (!empty($relatedItems)): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Có thể bạn quan tâm</h2>
        
        <div class="row">
            <?php foreach ($relatedItems as $related): ?>
                <div class="col-md-4 mb-4" data-aos="fade-up">
                    <div class="card">
                        <img src="<?php echo url($related['image']); ?>" class="card-img-top" alt="<?php echo $related['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $related['name']; ?></h5>
                            
                            <div class="rating mb-2">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?php if ($i <= $related['star']): ?>
                                        <i class="fas fa-star"></i>
                                    <?php elseif ($i - 0.5 <= $related['star']): ?>
                                        <i class="fas fa-star-half-alt"></i>
                                    <?php else: ?>
                                        <i class="far fa-star"></i>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <span class="review-count">(<?php echo $related['review_number']; ?> đánh giá)</span>
                            </div>
                            
                            <div class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                <?php echo $related['location']; ?>
                            </div>
                            
                            <div class="features">
                                <i class="fas fa-check"></i>
                                <?php echo $related['small_description']; ?>
                            </div>
                            
                            <a href="<?php echo url('detail.php?type=' . $type . '&id=' . $related['id']); ?>" class="btn btn-detail mt-3">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php
// Import file footer
require_once 'includes/footer.php';
?> 