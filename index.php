<?php
/**
 * Trang chủ Soleil
 * Hiển thị banner quảng cáo, khuyến mãi hấp dẫn, thông tin giới thiệu về Soleil
 */

// Thiết lập tiêu đề trang
$pageTitle = "Trang chủ";

// Import file header
require_once 'includes/header.php';
require_once 'includes/navbar.php';

// Lấy dữ liệu khu nghỉ dưỡng nổi bật
$featuredResorts = fetchAll("SELECT * FROM resort ORDER BY star DESC LIMIT 3");

// Lấy dữ liệu khu vui chơi nổi bật
$featuredAmusements = fetchAll("SELECT * FROM amusement ORDER BY star DESC LIMIT 3");

// Lấy dữ liệu dịch vụ nổi bật
$featuredServices = fetchAll("SELECT * FROM service ORDER BY star DESC LIMIT 3");
?>

<!-- Banner Hero -->
<section class="hero-banner swiper hero-swiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide" style="background-image: url('<?php echo url('assets/images/banners/banner-1.png'); ?>');">
            <div class="container">
                <div class="hero-content animate__animated animate__fadeIn">
                    <h1 class="hero-title">Chào mừng bạn đến với Soleil's Land</h1>
                    <p class="hero-subtitle">Hãy sẵn sàng khám phá thiên nhiên tuyệt đẹp, văn hóa độc đáo và những giây phút thư giãn tuyệt vời!</p>
                    <a href="<?php echo url('explore.php'); ?>" class="btn btn-primary hero-btn">Khám phá ngay</a>
                </div>
            </div>
        </div>
        <div class="swiper-slide" style="background-image: url('<?php echo url('assets/images/banners/banner-2.png'); ?>');">
            <div class="container">
                <div class="hero-content animate__animated animate__fadeIn">
                    <h1 class="hero-title">Trải nghiệm kỳ nghỉ tuyệt vời</h1>
                    <p class="hero-subtitle">Những khoảnh khắc đáng nhớ đang chờ đón bạn tại Soleil's Land</p>
                    <a href="<?php echo url('booking.php'); ?>" class="btn btn-primary hero-btn">Đặt vé ngay</a>
                </div>
            </div>
        </div>
        <div class="swiper-slide" style="background-image: url('<?php echo url('assets/images/banners/banner-3.png'); ?>');">
            <div class="container">
                <div class="hero-content animate__animated animate__fadeIn">
                    <h1 class="hero-title">Khám phá những điều tuyệt vời</h1>
                    <p class="hero-subtitle">Từ khu vui chơi đến khu nghỉ dưỡng, tất cả đều mang đến trải nghiệm khó quên</p>
                    <a href="<?php echo url('explore.php'); ?>" class="btn btn-primary hero-btn">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Điều hướng và phân trang -->
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</section>

<!-- Phần Khuyến Mãi -->
<section class="promotion-section py-5">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Khuyến mãi hấp dẫn</h2>
        
        <div class="row">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="promotion-card">
                    <img src="<?php echo url('assets/images/promotions/promotion-1.png'); ?>" alt="Ưu đãi mùa hè" class="promotion-img">
                    <div class="promotion-content">
                        <span class="promotion-tag">Ưu đãi đặc biệt</span>
                        <h3 class="promotion-title">Ưu Đãi Mùa Hè</h3>
                        <p class="promotion-text">Giảm 20% cho tất cả các đặt phòng trong những tháng hè</p>
                        <a href="<?php echo url('explore.php'); ?>" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="promotion-card">
                    <img src="<?php echo url('assets/images/promotions/promotion-2.png'); ?>" alt="Combo gia đình" class="promotion-img">
                    <div class="promotion-content">
                        <span class="promotion-tag">Combo tiết kiệm</span>
                        <h3 class="promotion-title">Combo Gia Đình</h3>
                        <p class="promotion-text">Giảm 15% khi đặt combo nghỉ dưỡng và vui chơi cho gia đình 4 người</p>
                        <a href="<?php echo url('explore.php'); ?>" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="promotion-card">
                    <img src="<?php echo url('assets/images/promotions/promotion-3.png'); ?>" alt="Ưu đãi cuối tuần" class="promotion-img">
                    <div class="promotion-content">
                        <span class="promotion-tag">Chỉ cuối tuần</span>
                        <h3 class="promotion-title">Ưu Đãi Cuối Tuần</h3>
                        <p class="promotion-text">Giảm 10% cho các đặt phòng vào cuối tuần và tặng kèm dịch vụ spa</p>
                        <a href="<?php echo url('explore.php'); ?>" class="btn btn-primary">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Phần Giới Thiệu Về Khu Nghỉ Dưỡng -->
<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0" data-aos="fade-right">
                <div class="about-img">
                    <img src="<?php echo url('assets/images/about/about-resort.png'); ?>" alt="Về Khu Nghỉ Dưỡng Của Chúng Tôi" class="img-fluid">
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="about-content">
                    <h2>Về Khu Nghỉ Dưỡng Của Chúng Tôi</h2>
                    <p>Soleil's Land mang đến sự kết hợp hoàn hảo giữa sang trọng và đẹp tự nhiên. Tọa lạc trên một bãi biển riêng, khu nghỉ dưỡng của chúng tôi có những phòng rộng rãi với tầm nhìn tuyệt đẹp, các lựa chọn ẩm thực đẳng cấp thế giới và nhiều hoạt động cho mọi lứa tuổi.</p>
                    <p>Chúng tôi tự hào mang đến dịch vụ chuẩn 5 sao và những trải nghiệm độc đáo cho du khách. Dù bạn đang tìm kiếm một kỳ nghỉ thư giãn hay một chuyến phiêu lưu đầy hứng khởi, Soleil's Land đều có thể đáp ứng.</p>
                    <a href="<?php echo url('explore.php?type=resort'); ?>" class="btn btn-primary">Tìm hiểu thêm</a>
                </div>
            </div>
        </div>
        
        <!-- Thống kê -->
        <div class="row mt-5">
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-item">
                    <div class="stats-number" data-target="15">0</div>
                    <div class="stats-text">Năm kinh nghiệm</div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="stats-item">
                    <div class="stats-number" data-target="200">0</div>
                    <div class="stats-text">Phòng & Suite</div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="stats-item">
                    <div class="stats-number" data-target="5">0</div>
                    <div class="stats-text">Nhà hàng</div>
                </div>
            </div>
            
            <div class="col-md-3 col-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="stats-item">
                    <div class="stats-number" data-target="98">0</div>
                    <div class="stats-text">Khách hài lòng</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Nút cuộn lên đầu trang -->
<a href="#" class="scroll-top-btn">
    <i class="fas fa-arrow-up"></i>
</a>

<?php
// Import file footer
require_once 'includes/footer.php';
?> 