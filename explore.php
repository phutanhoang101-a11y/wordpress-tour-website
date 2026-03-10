<?php
/**
 * Trang khám phá Soleil
 * Hiển thị danh sách khu nghỉ dưỡng, khu vui chơi, dịch vụ
 */

// Thiết lập tiêu đề trang
$pageTitle = "Khám phá";

// Import file header
require_once 'includes/header.php';
require_once 'includes/navbar.php';

// Xử lý tham số loại
$type = isset($_GET['type']) ? sanitize($_GET['type']) : 'all';

// Xác định loại hiển thị và tiêu đề
switch ($type) {
    case 'resort':
        $typeTitle = "Khu nghỉ dưỡng";
        $tableToQuery = "resort";
        break;
    case 'amusement':
        $typeTitle = "Khu vui chơi";
        $tableToQuery = "amusement";
        break;
    case 'service':
        $typeTitle = "Dịch vụ";
        $tableToQuery = "service";
        break;
    default:
        $typeTitle = "Tất cả";
        $tableToQuery = "all";
        break;
}

// Xử lý phân trang
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = ITEMS_PER_PAGE;
$offset = ($page - 1) * $limit;

// Lấy dữ liệu từ cơ sở dữ liệu
if ($tableToQuery == 'all') {
    // Lấy tổng số lượng bản ghi (cho phân trang)
    $countResort = fetchOne("SELECT COUNT(*) as total FROM resort");
    $countAmusement = fetchOne("SELECT COUNT(*) as total FROM amusement");
    $countService = fetchOne("SELECT COUNT(*) as total FROM service");
    $totalItems = $countResort['total'] + $countAmusement['total'] + $countService['total'];
    
    // Lấy dữ liệu từ cả 3 bảng với giới hạn
    $limitPerType = $limit / 3;
    $resorts = fetchAll("SELECT *, 'resort' as type FROM resort ORDER BY star DESC LIMIT $limitPerType");
    $amusements = fetchAll("SELECT *, 'amusement' as type FROM amusement ORDER BY star DESC LIMIT $limitPerType");
    $services = fetchAll("SELECT *, 'service' as type FROM service ORDER BY star DESC LIMIT $limitPerType");
    
    // Gộp dữ liệu
    $items = array_merge($resorts, $amusements, $services);
    
    // Sắp xếp theo sao giảm dần
    usort($items, function($a, $b) {
        return $b['star'] - $a['star'];
    });
} else {
    // Lấy tổng số lượng bản ghi (cho phân trang)
    $countResult = fetchOne("SELECT COUNT(*) as total FROM $tableToQuery");
    $totalItems = $countResult['total'];
    
    // Lấy dữ liệu từ một bảng cụ thể
    $items = fetchAll("SELECT *, '$tableToQuery' as type FROM $tableToQuery ORDER BY star DESC LIMIT $offset, $limit");
}

// Tính toán số trang
$totalPages = ceil($totalItems / $limit);
?>

<!-- Banner trang khám phá -->
<section class="hero-banner" style="background-image: url('<?php echo url('assets/images/banners/explore-banner.png'); ?>'); height: 50vh;">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title animate__animated animate__fadeInUp">Khám phá Soleil</h1>
            <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">Trải nghiệm độc đáo tại từng điểm tham quan và dịch vụ</p>
        </div>
    </div>
</section>

<!-- Phần khám phá chính -->
<section class="py-5">
    <div class="container">
        <!-- Tab chọn loại -->
        <div class="explore-tabs mb-5" data-aos="fade-up">
            <ul class="nav nav-pills justify-content-center mb-4">
                <li class="nav-item">
                    <a class="nav-link <?php echo $type == 'all' ? 'active' : ''; ?>" href="<?php echo url('explore.php'); ?>">
                        Tất cả
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $type == 'resort' ? 'active' : ''; ?>" href="<?php echo url('explore.php?type=resort'); ?>">
                        Khu nghỉ dưỡng
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $type == 'amusement' ? 'active' : ''; ?>" href="<?php echo url('explore.php?type=amusement'); ?>">
                        Khu vui chơi
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo $type == 'service' ? 'active' : ''; ?>" href="<?php echo url('explore.php?type=service'); ?>">
                        Dịch vụ
                    </a>
                </li>
            </ul>
        </div>
        
        <!-- Tiêu đề phần -->
        <h2 class="section-title" data-aos="fade-up"><?php echo $typeTitle; ?></h2>
        
        <!-- Danh sách các mục -->
        <div class="row">
            <?php if (!empty($items)): ?>
                <?php foreach ($items as $item): ?>
                    <div class="col-md-4 mb-4" data-aos="fade-up">
                        <div class="card">
                            <img src="<?php echo url($item['image']); ?>" class="card-img-top" alt="<?php echo $item['name']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $item['name']; ?></h5>
                                
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
                    <div class="alert alert-info">Không có mục nào phù hợp.</div>
                </div>
            <?php endif; ?>
        </div>
        
        <!-- Phân trang -->
        <?php if ($totalPages > 1): ?>
            <nav aria-label="Page navigation" class="mt-4">
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo url('explore.php?type=' . $type . '&page=' . ($page - 1)); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo url('explore.php?type=' . $type . '&page=' . $i); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo url('explore.php?type=' . $type . '&page=' . ($page + 1)); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
</section>

<?php
// Import file footer
require_once 'includes/footer.php';
?> 