-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2025 at 04:53 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soleil`
--

-- --------------------------------------------------------

--
-- Table structure for table `amusement`
--

CREATE TABLE `amusement` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` float NOT NULL DEFAULT '5',
  `review_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `amusement`
--

INSERT INTO `amusement` (`id`, `name`, `image`, `small_description`, `detail_description`, `location`, `star`, `review_number`, `created_at`, `updated_at`) VALUES
(1, 'Siêu Thị Games', 'assets/images/amusements/game.png', 'Miễn phí vé cho trẻ dưới 4 tuổi và nhiều ưu đãi khác', 'Là nơi hội tụ những trò chơi điện tử hấp dẫn, mới lạ như: đua ngựa, đập búa, đua mô tô, bắn súng, nhảy auditon…Siêu thị game trong khu công viên giải trí Soleil’s Land sẽ mang lại cho bạn những phút giây thư giãn, thoải mái bên gia đình, bạn bè. Cầm trong tay tấm thẻ vào Công viên bạn có thể tự do lựa chọn những trò chơi của khu Siêu thị Game theo ý thích của mình để chơi với số lần không hạn chế.', 'Cách trung tâm 1km', 5, 128, '2025-05-30 03:40:07', '2025-05-30 04:22:01'),
(2, 'Công viên nước', 'assets/images/amusements/waterpark.png', 'Mở cả ngày, nhiều trò chơi hấp dẫn', 'Công viên nước ở VinWonders Nha Trang bao gồm các khu trò chơi cảm giác mạnh: \r\nĐường trượt cảm tử quân (Kamikaze): Đây là “địa bàn” dành cho những người gan dạ, liều lĩnh. Với tốc độ lên tới 60km/h, cảm tử quân mang tới cho người chơi cảm giác như đang bay khỏi đường trượt có độ cao 21m.\r\nHố đen vũ trụ (Space Hole): Trò chơi này sẽ mang tới cho du khách những cảm nhận chân thật nhất về sự xoáy, cuốn, hút với tốc độ ánh sáng trong đường trượt có độ dài 19m.\r\nĐường trượt 6 làn (Multi Slide): Với độ cao lên tới 15m và tổng chiều dài đường trượt 100m, thả mình từ trên đỉnh xuống là cảm giác cực “phê” mà bất kỳ dân mê cảm giác mạnh nào cũng đều  không thể bỏ qua.\r\nĐường trượt phao bay đôi (Flying Boat): Với trò chơi này, 2 người đều có thể trải nghiệm cùng lúc. Từ độ cao 15m, hai người chơi sẽ được thả xuống một chiếc phao đôi và bắt đầu trượt với vận tốc tối đa. Lúc này, hơn cả trượt, người chơi sẽ có cảm giác như đang bay bổng và lướt đi trên những con tàu cao tốc hiện đại nhất. \r\nĐường trượt thân người (Body Slide): Trò chơi này gồm 3 máng trượt thân người chỉ cao 13m, được thiết kế với đa dạng màu sắc, cấu tạo, đem đến những thử thách từ dễ đến khó, thích hợp cho cả gia đình cùng trải nghiệm.. \r\nĐường trượt Sóng thần (Tsunami): Mặc dù chỉ có độ cao 13m nhưng sức cuốn cực mạnh của sóng trong trò chơi này sẽ làm những người can đảm nhất cũng phải “thót tim”.', 'Các trung tâm 1 km, nằm cạnh khu vui chơi Soleil', 4.8, 64, '2025-05-30 03:40:07', '2025-05-31 15:46:19'),
(3, 'Công viên giải trí', 'assets/images/amusements/congvien.png', 'Nhiều game điện tử hiện đại', 'Nơi du khách sẽ khai mở cánh cửa thời gian, vượt qua ranh giới về không gian để khám phá và tận hưởng những trải nghiệm vượt xa khỏi trí tưởng tưởng. Công viên Soleil được lựa chọn là điểm đến hàng đầu, bởi vì:\r\nCâu chuyện hoặc chủ đề công viên, dịch vụ vui chơi: đa dạng, phong phú, không lặp lại, không giống nhau ở Công viên Soleil; Sun World mang dấu ấn thiên nhiên - công trình và văn hóa địa phương; Sun World luôn tiên phong bắt kịp hoặc dẫn đầu xu hướng đầu tư ý tưởng sáng tạo, thiết kế & công nghệ để mỗi chuyến đi là một khám phá bất ngờ & mở ra những trải nghiệm mới.', 'Trong khu vui chơi Soleil', 4.5, 86, '2025-05-30 03:40:07', '2025-05-30 04:22:01');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people_count` int NOT NULL,
  `visit_date` date NOT NULL,
  `visit_end_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pending','confirmed','canceled') COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `fullname`, `email`, `phone`, `people_count`, `visit_date`, `visit_end_date`, `note`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Nguyễn Văn A', 'user1@gmail.com', '0123456789', 5, '2025-05-31', '2025-06-01', 'Nội dung ghi chú', 'pending', '2025-05-30 12:35:58', '2025-05-30 12:35:58'),
(2, 'Nguyễn Văn B', 'user2@gmail.com', '0123456788', 4, '2025-05-30', '2025-06-01', 'Nội dung ghi chú', 'pending', '2025-05-30 12:38:42', '2025-05-30 12:38:42'),
(3, 'Nguyễn Văn C', 'hoangbaof992@gmail.com', '0123456789', 3, '2025-05-31', '2025-06-02', '', 'pending', '2025-05-31 15:51:22', '2025-05-31 15:51:22');

-- --------------------------------------------------------

--
-- Table structure for table `resort`
--

CREATE TABLE `resort` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` float NOT NULL DEFAULT '5',
  `review_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `resort`
--

INSERT INTO `resort` (`id`, `name`, `image`, `small_description`, `detail_description`, `location`, `star`, `review_number`, `created_at`, `updated_at`) VALUES
(1, 'Tomodachi Làng Mít', 'assets/images/resorts/tomodachi.png', '3 phòng ngủ, 2 phòng tắm, Wifi miễn phí', 'Tomodachi Retreat Làng Mít tựa như một ốc đảo kỳ diệu. Nằm giữa không gian xanh mát yên bình của khu nghỉ dưỡng Soleil, nơi này lấy cảm hứng từ kiến trúc truyền thống của Việt Nam với những ngôi nhà mái lá quen thuộc, kết hợp với nét đặc trưng của kiến trúc Nhật Bản. \r\nKhu nghỉ dưỡng được trang trí bằng rất nhiều cây xanh (như chuối, mít, vải, nhãn...) và bao quanh bởi một hồ nước rộng lớn. Đây chính là điểm đến lý tưởng để \"refresh\" năng lượng và tìm lại sự cân bằng sau thời gian khó khăn, hứa hẹn mang đến những kỷ niệm đáng nhớ cho du khách.\r\nKhuôn viên của Tomodachi Làng Mít được thiết kế như một ngôi nhà vườn, tạo cảm giác thân thuộc và gần gũi như trở về quê nhà. Du khách có thể thư giãn giữa những hàng cây xanh tươi mát, thăm quan chợ quê truyền thống và trải nghiệm cuộc sống đồng quê đơn sơ.', 'Đà Lạt, cách trung tâm 2km', 5, 128, '2025-05-30 03:40:07', '2025-05-30 04:17:00'),
(2, 'Thang Mây Village & Resort', 'assets/images/resorts/thangmay.png', '2 phòng ngủ, 1 phòng tắm, Sân vườn', 'Với môi trường xanh mát và tầm nhìn trực diện ra hồ nước trong xanh, cùng với tầm nhìn hùng vĩ, Resort tạo ra một phong cảnh thiên nhiên tuyệt đẹp và đầy thơ mộng. Du khách có thể thả mình trong không gian yên bình và tận hưởng cảm giác thư thái giữa thiên nhiên, mỗi khoảnh khắc tại Bản Xôi Resort đều mang đến sự lãng mạn và cảm xúc trọn vẹn.', 'Đà Lạt, khu vực Hồ Xuân Hương', 5, 64, '2025-05-30 03:40:07', '2025-05-30 04:17:00'),
(3, 'Lamer Resort', 'assets/images/resorts/lamer.png', '3 phòng ngủ, 2 phòng tắm, Bếp đầy đủ', 'Tọa lạc tại vị trí đắc địa, chỉ cách chợ đêm Dinh Cậu 3km, cách sân bay 7km, là nơi thuận lợi để di chuyển đến các địa điểm tham quan du lịch ở Bắc và Nam Đảo.\r\nTất cả các phòng đều có máy lạnh, truyền hình cáp, két an toàn và phòng tắm riêng với máy sấy tóc cùng đồ vệ sinh cá nhân miễn phí. Ban công riêng có tầm nhìn tuyệt đẹp ra quang cảnh vườn hoa và hồ sen.\r\nLa Mer Resort - Phú Quốc sẽ là điểm đến ấn tượng và thú vị cho kỳ nghỉ của bạn. Đặt phòng ngay để có được mức giá tốt nhất chỉ trên trang web chính thức của chúng tôi!', 'Phú Quốc, gần biển', 4.5, 96, '2025-05-30 03:40:07', '2025-05-30 04:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `small_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` float NOT NULL DEFAULT '5',
  `review_number` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `image`, `small_description`, `detail_description`, `location`, `star`, `review_number`, `created_at`, `updated_at`) VALUES
(1, 'Estheva Spa', 'assets/images/services/spa.png', 'Có phòng riêng và phòng dành cho các cặp đôi', 'Khám phá các dịch vụ đa dạng tại như xông chân bài độc và liệu pháp đả thông kinh lạc cổ, vai, gáy, thận, gan, tỳ, vị, tim để cải thiện sức khỏe và giảm đau mỏi. Hòa mình trong không gian ấm cúng với các liệu pháp massage toàn thân, chân và đá nóng giúp giải tỏa căng thẳng và mệt mỏi từ công việc và cuộc sống hàng ngày.\r\nEstheva Spa không chỉ chú trọng chăm sóc cơ thể mà còn chú trọng đến làm đẹp với các dịch vụ chăm sóc da mặt từ cơ bản và chuyên sâu, mặt nạ ngọc, tẩy tế bào chết toàn thân. Tận hưởng không gian sang trọng, thiết kế tinh tế, mang đậm phong cách Hàn Quốc. Tới đây bạn sẽ có cảm giác như bước chân vào cung điện Joseon thời xưa.', 'Trong khu nghỉ dưỡng Soleil', 5, 128, '2025-05-30 03:40:07', '2025-05-30 04:28:51'),
(2, 'Gội đầu dưỡng sinh', 'assets/images/services/hair-treatment.png', '2 phòng ngủ, 1 phòng tắm, Sân vườn', 'Bằng cách kết hợp giữa gội đầu với các kỹ thuật bấm huyệt, massage, xoa bóp ở các bộ phận như cổ, đầu, cánh tay, vai gáy… từ đó tác động lên các huyệt đạo giúp cơ thể được thư giãn, giảm bớt căng thẳng, mệt mỏi.Gội đầu dưỡng sinh không chỉ đơn thuần là làm sạch tóc và da đầu mà nó còn được xem là phương pháp trị liệu tốt cho sức khỏe thể chất lẫn tinh thần. ', 'Đà Lạt, khu vực Hồ Xuân Hương', 5, 64, '2025-05-30 03:40:07', '2025-05-30 04:28:51'),
(3, 'Yoga', 'assets/images/services/yoga.png', 'Lớp học ngoài trời, giữa thiên nhiên', 'Hòa mình vào thiên nhiên tươi đẹp, dịch vụ yoga ngoài trời tại khu du lịch mang đến cho du khách những phút giây thư giãn tuyệt đối. Với không gian thoáng đãng, tiếng chim hót và gió nhẹ len qua từng tán cây, buổi tập giúp cân bằng năng lượng, cải thiện sức khỏe thể chất lẫn tinh thần. Phù hợp cho mọi lứa tuổi, lớp học được hướng dẫn bởi các huấn luyện viên chuyên nghiệp, mang đến trải nghiệm phục hồi và tái tạo toàn diện giữa thiên nhiên trong lành.', 'Khu vực bãi cỏ trung tâm', 4.8, 72, '2025-05-30 03:40:07', '2025-05-30 04:09:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amusement`
--
ALTER TABLE `amusement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resort`
--
ALTER TABLE `resort`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amusement`
--
ALTER TABLE `amusement`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resort`
--
ALTER TABLE `resort`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
