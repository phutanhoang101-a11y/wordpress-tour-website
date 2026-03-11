    <!-- Footer -->
    <footer class="bg-dark text-white pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row">
                <!-- Thông tin công ty -->
                <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <h5 class="mb-3 text-primary">Soleil's Land</h5>
                    <p>Khám phá thiên nhiên tuyệt đẹp, văn hóa độc đáo và những giây phút thư giãn tuyệt vời tại Soleil - nơi mỗi khoảnh khắc đều trở thành kỷ niệm đáng nhớ!</p>
                    <div class="social-icons mt-3">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <!-- Liên kết nhanh -->
                <div class="col-md-2 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <h5 class="mb-3 text-primary">Liên kết</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo url('index.php'); ?>" class="text-white text-decoration-none">Trang chủ</a></li>
                        <li class="mb-2"><a href="<?php echo url('explore.php'); ?>" class="text-white text-decoration-none">Khám phá</a></li>
                        <li class="mb-2"><a href="<?php echo url('booking.php'); ?>" class="text-white text-decoration-none">Đặt vé</a></li>
                    </ul>
                </div>
                
                <!-- Khám phá -->
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <h5 class="mb-3 text-primary">Khám phá</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="<?php echo url('explore.php?type=resort'); ?>" class="text-white text-decoration-none">Khu nghỉ dưỡng</a></li>
                        <li class="mb-2"><a href="<?php echo url('explore.php?type=amusement'); ?>" class="text-white text-decoration-none">Khu vui chơi</a></li>
                        <li class="mb-2"><a href="<?php echo url('explore.php?type=service'); ?>" class="text-white text-decoration-none">Dịch vụ</a></li>
                    </ul>
                </div>
                
                <!-- Liên hệ -->
                <div class="col-md-3 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <h5 class="mb-3 text-primary">Liên hệ</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-map-marker-alt me-2"></i> Đà Lạt, Lâm Đồng, Việt Nam</li>
                        <li class="mb-2"><i class="fas fa-phone me-2"></i> (84) 123 456 789</li>
                        <li class="mb-2"><i class="fas fa-envelope me-2"></i> info@soleil.com</li>
                    </ul>
                </div>
            </div>
            
            <hr class="my-4">
            
            <!-- Copyright -->
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Soleil's Land. Đã đăng ký bản quyền.</p>
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <p class="mb-0">Thiết kế bởi <a href="#" class="text-primary text-decoration-none">Soleil Team</a></p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- AOS - Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    
    <!-- Swiper Slider JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="<?php echo url('assets/js/main.js'); ?>"></script>
    
    <!-- Khởi tạo AOS -->
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
    
    <!-- Tùy chỉnh JS cho từng trang nếu có -->
    <?php if (isset($customJS)): ?>
        <script src="<?php echo url('assets/js/' . $customJS); ?>"></script>
    <?php endif; ?>
</body>
</html> 