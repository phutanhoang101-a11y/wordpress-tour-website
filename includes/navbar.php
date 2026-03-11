<?php
/**
 * Tệp navbar.php chứa thanh điều hướng chính của trang web
 */
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- Navbar -->
<header class="sticky-top">
    <nav class="navbar navbar-expand-lg bg-light-subtle">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="<?php echo url('index.php'); ?>">
                <img src="<?php echo url('assets/images/logo.png'); ?>" alt="Soleil Logo" height="60" class="animate__animated animate__pulse">
            </a>
            
            <!-- Nút hiển thị menu trên mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSoleil" aria-controls="navbarSoleil" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <!-- Menu chính -->
            <div class="collapse navbar-collapse" id="navbarSoleil">
                <!-- Form tìm kiếm -->
                <form class="d-flex mx-auto search-form" action="<?php echo url('search.php'); ?>" method="GET">
                    <div class="input-group">
                        <input class="form-control" type="search" name="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                
                <!-- Menu điều hướng -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'index.php' ? 'active' : ''; ?>" href="<?php echo url('index.php'); ?>">
                            Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'explore.php' ? 'active' : ''; ?>" href="<?php echo url('explore.php'); ?>">
                            Khám phá
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'booking.php' ? 'active' : ''; ?>" href="<?php echo url('booking.php'); ?>">
                            Đặt vé
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $currentPage == 'check_booking.php' ? 'active' : ''; ?>" href="<?php echo url('check_booking.php'); ?>">
                            Tra cứu vé
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header> 