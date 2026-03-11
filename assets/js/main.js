/**
 * File: main.js
 * Tệp JavaScript chính cho trang web Soleil
 */

// Đợi cho tài liệu HTML tải xong
document.addEventListener('DOMContentLoaded', function() {
    // Khởi tạo các hiệu ứng và chức năng
    initSwipers();
    initImageZoom();
    initScrollAnimations();
    initTooltips();
    initFormValidation();
    initCounterAnimation();
    initNavbarEffects();
    initLazyLoading();
});

/**
 * Khởi tạo slider Swiper 
 */
function initSwipers() {
    // Slider cho banner chính
    if (document.querySelector('.hero-swiper')) {
        new Swiper('.hero-swiper', {
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }

    // Slider cho phần khuyến mãi
    if (document.querySelector('.promotion-swiper')) {
        new Swiper('.promotion-swiper', {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 4000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
            }
        });
    }

    // Slider cho trang chi tiết
    if (document.querySelector('.detail-swiper')) {
        new Swiper('.detail-swiper', {
            slidesPerView: 1,
            spaceBetween: 0,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    }
}

/**
 * Khởi tạo hiệu ứng phóng to ảnh khi click
 */
function initImageZoom() {
    // Lấy tất cả các ảnh gallery
    const galleryItems = document.querySelectorAll('.gallery-item img');
    
    if (galleryItems.length) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function() {
                // Tạo modal để hiển thị ảnh phóng to
                const modal = document.createElement('div');
                modal.className = 'image-zoom-modal';
                modal.style.position = 'fixed';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = '100%';
                modal.style.backgroundColor = 'rgba(0, 0, 0, 0.9)';
                modal.style.display = 'flex';
                modal.style.justifyContent = 'center';
                modal.style.alignItems = 'center';
                modal.style.zIndex = '9999';
                
                // Tạo phần tử ảnh trong modal
                const img = document.createElement('img');
                img.src = this.src;
                img.style.maxWidth = '90%';
                img.style.maxHeight = '90%';
                img.style.objectFit = 'contain';
                img.style.transition = 'transform 0.3s ease';
                
                // Thêm nút đóng
                const closeBtn = document.createElement('button');
                closeBtn.innerHTML = '&times;';
                closeBtn.style.position = 'absolute';
                closeBtn.style.top = '20px';
                closeBtn.style.right = '20px';
                closeBtn.style.fontSize = '30px';
                closeBtn.style.color = 'white';
                closeBtn.style.background = 'none';
                closeBtn.style.border = 'none';
                closeBtn.style.cursor = 'pointer';
                
                // Thêm các phần tử vào modal
                modal.appendChild(img);
                modal.appendChild(closeBtn);
                
                // Thêm modal vào body
                document.body.appendChild(modal);
                
                // Ngăn cuộn trang
                document.body.style.overflow = 'hidden';
                
                // Sự kiện đóng modal
                closeBtn.addEventListener('click', function() {
                    document.body.removeChild(modal);
                    document.body.style.overflow = 'auto';
                });
                
                // Đóng modal khi click vào nền
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        document.body.removeChild(modal);
                        document.body.style.overflow = 'auto';
                    }
                });
            });
        });
    }
}

/**
 * Khởi tạo hiệu ứng cuộn
 */
function initScrollAnimations() {
    // Xử lý hiệu ứng hiển thị nút "Cuộn lên đầu trang" khi cuộn xuống
    const scrollTopBtn = document.querySelector('.scroll-top-btn');
    
    if (scrollTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > 300) {
                scrollTopBtn.classList.add('show');
            } else {
                scrollTopBtn.classList.remove('show');
            }
        });
        
        // Cuộn lên đầu trang khi click nút
        scrollTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }
    
    // Xử lý hiệu ứng parallax cho banner
    const heroBanner = document.querySelector('.hero-banner');
    if (heroBanner) {
        window.addEventListener('scroll', function() {
            const scrollPosition = window.pageYOffset;
            heroBanner.style.backgroundPositionY = scrollPosition * 0.5 + 'px';
        });
    }
}

/**
 * Khởi tạo tooltips Bootstrap
 */
function initTooltips() {
    // Khởi tạo tooltips của Bootstrap
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
}

/**
 * Khởi tạo xác thực biểu mẫu
 */
