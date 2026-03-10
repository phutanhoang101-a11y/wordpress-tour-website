<?php
/**
 * Trang tìm kiếm Soleil
 * Cho phép tìm kiếm khu nghỉ dưỡng, khu vui chơi, dịch vụ theo từ khóa
 */

// Thiết lập tiêu đề trang
$pageTitle = "Tìm kiếm";

// Import file header
require_once 'includes/header.php';
require_once 'includes/navbar.php';

// Xử lý tham số tìm kiếm
$keyword = isset($_GET['keyword']) ? sanitize($_GET['keyword']) : '';

// Nếu không có từ khóa, chuyển hướng về trang chủ
if (empty($keyword)) {
    redirect(url('index.php'));
}

// Cập nhật tiêu đề trang
$pageTitle = "Kết quả tìm kiếm: " . $keyword;

// Xử lý phân trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = ITEMS_PER_PAGE;
$offset = ($page - 1) * $limit;

// Tìm kiếm trong bảng resort
$keywordEscaped = escapeString($keyword);
$resortResults = fetchAll("SELECT *, 'resort' as type FROM resort 
                         WHERE name LIKE '%$keywordEscaped%' 
                         OR location LIKE '%$keywordEscaped%' 
                         OR detail_description LIKE '%$keywordEscaped%'");

// Tìm kiếm trong bảng amusement
$amusementResults = fetchAll("SELECT *, 'amusement' as type FROM amusement 
                             WHERE name LIKE '%$keywordEscaped%' 
                             OR location LIKE '%$keywordEscaped%' 
                             OR detail_description LIKE '%$keywordEscaped%'");

// Tìm kiếm trong bảng service
$serviceResults = fetchAll("SELECT *, 'service' as type FROM service 
                           WHERE name LIKE '%$keywordEscaped%' 
                           OR location LIKE '%$keywordEscaped%' 
                           OR detail_description LIKE '%$keywordEscaped%'");

// Gộp tất cả kết quả lại
$allResults = array_merge($resortResults, $amusementResults, $serviceResults);

// Sắp xếp kết quả theo sao giảm dần
usort($allResults, function($a, $b) {
    return $b['star'] - $a['star'];
});

// Tổng số kết quả
$totalItems = count($allResults);

// Tính toán số trang
$totalPages = ceil($totalItems / $limit);

// Lấy kết quả cho trang hiện tại
$results = array_slice($allResults, $offset, $limit);
?>

<!-- Banner tìm kiếm -->
<section class="hero-banner" style="background-image: url('<?php echo url('assets/images/banners/search-banner.png'); ?>'); height: 40vh;">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title animate__animated animate__fadeInUp">Kết quả tìm kiếm</h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">Tìm kiếm cho: "<?php echo $keyword; ?>"</p>
        </div>
    </div>
</section>

<!-- Phần kết quả tìm kiếm -->
<section class="py-5">
    <div class="container">
        <!-- Form tìm kiếm lại -->
        <div class="row justify-content-center mb-5" data-aos="fade-up">
            <div class="col-md-8">
                <form action="<?php echo url('search.php'); ?>" method="GET" class="search-form-large">
                    <div class="input-group">
                        <input type="text" class="form-control form-control-lg" name="keyword" value="<?php echo $keyword; ?>" placeholder="Nhập từ khóa tìm kiếm...">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fas fa-search"></i> Tìm kiếm
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Hiển thị số kết quả -->
        <div class="mb-4">
            <h2 data-aos="fade-up">Tìm thấy <?php echo $totalItems; ?> kết quả</h2>
        </div>
        
        <!-- Danh sách kết quả -->
        <div class="row">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $item): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="card">
                            <img src="<?php echo url($item['image']); ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                
                                <!-- Hiển thị loại -->
                                <div class="mb-2">
                                    <span class="badge bg-primary">
                                        <?php
                                        switch ($item['type']) {
                                            case 'resort':
                                                echo 'Khu nghỉ dưỡng';
                                                break;
                                            case 'amusement':
                                                echo 'Khu vui chơi';
                                                break;
                                            case 'service':
                                                echo 'Dịch vụ';
                                                break;
                                        }
                                        ?>
                                    </span>
                                </div>
                                
                                <div class="rating mb-2">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <?php if ($i <= $item['star']): ?>
                                            <i class="fas fa-star"></i>
                                        <?php elseif ($i - 0.5 <= $item['star']): ?>
                                            <i class="fas fa-star-half-alt"></i>
                                        <?php else: ?>
                                            <i class="far fa-star"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <span class="review-count">(<?php echo $item['review_number']; ?> đánh giá)</span>
                                </div>
                                
                                <div class="location">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo $item['location']; ?>
                                </div>
                                
                                <div class="features">
                                    <i class="fas fa-check"></i>
                                    <?php echo $item['small_description']; ?>
                                </div>
                                
                                <a href="<?php echo url('detail.php?type=' . $item['type'] . '&id=' . $item['id']); ?>" class="btn btn-detail mt-3">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info">
                        <p>Không tìm thấy kết quả nào phù hợp với từ khóa "<?php echo $keyword; ?>".</p>
                        <p>Vui lòng thử lại với từ khóa khác hoặc <a href="<?php echo url('explore.php'); ?>" class="alert-link">khám phá tất cả</a>.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo url('search.php?keyword=' . urlencode($keyword) . '&page=' . ($page - 1)); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo url('search.php?keyword=' . urlencode($keyword) . '&page=' . $i); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo url('search.php?keyword=' . urlencode($keyword) . '&page=' . ($page + 1)); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<!-- Phần gợi ý -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">Có thể bạn quan tâm</h2>
        
        <div class="row text-center">
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-hotel fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Khu nghỉ dưỡng</h4>
                        <p class="card-text">Khám phá các khu nghỉ dưỡng tuyệt vời với đầy đủ tiện nghi và dịch vụ cao cấp.</p>
                        <a href="<?php echo url('explore.php?type=resort'); ?>" class="btn btn-outline-primary">Xem tất cả</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-ticket-alt fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Khu vui chơi</h4>
                        <p class="card-text">Trải nghiệm những khu vui chơi giải trí thú vị và hấp dẫn cho mọi lứa tuổi.</p>
                        <a href="<?php echo url('explore.php?type=amusement'); ?>" class="btn btn-outline-primary">Xem tất cả</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="mb-3">
                            <i class="fas fa-spa fa-3x text-primary"></i>
                        </div>
                        <h4 class="card-title">Dịch vụ</h4>
                        <p class="card-text">Tận hưởng các dịch vụ chất lượng cao, giúp bạn thư giãn và tái tạo năng lượng.</p>
                        <a href="<?php echo url('explore.php?type=service'); ?>" class="btn btn-outline-primary">Xem tất cả</a>
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