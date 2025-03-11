-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 11, 2025 lúc 07:37 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `dathucpham`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_admin`
--

CREATE TABLE `da_admin` (
  `adminID` int(11) NOT NULL,
  `adminTen` varchar(255) NOT NULL,
  `adminPass` varchar(250) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_admin`
--

INSERT INTO `da_admin` (`adminID`, `adminTen`, `adminPass`, `adminUser`, `adminEmail`, `level`) VALUES
(4, 'yennhi', 'a591024321c5e2bdbd23ed35f0574dde', 'yennhi', 'yennhi@gmail.com', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_chitiettp`
--

CREATE TABLE `da_chitiettp` (
  `ChiTietID` int(11) NOT NULL,
  `ChiTietName` varchar(255) NOT NULL,
  `ChiTietGia` varchar(255) NOT NULL,
  `donvitinh` int(11) NOT NULL,
  `PhanLoaiTPID` int(11) NOT NULL,
  `DMID` int(11) NOT NULL,
  `mota` text NOT NULL,
  `ChiTietImg` varchar(255) NOT NULL,
  `typee` int(11) NOT NULL,
  `productSL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_chitiettp`
--

INSERT INTO `da_chitiettp` (`ChiTietID`, `ChiTietName`, `ChiTietGia`, `donvitinh`, `PhanLoaiTPID`, `DMID`, `mota`, `ChiTietImg`, `typee`, `productSL`) VALUES
(1, 'Tôm càng xanh loại 1(Đặt biệt)', '240000', 2, 17, 7, '<p>T&ocirc;m c&agrave;ng xanh loại 1 được nhập khẩu từ H&agrave;n quốc. Vận chuyển về Việt Nam trong v&ograve;ng 1 tuần. Được bảo quản kh&eacute;p k&iacute;n n&ecirc;n vẫn giữ được độ tươi ngon của t&ocirc;m, gi&uacute;p cho người ti&ecirc;u d&ugrave;ng cam nhận được sự tươi ngon ngọt nước của t&ocirc;m</p>', 'dff564a5e0.jpg', 1, '54.8'),
(3, 'Mực xú', '100000', 2, 17, 6, '<p>vvbvbfbvkfg bsgvuhvghchskhgwhfsdcgiwvshghr&nbsp; ssdukf sfirs sfisvvyfhskuh&nbsp; s&nbsp; skdvr cs isgs fjsdgr ư sgjcvg vrfgdcb i wggsdgs sf cjegfs&nbsp; fgwufgsb jgs&nbsp; sdf gjdsfgwr</p>', 'fa29e88247.jpg', 1, '50'),
(10, 'Rau muống', '8000', 1, 15, 9, '<p>R&acirc;u muống tươi v&agrave; ngon nhất hdhd gdgd yaya iiei iaiai ododo oaoao hhdh ậ ajajaj&nbsp;</p>\r\n<div class=\"ddict_btn\" style=\"top: 9px; left: 425.363px;\"><img src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/logo/48.png\" alt=\"\" /></div>', '1c852cc39e.jpg', 1, '17.6'),
(11, 'Xà lách lô lô xanh thuỷ canh', '45000', 1, 15, 10, '<p>X&agrave; l&aacute;ch thủy canh v&agrave; ngon nhất hdhd gdgd yaya iiei iaiai ododo oaoao hhdh ậ ajajaj&nbsp;</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: -13px; top: -20px;\">&nbsp;</div>', '73a7d02d03.jpg', 2, '35'),
(13, 'Táo xanh nhập khẩu', '23000', 2, 7, 12, '<p>R&acirc;u muống tươi v&agrave; ngon nhất hdhd gdgd yaya iiei iaiai ododo oaoao hhdh ậ ajajaj&nbsp;</p>', '7655090906.jpg', 2, '50'),
(14, 'Dưa hấu đỏ ao', '31000', 2, 7, 12, '<p>Dưa hấu tươi v&agrave; ngon nhất hdhd gdgd yaya iiei iaiai ododo oaoao hhdh ậ ajajaj&nbsp;</p>', '35df9674c3.jpg', 1, '40'),
(15, 'Quả xoài cát hòa lộc', '45000', 2, 7, 11, '<p>R&acirc;u muống tươi v&agrave; ngon nhất hdhd gdgd yaya iiei iaiai ododo oaoao hhdh ậ ajajaj&nbsp;</p>', '813b18d4f8.jpg', 2, '27'),
(16, 'Nho nhập khẩu (Mỹ)', '102000', 2, 7, 11, '<p>Nho nhập khẩu từ mỹ. rất ngon v&agrave; ngọt gi&agrave;u vitamin</p>', '00ee555d79.jpg', 1, '46'),
(17, 'Măng cục Ta', '1000', 2, 7, 11, '<p>măng cục ta được trồng tại đồng bằng s&ocirc;ng cửu long</p>', 'edb403a0fd.jpg', 1, '40'),
(18, 'Chôm chôm', '35000', 2, 7, 12, '<p>Tr&aacute;i ch&ocirc;m ch&ocirc;m 1 ch&ugrave;m ch&ocirc;m ch&ocirc;m rất hấp dẫn</p>', '13892caa75.jpg', 1, '40'),
(19, 'SupLo', '80000', 2, 15, 10, '<p><span>Rau l&agrave; nh&oacute;m thực phẩm từ thực vật được sử dụng rộng r&atilde;i trong chế biến thực phẩm, mang lại nhiều lợi &iacute;ch dinh dưỡng v&agrave; hương vị tuyệt vời. Những loại rau như cải xanh, c&agrave; chua, c&agrave; rốt, b&ocirc;ng cải, v&agrave; rau mầm kh&ocirc;ng chỉ l&agrave; nguồn cung cấp nhiều vitamin, kho&aacute;ng chất v&agrave; chất xơ, m&agrave; c&ograve;n gi&uacute;p tăng cường sức khỏe v&agrave; ngăn chặn nhiều bệnh tật. Rau thường được sử dụng trong ẩm thực truyền thống v&agrave; hiện đại, đồng thời c&ograve;n đ&oacute;ng vai tr&ograve; quan trọng trong việc tạo n&ecirc;n những bữa ăn ngon miệng v&agrave; c&acirc;n đối</span></p>', '695ba03a8b.jpg', 2, '43'),
(20, 'Măng tây', '41000', 1, 15, 10, '<p><span>Rau l&agrave; nh&oacute;m thực phẩm từ thực vật được sử dụng rộng r&atilde;i trong chế biến thực phẩm, mang lại nhiều lợi &iacute;ch dinh dưỡng v&agrave; hương vị tuyệt vời. Những loại rau như cải xanh, c&agrave; chua, c&agrave; rốt, b&ocirc;ng cải, v&agrave; rau mầm kh&ocirc;ng chỉ l&agrave; nguồn cung cấp nhiều vitamin, kho&aacute;ng chất v&agrave; chất xơ, m&agrave; c&ograve;n gi&uacute;p tăng cường sức khỏe v&agrave; ngăn chặn nhiều bệnh tật. Rau thường được sử dụng trong ẩm thực truyền thống v&agrave; hiện đại, đồng thời c&ograve;n đ&oacute;ng vai tr&ograve; quan trọng trong việc tạo n&ecirc;n những bữa ăn ngon miệng v&agrave; c&acirc;n đối</span></p>', 'e184dcc615.jpg', 2, '50'),
(21, 'Rau nhúc', '10000', 1, 15, 9, '<p><span>Rau l&agrave; nh&oacute;m thực phẩm từ thực vật được sử dụng rộng r&atilde;i trong chế biến thực phẩm, mang lại nhiều lợi &iacute;ch dinh dưỡng v&agrave; hương vị tuyệt vời. Những loại rau như cải xanh, c&agrave; chua, c&agrave; rốt, b&ocirc;ng cải, v&agrave; rau mầm kh&ocirc;ng chỉ l&agrave; nguồn cung cấp nhiều vitamin, kho&aacute;ng chất v&agrave; chất xơ, m&agrave; c&ograve;n gi&uacute;p tăng cường sức khỏe v&agrave; ngăn chặn nhiều bệnh tật. Rau thường được sử dụng trong ẩm thực truyền thống v&agrave; hiện đại, đồng thời c&ograve;n đ&oacute;ng vai tr&ograve; quan trọng trong việc tạo n&ecirc;n những bữa ăn ngon miệng v&agrave; c&acirc;n đối</span></p>', '273c5b5091.jpg', 2, '49'),
(22, 'Thịt 3 chỉ heo', '120000', 1, 18, 13, '<p><span>Thịt heo v&agrave; thịt b&ograve; l&agrave; hai loại thực phẩm thịt phổ biến được sử dụng rộng r&atilde;i trong ẩm thực to&agrave;n cầu. Thịt heo, được chiết xuất từ thịt của con heo, thường c&oacute; hương vị độc đ&aacute;o v&agrave; gi&agrave;u chất dinh dưỡng. C&aacute;c phần kh&aacute;c nhau của heo, như thịt lươn, thịt vai, xương nạc, được sử dụng trong nhiều m&oacute;n ăn kh&aacute;c nhau, từ m&oacute;n hấp đến m&oacute;n x&agrave;o v&agrave; nướng.</span></p>', '6c153a01c4.jpg', 1, '20'),
(23, 'Thịt cốc lếch heo', '150000', 1, 18, 13, '<p><span>Thịt heo v&agrave; thịt b&ograve; l&agrave; hai loại thực phẩm thịt phổ biến được sử dụng rộng r&atilde;i trong ẩm thực to&agrave;n cầu. Thịt heo, được chiết xuất từ thịt của con heo, thường c&oacute; hương vị độc đ&aacute;o v&agrave; gi&agrave;u chất dinh dưỡng. C&aacute;c phần kh&aacute;c nhau của heo, như thịt lươn, thịt vai, xương nạc, được sử dụng trong nhiều m&oacute;n ăn kh&aacute;c nhau, từ m&oacute;n hấp đến m&oacute;n x&agrave;o v&agrave; nướng.</span></p>', '912c8e6488.jpg', 2, '20'),
(24, 'Chân heo', '90000', 2, 18, 13, '<p><span>Thịt heo v&agrave; thịt b&ograve; l&agrave; hai loại thực phẩm thịt phổ biến được sử dụng rộng r&atilde;i trong ẩm thực to&agrave;n cầu. Thịt heo, được chiết xuất từ thịt của con heo, thường c&oacute; hương vị độc đ&aacute;o v&agrave; gi&agrave;u chất dinh dưỡng. C&aacute;c phần kh&aacute;c nhau của heo, như thịt lươn, thịt vai, xương nạc, được sử dụng trong nhiều m&oacute;n ăn kh&aacute;c nhau, từ m&oacute;n hấp đến m&oacute;n x&agrave;o v&agrave; nướng.</span></p>', 'e89a1e0bfc.jpg', 2, '45'),
(25, 'Bò 3 chỉ', '220000', 2, 18, 15, '<p><span> thịt b&ograve; l&agrave; sản phẩm từ thịt của con b&ograve;. Thịt b&ograve; thường c&oacute; cấu tr&uacute;c cơ bản với c&aacute;c phần như thịt đ&ugrave;i, thịt cổ, thịt bắp, v&agrave; xương. Thịt b&ograve; thường c&oacute; hương vị đậm đ&agrave; v&agrave; thơm ngon, l&agrave; th&agrave;nh phần ch&iacute;nh của nhiều m&oacute;n ăn nổi tiếng như b&ograve; b&iacute;t tết, b&ograve; kho, hay b&ograve; nướng.</span></p>', '85c2e81159.jpg', 1, '42'),
(26, 'Thịt ba chỉ bò Mỹ cắt cuộn Orifood ', '102000', 2, 18, 13, '<p><span> thịt b&ograve; l&agrave; sản phẩm từ thịt của con b&ograve;. Thịt b&ograve; thường c&oacute; cấu tr&uacute;c cơ bản với c&aacute;c phần như thịt đ&ugrave;i, thịt cổ, thịt bắp, v&agrave; xương. Thịt b&ograve; thường c&oacute; hương vị đậm đ&agrave; v&agrave; thơm ngon, l&agrave; th&agrave;nh phần ch&iacute;nh của nhiều m&oacute;n ăn nổi tiếng như b&ograve; b&iacute;t tết, b&ograve; kho, hay b&ograve; nướng.</span></p>', '01bb0f2d89.jpg', 1, '18'),
(28, 'Cánh giữa gà nhập khẩu', '145000', 2, 18, 14, '<p><span>Thịt g&agrave; l&agrave; một nguồn thực phẩm chất lượng v&agrave; phổ biến tr&ecirc;n to&agrave;n thế giới, được sử dụng trong nhiều loại m&oacute;n ăn với sự đa dạng v&agrave; linh hoạt. Thịt g&agrave; c&oacute; hương vị nhẹ nh&agrave;ng v&agrave; thơm ngon, ph&ugrave; hợp cho nhiều phong c&aacute;ch nấu ăn kh&aacute;c nhau.</span></p>', 'c9e54be615.jpg', 2, '45'),
(31, 'Táo Gala mini nhập khẩu', '53000', 2, 7, 12, '<p>T&aacute;o gala mini&nbsp;</p>\r\n<p>(Loại nhỏ)</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 81px; top: -20px;\">&nbsp;</div>', '67df3d5be2.jpg', 1, '30'),
(32, 'Quýt giống Úc trái từ 120g trở lên', '49000', 2, 7, 12, '<p>qu&yacute;t giống &uacute;c<img class=\"ddict_audio\" src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/img/audio.png\" alt=\"\" /></p>', '57fe2a0b03.jpg', 1, '24'),
(39, 'Bơ sáp', '38200', 1, 7, 12, '<p>bơ s&aacute;p đ&agrave; lạt&nbsp;</p>\r\n<div id=\"gtx-trans\" style=\"position: absolute; left: 66px; top: 20.5556px;\">&nbsp;</div>\r\n<div class=\"ddict_div\" style=\"top: 24.5556px; max-width: 150px; left: 5px;\"><img class=\"ddict_audio\" src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/img/audio.png\" alt=\"\" />\r\n<p class=\"ddict_sentence\">fsfdf</p>\r\n</div>', '2936c319eb.jpg', 1, '43.6'),
(41, 'Dưa hấu không hạt trái từ 2 kg trở lên', '20600 ', 1, 7, 12, '<p><span>20.600&nbsp;Dưa hấu kh&ocirc;ng hạt tr&aacute;i từ 2 kg trở l&ecirc;n</span></p>\r\n<div class=\"ddict_div\" style=\"top: 24.5556px; max-width: 150px; left: 5px;\"><img class=\"ddict_audio\" src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/img/audio.png\" alt=\"\" />\r\n<p class=\"ddict_sentence\">20.600&nbsp;</p>\r\n</div>', 'ffd08d2b16.jpg', 1, '9'),
(42, 'Chuối già giống Nam Mỹ trái từ 120 - 220g', '1000', 2, 7, 4, '<p>chuối gi&agrave; giống mỹ</p>\r\n<div class=\"ddict_div\" style=\"top: 24.5556px; max-width: 150px; left: 5px;\"><img class=\"ddict_audio\" src=\"chrome-extension://bpggmmljdiliancllaapiggllnkbjocb/img/audio.png\" alt=\"\" />\r\n<p class=\"ddict_sentence\">25.900</p>\r\n</div>', 'd5f4800371.jpg', 2, '18'),
(48, 'Tôm càng xanh', '2000', 1, 17, 7, '<p>T&ocirc;m c&agrave;ng xanh ngon</p>', 'b2ce7609d7.jpg', 1, '8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_dathang`
--

CREATE TABLE `da_dathang` (
  `dathangID` int(11) NOT NULL,
  `ChiTietID` int(11) NOT NULL,
  `madonhang` varchar(20) NOT NULL,
  `ChiTietName` varchar(255) NOT NULL,
  `cusID` int(11) NOT NULL,
  `soluong` varchar(255) NOT NULL,
  `orderGia` varchar(255) NOT NULL,
  `orderImg` varchar(255) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 0,
  `ngaymua` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_dathang`
--

INSERT INTO `da_dathang` (`dathangID`, `ChiTietID`, `madonhang`, `ChiTietName`, `cusID`, `soluong`, `orderGia`, `orderImg`, `TrangThai`, `ngaymua`) VALUES
(123, 26, '554', 'Thịt ba chỉ bò Mỹ cắt cuộn Orifood ', 13, '2', '204000', ' 01bb0f2d89.jpg', 0, '2024-11-24 17:13:30'),
(124, 39, '554', 'Bơ sáp', 13, '1', '38200', ' 2936c319eb.jpg', 0, '2024-11-24 17:13:30'),
(125, 48, '5130', 'Tôm càng xanh', 13, '1', '230000', ' b2ce7609d7.jpg', 0, '2024-11-24 17:37:57'),
(126, 31, '5130', 'Táo Gala mini nhập khẩu', 13, '3', '159000', ' 67df3d5be2.jpg', 0, '2024-11-24 17:37:57'),
(127, 48, '3644', 'Tôm càng xanh', 13, '2', '460000', ' b2ce7609d7.jpg', 0, '2024-11-24 19:41:08'),
(128, 48, '5052', 'Tôm càng xanh', 14, '2', '460000', ' b2ce7609d7.jpg', 0, '2024-11-26 03:12:54'),
(129, 39, '5052', 'Bơ sáp', 14, '1', '38200', ' 2936c319eb.jpg', 0, '2024-11-26 03:12:54'),
(130, 32, '5484', 'Quýt giống Úc trái từ 120g trở lên', 0, '1', '49000', ' 57fe2a0b03.jpg', 0, '2024-11-26 03:18:52'),
(131, 32, '9059', 'Quýt giống Úc trái từ 120g trở lên', 14, '1', '49000', ' 57fe2a0b03.jpg', 0, '2024-11-26 03:19:43'),
(132, 48, '1136', 'Tôm càng xanh', 14, '1', '230000', ' b2ce7609d7.jpg', 0, '2024-11-26 05:04:40'),
(133, 32, '5520', 'Quýt giống Úc trái từ 120g trở lên', 14, '1', '49000', ' 57fe2a0b03.jpg', 0, '2024-12-01 04:36:17'),
(134, 39, '5520', 'Bơ sáp', 14, '1', '38200', ' 2936c319eb.jpg', 0, '2024-12-01 04:36:17'),
(135, 42, '5520', 'Chuối già giống Nam Mỹ trái từ 120 - 220g', 14, '1', '1000', ' d5f4800371.jpg', 0, '2024-12-01 04:36:17'),
(136, 41, '5520', 'Dưa hấu không hạt trái từ 2 kg trở lên', 14, '1', '20600', ' ffd08d2b16.jpg', 0, '2024-12-01 04:36:17'),
(137, 39, '1138', 'Bơ sáp', 14, '1', '38200', ' 2936c319eb.jpg', 0, '2024-12-01 04:36:36'),
(138, 41, '5619', 'Dưa hấu không hạt trái từ 2 kg trở lên', 14, '2', '41200', ' ffd08d2b16.jpg', 0, '2024-12-10 03:47:49'),
(139, 39, '5619', 'Bơ sáp', 14, '1', '38200', ' 2936c319eb.jpg', 0, '2024-12-10 03:47:49'),
(140, 42, '5619', 'Chuối già giống Nam Mỹ trái từ 120 - 220g', 14, '1', '1000', ' d5f4800371.jpg', 0, '2024-12-10 03:47:49'),
(141, 42, '5619', 'Chuối già giống Nam Mỹ trái từ 120 - 220g', 14, '2', '2000', ' d5f4800371.jpg', 0, '2024-12-10 03:47:49'),
(142, 48, '5619', 'Tôm càng xanh', 14, '1', '230000', ' b2ce7609d7.jpg', 0, '2024-12-10 03:47:49'),
(143, 41, '3406', 'Dưa hấu không hạt trái từ 2 kg trở lên', 14, '1', '20600', ' ffd08d2b16.jpg', 0, '2024-12-10 03:49:18'),
(144, 41, '5123', 'Dưa hấu không hạt trái từ 2 kg trở lên', 14, '1', '20600', ' ffd08d2b16.jpg', 0, '2024-12-25 01:01:44'),
(145, 42, '5123', 'Chuối già giống Nam Mỹ trái từ 120 - 220g', 14, '1', '1000', ' d5f4800371.jpg', 0, '2024-12-25 01:01:44'),
(146, 42, '5123', 'Chuối già giống Nam Mỹ trái từ 120 - 220g', 14, '1', '1000', ' d5f4800371.jpg', 0, '2024-12-25 01:01:44'),
(147, 41, '4510', 'Dưa hấu không hạt trái từ 2 kg trở lên', 14, '1', '20600', ' ffd08d2b16.jpg', 0, '2024-12-25 01:02:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_dmcon`
--

CREATE TABLE `da_dmcon` (
  `DMID` int(11) NOT NULL,
  `DMName` varchar(255) NOT NULL,
  `PhanLoaiTPID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_dmcon`
--

INSERT INTO `da_dmcon` (`DMID`, `DMName`, `PhanLoaiTPID`) VALUES
(4, 'Chuối khô', 7),
(6, 'Mực ống', 17),
(7, 'Tôm càng', 17),
(8, 'bạch tuột', 17),
(9, 'dưới nước', 15),
(10, 'Trên cạn', 15),
(11, 'quả', 7),
(12, 'trái', 7),
(13, 'Thịt heo', 18),
(14, 'thịt gà', 18),
(15, 'thịt bò', 18),
(16, 'Đậu lên cây', 19),
(17, 'cá', 17);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_dmphanloai`
--

CREATE TABLE `da_dmphanloai` (
  `DMPhanLoaiID` int(11) NOT NULL,
  `DMPhanLoaiName` int(11) NOT NULL,
  `PhanLoaiTPID` int(11) NOT NULL,
  `mota` int(11) NOT NULL,
  `DMPhanLoaiGIa` int(11) NOT NULL,
  `DMPhanLoaiImg` int(11) NOT NULL,
  `typee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_donhangdadat`
--

CREATE TABLE `da_donhangdadat` (
  `id_donhangdadat` int(11) NOT NULL,
  `madonhang` varchar(20) NOT NULL,
  `TrangThai` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `ngaydat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_donhangdadat`
--

INSERT INTO `da_donhangdadat` (`id_donhangdadat`, `madonhang`, `TrangThai`, `customer_id`, `ngaydat`) VALUES
(15, '5130', 1, 13, '2024-11-24 17:39:17'),
(16, '3644', 1, 13, '2024-11-26 03:21:10'),
(18, '5484', 0, 0, '2024-11-26 03:18:51'),
(19, '9059', 2, 14, '2024-12-01 04:19:01'),
(20, '1136', 2, 14, '2024-12-01 04:37:29'),
(21, '5520', 2, 14, '2024-12-01 04:37:26'),
(22, '1138', 2, 14, '2024-12-01 04:37:20'),
(23, '5619', 0, 14, '2024-12-10 03:47:49'),
(24, '3406', 0, 14, '2024-12-10 03:49:18'),
(25, '5123', 0, 14, '2024-12-25 01:01:44'),
(26, '4510', 0, 14, '2024-12-25 01:02:44');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_giohang`
--

CREATE TABLE `da_giohang` (
  `ghID` int(11) NOT NULL,
  `gia` varchar(200) NOT NULL,
  `img` varchar(255) NOT NULL,
  `ChiTietID` int(11) NOT NULL,
  `ChiTietName` varchar(255) NOT NULL,
  `sed` varchar(255) NOT NULL,
  `soluong` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `TrangThai` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_giohang`
--

INSERT INTO `da_giohang` (`ghID`, `gia`, `img`, `ChiTietID`, `ChiTietName`, `sed`, `soluong`, `stock`, `TrangThai`) VALUES
(282, '20600 ', ' ffd08d2b16.jpg', 41, 'Dưa hấu không hạt trái từ 2 kg trở lên', '5pmlvpjt18q7dtum74pfhccb04', '1', '9', 0),
(283, '2000', ' b2ce7609d7.jpg', 48, 'Tôm càng xanh', '5pmlvpjt18q7dtum74pfhccb04', '1', '8', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_huyen`
--

CREATE TABLE `da_huyen` (
  `huyenID` int(11) NOT NULL,
  `TenHuyen` varchar(256) NOT NULL,
  `tinhID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_huyen`
--

INSERT INTO `da_huyen` (`huyenID`, `TenHuyen`, `tinhID`) VALUES
(1, 'Tp.Mỹ Tho', 63),
(2, 'TX.Cai Lậy', 63),
(3, 'TX.Gò Công', 63),
(4, 'Cái Bè', 63),
(5, 'Gò Công Tây', 63),
(6, 'Gò Công Đông', 63),
(7, 'Chợ Gạo', 63),
(8, 'Châu Thành', 63),
(9, 'Tân Phước', 63),
(10, 'Cai Lậy', 63),
(11, 'Tân Phú Đông', 63),
(12, 'Bình Đại', 71),
(13, 'Châu Thành', 71),
(14, 'Giồng Trôm', 71),
(15, 'Ba Tri', 71),
(16, 'Chợ Lách', 71),
(17, 'Mỏ Cày Nam', 71),
(18, 'Mỏ Cày Bắc', 71),
(19, 'Thạnh Phú', 71),
(20, 'TP.Bến Tre', 71),
(21, 'TP.Tân An', 62),
(22, 'Bến Lức', 62),
(23, 'Cần Đước', 62),
(24, 'Cần Giuộc', 62),
(25, 'Châu Thành', 62),
(26, 'Đức Hòa', 62),
(27, 'Đức Huệ', 62),
(28, 'Mộc Hóa', 62),
(29, 'Tân Trụ', 62),
(30, 'Thủ Thừa', 62);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_loginuser`
--

CREATE TABLE `da_loginuser` (
  `cusID` int(11) NOT NULL,
  `cusName` varchar(200) NOT NULL,
  `cusDiaChi` varchar(200) NOT NULL,
  `tinhID` int(11) NOT NULL,
  `huyenID` int(11) NOT NULL,
  `cusSDT` varchar(30) NOT NULL,
  `cusEmail` varchar(50) NOT NULL,
  `cusPass` varchar(200) NOT NULL,
  `points` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_loginuser`
--

INSERT INTO `da_loginuser` (`cusID`, `cusName`, `cusDiaChi`, `tinhID`, `huyenID`, `cusSDT`, `cusEmail`, `cusPass`, `points`) VALUES
(13, 'Lê Thị Yến Nhi', ' ấp bình', 63, 8, '0925506435', 'thainhi0701@gmail.com', '2440a3ee3542a64762a9ca58d6b54782', 0),
(14, 'Lê Gia Hân', ' ấp bình', 63, 11, '0786953863', 'giahan@gmail.com', 'f7791c2a353773f037360cd570c8a6d3', 600);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_phanloaitp`
--

CREATE TABLE `da_phanloaitp` (
  `PhanLoaiTPID` int(11) NOT NULL,
  `PhanLoaiTPName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_phanloaitp`
--

INSERT INTO `da_phanloaitp` (`PhanLoaiTPID`, `PhanLoaiTPName`) VALUES
(7, 'Trái cây'),
(15, 'Rau hữu cơ'),
(16, 'Đồ lạnh'),
(17, 'Tươi sống'),
(18, 'Các loại Thịt');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_thanhpho`
--

CREATE TABLE `da_thanhpho` (
  `tinhID` int(11) NOT NULL,
  `tenTinh` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_thanhpho`
--

INSERT INTO `da_thanhpho` (`tinhID`, `tenTinh`) VALUES
(11, 'cao Bằng'),
(12, 'Lạng Sơn'),
(14, 'Quảng Ninh'),
(15, 'Hải Phòng'),
(17, 'Thái Bình'),
(18, 'Nam Định'),
(19, 'Phú Thọ'),
(20, 'Thái Nguyên'),
(21, 'Yên Bái'),
(22, 'Tuyên Quang'),
(23, 'Hà Giang'),
(24, 'Lào Cai'),
(25, 'Lai Châu'),
(26, 'Sơn La'),
(27, 'Điện Biên'),
(28, 'Hòa Bình'),
(29, 'Hà Nội'),
(34, 'Hải Dương'),
(35, 'Ninh Bình'),
(36, 'Thanh Hóa'),
(37, 'Nghệ An'),
(38, 'Hà Tĩnh'),
(39, 'Đồng Nai'),
(43, 'Đà Nẵng'),
(47, 'Đắk Lắk'),
(48, 'Đắk Nông'),
(49, 'Lâm Đồng'),
(51, 'TP Hồ Chí Minh'),
(61, 'Bình Dương'),
(62, 'Long An'),
(63, 'Tiền Giang'),
(64, 'Vĩnh Long'),
(65, 'Cần Thơ'),
(66, 'Đồng Tháp'),
(67, 'An Giang'),
(68, 'Kiên Giang'),
(69, 'Cà Mau'),
(70, 'Tây Ninh'),
(71, 'Bến Tre');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `da_themsile`
--

CREATE TABLE `da_themsile` (
  `sileID` int(11) NOT NULL,
  `sileImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `da_themsile`
--

INSERT INTO `da_themsile` (`sileID`, `sileImg`) VALUES
(3, '31e17e8c0d.jpg'),
(8, 'b08a6deff5.jpg'),
(10, '8ab8da59a3.png'),
(11, 'b94f4c9d44.png'),
(12, '8f45ece2cd.png'),
(13, '18d1695477.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `ten` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ghichu` text NOT NULL,
  `thoigiantao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `ten`, `email`, `ghichu`, `thoigiantao`) VALUES
(4, 'Mỹ Tiên', 'ngothimytien14072003@gmail.com', 'Bạn có thể bán thêm món sandwich không', '2024-05-08 17:50:28'),
(6, 'Yến Nhi', 'thainhi0701@gmail.com', 'tôi cần có thêm nhiều loại lựa chọn hơn như là bánh trái', '2024-05-08 20:36:01'),
(7, 'Yến Nhi', 'thainhi0701@gmail.com', 'mô tả', '2024-05-09 02:19:51'),
(8, 'Yến Nhi', 'thainhi0701@gmail.com', 'tôi cần thêm nhiều sản phẩm hơn', '2024-05-23 12:52:31');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `da_admin`
--
ALTER TABLE `da_admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Chỉ mục cho bảng `da_chitiettp`
--
ALTER TABLE `da_chitiettp`
  ADD PRIMARY KEY (`ChiTietID`);

--
-- Chỉ mục cho bảng `da_dathang`
--
ALTER TABLE `da_dathang`
  ADD PRIMARY KEY (`dathangID`);

--
-- Chỉ mục cho bảng `da_dmcon`
--
ALTER TABLE `da_dmcon`
  ADD PRIMARY KEY (`DMID`),
  ADD KEY `id_pltp` (`PhanLoaiTPID`);

--
-- Chỉ mục cho bảng `da_donhangdadat`
--
ALTER TABLE `da_donhangdadat`
  ADD PRIMARY KEY (`id_donhangdadat`);

--
-- Chỉ mục cho bảng `da_giohang`
--
ALTER TABLE `da_giohang`
  ADD PRIMARY KEY (`ghID`);

--
-- Chỉ mục cho bảng `da_huyen`
--
ALTER TABLE `da_huyen`
  ADD PRIMARY KEY (`huyenID`),
  ADD KEY `idhuen` (`tinhID`);

--
-- Chỉ mục cho bảng `da_loginuser`
--
ALTER TABLE `da_loginuser`
  ADD PRIMARY KEY (`cusID`);

--
-- Chỉ mục cho bảng `da_phanloaitp`
--
ALTER TABLE `da_phanloaitp`
  ADD PRIMARY KEY (`PhanLoaiTPID`),
  ADD KEY `machuong` (`PhanLoaiTPID`);

--
-- Chỉ mục cho bảng `da_thanhpho`
--
ALTER TABLE `da_thanhpho`
  ADD PRIMARY KEY (`tinhID`),
  ADD KEY `id_tinhid` (`tinhID`);

--
-- Chỉ mục cho bảng `da_themsile`
--
ALTER TABLE `da_themsile`
  ADD PRIMARY KEY (`sileID`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `da_admin`
--
ALTER TABLE `da_admin`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `da_chitiettp`
--
ALTER TABLE `da_chitiettp`
  MODIFY `ChiTietID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `da_dathang`
--
ALTER TABLE `da_dathang`
  MODIFY `dathangID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT cho bảng `da_dmcon`
--
ALTER TABLE `da_dmcon`
  MODIFY `DMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `da_donhangdadat`
--
ALTER TABLE `da_donhangdadat`
  MODIFY `id_donhangdadat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `da_giohang`
--
ALTER TABLE `da_giohang`
  MODIFY `ghID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=284;

--
-- AUTO_INCREMENT cho bảng `da_huyen`
--
ALTER TABLE `da_huyen`
  MODIFY `huyenID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `da_loginuser`
--
ALTER TABLE `da_loginuser`
  MODIFY `cusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `da_phanloaitp`
--
ALTER TABLE `da_phanloaitp`
  MODIFY `PhanLoaiTPID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `da_themsile`
--
ALTER TABLE `da_themsile`
  MODIFY `sileID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `da_huyen`
--
ALTER TABLE `da_huyen`
  ADD CONSTRAINT `da_huyen_ibfk_1` FOREIGN KEY (`tinhID`) REFERENCES `da_thanhpho` (`tinhID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
