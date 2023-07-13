-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: sql210.byetcluster.com
-- Thời gian đã tạo: Th7 11, 2023 lúc 10:42 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `b12_34506519_php01`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bills`
--

CREATE TABLE `bills` (
  `idBill` int(11) NOT NULL,
  `idUser` varchar(20) DEFAULT NULL,
  `idProduct` int(11) DEFAULT NULL,
  `dateBuy` date DEFAULT NULL,
  `countProduct` varchar(200) DEFAULT NULL,
  `totalProduct` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `bills`
--

INSERT INTO `bills` (`idBill`, `idUser`, `idProduct`, `dateBuy`, `countProduct`, `totalProduct`) VALUES
(2, 'dfast17', 2, '2023-05-04', '2', '1600'),
(3, 'dfast17', 1, '2023-05-04', '1', '800'),
(4, 'dfast171', 21, '2023-05-04', '1', '1435'),
(5, 'dfast173', 22, '2023-06-05', '3', '5886'),
(6, 'dfast171', 12, '2023-06-05', '4', '5740'),
(7, 'dfast172', 32, '2023-06-06', '1', '4377'),
(8, 'dfast171', 12, '2023-06-06', '4', '5740'),
(9, 'dfast173', 22, '2023-06-06', '3', '5886'),
(10, 'dfast17', 42, '2023-06-07', '1', '800'),
(11, 'dfast171', 52, '2023-06-07', '4', '5740'),
(12, 'dfast171', 21, '2023-06-07', '2', '2870'),
(13, 'dfast173', 31, '2023-06-07', '3', '5886'),
(14, 'dfast173', 41, '2023-06-07', '1', '1962'),
(15, 'dfast173', 51, '2023-06-07', '1', '1962'),
(17, 'dfast171', 41, '2023-06-09', '1', '1435'),
(18, 'dfast17', 42, '2023-06-09', '1', '800'),
(19, 'dfast172', 43, '2023-06-10', '1', '4377'),
(20, 'dfast173', 44, '2023-06-10', '1', '1962'),
(21, 'dfast173', 45, '2023-06-11', '3', '5886'),
(22, 'dfast17', 46, '2023-06-11', '1', '800'),
(23, 'dfast172', 47, '2023-06-12', '2', '8754'),
(24, 'dfast173', 42, '2023-06-12', '4', '7848'),
(25, 'dfast17', 43, '2023-06-13', '1', '800'),
(26, 'dfast17', 41, '2023-06-13', '3', '2400'),
(28, 'dfast171', 51, '2023-06-13', '2', '2870'),
(29, 'dfast17', 50, '2023-06-13', '3', '2400'),
(30, 'dfast172', 52, '2023-06-13', '3', '13131'),
(31, 'dfast173', 53, '2023-06-13', '1', '1962'),
(32, 'dfast17', 54, '2023-06-13', '4', '3200'),
(33, 'dfast173', 51, '2023-06-13', '3', '5886'),
(34, 'dfast171', 51, '2023-06-13', '1', '1435'),
(35, 'dfast171', 55, '2023-06-13', '2', '2870'),
(36, 'dfast17', 2, '2023-06-17', '1', '1435'),
(37, 'dfast17', 3, '2023-06-17', '2', '8754'),
(38, 'dfast171', 49, '2023-06-17', '1', '47'),
(39, 'dfast171', 62, '2023-06-17', '1', '213'),
(40, 'dfast171', 60, '2023-06-17', '1', '810'),
(41, 'dfast171', 47, '2023-06-17', '1', '48'),
(42, 'dfast171', 51, '2023-06-17', '1', '2217'),
(43, 'dfast171', 3, '2023-06-17', '1', '4377'),
(44, 'dfast172', 47, '2023-06-17', '2', '96'),
(45, 'dfast172', 48, '2023-06-17', '1', '36'),
(46, 'dfast172', 11, '2023-06-17', '1', '1551'),
(47, 'dfast172', 52, '2023-06-17', '1', '315'),
(48, 'dfast172', 55, '2023-06-17', '1', '341');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `idCart` int(11) NOT NULL,
  `idUser` varchar(20) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `countProduct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`idCart`, `idUser`, `idProduct`, `countProduct`) VALUES
