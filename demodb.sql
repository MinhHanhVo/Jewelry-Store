
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


--
-- Cơ sở dữ liệu: `trangsucshop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng bình luậnluận `blsanpham`
--

CREATE TABLE `blsanpham` (
  `id_bl` int(10) NOT NULL,
  `id_sp` int(10) NOT NULL,
  `ten` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dien_thoai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `binh_luan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ngay_gio` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiet_donhang`
--

CREATE TABLE `chitiet_donhang` (
  `id_chitiet` int(11) NOT NULL,
  `id_donhang` int(11) DEFAULT NULL,
  `id_sanpham` int(11) DEFAULT NULL,
  `ten_sanpham` varchar(255) DEFAULT NULL,
  `gia` float DEFAULT NULL,
  `so_luong` int(11) DEFAULT NULL,
  `thanh_tien` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `dmsanpham`
--

CREATE TABLE `dmsanpham` (
  `id_dm` int(10) NOT NULL,
  `ten_dm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `dmsanpham`
--

INSERT INTO `dmsanpham` (`id_dm`, `ten_dm`) VALUES
(1, 'Nhẫn'),
(2, 'Dây chuyền'),
(3, 'Bông tai'),
(4, 'Lắc tay'),
(5, 'Charm'),
(6, 'Kiềng'),
(7, 'Vòng'),
(8, 'Mặt dây chuyền');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `donhang`
--

CREATE TABLE `donhang` (
  `id_donhang` int(11) NOT NULL,
  `ten_khachhang` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `dia_chi` varchar(255) NOT NULL,
  `tong_gia` float NOT NULL,
  `ngay_dat` datetime DEFAULT current_timestamp(),
  `trang_thai` enum('Chờ giao hàng','Đang giao hàng','Đã thanh toán') DEFAULT 'Chờ giao hàng',
  `phuong_thuc_thanh_toan` enum('Tiền mặt','Chuyển khoản ngân hàng','Ví MOMO') DEFAULT 'Tiền mặt'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `id_sp` int(11) UNSIGNED NOT NULL,
  `id_dm` int(11) UNSIGNED NOT NULL,
  `ten_sp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `anh_sp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `gia_sp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `khuyen_mai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trang_thai` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dac_biet` int(1) NOT NULL,
  `chi_tiet_sp` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `so_luong` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`id_sp`, `id_dm`, `ten_sp`, `anh_sp`, `gia_sp`, `khuyen_mai`, `trang_thai`, `dac_biet`, `chi_tiet_sp`, `so_luong`) VALUES
(2, 1, 'Nhẫn đôi bạc đính đá CZ All Of Love', 'nhan2.jpg', '863000', 'Không', 'Lượng hàng trong kho thấp', 0, 'Hẳn là người ấy và bạn sẽ đều rất vui và hạnh phúc khi cùng sở hữu kỷ vật tình yêu rất đẹp và ý nghĩa này, mà nhất là khi nó lại có thể đi cùng các bạn qua thời gian. Nhẫn đôi bạc All Of Love được làm từ bạc S925 cao cấp, điểm nhấn bởi viên đá Cubic Zirconia sang trọng và được chế tác hết sức tỉ mỉ bởi những nghệ nhân lành nghề. Chúc cặp đôi luôn hạnh phúc và sánh bước bên nhau cùng kỷ vật này nhé !!', 20),
(3, 1, 'Nhẫn bạc nữ đính đá CZ hoa bướm', 'nhan3.jpg', '620000', 'Không', 'Lượng hàng trong kho thấp', 0, 'Chiếc nhẫn bạc S925 được trang trí, tạo điểm nhấn bằng nhiều viên đá Cubic Zirconia vô cùng sang trọng. Dù bạn dùng em nó để đi dự tiệc, đi chơi hay đi làm, thì bạn sẽ luôn toát lên vẻ kiều diễm, duyên dáng và thanh lịch. Chắc chắn đây sẽ là 1 trong những items xứng đáng nhất trong tủ trang sức của bạn đó!', 20),
(4, 1, 'Nhẫn bạc nữ đính kim cương Moissanite Scarlett', 'nhan4.jpg', '935000', 'Không', 'Còn hàng', 0, 'Sản phẩm được làm từ bạc S925 mạ bạch kim, đính kim cương Moissanite 0,5 carat với thiết kế đan xen vào sự độc đáo là một chút dịu dàng, mang đến vẻ đẹp vừa nhẹ nhàng lại vừa năng động. Dù bạn kết hợp chiếc nhẫn xinh xắn này với trang phục nào đi nữa thì đây cũng là dấu ấn thật sự tuyệt vời cho bạn!', 100),
(5, 1, 'Nhẫn bạc nữ đính đá CZ hình bông hoa đào', 'nhan5.jpg', '632000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn bạc S925 đính đá Cubic Zirconia với thiết kế hình bông hoa đào thống nhất khoe trọn vẻ đẹp nữ tính, rạng rỡ của người đeo nên thường được phái mạnh sử dụng làm món quà bất ngờ và vô cùng ý nghĩa cho nàng như lời gửi gắm, truyền tải những tâm tư và tình cảm chân thành dành cho nàng.', 100),
(6, 1, 'Nhẫn bạc nữ mạ vàng đính đá CZ cây ô liu', 'nhan6.jpg', '817000', 'Không', 'Còn hàng', 1, 'Nếu bạn đang tìm kiếm một sản phẩm vừa đẹp, tinh tế về thẩm mỹ, vừa mang ý nghĩa mang lại may mắn, nhất là về tiền tài thì thiết kế nhẫn LILI_114577 là dành cho bạn đó. Em nó được làm từ bạc 92.5% nguyên chất, mạ vàng cao cấp, được các nghệ nhân chế tác một cách tỉ mỉ, tinh sảo. Món trang sức bạc này sẽ giúp bạn thêm phần đáng yêu và thu hút đó. Hãy tỏa sáng cùng em nó nhé !!', 100),
(7, 1, 'Nhẫn bạc nữ mạ vàng 18k đính đá CZ hình trái tim', 'nhan7.jpg', '601000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn được làm từ bạc 925 mạ vàng 18k với điểm nhấn là viên đá Cubic Zirconia hình trái tim. Được lấy cảm hứng từ những trái tim lãng mạn, e thẹn và ngọt ngào. Những trái tim nho nhỏ đính những viên đá Cubic Zirconia nổi bật đeo ở ngón tay bạn như được nhắc nhở rằng mình vẫn đang được yêu thương dù có đang cô đơn thế nào đi nữa. Đây là cách ghi nhớ thông điệp tình yêu rất duyên dáng, ý nhị, mà vẫn rất tươi sáng và trẻ trung.', 100),
(8, 1, 'Nhẫn bạc nữ đính kim cương Moissanite Elfleda', 'nhan8.jpg', '1070000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn cao cấp được làm từ bạc S925 đính viên kim cương Moissanite 1 carat. Nó sẽ mang đến cho bạn sự sang trọng và quý phái. Dù trong hoàn cảnh nào: đi làm, đi dự tiệc hay đi chơi với bạn bè, đôi tay của bạn sẽ cực kỳ nổi bật đấy.', 100),
(9, 1, 'Nhẫn bạc nữ mạ vàng đính đá CZ Ares', 'nhan9.jpg', '637000', 'Không', 'Còn hàng', 0, 'Nếu bạn đang tìm kiếm một sản phẩm vừa đẹp, tinh tế về thẩm mỹ, vừa mang ý nghĩa mang lại may mắn thì thiết kế nhẫn bạc này là dành cho bạn đó. Em nó được làm từ bạc 92.5% nguyên chất, với tùy chọn mạ vàng cao cấp, được các nghệ nhân chế tác một cách tỉ mỉ, tinh sảo. Món trang sức bạc này sẽ giúp bạn thêm phần đáng yêu và thu hút đó. Hãy tỏa sáng cùng em nó nhé !!', 100),
(10, 1, 'Nhẫn bạc nữ may mắn Lucky Day', 'nhan10.jpg', '647000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn được làm từ bạc S925 cao cấp, mang thiết kế chữ Lucky ở trung tâm vô cùng thời trang và phong cách sẽ là sự lựa chọn hoàn hảo cho các cô gái cá tính, trẻ trung, phóng khoáng. Chiếc nhẫn may mắn này kết hợp với cá tính của bạn chắc chắn sẽ khiến bạn vô cùng đặc biệt đấy!', 100),
(11, 1, 'Nhẫn bạc nữ đính kim cương Moissanite hình ngôi sao 6 cánh Gianna', 'nhan11.jpg', '898000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn được làm từ bạc S925 mạ vàng trắng, đính kim cương Moissanite 1 carat với thiết kế hình ngôi sao 6 cánh đan xen vào sự độc đáo là một chút dịu dàng, mang đến vẻ đẹp vừa nhẹ nhàng lại vừa năng động. Dù bạn kết hợp chiếc nhẫn xinh xắn này với trang phục nào đi nữa thì đây cũng là dấu ấn thật sự tuyệt vời cho bạn!', 100),
(12, 1, 'Nhẫn bạc nữ đính pha lê Aurora cá xinh xắn', 'nhan12.jpg', '653000', 'Không', 'Còn hàng', 1, 'Chiếc nhẫn được làm từ bạc S925 được đính viên pha lê Aurora hình chú cá xinh xắn. Một phong cách thiết kế tượng trưng cho sự nữ tính, thanh lịch. Chắc hẳn bạn cũng như bất cứ cô gái nào cũng muốn mình trở thành chủ nhân của một chiếc nhẫn đặc biệt này đấy!', 100),
(13, 1, 'Nhẫn bạc nam đính kim cương Moissanite Kane', 'nhan13.jpg', '1415000', 'Không', 'Còn hàng', 1, 'Sản phẩm làm từ bạc S925 đính kim cương Moissanite 1 carat sở hữu vẻ đẹp vừa quý phái lại vừa hiện đại, cho phép bạn sáng tạo, mix match cùng những món trang sức cũng như trang phục khác nhau, sẽ giúp bạn nổi bật và thu hút mọi ánh nhìn dù bạn xuất hiện ở đâu, dạo phố, cafe, tiệc tùng hay đi làm. Đừng ngạc nhiên khi nhiều ánh mắt hướng về bạn vì sự tinh tế này nhé !!', 100),
(14, 1, 'Nhẫn bạc nam dạng xoay tròn hình hoa văn Francis', 'nhan14.jpg', '1484000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn làm từ bạc S925 với thiết kế dạng xoay tròn hình hoa văn mang đến cho bạn sự tinh tế và thanh thoát mỗi khi ra ngoài. Với sự tỉ mỉ trong từng đường nét thiết kế, bạn sẽ trở nên hoàn hảo hơn khi đeo chiếc nhẫn này đấy!', 100),
(15, 1, 'Nhẫn bạc nam đính đá CZ hình vương miện Romeo', 'nhan15.jpg', '1081000', 'Không', 'Còn hàng', 1, 'Chiếc nhẫn làm từ bạc S925 đính đá Cubic Zirconia với thiết kế hình vương miện mang đến vẻ đẹp vừa thanh lịch lại vừa năng động. Dù bạn kết hợp chiếc nhẫn này với trang phục nào đi nữa thì đây cũng là dấu ấn thật sự tuyệt vời cho bạn đó!', 100),
(16, 1, 'Nhẫn bạc nam đính đá CZ Antonio', 'nhan16.jpg', '824000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn được làm từ bạc S925 đính đá Cubic Zirconia mang đến sự cuốn hút toát lên vẻ sang chảnh và nổi bật cho bạn. Chắc chắn em nó sẽ là một trong những items xứng đáng nhất trong tủ trang sức của bạn đó!', 100),
(17, 1, 'Nhẫn cặp đôi bạc đính kim cương Moissanite Theophilus', 'nhan17.jpg', '1346000', 'Không', 'Còn hàng', 1, 'Cặp nhẫn được làm từ bạc S925 đính viên kim cương Moissanite 1 carat sở hữu vẻ đẹp vừa quý phái lại vừa hiện đại, mang hơi hướng của sự phóng khoáng, là món phụ kiện không thể thiếu đối với mỗi cô gái, chàng trai, rất phù hợp khi làm quà tặng, cầu hôn, đính hôn, nhẫn cưới,… Chiếc nhẫn là món trang sức với kiểu dáng, thiết kế, màu sắc tinh tế và là đại diện cho mỗi phong cách khác nhau giúp chàng và nàng tự tin xuống phố, hội họp bạn bè hay dự một buổi tiệc tùng nào đó.', 100),
(18, 1, 'Nhẫn cặp đôi bạc mạ bạch kim trơn đơn giản Black And White', 'nhan18.jpg', '1037000', 'Không', 'Còn hàng', 0, 'Cặp nhẫn được làm từ bạc 925 sở hữu vẻ đẹp vừa quý phái lại vừa hiện đại, mang hơi hướng của sự phóng khoáng, là món phụ kiện không thể thiếu đối với mỗi cô gái, chàng trai. Em nó là món trang sức với kiểu dáng, thiết kế, màu sắc tinh tế và là đại diện cho mỗi phong cách khác nhau giúp chàng và nàng tự tin xuống phố, hội họp bạn bè hay dự một buổi tiệc tùng nào đó.\r\n\r\nVới cặp nhẫn màu đen, quá trình chuyển từ màu đen -> xám -> trắng (diễn ra trong khoảng 1-2 tháng) tượng trưng cho từng cột mốc vượt qua các khó khăn để bên nhau trọn đời.', 100),
(19, 1, 'Nhẫn bạc nữ mạ vàng xếp chồng đính đá Garnet, CZ vương miện Niche đẹp', 'nhan19.jpg', '1007000', 'Không', 'Còn hàng', 1, 'Chiếc nhẫn được làm từ bạc S925 với thiết kế dạng xếp chồng, đính viên đá Garnet kết hợp Cubic Zirconia hình vương miện cao cấp. Đá Garnet là biểu tượng của vẻ đẹp, tình yêu và sự vĩnh hằng nên dù bạn kết hợp chiếc nhẫn xinh xắn này với trang phục nào đi nữa thì đây cũng là dấu ấn thật sự tuyệt vời cho bạn!', 100),
(20, 1, 'Nhẫn bạc nữ đính đá CZ hình cành và lá Natalie', 'nhan20.jpg', '740000', 'Không', 'Còn hàng', 0, 'Chiếc nhẫn được làm bằng bạc S925 đính đá Cubic Zirconia với thiết kế hình cành và lá mang đến sự cuốn hút toát lên vẻ sang chảnh và nổi bật cho bạn. Chắc chắn em nó sẽ là một trong những items xứng đáng nhất trong tủ trang sức của bạn đó!', 100),
(21, 2, 'Dây chuyền đôi bạc đính đá Opal Obsidian thiên thần ác quỷ', 'daychuyen1.jpg', '1415000', 'Không', 'Còn hàng', 1, 'Nếu bạn đang tìm kiếm một mẫu trang sức trang sức đẹp, tinh tế cho cặp đôi thì dây chuyền đôi LILI_979263 hoàn toàn thỏa mãn điều đó. Dây chuyền làm từ bạc S925 mạ vàng, đính đá quý Opal và Obsidian cao cấp. Với thiết kế thiên thần và ác quỷ, là biểu tượng của sự hòa hợp âm dương, biểu trưng cho hôn nhân viên mãn, hạnh phúc, chung thủy, sự tương sinh, tương hỗ, bổ trợ cho nhau. Trong phong thủy, sự kết hợp này giúp đường tình duyên, hôn nhân tốt đẹp hơn. Chắc chắn cặp dây chuyền LILI_979263 sẽ không thể trong bộ sưu tập của các đôi tình nhân.', 100),
(22, 2, 'Dây chuyền bạc nữ đính đá CZ 2 trái tim ghép đôi', 'daychuyen2.jpg', '786000', 'Không', 'Còn hàng', 1, 'Bạn sẽ không chỉ thêm phần xinh xắn và thanh lịch khi diện em dây chuyền 2 trái tim ghép đôi này, mà còn thể hiện gu thẩm mỹ rất riêng cùng tình yêu rộng lớn đấy nhé. Hãy tưởng tượng bạn sẽ duyên dáng và thu hút làm sao khi bạn diện chiếc vòng cổ này đi làm, đi hẹn hò hay đi chơi với bạn bè. Dây chuyền bạc nữ 2 trái tim ghép đôi LILI_763116 được làm từ bạc 925 chuyên dụng mạ vàng hồng, điểm nhấn bởi những viên đá Cubic Zirconia cao cấp và được chế tác hết sức tỉ mỉ bởi những nghệ nhân lành nghề. Cùng em nó ra ngoài và tỏa sáng thôi nào !!', 100),
(23, 2, 'Dây chuyền bạc nữ đính đá CZ đôi thiên nga', 'daychuyen3.jpg', '757000', 'Không', 'Còn hàng', 1, 'Bạn sẽ không chỉ thêm phần xinh xắn và thanh lịch khi diện em dây chuyền bạc đôi thiên nga này, mà nó còn biểu trưng cho sự tình yêu chung thủy, sự đẹp đẽ và thánh thiện. Hãy tưởng tượng bạn sẽ duyên dáng và thu hút làm sao khi bạn diện chiếc vòng cổ này đi làm, đi hẹn hò hay đi chơi với bạn bè. Dây chuyền bạc nữ đôi thiên nga đính đá CZ LILI_879835 được làm từ bạc 925 chuyên dụng , điểm nhấn bởi những viên đá Cubic Zirconia cao cấp và được chế tác hết sức tỉ mỉ bởi những nghệ nhân lành nghề. Cùng em nó ra ngoài và tỏa sáng thôi nào !!', 99),
(24, 2, 'Dây chuyền bạc nữ 2 tầng đính đá CZ Keisha', 'daychuyen4.jpg', '981000', 'Không', 'Còn hàng', 1, 'Bạn sẽ thêm phần xinh xắn và thanh lịch khi diện em dây chuyền bạc 2 tầng này đấy. Hãy tưởng tượng bạn sẽ duyên dáng và thu hút làm sao khi bạn diện chiếc vòng cổ này đi làm, đi hẹn hò hay đi chơi với bạn bè. Dây chuyền bạc nữ 2 tầng LILI_717374 được làm từ bạc 925 chuyên dụng , điểm nhấn bởi những viên đá Cubic Zirconia cao cấp và được chế tác hết sức tỉ mỉ bởi những nghệ nhân lành nghề. Cùng em nó ra ngoài và tỏa sáng thôi nào !!', 100),
(25, 3, 'Bông tai bạc Ý S925 nữ mạ bạch kim đính đá CZ hình trái tim', 'bongtai1.jpg', '671000', 'Không', 'Còn hàng', 1, 'Chiếc bông tai được làm từ bạc S925 đính đá Cubic Zirconia cao cấp hình trái tim với thiết kế là lựa chọn hoàn hảo cho bạn trong những trang phục dự tiệc trang trọng và là một chiếc khuyên không thể thiếu cho những bạn đã bấm khuyên tai. Bạn có muốn cùng em nó hóa trang thành nàng công chúa lộng lẫy không nào?', 100),
(26, 3, 'Bông tai bạc nữ đính đá CZ, ngọc trai Fidelma', 'bongtai2.jpg', '586000', 'Không', 'Còn hàng', 1, 'Chiếc bông tai được làm bằng bạc S925 đính đá Cubic Zirconia, ngọc trai cao cấp. Khoác lên mình thiết kế bất đối xứng độc đáo, mang đến vẻ đẹp kiêu kỳ, cá tính và sự trẻ trung cho cô nàng sở hữu. Đây cũng là món quà ý nghĩa mà phái mạnh có thể dành cho phái đẹp như thể hiện sự nâng niu, trân trọng, và bảo vệ người phụ nữ mình yêu.', 100),
(27, 3, 'Bông tai bạc Ý S925 nữ dạng nụ mạ bạch kim đính đá CZ cỏ 4 lá', 'bongtai3.jpg', '625000', 'Không', 'Còn hàng', 0, 'Sản phẩm được làm từ bạc Ý S925 đính đá Cubic Zirconia cao cấp hình cỏ 4 lá, là một chiếc khuyên không thể thiếu cho những bạn đã bấm khuyên tai. Chiếc bông tai vô cùng phù hợp dùng để đeo đi học, đi làm văn phòng mà không gây bất tiện nhưng vẫn giúp bạn khoe được cá tính của mình. Với sự tỉ mỉ trong từng đường nét thiết kế, bạn sẽ trở nên hoàn hảo hơn khi đeo bông tai này đấy!', 100),
(28, 3, 'Bông tai giả kẹp bạc nữ/nam Make Love', 'bongtai4.jpg', '877000', 'Không', 'Còn hàng', 0, 'Sản phẩm được làm từ bạc S925 chứa 92,5% bạc nguyên chất, với phong cách thiết kế mang đến cho bạn sự tinh tế và thanh thoát mỗi khi ra ngoài. Bạn đã sẵn sàng để tỏa sáng và thu hút mọi ánh nhìn cùng em nó chưa nào !!', 100),
(29, 4, 'Lắc tay vàng 18K nữ đính kim cương tự nhiên hình cỏ 4 lá Keelin', 'lactay1.jpg', '7917000', 'Không', 'Còn hàng', 1, 'Chiếc lắc tay làm từ vàng hồng 18K đính kim cương tự nhiên, sở hữu vẻ đẹp vừa quý phái lại vừa hiện đại, là món phụ kiện không thể thiếu đối với mỗi cô gái, đại diện cho mỗi phong cách khác nhau giúp nàng tự tin xuống phố, hội họp bạn bè hay dự một buổi tiệc tùng nào đó. Đừng ngạc nhiên khi nhiều ánh mắt hướng về bạn vì sự tinh tế này nhé !!', 92),
(30, 4, 'Lắc tay bạc cặp đôi tình yêu Forever Love', 'lactay2.jpg', '1200000', 'Không', 'Còn hàng', 1, 'Lấy cảm hứng từ vòng tròn vô cực, tượng trưng cho vẻ đẹp bền chặt vĩnh cửu của tình yêu đôi lứa, lắc bạc LILI_986852 được thiết kế một cách tinh xảo, với chất liệu bạc S925 cao cấp, sang trọng. Món trang sức không chỉ giúp bạn trông thật thanh lịch và duyên dáng, mà còn như như một tín hiệu của tình yêu và hạnh phúc. Chúc bạn luôn hạnh phúc bên gia đình và người thương !!', 100),
(31, 4, 'Lắc tay bạc nữ mạ bạch kim đính đá CZ cỏ 4 lá', 'lactay3.jpg', '816000', 'Không', 'Còn hàng', 0, 'Chiếc lắc được làm từ bạc 925 mạ bạch kim đính 2 viên đá Cubic Zirconia được chế tác tỉ mỉ. Với thiết kế hình cỏ bốn lá thống nhất khoe trọn vẻ đẹp nữ tính, rạng rỡ của người đeo nên thường được phái mạnh sử dụng làm món quà bất ngờ và vô cùng ý nghĩa cho nàng như lời gửi gắm, truyền tải những tâm tư và tình cảm chân thành dành cho nàng.', 100),
(32, 4, 'Lắc tay bạc nữ đính đá CZ hình trái tim Heart Of The Sea', 'lactay4.jpg', '1188000', 'Không', 'Còn hàng', 0, 'Sản phẩm được làm từ bạc S925 cao cấp được tô điểm bằng những viên đá Cubic Zirconia hình trái tim bao quanh. Chiếc lắc mang đến sự cuốn hút toát lên vẻ sang chảnh và nổi bật cho bạn. Chắc chắn chiếc lắc này sẽ là một trong những items xứng đáng nhất trong tủ trang sức của bạn', 100),
(33, 5, 'Hạt charm bạc nữ đính đá CZ hình cúc họa mi Eileen', 'charm1.jpg', '984000', 'Không', 'Còn hàng', 1, 'Hạt charm được làm từ bạc S925 đính đá Cubic Zirconia với thiết kế hình hoa cúc họa mi tạo nên phong cách sang trọng và tinh tế cho phái đẹp, giúp nàng luôn cảm thấy tự tin thể hiện bản thân. Chiếc charm xinh xắn này chắc chắn sẽ mang đến vẻ đẹp, sức hút cho bạn đó!', 100),
(34, 5, 'Hạt charm bạc nữ DIY đính đá CZ hoa tuyết Ophelia', 'charm2.jpg', '676000', 'Không', 'Còn hàng', 1, 'Hạt charm được làm từ bạc S925 đính đá Cubic Zirconia với thiết kế tinh xảo, mang đến vẻ đẹp tinh tế và thu hút ánh nhìn ngay từ những giây phút đầu tiên. Sự hiện diện của chiếc charm không chỉ là điểm nhấn nhá thể hiện phong cách nữ tính mà còn âm thầm thể hiện gu thẩm mỹ, phong cách riêng của bạn!', 93),
(35, 5, 'Hạt charm bạc nữ DIY đính đá CZ Kendall', 'charm3.jpg', '935000', 'Không', 'Còn hàng', 0, 'Hạt charm được chế tác từ bạc S925 đính đá Cubic Zirconia với thiết kế mang đến cho bạn không chỉ sự thanh lịch mà còn toát lên vẻ tinh tế. Món trang sức rất dễ để phối đồ cho các chị em vì em nó đẹp trong mọi khoảnh khắc !!', 100),
(36, 5, 'Hạt charm bạc nữ đính đá CZ hình đôi cánh thiên thần Mariana', 'charm4.jpg', '750000', 'Không', 'Còn hàng', 0, 'Hạt charm được chế tác từ bạc S925 đính đá Cubic Zirconia được thiết kế hình đôi cánh thiên thần một cách tỉ mỉ, cuốn hút, không những thể hiện sự nữ tính mà còn âm thầm thể hiện gu thẩm mỹ và phong cách của riêng của bạn!', 100),
(38, 6, 'Kiềng Vàng trắng Ý 18K', 'kieng2.png', '26300000', 'Không', 'Còn hàng', 0, 'Sở hữu kiểu dáng độc đáo với lối thiết kế hiện đại, chiếc kiềng vàng Ý 18K không chỉ mang vẻ đẹp phá cách mà còn tô điểm nét thời thượng. Chiếc kiềng được chế tác từ vàng Ý 18K và ghi điểm với sự độc lạ sẽ cùng nàng kiêu hãnh tỏa sáng trên mọi bước đường. Sở hữu kiểu dáng mảnh mai, sản phẩm sẽ làm nổi bật vẻ đẹp kiêu sa của nàng.', 100),
(39, 6, 'Kiềng cưới Vàng 18K PNJ Trầu Cau', 'kieng3.jpg', '5260000', 'Không', 'Còn hàng', 1, 'Chế tác từ vàng 18K trên thiết kế độc đáo, chiếc kiềng cưới mang vẻ đẹp vừa truyền thống lại vừa hiện đại.Lá trầu bên ngoài được tạo nét theo cánh phượng uyển chuyển bao bọc bên trong là quả cau, thể hiện sự hòa quyện giữa miếng trầu và cánh phượng vừa mang đậm tính văn hóa bản sắc dân tộc vừa thể hiện được tình cảm sắt son của đôi lứa.', 97),
(40, 6, 'Vòng tay bạc nữ dạng kiềng đính đá pha lê Eye of the muse', 'kieng4.jpg', '1267000', 'Không', 'Còn hàng', 0, 'Chiếc vòng được làm từ bạc 925 mạ bạch kim đính đá pha lê Eye of the muse và là một trong những chiếc vòng tay bạc đẹp nhất hiện nay. Sở hữu điểm nhấn là viên pha lê cao cấp cho phép nàng sáng tạo, mix&match cùng những món trang sức cũng như trang phục khác nhau. Sự phản chiếu đa sắc của viên đá pha lê sẽ giúp cho sản phẩm thêm phần huyền ảo trong mắt mọi người, giúp nàng luôn tỏa sáng rực rỡ.', 100);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanhvien`
--

CREATE TABLE `thanhvien` (
  `id_thanhvien` int(10) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mat_khau` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `thanhvien`
--

INSERT INTO `thanhvien` (`id_thanhvien`, `email`, `mat_khau`) VALUES
(1, 'test@gmail.com', '123456'),
(2, 'admin@gmail.com', '123456');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD PRIMARY KEY (`id_chitiet`),
  ADD KEY `id_donhang` (`id_donhang`);

--
-- Chỉ mục cho bảng `dmsanpham`
--
ALTER TABLE `dmsanpham`
  ADD PRIMARY KEY (`id_dm`);

--
-- Chỉ mục cho bảng `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`id_donhang`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`id_sp`);

--
-- Chỉ mục cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  ADD PRIMARY KEY (`id_thanhvien`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  MODIFY `id_chitiet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `dmsanpham`
--
ALTER TABLE `dmsanpham`
  MODIFY `id_dm` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `donhang`
--
ALTER TABLE `donhang`
  MODIFY `id_donhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `id_sp` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `thanhvien`
--
ALTER TABLE `thanhvien`
  MODIFY `id_thanhvien` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `chitiet_donhang`
--
ALTER TABLE `chitiet_donhang`
  ADD CONSTRAINT `chitiet_donhang_ibfk_1` FOREIGN KEY (`id_donhang`) REFERENCES `donhang` (`id_donhang`);
COMMIT;