function initFormValidation() {
    // Lấy tất cả các form cần xác thực
    const forms = document.querySelectorAll('.needs-validation');
    
    if (forms.length) {
        // Vòng lặp qua các form và ngăn chặn gửi nếu không hợp lệ
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    }
    
    // Xác thực email
    const emailInputs = document.querySelectorAll('input[type="email"]');
    if (emailInputs.length) {
        emailInputs.forEach(input => {
            input.addEventListener('blur', function() {
                const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
                
                if (this.value && !emailRegex.test(this.value)) {
                    this.setCustomValidity('Vui lòng nhập địa chỉ email hợp lệ');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    }
    
    // Xác thực số điện thoại
    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    if (phoneInputs.length) {
        phoneInputs.forEach(input => {
            input.addEventListener('blur', function() {
                const phoneRegex = /^[0-9]{10,11}$/;
                
                if (this.value && !phoneRegex.test(this.value)) {
                    this.setCustomValidity('Vui lòng nhập số điện thoại hợp lệ (10-11 số)');
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    }
}

/**
 * Khởi tạo hiệu ứng đếm số
 */
function initCounterAnimation() {
    // Kiểm tra xem có phần tử counter không
    const counters = document.querySelectorAll('.stats-number');
    
    if (counters.length) {
        // Tạo một IntersectionObserver để theo dõi khi các phần tử counter hiển thị trong viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = parseInt(counter.getAttribute('data-target'));
                    let count = 0;
                    const duration = 2000; // Thời gian đếm (ms)
                    const interval = Math.floor(duration / target);
                    
                    // Bắt đầu đếm
                    const timer = setInterval(() => {
                        count += 1;
                        counter.textContent = count;
                        
                        // Dừng đếm khi đạt đến giá trị mục tiêu
                        if (count >= target) {
                            clearInterval(timer);
                        }
                    }, interval);
                    
                    // Ngừng theo dõi phần tử sau khi đã kích hoạt hiệu ứng
                    observer.unobserve(counter);
                }
            });
        });
        
        // Theo dõi tất cả các phần tử counter
        counters.forEach(counter => {
            observer.observe(counter);
        });
    }
}

/**
 * Khởi tạo hiệu ứng cho thanh điều hướng
 */
function initNavbarEffects() {
    const navbar = document.querySelector('.navbar');
    
    if (navbar) {
        // Thay đổi style cho navbar khi cuộn trang
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
                navbar.classList.add('bg-white');
                navbar.classList.remove('bg-light-subtle');
            } else {
                navbar.classList.remove('navbar-scrolled');
                navbar.classList.remove('bg-white');
                navbar.classList.add('bg-light-subtle');
            }
        });
    }
}

/**
 * Khởi tạo tính năng lazy loading cho ảnh
 */
function initLazyLoading() {
    // Kiểm tra xem trình duyệt có hỗ trợ IntersectionObserver không
    if ('IntersectionObserver' in window) {
        const lazyImages = document.querySelectorAll('img.lazy');
        
        if (lazyImages.length) {
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const lazyImage = entry.target;
                        lazyImage.src = lazyImage.dataset.src;
                        lazyImage.classList.remove('lazy');
                        imageObserver.unobserve(lazyImage);
                    }
                });
            });
            
            lazyImages.forEach(image => {
                imageObserver.observe(image);
            });
        }
    } else {
        // Fallback cho trình duyệt không hỗ trợ IntersectionObserver
        let lazyLoadThrottleTimeout;
        
        function lazyLoad() {
            if (lazyLoadThrottleTimeout) {
                clearTimeout(lazyLoadThrottleTimeout);
            }
            
            lazyLoadThrottleTimeout = setTimeout(function() {
                const scrollTop = window.pageYOffset;
                const lazyImages = document.querySelectorAll('img.lazy');
                
                lazyImages.forEach(img => {
                    if (img.offsetTop < window.innerHeight + scrollTop) {
                        img.src = img.dataset.src;
                        img.classList.remove('lazy');
                    }
                });
                
                if (lazyImages.length == 0) {
                    document.removeEventListener('scroll', lazyLoad);
                    window.removeEventListener('resize', lazyLoad);
                    window.removeEventListener('orientationChange', lazyLoad);
                }
            }, 20);
        }
        
        document.addEventListener('scroll', lazyLoad);
        window.addEventListener('resize', lazyLoad);
        window.addEventListener('orientationChange', lazyLoad);
    }
} 