(71, 'dfast17', 7, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comments`
--

CREATE TABLE `comments` (
  `idComment` int(255) NOT NULL,
  `commentValue` varchar(1000) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `idUser` varchar(20) NOT NULL,
  `dateComment` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comments`
--

INSERT INTO `comments` (`idComment`, `commentValue`, `idProduct`, `idUser`, `dateComment`) VALUES
(1, 'comment value 1', 1, 'username1', '2023-06-06'),
(2, 'comment value', 2, 'dfast17', '2023-06-05'),
(3, 'comment value', 23, 'dfast171', '2023-06-05'),
(4, 'comment value', 21, 'dfast171', '2023-06-05'),
(5, 'comment value', 10, 'dfast17', '2023-06-05'),
(6, 'comment value', 12, 'dfast172', '2023-06-05'),
(7, 'comment value', 7, 'dfast173', '2023-06-05'),
(8, 'comment value', 30, 'dfast171', '2023-06-05'),
(9, 'comment value', 50, 'dfast173', '2023-06-05'),
(10, 'comment value', 44, 'dfast172', '2023-06-05'),
(11, 'comment value', 29, 'dfast17', '2023-05-05'),
(12, 'comment value', 24, 'dfast171', '2023-04-05'),
(13, 'comment value', 2, 'dfast171', '2023-05-05'),
(14, 'comment value', 10, 'dfast17', '2023-05-05'),
(15, 'comment value', 42, 'dfast172', '2023-06-04'),
(16, 'comment value', 7, 'dfast173', '2023-06-05'),
(17, 'comment value', 60, 'dfast171', '2023-06-03'),
(18, 'comment value', 10, 'dfast173', '2023-06-01'),
(19, 'comment value', 34, 'dfast172', '2023-06-01'),
(20, 'goods', 1, 'dfast17', '2023-06-12'),
(21, 'test comment 02', 1, 'dfast17', '2023-06-13'),
(22, 'tesst', 62, 'dfast17', '2023-06-14'),
(23, 'ádg', 2, 'dfast17', '2023-06-14'),
(24, 'test', 51, 'dfast17', '2023-06-21'),
(25, 'a', 2, 'dfast17', '2023-06-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `harddrive`
--

CREATE TABLE `harddrive` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `connectionprotocol` varchar(500) CHARACTER SET latin1 NOT NULL,
  `capacitylevels` varchar(500) CHARACTER SET latin1 NOT NULL,
  `size` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `harddrive`
--

INSERT INTO `harddrive` (`id`, `idProduct`, `connectionprotocol`, `capacitylevels`, `size`) VALUES
(1, 62, 'PCIe Gen 4 x4', '1TB', 'M.2 2280'),
(2, 63, 'PCIe Gen 4 x4', '2TB', 'M.2 2280'),
(3, 64, 'PCIe Gen 4 x4', '512GB', 'M.2 2280');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `keyboard`
--

CREATE TABLE `keyboard` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `layout` varchar(255) CHARACTER SET latin1 NOT NULL,
  `connection` varchar(255) CHARACTER SET latin1 NOT NULL,
  `switch` varchar(500) CHARACTER SET latin1 NOT NULL,
  `keyboardmaterial` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `keyboard`
--

INSERT INTO `keyboard` (`id`, `idProduct`, `layout`, `connection`, `switch`, `keyboardmaterial`) VALUES
(1, 41, '61 phím', 'USB Type-C', 'Cherry switch', 'PBT + Thermal sublimation'),
(2, 42, '61 phím', 'Bluetooth và có th? dùng ? ch? ?? có dây', 'Kailh s?n xu?t riêng cho DareU', 'PBT'),
(3, 43, 'TKL nh? g?n', 'TYPE-C', 'Cherry MX', 'PBT'),
(4, 44, '102 phím', 'Bluetooth 5.0 + 2.4Ghz + Type-C', 'Red Linear CIY Customized Switches', 'PBT'),
(5, 45, '61 phím', 'USB Type-C,Bluetooth5.0 và Wireless 2.4G.', 'Conten switch ( Blue )', 'PBT'),
(6, 46, 'full size', 'USB 2.0', 'Mechanical-like plunger switches', 'PBT'),
(7, 47, 'full size', 'USB 2.0', 'Kailh Blue', 'Matte coating keycaps');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `laptop`
--

CREATE TABLE `laptop` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `cpu` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `ram` varchar(255) CHARACTER SET latin1 NOT NULL,
  `maxram` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `storage` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `os` varchar(500) CHARACTER SET latin1 NOT NULL,
  `resolution` varchar(500) CHARACTER SET latin1 NOT NULL,
  `sizeInch` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `laptop`
--

INSERT INTO `laptop` (`id`, `idProduct`, `cpu`, `ram`, `maxram`, `storage`, `os`, `resolution`, `sizeInch`) VALUES
(1, 1, 'AMD Ryzen 7 5000 Series', '16 GB', '64', '512GB', 'Windows 11 Home', '1920x1080', 15.6),
(2, 2, 'Intel Core i7', '16 GB', '64', '512GB', 'Windows 11 Home', '1920x1080', 17.3),
(3, 3, 'Intel Core i7', '16 GB', '', '1TB', 'Windows 11 Home', '1920x1080', 15.6),
(4, 4, 'Intel Core i7', '16 GB', '64', '1TB', 'Windows 11 Home', '1920x1080', 17.3),
(5, 5, 'Intel Core i5', '16 GB', '', '512GB', 'Windows 11 home', '', 15.6),
(6, 6, 'Intel Core i7', '16 GB', '', '1024GB', 'Windows 11 Home', '', 15.6),
(7, 7, 'AMD Ryzen 7 5000 Series', '16 GB', '32', '1TB', 'Windows 11 Home', '1920x1080', 16.1),
(8, 8, 'Intel 11th Generation Core i7', '16 GB', '', '512GB', 'Windows 11 Home', '2256x1504', 13.5),
(9, 9, 'Intel 10th Generation Core i7', '32 GB', '', '512GB', 'Windows 10 Home', '3240x2160', 15),
(10, 10, 'Intel Core i7', '16 GB', '32', '1TB', 'Windows 10', '1920x1080', 15.6),
(11, 11, 'Intel Core i5', '16 GB', '32', '512GB', 'Windows 11 Home', '1920x1080', 15.6),
(12, 12, 'Intel® Core™ i7', '16 GB', '48', '512GB', 'Windows 11 Pro', '1920x1080', 14),
(13, 13, 'AMD Ryzen 5', '8 GB', '16', '256GB', 'Windows 10 Pro', '1920x1080', 15.6),
(14, 14, 'AMD Ryzen 7 6000 Series', '16 GB', '', '512GB', 'Windows 10 Pro', '1920x1200', 16),
(15, 15, 'Intel 12th Generation Core i7', '16 GB', '', '512GB', 'Windows 11 Home', '2240x1400', 14),
(16, 16, 'Intel Core i7', '16 GB', '', '1TB', 'Windows 11 Home', '2880x1800', 13.3),
(17, 17, 'Intel Core i9', '64 GB', '', '2GB', 'Windows 10', '', 17.3),
(18, 18, 'Intel Core i9', '32 GB', '', '1TB', 'Windows 11 Home', '2560x1600', 16),
(19, 19, 'AMD Ryzen 7', '16 GB', '', '512GB', 'Windows 10', '1920x1080', 15.6),
(20, 20, 'AMD Ryzen 7', '16 GB', '', '1TB', 'Windows 11 Home', '2560x1440', 16.1),
(21, 21, 'Intel Core i7', '32 GB', '32', '1512GB', 'Windows 10', '1920x1080', 17.3),
(22, 22, 'Intel 11th Generation Core i7 Evo Platform', '16 GB', '', '512GB', 'Windows 11 Home', '3840x2160', 13.3),
(23, 23, 'Intel Core i5', '8 GB', '32', '256GB', 'Windows 10 Pro', '1920x1080', 15.6),
(24, 24, 'Intel Core i7', '16 GB', '64', '1TB', 'Windows 11 Home', '1920x1080', 17.3),
(25, 25, 'Intel 10th Generation Core i7', '8 GB', '', '512GB', 'Windows 10', '1920x1080', 15.6),
(26, 26, 'Apple M1 Pro', '16 GB', '', '512GB', 'macOS Monterey 12', '3024x1964', 14.2),
(27, 27, 'Intel Core i7', '16 GB', '', '512GB', 'Windows', '', 14),
(28, 28, 'Intel 8th Generation Core i7', '16 GB', '', '512GB', 'Windows 10 Pro', '3840x2160', 13.3),
(29, 29, 'Intel 13th Generation Core i9', '16 GB', '32', '1TB', 'Windows 11 Home', '2560x1440', 16),
(30, 30, 'Intel Core i7', '16 GB', '16', '512GB', 'Windows 11 Home', '1920x1080', 17.3),
(31, 31, 'Intel 12th Generation Core i9', '32 GB', '', '1TB', 'Windows 11 Home', '1920x1080', 15.6),
(32, 32, 'AMD Ryzen 9 5000 Series', '16 GB', '', '1024GB', 'Windows 11 Home', '3840x2160', 15.6),
(33, 33, 'Intel 8th Generation Core i5', '16 GB', '', '512GB', 'Mac OS', '2560x1600', 13.3),
(34, 34, 'Intel 12th Generation Core i7', '16 GB', '64', '1TB', 'Windows 11 Home', '1920x1080', 15.6),
(35, 35, 'AMD Ryzen 7', '16 GB', '64', '512GB', 'Windows 10 Home', '1920x1080', 15.6),
(36, 36, 'Intel Core i7', '16 GB', '16', '512GB', 'Windows', '1920x1200', 13.4),
(37, 37, 'Intel Core i9', '16 GB', '32', '512GB', 'Windows 11 Home', '1920x1080', 15.6),
(38, 38, 'Intel Core i9', '32 GB', '32', '1TB', 'Windows 11 Home', '2560x1600', 16),
(39, 39, 'Intel Core i7', '16 GB', '', '512GB', 'Windows 10 Home', '2560x1600', 16),
(40, 40, 'Intel Core i7', '16 GB', '', '1TB', 'Windows 11 Home', '2560x1440', 17.3);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monitor`
--

CREATE TABLE `monitor` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `resolution` varchar(255) CHARACTER SET latin1 NOT NULL,
  `sizeInch` float NOT NULL,
  `scanfrequency` varchar(255) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `monitor`
--

INSERT INTO `monitor` (`id`, `idProduct`, `resolution`, `sizeInch`, `scanfrequency`) VALUES
(1, 50, '1920 x 1080', 24, '75 hz'),
(2, 51, '5120 x 1440', 49, '240 hz'),
(3, 52, '2560 x 1440', 27, '75 hz'),
(4, 53, '2K', 34, '144 hz'),
(5, 54, '1920 x 1080', 27, '165 hz'),
(6, 55, '2560 x 1440', 27, '60 hz');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mouse`
--

CREATE TABLE `mouse` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `dpi` varchar(255) CHARACTER SET latin1 NOT NULL,
  `connection` varchar(255) CHARACTER SET latin1 NOT NULL,
  `switch` varchar(255) CHARACTER SET latin1 NOT NULL,
  `ledlight` varchar(500) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `mouse`
--

INSERT INTO `mouse` (`id`, `idProduct`, `dpi`, `connection`, `switch`, `ledlight`) VALUES
(1, 48, 'Up to 6400 DPI', 'USB 2.0', 'OMRON 20M', 'RGB'),
(2, 49, 'Up to 6200 DPI', 'USB 2.0', 'OMRON 20M', 'Single color');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `nameProduct` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `discount` float DEFAULT NULL,
  `imgProduct` mediumtext NOT NULL,
  `dateAdded` date NOT NULL,
  `des` varchar(2000) NOT NULL,
  `view` int(11) DEFAULT 0,
  `idType` int(11) NOT NULL,
  `brand` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`idProduct`, `nameProduct`, `price`, `discount`, `imgProduct`, `dateAdded`, `des`, `view`, `idType`, `brand`) VALUES
(1, 'Msi Bravo', 800, 0, 'https://asset.msi.com/resize/image/global/product/product_162175108621129650150f18f256a57cdb5001e680.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 36, 1, 'msi'),
(2, 'Msi Katana GF76', 1435, 0, 'https://asset.msi.com/resize/image/global/product/product_16190861968258ba21f10ef2500b64c8d57c0d1b1b.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 137, 1, 'msi'),
(3, 'Msi Raider GE67', 4377, 0, 'https://asset.msi.com/resize/image/global/product/product_165206346972b3177230787d73a75770296820b96a.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 25, 1, 'msi'),
(4, 'Msi Katana 15 B13V ', 1962, 0, 'https://asset.msi.com/resize/image/global/product/product_16681474672e22620f836c3d7ce248a04b704a3210.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 11, 1, 'msi'),
(5, 'Acer Nitro 5', 1335, 0, 'https://images.acer.com/is/image/acer/Nitro-5-AN517-53-Bl1-01a?$Series-Component-M1-M2-S$', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 12, 1, 'acer'),
(6, 'Msi GE75 Raider', 1960, 0, 'https://asset.msi.com/resize/image/global/product/product_1668757206d622a2119ca82ce7b6184af7c1f3443d.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 23, 1, 'msi'),
(7, 'Hp omen', 1480, 0, 'https://www.hp.com/content/dam/sites/worldwide/personal-computers/consumer/gaming/gaming-gateway/22C1_Omen_Hendricks_16_60w_Numpad_1-Zone_ShadowBlack_NT_HDcam_nonODD_nonFPR_Freedos_CoreSet_Front.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'hp'),
(8, 'Microsoft Surface 4', 1400, 0, 'https://c.s-microsoft.com/en-us/CMSImages/Surface_Home_DeviceShowcase_F22JB_Color_V1.png?version=9b651b37-60b1-ec15-4e0a-9fcc0ce69762', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'microsoft'),
(9, 'Microsoft Surface Book 3', 2520, 0, 'https://static.wixstatic.com/media/cbdb35_b3187d3e7f874e17ab023c479bf139e4~mv2.png/v1/fill/w_241,h_241,al_c,lg_1,q_85,enc_auto/surface%20book%203%20screen%20repair.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 15, 1, 'microsoft'),
(10, 'Asus ROG G512LW-HN118T', 1202, 0, 'https://www.asus.com/media/Odin/Websites/vn/ProductLine/20220507094848/P_setting_xxx_0_90_end_185.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(11, 'Asus TUF Dash F15', 1551, 0, 'https://dlcdnwebimgs.asus.com/gain/7e253a39-8b45-47cd-83d0-208eef4756af/w185', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(12, 'Lenovo ThinkPad T14', 1840, 0, 'https://www.lenovo.com/medias/lenovo-laptops-thinkpad-t14s-gen-3-14-intel-gallery-1.png?context=bWFzdGVyfHJvb3R8NjU4NDMxfGltYWdlL3BuZ3xoOGIvaGU5LzEzNzEyNjQzNjUzNjYyLnBuZ3wzODQ0YWEzZjA5ODA1YzA3NjAwNTM3ZjJhNTdlZjc3MzAyZmYzMWM5ZmY2MWY2ZDA0OTM2NjE2NzcxNTA4ODky', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'lenovo'),
(13, 'Dell Vostro 3525', 924, 0, 'https://product.hstatic.net/200000019898/product/dv3520nt-cnb-00000ff090-gy-paint_83c69fabb083406eb1ae7235d42c5761_master.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'dell'),
(14, 'Lenovo ThinkPad Z16', 2055, 0, 'https://p1-ofp.static.pub/fes/cms/2022/04/29/65kfbwvftiqkgti1q6l4pixnh1fig3043050.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 11, 1, 'lenovo'),
(15, 'Acer Swift X SFX14', 1200, 0, 'https://images.acer.com/is/image/acer/acer-swift-x-14-sfx14-71g-fingerprint-backlit-wallpaper-steel-gray-01-1?$Series-Component-M1-M2-S$', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'acer'),
(16, 'Asus ZenBook S13', 1964, 0, 'https://dlcdnwebimgs.asus.com/gain/76609e36-47ce-47fb-8d44-af8b1b3804a0/w185', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(17, 'Msi Stealth GS77', 4364, 0, 'https://asset.msi.com/resize/image/global/product/product_1650005024261a1da4b5a02c3a5d2e53f259c2fab5.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 19, 1, 'msi'),
(18, 'ROG Zephyrus M16', 1177, 0, 'https://dlcdnwebimgs.asus.com/gain/BC25DC21-BEC8-4D72-984C-CF2568F859BD/w185/fwebp', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(19, 'HP Omen 15', 1530, 0, 'https://www.hp.com/content/dam/sites/worldwide/personal-computers/consumer/gaming/gaming-gateway/Omen%2015%20intel1.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'hp'),
(20, 'HP Victus 5800H', 1647, 0, 'https://www.hp.com/content/dam/sites/omen/worldwide/laptops/2022-victus-15-intel/Hero%20Image%203.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'hp'),
(21, 'Acer Nitro 5 Gaming 2020', 1611, 0, 'https://images.acer.com/is/image/acer/Nitro-5-AN517-41-Bl1-RGB-01a?$Series-Component-M1-M2-S$', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'acer'),
(22, 'Dell Inspiron 2020', 1190, 0, 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/page/franchise/inspiron/inspiron-15-3520-sl-800x550.png?fmt=png-alpha&wid=800&hei=550', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'dell'),
(23, 'Dell Latitude 3520', 950, 0, 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/vostro-notebooks/vostro-14-3420/spi/ng/notebook-vostro-14-3420-800x550.png?fmt=png-alpha&wid=800&hei=550', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'dell'),
(24, 'Msi Gaming GP76 Leopard', 3037, 0, 'https://asset.msi.com/resize/image/global/product/product_1619491076f2b732f6ac2a3c1b40d81faf279c94b6.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 18, 1, 'msi'),
(25, 'Msi GF65 THIN', 1114, 0, 'https://asset.msi.com/resize/image/global/product/product_16703914683041cca9a1f044dbea5916ac8b8f4178.png62405b38c58fe0f07fcef2367d8a9ba1/400.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'msi'),
(26, 'Apple Macbook Pro', 1599, 0, 'https://www.apple.com/v/macbook-pro/ah/images/overview/compare/compare_mbp14__f17pgqjk7syi_large.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'apple'),
(27, 'Lenovo ThinkPad X1 Yoga G7', 2748, 0, 'https://p2-ofp.static.pub/fes/cms/2021/12/06/unvilqz9ei8c22vr6lo6p43xrgpg4t960588.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 15, 1, 'lenovo'),
(28, 'Asus ZenBook S UX391FA', 1500, 0, 'https://dlcdnwebimgs.asus.com/gain/b6697d59-4b39-4ae6-a75b-75095348495e/w800', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(29, 'Asus ROG Zephyrus 16 QHD', 1950, 0, 'https://dlcdnwebimgs.asus.com/gain/39E67767-AA86-46FC-BC54-6025F73EC823/w185/fwebp', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(30, 'Lenovo Legion 5', 1390, 0, 'https://www.lenovo.com/medias/lenovo-laptop-legion-5i-pro-16-intel-homepage-thumb.png?context=bWFzdGVyfHJvb3R8NjI2MzZ8aW1hZ2UvcG5nfGg4Mi9oNjEvMTQxOTA1NTQ5NzIxOTAucG5nfGU2NmQ1NjhlNTJkMmM3YzAyMjNkZTMzNWNhMzBjZmJjYmQ3NjBmZjJhZDkyMGJlNDNhMzY4MTM2YzE1YWU3ZGU', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 11, 1, 'lenovo'),
(31, 'Alienware x15 R2', 2800, 0, 'https://i.dell.com/is/image/DellContent/content/dam/ss2/product-images/dell-client-products/notebooks/alienware-notebooks/alienware-x15-r2/media-gallery/laptop-alienware-x15-r2-nonlit-touchpad-gallery-3.psd?fmt=png-alpha&pscan=auto&scl=1&hei=402&wid=402&qlt=100,1&resMode=sharp2&size=402,402&chrss=full', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 15, 1, 'dell'),
(32, 'Lenovo Legion Slim 7', 1440, 0, 'https://www.lenovo.com/medias/lenovo-laptop-gaming-legion-slim-7-15in-amd-thumb-front%20(1).png?context=bWFzdGVyfHJvb3R8NjMzMjJ8aW1hZ2UvcG5nfGgyOC9oMTEvMTQ1MjQ2OTY1MjY4NzgucG5nfDRlYjQwN2EwNmVkMWQ5ZDhlN2RmNjgxMDVkNzYzM2Y2NjZmNGU2NWYxYWZjNWViMmNmYWYyYjU4NTE2MDZlODU', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'lenovo'),
(33, 'Apple Macbook Air', 1360, 0, 'https://www.apple.com/v/macbook-air/o/images/overview/compare/compare_mba_m2__eyi7f28aeg02_large.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'apple'),
(34, 'MSI Sword', 1000, 0, 'https://asset.msi.com/resize/image/global/product/product_16666861201c8f960a89df17789326fab5cbc1a654.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 11, 1, 'msi'),
(35, 'Msi Alpha 15 B5eek-009NL', 1236, 0, 'https://asset.msi.com/resize/image/global/product/product_162390210472f45b57b27e100f768553bb3997eee9.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'msi'),
(36, 'Asus ROG FLOW Z13 GZ301ZC-LD092W', 2047, 0, 'https://dlcdnwebimgs.asus.com/gain/8CA92122-BD8B-4A7C-A4FB-933DFFAFB7A3/w185/fwebp', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'asus'),
(37, 'Acer Predator Helios 300', 1724, 0, 'https://www.acervietnam.com.vn/wp-content/uploads/2021/08/predator-helios-300-ph315-55-4zone-backlit-on-wallpaper-logo-black-01-min-1536x1234.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'acer'),
(38, 'Acer Predator Triton 500 SE', 3341, 0, 'https://www.acervietnam.com.vn/wp-content/uploads/2021/06/predator-triton-500-se-pt516-52s-fingerprint-3zone-backlit-on-wallpaper-logo-steel-gray-02-min-1536x1019.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 18, 1, 'acer'),
(39, 'Acer Predator Gaming 16', 2247, 0, 'https://www.acervietnam.com.vn/wp-content/uploads/2023/01/ST_16_02.png-custom-min-1536x1536.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 10, 1, 'acer'),
(40, 'Razer Blade 17 RZ09-0423N*C3', 3772, 0, 'https://assets3.razerzone.com/gfPXwfPok_p0dQx57RPmfwk8YxU=/500x500/https%3A%2F%2Fhybrismediaprod.blob.core.windows.net%2Fsys-master-phoenix-images-container%2Fhc6%2Fh23%2F9481463562270%2Fblade15-ch9-500x500.png', '2023-06-04', 'A laptop is a portable computer that is designed to be used on the go. It typically has a built-in screen, keyboard, and touchpad or trackpad. Laptops come in a variety of sizes and configurations, ranging from lightweight ultrabooks to high-performance gaming laptops. They are powered by rechargeable batteries and can be used for a variety of tasks, such as browsing the web, creating documents, playing games, and more.', 18, 1, 'razer'),
(41, 'Keyboard DAREU A87 DREAM (PBT - Brown - Red CHERRY switch)', 67, 0, 'https://dareu.com.vn/wp-content/uploads/2021/04/ban-phim-co-dareu-a87-dream-02-300x300.png', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 11, 2, 'dareu'),
(42, 'Keyboard bluetooth DAREU EK861 61KEY (PBT - Blue - Brown - Red D-KAILH switch)', 54, 0, 'https://dareu.com.vn/wp-content/uploads/2021/04/ban-phim-co-khong-day-dareu-ek861-01.png', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 28, 2, 'dareu'),
(43, 'Keyboard  DAREU A87 SWALLOW (PBT - Brown - Red CHERRY switch)', 29, 0, 'https://dareu.com.vn/wp-content/uploads/2021/04/ban-phim-co-dareu-a87-swallow-03.png', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 2, 'dareu'),
(44, 'LANGTU LT-L8', 89, 0, 'https://cdn.shopify.com/s/files/1/0533/3719/4668/products/LANGTULT-L8102-KeyTri-MobeConnection100_HotswapRGBLEDBacklitMechanicalGamingKeyboardft.RedLinearCIYCustomizedSwitches_PBTKeycaps04_360x.png?v=1648025312', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 2, 'langtu'),
(45, 'LANGTU G1000', 89, 0, 'https://cdn.shopify.com/s/files/1/0533/3719/4668/products/7bc38404-2b77-43e4-855b-783020d01f1b_360x.png?v=1647250481', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 2, 'langtu'),
(46, 'VIGOR GK50 ELITE KAILH BLUE', 60, 0, 'https://asset.msi.com/resize/image/global/product/product_1605608893eb7e45c5e8b63b0969c8ae9fb338d42a.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 11, 2, 'msi'),
(47, 'VIGOR GK30 WHITE', 48, 0, 'https://asset.msi.com/resize/image/global/product/product_163937693155ac567b66e5d2dea14391f36dd0099c.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A keyboard is an input device that is used to enter text and commands into a computer. It typically has a set of keys arranged in a specific layout, such as QWERTY or AZERTY, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 2, 'msi'),
(48, 'CLUTCH GM20 ELITE', 36, 0, 'https://asset.msi.com/resize/image/global/product/product_8_20200929174953_5f7303417b8fc.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A mouse is an input device that is used to control the movement of the cursor on a computer screen. It typically has two or more buttons and a scroll wheel, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 7, 'msi'),
(49, 'CLUTCH GM30', 47, 0, 'https://asset.msi.com/resize/image/global/product/product_10_20190823060825_5d5f82d927f03.png62405b38c58fe0f07fcef2367d8a9ba1/1024.png', '2023-06-04', 'A mouse is an input device that is used to control the movement of the cursor on a computer screen. It typically has two or more buttons and a scroll wheel, and can be connected to a computer via USB or wirelessly via Bluetooth.', 10, 7, 'msi'),
(50, 'ASUS VZ24EHE 24 IPS 75Hz Monitor', 192, 0, 'https://dlcdnwebimgs.asus.com/gain/d7c8422e-74bb-4701-9f74-5d3510d9ffad/w185/fwebp', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 10, 3, 'asus'),
(51, 'SAMSUNG QLED Curved Monitor LC49G95 49 VA 2K 240Hz Gsync', 2217, 0, 'https://images.samsung.com/is/image/samsung/p6pim/vn/ls49ag950nexxv/gallery/vn-odyssey-neo-g9-g95na-ls49ag950nexxv-thumb-459531782?$252_252_PNG$', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 11, 3, 'samsung'),
(52, 'Lenovo Q27q-20 27 IPS 2K 75Hz', 315, 0, 'https://static.lenovo.com/mea/campaign/newmonitors/images/q-series/Q27h-20/Q27h-20-200.png', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 11, 3, 'lenovo'),
(53, 'GIGABYTE G34WQC A 34 2K 144Hz HDR400 curved gaming monitor', 554, 0, 'https://www.gigabyte.com/FileUpload/Global/KeyFeature/1530/innergigabyteimages/bg1.png', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 10, 3, 'gigabyte'),
(54, 'AOC C27G3 27 VA 165Hz FreeSync gaming monitor', 298, 0, 'https://anphat.com.vn/media/product/41216_c27g3_f.png', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 10, 3, 'aoc'),
(55, 'Dell P2723D 27 IPS 2K . Monitor', 341, 0, 'https://product.hstatic.net/1000026716/product/gearvn-man-hinh-dell-p2723d-27-ips-2k-1_374ec2b87a6e4128a8de44fec63f9445.png', '2023-06-04', ' A monitor is an output device that displays images and text generated by a computer. It typically has a flat screen and can be connected to a computer via HDMI, VGA, or DisplayPort.', 10, 3, 'dell'),
(56, 'GIGABYTE AORUS GeForce RTX 4070 Ti MASTER 12G', 1386, 0, 'https://www.gigabyte.com/FileUpload/Global/KeyFeature/2304/innergigabyteimages/kf-card.png', '2023-06-04', '', 10, 6, 'gigabyte'),
(57, 'MSI GeForce RTX 4070 Ti GAMING X TRIO 12G', 1236, 0, 'https://product.hstatic.net/1000026716/product/z4013982679490_d0b6304871e83edafd2d0d5cbfbf7fff_60e5d549c0ea4b7a9a0af61e3ef99f23.jpg', '2023-06-04', '', 10, 6, 'msi'),
(58, 'ASUS ROG Strix GeForce RTX 4090', 2771, 0, 'https://www.asus.com/media/Odin/Websites/global/SubSeries/global_ROG-Strix/P_setting_xxx_0_90_end_185.png?webp', '2023-06-04', '', 15, 6, 'asus'),
(59, 'RAM G.Skill Trident Z5 RGB 64GB (2x32GB) DDR5', 810, 0, 'https://product.hstatic.net/1000026716/product/new_project__31__5556a24a399d4abab501570e7a05f8a4.png', '2023-06-04', '', 10, 4, 'g.skill'),
(60, 'RAM Corsair Dominator Platinum 64GB (2x32GB) DDR5', 810, 0, 'https://product.hstatic.net/1000026716/product/-cmt32gx5m2x5200c38-gallery-dominator-rgb-platinum-black-ddr5-01_8f962c81064143c68d9313ed53279f53.png', '2023-06-04', '', 10, 4, 'corsair'),
(61, 'RAM Kingston Fury Beast RGB 64GB (2x32GB)', 639, 0, 'https://product.hstatic.net/1000026716/product/ktc-product-memory-beast-ddr5-rgb-kit-of-2-2-lg_4275f28ffd3a486ba26fa3604f3bb163.png', '2023-06-04', '', 10, 4, 'kingston'),
(62, 'SSD GIGABYTE AORUS 1TB M.2 PCIe NVMe gen 4', 213, 0, 'https://static.gigabyte.com/StaticFile/Image/Global/44965a022c146317dbd48ff24b880d32/Product/25700/webp/300', '2023-06-04', '', 12, 5, 'gigabyte'),
(63, 'SSD Kingston KC3000 2TB M.2 PCIe gen 4 NVMe', 511, 0, 'https://bizweb.dktcdn.net/thumb/small/100/329/122/products/ssd-kingston-kc3000-m-2-pcie-gen4-x4-nvme-2tb-skc3000d-2048g-1.png?v=1639379333410', '2023-06-04', '', 10, 5, 'kingston'),
(64, 'Gigabyte SSD AORUS RGB M.2 NVMe 512GB', 85, 0, 'https://product.hstatic.net/1000026716/product/aorus_rgb_ssd_gearvn_a7d64544d02543348ee0a03f75775212.png', '2023-06-04', '', 10, 5, 'gigabyte');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ram`
--

CREATE TABLE `ram` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `capacity` varchar(500) CHARACTER SET latin1 NOT NULL,
  `busram` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `typeram` varchar(500) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ram`
--

INSERT INTO `ram` (`id`, `idProduct`, `capacity`, `busram`, `typeram`) VALUES
(1, 59, '64GB (2x32GB)', '4800 MT/s', 'DDR5'),
(2, 60, '64GB (2x32GB)', '6400MHz - 5600MHz', 'DDR5'),
(3, 61, 'up to 128GB', '4800MT/s - 5200MT/s - 5600MT/s - 6000MT/s', 'DDR5');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `transports`
--

CREATE TABLE `transports` (
  `idTrans` int(11) NOT NULL,
  `idUser` varchar(20) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `countProduct` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` varchar(5000) DEFAULT NULL,
  `costs` varchar(200) DEFAULT NULL,
  `method` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `transports`
--

INSERT INTO `transports` (`idTrans`, `idUser`, `idProduct`, `countProduct`, `status`, `fullName`, `phone`, `address`, `costs`, `method`) VALUES
(1, 'dfast17', 2, 1, 'Đang vận chuyển', 'Đình Phát', '012345678', 'address 1, Huyện Hòa Vang, Thành phố Đà Nẵng', '0', 'Payment on delivery'),
(2, 'dfast17', 3, 2, 'Đang vận chuyển', 'Đình Phát', '012345678', 'address 1, Huyện Hòa Vang, Thành phố Đà Nẵng', '0', 'Payment on delivery'),
(4, 'dfast171', 49, 1, 'Chờ xác nhận', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(5, 'dfast171', 62, 1, 'Chờ xác nhận', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(6, 'dfast171', 60, 1, 'Đang vận chuyển', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(7, 'dfast171', 47, 1, 'Chờ xác nhận', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(8, 'dfast171', 51, 1, 'Chuẩn bị đơn hàng', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(9, 'dfast171', 3, 1, 'Chờ xác nhận', 'Dinh Phat', '123456789', 'address detail 1, Quận Gò Vấp, Thành phố Hồ Chí Minh', '0.85', 'Payment on delivery'),
(11, 'dfast172', 47, 2, 'Đang vận chuyển', 'Phat', '012345678', 'address detail 1, Quận Hoàn Kiếm, Thành phố Hà Nội', '0.85', 'Pay by credit card/visa'),
(12, 'dfast172', 48, 1, 'Chuẩn bị đơn hàng', 'Phat', '012345678', 'address detail 1, Quận Hoàn Kiếm, Thành phố Hà Nội', '0.85', 'Pay by credit card/visa'),
(13, 'dfast172', 11, 1, 'Đang vận chuyển', 'Phat', '012345678', 'address detail 1, Quận Hoàn Kiếm, Thành phố Hà Nội', '0.85', 'Pay by credit card/visa'),
(14, 'dfast172', 52, 1, 'Đang vận chuyển', 'Phat', '012345678', 'address detail 1, Quận Hoàn Kiếm, Thành phố Hà Nội', '0.85', 'Pay by credit card/visa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `type`
--

CREATE TABLE `type` (
  `idType` int(11) NOT NULL,
  `nameType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `type`
--

INSERT INTO `type` (`idType`, `nameType`) VALUES
(1, 'laptop'),
(2, 'keyboard'),
(3, 'display'),
(4, 'ram'),
(5, 'hard-drive'),
(6, 'vga'),
(7, 'mice');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `idUser` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nameUser` varchar(50) NOT NULL,
  `img` varchar(10000) NOT NULL,
  `email` varchar(50) NOT NULL,
  `roleUser` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`idUser`, `password`, `nameUser`, `img`, `email`, `roleUser`) VALUES
('admin', 'adminxshop', 'admin', '', 'adminxshop@gmail.com', 0),
('dfast17', 'dfast1705', 'Phát', 'simple-simple-background-minimalism-black-background-wallpaper-preview-removebg-preview.png', 'dfast17005@gmail.com', 1),
('dfast171', 'dfast17051', 'Phat', '', 'dfast171@gmail.com', 2),
('dfast172', 'dfast17052', 'Phat', '', 'dfast172@gmail.com', 2),
('dfast173', 'dfast17053', 'Phat', '', 'dfast173@gmail.com', 2),
('username1', 'password1', 'User 01', '', 'user01@gmail.com', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `vga`
--

CREATE TABLE `vga` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) NOT NULL,
  `memory` varchar(200) CHARACTER SET latin1 NOT NULL,
  `memoryspeed` varchar(200) CHARACTER SET latin1 NOT NULL,
  `heartbeat` varchar(200) CHARACTER SET latin1 NOT NULL,
  `size` varchar(200) CHARACTER SET latin1 NOT NULL,
  `resolution` varchar(200) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `vga`
--

INSERT INTO `vga` (`id`, `idProduct`, `memory`, `memoryspeed`, `heartbeat`, `size`, `resolution`) VALUES
(1, 56, '12GB GDDR6X', '21 Gbps', '1800 MHz', '312 x 133 x 55 mm', 'Up to 7680 x 4320'),
(2, 57, '12GB GDDR6X', '21 Gbps', '1860 MHz', '312 x 133 x 55 mm', 'Up to 7680 x 4320'),
(3, 58, '24GB GDDR6X', '21 Gbps', '1950 MHz', '313 x 140 x 58 mm', 'Up to 10800 x 7200');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `idProduct` int(11) DEFAULT NULL,
  `idpersonIOX` varchar(200) NOT NULL,
  `dateIOX` date DEFAULT NULL,
  `countProduct` int(11) NOT NULL,
  `statusWare` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `warehouse`
--

INSERT INTO `warehouse` (`id`, `idProduct`, `idpersonIOX`, `dateIOX`, `countProduct`, `statusWare`) VALUES
(1, 1, 'dfast17', '2023-05-01', 60, 'import'),
(2, 2, 'dfast17', '2023-05-01', 60, 'import'),
(3, 3, 'dfast17', '2023-05-01', 60, 'import'),
(4, 4, 'dfast17', '2023-05-01', 60, 'import'),
(5, 5, 'dfast17', '2023-05-01', 60, 'import'),
(6, 6, 'dfast17', '2023-05-01', 60, 'import'),
(7, 7, 'dfast17', '2023-05-01', 60, 'import'),
(8, 8, 'dfast17', '2023-05-01', 60, 'import'),
(9, 9, 'dfast17', '2023-05-01', 60, 'import'),
(10, 10, 'dfast17', '2023-05-01', 60, 'import'),
(11, 11, 'dfast17', '2023-05-01', 60, 'import'),
(12, 12, 'dfast17', '2023-05-01', 60, 'import'),
(13, 13, 'dfast17', '2023-05-01', 60, 'import'),
(14, 14, 'dfast17', '2023-05-01', 60, 'import'),
(15, 15, 'dfast17', '2023-05-01', 60, 'import'),
(16, 16, 'dfast17', '2023-05-01', 60, 'import'),
(17, 17, 'dfast17', '2023-05-01', 60, 'import'),
(18, 18, 'dfast17', '2023-05-01', 60, 'import'),
(19, 19, 'dfast17', '2023-05-01', 60, 'import'),
(20, 20, 'dfast17', '2023-05-01', 60, 'import'),
(21, 21, 'dfast17', '2023-05-01', 60, 'import'),
(22, 22, 'dfast17', '2023-05-01', 60, 'import'),
(23, 23, 'dfast17', '2023-05-01', 60, 'import'),
(24, 24, 'dfast17', '2023-05-01', 60, 'import'),
(25, 25, 'dfast17', '2023-05-01', 60, 'import'),
(26, 26, 'dfast17', '2023-05-01', 60, 'import'),
(27, 27, 'dfast17', '2023-05-01', 60, 'import'),
(28, 28, 'dfast17', '2023-05-01', 60, 'import'),
(29, 29, 'dfast17', '2023-05-01', 60, 'import'),
(30, 30, 'dfast17', '2023-05-01', 60, 'import'),
(31, 31, 'dfast17', '2023-05-01', 60, 'import'),
(32, 32, 'dfast17', '2023-05-01', 60, 'import'),
(33, 33, 'dfast17', '2023-05-01', 60, 'import'),
(34, 34, 'dfast17', '2023-05-01', 60, 'import'),
(35, 35, 'dfast17', '2023-05-01', 60, 'import'),
(36, 36, 'dfast17', '2023-05-01', 60, 'import'),
(37, 37, 'dfast17', '2023-05-01', 60, 'import'),
(38, 38, 'dfast17', '2023-05-01', 60, 'import'),
(39, 39, 'dfast17', '2023-05-01', 60, 'import'),
(40, 40, 'dfast17', '2023-05-01', 60, 'import'),
(41, 41, 'dfast17', '2023-05-01', 60, 'import'),
(42, 42, 'dfast17', '2023-05-01', 60, 'import'),
(43, 43, 'dfast17', '2023-05-01', 60, 'import'),
(44, 44, 'dfast17', '2023-05-01', 60, 'import'),
(45, 45, 'dfast17', '2023-05-01', 60, 'import'),
(46, 46, 'dfast17', '2023-05-01', 60, 'import'),
(47, 47, 'dfast17', '2023-05-01', 60, 'import'),
(48, 48, 'dfast17', '2023-05-01', 60, 'import'),
(49, 49, 'dfast17', '2023-05-01', 60, 'import'),
(50, 50, 'dfast17', '2023-05-01', 60, 'import'),
(51, 51, 'dfast17', '2023-05-01', 60, 'import'),
(52, 52, 'dfast17', '2023-05-01', 60, 'import'),
(53, 53, 'dfast17', '2023-05-01', 60, 'import'),
(54, 54, 'dfast17', '2023-05-01', 60, 'import'),
(55, 55, 'dfast17', '2023-05-01', 60, 'import'),
(56, 56, 'dfast17', '2023-05-01', 60, 'import'),
(57, 57, 'dfast17', '2023-05-01', 60, 'import'),
(58, 58, 'dfast17', '2023-05-01', 60, 'import'),
(59, 59, 'dfast17', '2023-05-01', 60, 'import'),
(60, 60, 'dfast17', '2023-05-01', 60, 'import'),
(61, 61, 'dfast17', '2023-05-01', 60, 'import'),
(62, 62, 'dfast17', '2023-05-01', 60, 'import'),
(63, 63, 'dfast17', '2023-05-01', 60, 'import'),
(64, 64, 'dfast17', '2023-05-01', 60, 'import'),
(65, 1, 'dfast17', '2023-07-07', 10, 'import'),
(66, 11, 'dfast17', '2023-07-07', 2, 'import'),
(67, 21, 'dfast17', '2023-07-07', 7, 'import'),
(68, 31, 'dfast17', '2023-07-07', 5, 'import'),
(69, 41, 'dfast17', '2023-07-07', 8, 'import'),
(70, 2, 'dfast17', '2023-07-07', 9, 'import'),
(71, 15, 'dfast17', '2023-07-07', 5, 'import'),
(72, 51, 'dfast17', '2023-07-07', 2, 'import'),
(73, 44, 'dfast17', '2023-07-07', 10, 'import'),
(74, 1, 'admin', '2023-07-08', 2, 'export'),
(75, 11, 'admin', '2023-07-08', 3, 'export'),
(76, 12, 'admin', '2023-07-08', 3, 'export'),
(77, 13, 'admin', '2023-07-08', 4, 'export'),
(78, 21, 'admin', '2023-07-08', 1, 'export'),
(79, 31, 'admin', '2023-07-08', 1, 'export'),
(80, 5, 'admin', '2023-07-08', 2, 'export'),
(81, 6, 'admin', '2023-07-08', 5, 'export'),
(82, 2, 'admin', '2023-07-08', 7, 'export'),
(83, 3, 'admin', '2023-07-08', 2, 'export');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`idBill`),
  ADD KEY `ma_kh` (`idUser`),
  ADD KEY `ma_hh` (`idProduct`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `ma_kh` (`idUser`),
  ADD KEY `ma_hh` (`idProduct`);

--
-- Chỉ mục cho bảng `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`idComment`),
  ADD KEY `ma_hh` (`idProduct`),
  ADD KEY `ma_kh` (`idUser`);

--
-- Chỉ mục cho bảng `harddrive`
--
ALTER TABLE `harddrive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `keyboard`
--
ALTER TABLE `keyboard`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `monitor`
--
ALTER TABLE `monitor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `mouse`
--
ALTER TABLE `mouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`),
  ADD KEY `IDtYPE` (`idType`) USING BTREE,
  ADD KEY `Brand` (`brand`);

--
-- Chỉ mục cho bảng `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `transports`
--
ALTER TABLE `transports`
  ADD PRIMARY KEY (`idTrans`),
  ADD KEY `ma_kh` (`idUser`),
  ADD KEY `ma_hh` (`idProduct`);

--
-- Chỉ mục cho bảng `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`idType`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- Chỉ mục cho bảng `vga`
--
ALTER TABLE `vga`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`);

--
-- Chỉ mục cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idProduct` (`idProduct`),
  ADD KEY `warehouse_ibfk_2` (`idpersonIOX`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `bills`
--
ALTER TABLE `bills`
  MODIFY `idBill` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT cho bảng `comments`
--
ALTER TABLE `comments`
  MODIFY `idComment` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `harddrive`
--
ALTER TABLE `harddrive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `keyboard`
--
ALTER TABLE `keyboard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `laptop`
--
ALTER TABLE `laptop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `monitor`
--
ALTER TABLE `monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `mouse`
--
ALTER TABLE `mouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT cho bảng `ram`
--
ALTER TABLE `ram`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `transports`
--
ALTER TABLE `transports`
  MODIFY `idTrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `type`
--
ALTER TABLE `type`
  MODIFY `idType` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `vga`
--
ALTER TABLE `vga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `bills_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`);

--
-- Các ràng buộc cho bảng `harddrive`
--
ALTER TABLE `harddrive`
  ADD CONSTRAINT `harddrive_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `keyboard`
--
ALTER TABLE `keyboard`
  ADD CONSTRAINT `keyboard_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `laptop`
--
ALTER TABLE `laptop`
  ADD CONSTRAINT `laptop_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `monitor`
--
ALTER TABLE `monitor`
  ADD CONSTRAINT `monitor_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `mouse`
--
ALTER TABLE `mouse`
  ADD CONSTRAINT `mouse_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`idType`) REFERENCES `type` (`idType`);

--
-- Các ràng buộc cho bảng `ram`
--
ALTER TABLE `ram`
  ADD CONSTRAINT `ram_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `transports`
--
ALTER TABLE `transports`
  ADD CONSTRAINT `transports_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `transports_ibfk_3` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `vga`
--
ALTER TABLE `vga`
  ADD CONSTRAINT `vga_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`);

--
-- Các ràng buộc cho bảng `warehouse`
--
ALTER TABLE `warehouse`
  ADD CONSTRAINT `warehouse_ibfk_1` FOREIGN KEY (`idProduct`) REFERENCES `products` (`idProduct`),
  ADD CONSTRAINT `warehouse_ibfk_2` FOREIGN KEY (`idpersonIOX`) REFERENCES `users` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
