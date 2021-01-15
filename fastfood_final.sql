-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 07, 2021 lúc 05:42 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `fastfood`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
--

CREATE TABLE `binh_luan` (
  `ma_bl` int(11) NOT NULL,
  `ma_tv` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `noidung_bl` text NOT NULL,
  `trang_thai_bl` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `binh_luan`
--

INSERT INTO `binh_luan` (`ma_bl`, `ma_tv`, `ma_sp`, `noidung_bl`, `trang_thai_bl`, `created_at`, `updated_at`) VALUES
(1, 3, 4, 'Tôi thề với chúa là cái Pizza này nó ngon qtqd', 0, '2020-09-28 13:27:28', '2020-10-31 07:28:40'),
(2, 3, 4, 'Tôi nói thiệt đó... Nói dóc làm chó\r\nAhihi.', 0, '2020-09-28 13:38:23', '2020-11-09 10:29:22'),
(3, 4, 6, 'Tôi yêu cái bánh này mất rồi!', 0, '2020-09-28 14:58:47', '2020-10-31 08:07:57'),
(25, 3, 22, 'I am NK', 0, '2020-10-11 06:44:29', '2020-10-11 06:44:29'),
(38, 3, 32, 'Tôi yêu Việt Nam của tôi!', 0, '2020-10-25 13:51:35', '2020-10-31 07:02:19'),
(74, 3, 33, 'I love you!', 0, '2020-10-31 11:32:31', '2020-10-31 11:32:31'),
(76, 4, 27, 'Cái bánh hamburger này có ngon không mọi người?', 0, '2021-01-01 08:45:10', '2021-01-01 08:45:10'),
(80, 5, 33, 'hihi', 1, '2021-01-06 11:24:24', '2021-01-06 11:25:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `ma_dh` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `soluong` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`ma_dh`, `ma_sp`, `soluong`, `created_at`, `updated_at`) VALUES
(75, 22, 1, '2020-11-20 06:47:36', '2020-11-20 06:47:36'),
(75, 19, 1, '2020-11-20 06:47:36', '2020-11-20 06:47:36'),
(75, 15, 1, '2020-11-20 06:47:36', '2020-11-20 06:47:36'),
(76, 32, 1, '2020-11-20 07:36:23', '2020-11-20 07:36:23'),
(76, 23, 1, '2020-11-20 07:36:23', '2020-11-20 07:36:23'),
(76, 24, 1, '2020-11-20 07:36:23', '2020-11-20 07:36:23'),
(84, 33, 2, '2020-11-21 06:57:04', '2020-11-21 06:57:04'),
(84, 28, 1, '2020-11-21 06:57:04', '2020-11-21 06:57:04'),
(85, 23, 2, '2020-11-21 06:58:25', '2020-11-21 06:58:25'),
(85, 24, 3, '2020-11-21 06:58:25', '2020-11-21 06:58:25'),
(86, 29, 1, '2020-11-30 09:02:21', '2020-11-30 09:02:21'),
(87, 29, 1, '2020-11-30 09:09:09', '2020-11-30 09:09:09'),
(93, 33, 1, '2021-01-01 09:10:27', '2021-01-01 09:10:27'),
(93, 23, 1, '2021-01-01 09:10:27', '2021-01-01 09:10:27'),
(93, 24, 1, '2021-01-01 09:10:27', '2021-01-01 09:10:27'),
(94, 23, 3, '2021-01-01 09:17:17', '2021-01-01 09:17:17'),
(95, 28, 1, '2021-01-04 17:52:38', '2021-01-04 17:52:38'),
(95, 30, 1, '2021-01-04 17:52:38', '2021-01-04 17:52:38'),
(95, 25, 1, '2021-01-04 17:52:38', '2021-01-04 17:52:38'),
(106, 28, 4, '2021-01-05 13:54:49', '2021-01-05 13:54:49'),
(107, 33, 1, '2021-01-05 14:00:15', '2021-01-05 14:00:15'),
(107, 32, 1, '2021-01-05 14:00:15', '2021-01-05 14:00:15'),
(107, 31, 1, '2021-01-05 14:00:15', '2021-01-05 14:00:15'),
(108, 30, 1, '2021-01-05 14:04:56', '2021-01-05 14:04:56'),
(108, 29, 1, '2021-01-05 14:04:56', '2021-01-05 14:04:56'),
(108, 26, 1, '2021-01-05 14:04:56', '2021-01-05 14:04:56'),
(109, 17, 1, '2021-01-05 14:06:16', '2021-01-05 14:06:16'),
(109, 16, 2, '2021-01-05 14:06:16', '2021-01-05 14:06:16'),
(109, 18, 1, '2021-01-05 14:06:16', '2021-01-05 14:06:16'),
(110, 33, 3, '2021-01-07 14:56:57', '2021-01-07 14:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_tpdd`
--

CREATE TABLE `chi_tiet_tpdd` (
  `ma_sp` int(11) NOT NULL,
  `ma_tpdd` int(11) NOT NULL,
  `gia_tri` char(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_tpdd`
--

INSERT INTO `chi_tiet_tpdd` (`ma_sp`, `ma_tpdd`, `gia_tri`, `created_at`, `updated_at`) VALUES
(31, 1, '50%', '2020-11-04 14:43:39', '2020-11-04 14:43:39'),
(31, 4, '5%', '2020-11-04 14:43:39', '2020-11-04 14:43:39'),
(31, 5, '1%', '2020-11-04 14:43:39', '2020-11-04 14:43:39'),
(31, 6, '25%', '2020-11-04 14:43:39', '2020-11-04 14:43:39'),
(31, 7, '60%', '2020-11-04 14:43:39', '2020-11-04 14:43:39'),
(30, 1, '15%', '2020-11-04 14:43:45', '2020-11-04 14:43:45'),
(30, 4, '20%', '2020-11-04 14:43:45', '2020-11-04 14:43:45'),
(30, 5, '5%', '2020-11-04 14:43:45', '2020-11-04 14:43:45'),
(30, 6, '30%', '2020-11-04 14:43:45', '2020-11-04 14:43:45'),
(30, 7, '40%', '2020-11-04 14:43:45', '2020-11-04 14:43:45'),
(29, 1, '12%', '2020-11-04 14:43:51', '2020-11-04 14:43:51'),
(29, 4, '16%', '2020-11-04 14:43:51', '2020-11-04 14:43:51'),
(29, 5, '5%', '2020-11-04 14:43:51', '2020-11-04 14:43:51'),
(29, 6, '38%', '2020-11-04 14:43:51', '2020-11-04 14:43:51'),
(29, 7, '60%', '2020-11-04 14:43:51', '2020-11-04 14:43:51'),
(28, 1, '5%', '2020-11-04 14:44:01', '2020-11-04 14:44:01'),
(28, 4, '5%', '2020-11-04 14:44:01', '2020-11-04 14:44:01'),
(28, 5, '3%', '2020-11-04 14:44:01', '2020-11-04 14:44:01'),
(28, 6, '45%', '2020-11-04 14:44:01', '2020-11-04 14:44:01'),
(28, 7, '15%', '2020-11-04 14:44:01', '2020-11-04 14:44:01'),
(27, 1, '35%', '2020-11-04 14:44:10', '2020-11-04 14:44:10'),
(27, 4, '10%', '2020-11-04 14:44:10', '2020-11-04 14:44:10'),
(27, 5, '5%', '2020-11-04 14:44:10', '2020-11-04 14:44:10'),
(27, 6, '25%', '2020-11-04 14:44:10', '2020-11-04 14:44:10'),
(27, 7, '60%', '2020-11-04 14:44:10', '2020-11-04 14:44:10'),
(26, 1, '45%', '2020-11-04 14:44:16', '2020-11-04 14:44:16'),
(26, 4, '35%', '2020-11-04 14:44:16', '2020-11-04 14:44:16'),
(26, 5, '10%', '2020-11-04 14:44:16', '2020-11-04 14:44:16'),
(26, 6, '35%', '2020-11-04 14:44:16', '2020-11-04 14:44:16'),
(26, 7, '55%', '2020-11-04 14:44:16', '2020-11-04 14:44:16'),
(25, 1, '45%', '2020-11-04 14:44:25', '2020-11-04 14:44:25'),
(25, 4, '35%', '2020-11-04 14:44:25', '2020-11-04 14:44:25'),
(25, 5, '9%', '2020-11-04 14:44:25', '2020-11-04 14:44:25'),
(25, 6, '25%', '2020-11-04 14:44:25', '2020-11-04 14:44:25'),
(25, 7, '45%', '2020-11-04 14:44:25', '2020-11-04 14:44:25'),
(24, 1, '45%', '2020-11-04 14:44:39', '2020-11-04 14:44:39'),
(24, 4, '35%', '2020-11-04 14:44:39', '2020-11-04 14:44:39'),
(24, 5, '10%', '2020-11-04 14:44:39', '2020-11-04 14:44:39'),
(24, 6, '15%', '2020-11-04 14:44:39', '2020-11-04 14:44:39'),
(24, 7, '45%', '2020-11-04 14:44:39', '2020-11-04 14:44:39'),
(23, 1, '5%', '2020-11-04 14:44:48', '2020-11-04 14:44:48'),
(23, 4, '6%', '2020-11-04 14:44:48', '2020-11-04 14:44:48'),
(23, 5, '7%', '2020-11-04 14:44:48', '2020-11-04 14:44:48'),
(23, 6, '35%', '2020-11-04 14:44:48', '2020-11-04 14:44:48'),
(23, 7, '35%', '2020-11-04 14:44:48', '2020-11-04 14:44:48'),
(22, 1, '5%', '2020-11-04 14:44:58', '2020-11-04 14:44:58'),
(22, 4, '55', '2020-11-04 14:44:58', '2020-11-04 14:44:58'),
(22, 5, '5%', '2020-11-04 14:44:58', '2020-11-04 14:44:58'),
(22, 6, '25%', '2020-11-04 14:44:58', '2020-11-04 14:44:58'),
(22, 7, '35%', '2020-11-04 14:44:58', '2020-11-04 14:44:58'),
(21, 1, '5%', '2020-11-04 14:45:05', '2020-11-04 14:45:05'),
(21, 4, '5%', '2020-11-04 14:45:05', '2020-11-04 14:45:05'),
(21, 5, '5%', '2020-11-04 14:45:05', '2020-11-04 14:45:05'),
(21, 6, '25%', '2020-11-04 14:45:05', '2020-11-04 14:45:05'),
(21, 7, '25%', '2020-11-04 14:45:05', '2020-11-04 14:45:05'),
(20, 1, '5%', '2020-11-04 14:45:12', '2020-11-04 14:45:12'),
(20, 4, '5%', '2020-11-04 14:45:12', '2020-11-04 14:45:12'),
(20, 5, '5%', '2020-11-04 14:45:12', '2020-11-04 14:45:12'),
(20, 6, '25%', '2020-11-04 14:45:12', '2020-11-04 14:45:12'),
(20, 7, '50%', '2020-11-04 14:45:12', '2020-11-04 14:45:12'),
(19, 1, '5%', '2020-11-04 14:45:43', '2020-11-04 14:45:43'),
(19, 4, '2%', '2020-11-04 14:45:43', '2020-11-04 14:45:43'),
(19, 5, '5%', '2020-11-04 14:45:43', '2020-11-04 14:45:43'),
(19, 6, '35%', '2020-11-04 14:45:43', '2020-11-04 14:45:43'),
(19, 7, '25%', '2020-11-04 14:45:43', '2020-11-04 14:45:43'),
(18, 1, '5%', '2020-11-04 14:45:50', '2020-11-04 14:45:50'),
(18, 4, '5%', '2020-11-04 14:45:50', '2020-11-04 14:45:50'),
(18, 5, '5%', '2020-11-04 14:45:50', '2020-11-04 14:45:50'),
(18, 6, '25%', '2020-11-04 14:45:50', '2020-11-04 14:45:50'),
(18, 7, '25%', '2020-11-04 14:45:50', '2020-11-04 14:45:50'),
(17, 1, '15%', '2020-11-04 14:45:59', '2020-11-04 14:45:59'),
(17, 4, '5%', '2020-11-04 14:45:59', '2020-11-04 14:45:59'),
(17, 5, '5%', '2020-11-04 14:45:59', '2020-11-04 14:45:59'),
(17, 6, '25%', '2020-11-04 14:45:59', '2020-11-04 14:45:59'),
(17, 7, '10%', '2020-11-04 14:45:59', '2020-11-04 14:45:59'),
(16, 1, '35%', '2020-11-04 14:46:06', '2020-11-04 14:46:06'),
(16, 4, '5%', '2020-11-04 14:46:06', '2020-11-04 14:46:06'),
(16, 5, '5%', '2020-11-04 14:46:06', '2020-11-04 14:46:06'),
(16, 6, '15%', '2020-11-04 14:46:06', '2020-11-04 14:46:06'),
(16, 7, '10%', '2020-11-04 14:46:06', '2020-11-04 14:46:06'),
(15, 1, '35%', '2020-11-04 14:46:11', '2020-11-04 14:46:11'),
(15, 4, '5%', '2020-11-04 14:46:11', '2020-11-04 14:46:11'),
(15, 5, '5%', '2020-11-04 14:46:11', '2020-11-04 14:46:11'),
(15, 6, '35%', '2020-11-04 14:46:11', '2020-11-04 14:46:11'),
(15, 7, '25%', '2020-11-04 14:46:11', '2020-11-04 14:46:11'),
(14, 1, '25%', '2020-11-04 14:46:19', '2020-11-04 14:46:19'),
(14, 4, '5%', '2020-11-04 14:46:19', '2020-11-04 14:46:19'),
(14, 5, '5%', '2020-11-04 14:46:19', '2020-11-04 14:46:19'),
(14, 6, '35%', '2020-11-04 14:46:19', '2020-11-04 14:46:19'),
(14, 7, '5%', '2020-11-04 14:46:19', '2020-11-04 14:46:19'),
(13, 1, '10%', '2020-11-04 14:46:29', '2020-11-04 14:46:29'),
(13, 4, '5%', '2020-11-04 14:46:29', '2020-11-04 14:46:29'),
(13, 5, '5%', '2020-11-04 14:46:29', '2020-11-04 14:46:29'),
(13, 6, '50%', '2020-11-04 14:46:29', '2020-11-04 14:46:29'),
(13, 7, '55%', '2020-11-04 14:46:29', '2020-11-04 14:46:29'),
(12, 1, '51%', '2020-11-04 14:46:41', '2020-11-04 14:46:41'),
(12, 4, '5%', '2020-11-04 14:46:41', '2020-11-04 14:46:41'),
(12, 5, '5%', '2020-11-04 14:46:41', '2020-11-04 14:46:41'),
(12, 6, '59%', '2020-11-04 14:46:41', '2020-11-04 14:46:41'),
(12, 7, '50%', '2020-11-04 14:46:41', '2020-11-04 14:46:41'),
(11, 1, '40%', '2020-11-04 14:50:34', '2020-11-04 14:50:34'),
(11, 4, '5%', '2020-11-04 14:50:34', '2020-11-04 14:50:34'),
(11, 5, '5%', '2020-11-04 14:50:34', '2020-11-04 14:50:34'),
(11, 6, '45%', '2020-11-04 14:50:34', '2020-11-04 14:50:34'),
(11, 7, '65%', '2020-11-04 14:50:34', '2020-11-04 14:50:34'),
(10, 1, '50%', '2020-11-04 14:50:40', '2020-11-04 14:50:40'),
(10, 4, '10%', '2020-11-04 14:50:40', '2020-11-04 14:50:40'),
(10, 5, '5%', '2020-11-04 14:50:41', '2020-11-04 14:50:41'),
(10, 6, '25%', '2020-11-04 14:50:41', '2020-11-04 14:50:41'),
(10, 7, '60%', '2020-11-04 14:50:41', '2020-11-04 14:50:41'),
(8, 1, '35%', '2020-11-04 14:51:04', '2020-11-04 14:51:04'),
(8, 5, '5%', '2020-11-04 14:51:04', '2020-11-04 14:51:04'),
(8, 6, '40%', '2020-11-04 14:51:04', '2020-11-04 14:51:04'),
(8, 7, '50%', '2020-11-04 14:51:04', '2020-11-04 14:51:04'),
(7, 1, '35%', '2020-11-04 14:51:09', '2020-11-04 14:51:09'),
(7, 5, '5%', '2020-11-04 14:51:09', '2020-11-04 14:51:09'),
(7, 6, '10%', '2020-11-04 14:51:09', '2020-11-04 14:51:09'),
(7, 7, '50%', '2020-11-04 14:51:09', '2020-11-04 14:51:09'),
(6, 1, '40%', '2020-11-04 14:51:14', '2020-11-04 14:51:14'),
(6, 4, '10%', '2020-11-04 14:51:14', '2020-11-04 14:51:14'),
(5, 1, '40%', '2020-11-04 14:51:21', '2020-11-04 14:51:21'),
(33, 1, '5%', '2020-12-13 11:52:49', '2020-12-13 11:52:49'),
(33, 4, '3%', '2020-12-13 11:52:49', '2020-12-13 11:52:49'),
(33, 5, '12%', '2020-12-13 11:52:49', '2020-12-13 11:52:49'),
(33, 6, '35%', '2020-12-13 11:52:49', '2020-12-13 11:52:49'),
(33, 7, '5%', '2020-12-13 11:52:49', '2020-12-13 11:52:49'),
(32, 1, '60%', '2020-12-13 11:53:02', '2020-12-13 11:53:02'),
(32, 4, '1%', '2020-12-13 11:53:02', '2020-12-13 11:53:02'),
(32, 5, '1%', '2020-12-13 11:53:02', '2020-12-13 11:53:02'),
(32, 6, '55%', '2020-12-13 11:53:02', '2020-12-13 11:53:02'),
(32, 7, '55%', '2020-12-13 11:53:02', '2020-12-13 11:53:02'),
(9, 1, '5%', '2020-12-14 05:41:41', '2020-12-14 05:41:41'),
(9, 5, '10%', '2020-12-14 05:41:41', '2020-12-14 05:41:41'),
(9, 6, '15%', '2020-12-14 05:41:41', '2020-12-14 05:41:41'),
(9, 7, '45%', '2020-12-14 05:41:41', '2020-12-14 05:41:41'),
(4, 1, '35%', '2020-12-20 14:52:12', '2020-12-20 14:52:12'),
(4, 4, '25%', '2020-12-20 14:52:12', '2020-12-20 14:52:12'),
(4, 5, '15%', '2020-12-20 14:52:12', '2020-12-20 14:52:12');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_gia`
--

CREATE TABLE `danh_gia` (
  `ma_tv` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `so_sao` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `danh_gia`
--

INSERT INTO `danh_gia` (`ma_tv`, `ma_sp`, `so_sao`, `created_at`, `updated_at`) VALUES
(3, 4, 3, '2020-10-10 13:35:23', '2020-10-10 13:35:23'),
(3, 5, 5, '2020-10-10 13:35:53', '2020-10-10 13:35:53'),
(3, 6, 4, '2020-10-05 10:00:17', '2020-10-05 10:00:17'),
(3, 16, 5, '2020-10-10 15:43:49', '2020-10-10 15:43:49'),
(3, 17, 4, '2020-10-10 15:43:06', '2020-10-10 15:43:06'),
(3, 18, 5, '2020-10-10 14:05:16', '2020-10-10 14:05:16'),
(3, 27, 5, '2021-01-01 08:49:40', '2021-01-01 08:49:40'),
(3, 32, 5, '2020-10-15 14:40:34', '2020-10-15 14:40:34'),
(3, 33, 5, '2020-10-12 03:55:22', '2020-10-12 03:55:22'),
(4, 6, 5, '2020-10-03 06:32:59', '2020-10-03 06:32:59'),
(4, 27, 4, '2021-01-01 08:53:38', '2021-01-01 08:53:38'),
(4, 33, 4, '2020-12-29 15:31:21', '2020-12-29 15:31:21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devvn_quanhuyen`
--

CREATE TABLE `devvn_quanhuyen` (
  `maqh` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `matp` varchar(5) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `devvn_quanhuyen`
--

INSERT INTO `devvn_quanhuyen` (`maqh`, `name`, `type`, `matp`) VALUES
('916', 'Quận Ninh Kiều', 'Quận', '92'),
('917', 'Quận Ô Môn', 'Quận', '92'),
('918', 'Quận Bình Thuỷ', 'Quận', '92'),
('919', 'Quận Cái Răng', 'Quận', '92'),
('923', 'Quận Thốt Nốt', 'Quận', '92'),
('924', 'Huyện Vĩnh Thạnh', 'Huyện', '92'),
('925', 'Huyện Cờ Đỏ', 'Huyện', '92'),
('926', 'Huyện Phong Điền', 'Huyện', '92'),
('927', 'Huyện Thới Lai', 'Huyện', '92');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devvn_tinhthanhpho`
--

CREATE TABLE `devvn_tinhthanhpho` (
  `matp` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Đang đổ dữ liệu cho bảng `devvn_tinhthanhpho`
--

INSERT INTO `devvn_tinhthanhpho` (`matp`, `name`, `type`) VALUES
('92', 'Thành phố Cần Thơ', 'Thành phố Trung ương');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `devvn_xaphuongthitran`
--

CREATE TABLE `devvn_xaphuongthitran` (
  `maxptt` varchar(5) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `maqh` varchar(5) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `devvn_xaphuongthitran`
--

INSERT INTO `devvn_xaphuongthitran` (`maxptt`, `name`, `type`, `maqh`) VALUES
('31117', 'Phường Cái Khế', 'Phường', '916'),
('31120', 'Phường An Hòa', 'Phường', '916'),
('31123', 'Phường Thới Bình', 'Phường', '916'),
('31126', 'Phường An Nghiệp', 'Phường', '916'),
('31129', 'Phường An Cư', 'Phường', '916'),
('31132', 'Phường An Hội', 'Phường', '916'),
('31135', 'Phường Tân An', 'Phường', '916'),
('31138', 'Phường An Lạc', 'Phường', '916'),
('31141', 'Phường An Phú', 'Phường', '916'),
('31144', 'Phường Xuân Khánh', 'Phường', '916'),
('31147', 'Phường Hưng Lợi', 'Phường', '916'),
('31149', 'Phường An Khánh', 'Phường', '916'),
('31150', 'Phường An Bình', 'Phường', '916'),
('31153', 'Phường Châu Văn Liêm', 'Phường', '917'),
('31154', 'Phường Thới Hòa', 'Phường', '917'),
('31156', 'Phường Thới Long', 'Phường', '917'),
('31157', 'Phường Long Hưng', 'Phường', '917'),
('31159', 'Phường Thới An', 'Phường', '917'),
('31162', 'Phường Phước Thới', 'Phường', '917'),
('31165', 'Phường Trường Lạc', 'Phường', '917'),
('31168', 'Phường Bình Thủy', 'Phường', '918'),
('31169', 'Phường Trà An', 'Phường', '918'),
('31171', 'Phường Trà Nóc', 'Phường', '918'),
('31174', 'Phường Thới An Đông', 'Phường', '918'),
('31177', 'Phường An Thới', 'Phường', '918'),
('31178', 'Phường Bùi Hữu Nghĩa', 'Phường', '918'),
('31180', 'Phường Long Hòa', 'Phường', '918'),
('31183', 'Phường Long Tuyền', 'Phường', '918'),
('31186', 'Phường Lê Bình', 'Phường', '919'),
('31189', 'Phường Hưng Phú', 'Phường', '919'),
('31192', 'Phường Hưng Thạnh', 'Phường', '919'),
('31195', 'Phường Ba Láng', 'Phường', '919'),
('31198', 'Phường Thường Thạnh', 'Phường', '919'),
('31201', 'Phường Phú Thứ', 'Phường', '919'),
('31204', 'Phường Tân Phú', 'Phường', '919'),
('31207', 'Phường Thốt Nốt', 'Phường', '923'),
('31210', 'Phường Thới Thuận', 'Phường', '923'),
('31211', 'Xã Vĩnh Bình', 'Xã', '924'),
('31212', 'Phường Thuận An', 'Phường', '923'),
('31213', 'Phường Tân Lộc', 'Phường', '923'),
('31216', 'Phường Trung Nhứt', 'Phường', '923'),
('31217', 'Phường Thạnh Hoà', 'Phường', '923'),
('31219', 'Phường Trung Kiên', 'Phường', '923'),
('31222', 'Xã Trung An', 'Xã', '925'),
('31225', 'Xã Trung Thạnh', 'Xã', '925'),
('31227', 'Phường Tân Hưng', 'Phường', '923'),
('31228', 'Phường Thuận Hưng', 'Phường', '923'),
('31231', 'Thị trấn Thanh An', 'Thị trấn', '924'),
('31232', 'Thị trấn Vĩnh Thạnh', 'Thị trấn', '924'),
('31234', 'Xã Thạnh Mỹ', 'Xã', '924'),
('31237', 'Xã Vĩnh Trinh', 'Xã', '924'),
('31240', 'Xã Thạnh An', 'Xã', '924'),
('31241', 'Xã Thạnh Tiến', 'Xã', '924'),
('31243', 'Xã Thạnh Thắng', 'Xã', '924'),
('31244', 'Xã Thạnh Lợi', 'Xã', '924'),
('31246', 'Xã Thạnh Qưới', 'Xã', '924'),
('31249', 'Xã Thạnh Phú', 'Xã', '925'),
('31252', 'Xã Thạnh Lộc', 'Xã', '924'),
('31255', 'Xã Trung Hưng', 'Xã', '925'),
('31258', 'Thị trấn Thới Lai', 'Thị trấn', '927'),
('31261', 'Thị trấn Cờ Đỏ', 'Thị trấn', '925'),
('31264', 'Xã Thới Hưng', 'Xã', '925'),
('31267', 'Xã Thới Thạnh', 'Xã', '927'),
('31268', 'Xã Tân Thạnh', 'Xã', '927'),
('31270', 'Xã Xuân Thắng', 'Xã', '927'),
('31273', 'Xã Đông Hiệp', 'Xã', '925'),
('31274', 'Xã Đông Thắng', 'Xã', '925'),
('31276', 'Xã Thới Đông', 'Xã', '925'),
('31277', 'Xã Thới Xuân', 'Xã', '925'),
('31279', 'Xã Đông Bình', 'Xã', '927'),
('31282', 'Xã Đông Thuận', 'Xã', '927'),
('31285', 'Xã Thới Tân', 'Xã', '927'),
('31286', 'Xã Trường Thắng', 'Xã', '927'),
('31288', 'Xã Định Môn', 'Xã', '927'),
('31291', 'Xã Trường Thành', 'Xã', '927'),
('31294', 'Xã Trường Xuân', 'Xã', '927'),
('31297', 'Xã Trường Xuân A', 'Xã', '927'),
('31298', 'Xã Trường Xuân B', 'Xã', '927'),
('31299', 'Thị trấn Phong Điền', 'Thị trấn', '926'),
('31300', 'Xã Nhơn Ái', 'Xã', '926'),
('31303', 'Xã Giai Xuân', 'Xã', '926'),
('31306', 'Xã Tân Thới', 'Xã', '926'),
('31309', 'Xã Trường Long', 'Xã', '926'),
('31312', 'Xã Mỹ Khánh', 'Xã', '926'),
('31315', 'Xã Nhơn Nghĩa', 'Xã', '926');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doi_mat_khau`
--

CREATE TABLE `doi_mat_khau` (
  `id` int(11) NOT NULL,
  `email` char(250) NOT NULL,
  `chuoi_bi_mat` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `doi_mat_khau`
--

INSERT INTO `doi_mat_khau` (`id`, `email`, `chuoi_bi_mat`) VALUES
(20, 'nghiahavl2@gmail.com', 'cxSrV3vU');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `ma_dh` int(11) NOT NULL,
  `ma_tv` int(11) DEFAULT NULL,
  `ten_nn` char(50) NOT NULL,
  `email_nn` char(250) DEFAULT NULL,
  `sdt_nn` char(15) NOT NULL,
  `diachi_nn` text NOT NULL,
  `trang_thai_dh` int(11) NOT NULL DEFAULT 0,
  `trang_thai_tt` int(11) NOT NULL DEFAULT 0,
  `tongtien` float NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`ma_dh`, `ma_tv`, `ten_nn`, `email_nn`, `sdt_nn`, `diachi_nn`, `trang_thai_dh`, `trang_thai_tt`, `tongtien`, `created_at`, `updated_at`) VALUES
(75, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Hẻm 359 NVC, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 1, 170000, '2020-11-20 06:47:36', '2020-12-20 14:48:36'),
(76, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', '111, Phường Thới Hòa, Quận Ô Môn, Thành phố Cần Thơ', 2, 1, 250000, '2020-10-20 07:36:23', '2020-11-20 08:12:07'),
(84, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', '111, Phường Cái Khế, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 1, 175000, '2020-11-21 06:57:04', '2020-12-20 15:29:07'),
(85, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', '222, Phường Thới An Đông, Quận Bình Thuỷ, Thành phố Cần Thơ', 2, 2, 425000, '2020-11-21 06:58:25', '2020-12-20 14:47:45'),
(86, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Hẻm 359, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 2, 71000, '2020-11-30 09:02:21', '2021-01-02 16:14:49'),
(87, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', '1112, Phường Thới Hòa, Quận Ô Môn, Thành phố Cần Thơ', 2, 2, 71000, '2020-11-30 09:09:09', '2021-01-02 16:14:48'),
(93, 4, 'Trần Thị Yến Nhi', 'htnghia120898@gmail.com', '123456789', 'Hẻm 311, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 2, 232000, '2021-01-01 09:10:27', '2021-01-05 15:07:08'),
(94, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Số nhà 113, Phường Lê Bình, Quận Cái Răng, Thành phố Cần Thơ', 2, 1, 285000, '2021-02-01 09:17:17', '2021-01-05 15:07:03'),
(95, 5, 'Hà Trọng Nghĩa', 'nghiab1606914@student.ctu.edu.vn', '0332370223', 'Số nhà 734, Phường Hưng Thạnh, Quận Cái Răng, Thành phố Cần Thơ', 2, 2, 224000, '2021-03-04 17:52:38', '2021-01-05 15:09:32'),
(106, NULL, 'Hồ Hải Hùng', NULL, '0989741523', '111, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 1, 215000, '2021-03-05 13:54:49', '2021-01-05 15:06:38'),
(107, NULL, 'Trần Lê Như Nguyệt', NULL, '0594623566', '4434, Phường An Nghiệp, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 2, 210000, '2021-04-05 14:00:15', '2021-01-05 15:09:29'),
(108, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Hẻm 311, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 2, 1, 229000, '2021-05-05 14:04:56', '2021-01-05 15:07:36'),
(109, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Hẻm 359, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 2, 210000, '2021-06-05 14:06:16', '2021-01-05 15:02:16'),
(110, 3, 'Hà Trọng Nghĩa', 'nghiahavl2@gmail.com', '0332370223', 'Hẻm 311, Phường An Hòa, Quận Ninh Kiều, Thành phố Cần Thơ', 0, 2, 180000, '2021-01-07 14:56:57', '2021-01-07 14:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `ma_km` int(11) NOT NULL,
  `ten_km` char(250) NOT NULL,
  `ngay_bd` datetime NOT NULL,
  `ngay_kt` datetime NOT NULL,
  `noi_dung_km` text NOT NULL,
  `loai_km` int(11) NOT NULL,
  `gia_tri_km` float NOT NULL,
  `ma_loaisp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`ma_km`, `ten_km`, `ngay_bd`, `ngay_kt`, `noi_dung_km`, `loai_km`, `gia_tri_km`, `ma_loaisp`, `created_at`, `updated_at`) VALUES
(1, 'Khuyến mãi tháng 11', '2020-11-01 00:00:00', '2020-11-30 00:00:00', 'Tháng 11 sinh nhật của chủ cửa hàng nên tất cả Pizza sẽ được giảm 3%', 2, 5000, 2, '2020-10-31 13:31:59', '2021-01-07 14:27:47'),
(3, 'Khuyến mãi tháng 12', '2020-12-01 00:00:00', '2020-12-31 00:00:00', 'Tháng 12 cuối năm nên thích khuyến mãi chơi đó được không... Khuyến mãi 10% luôn cho tất cả các hamburger', 1, 10, 1, '2020-11-02 14:23:20', '2021-01-07 14:28:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loai_san_pham`
--

CREATE TABLE `loai_san_pham` (
  `ma_loaisp` int(11) NOT NULL,
  `ten_loaisp` char(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `loai_san_pham`
--

INSERT INTO `loai_san_pham` (`ma_loaisp`, `ten_loaisp`, `created_at`, `updated_at`) VALUES
(1, 'HAMBURGER', '2020-09-17 07:47:47', '2020-10-05 09:55:11'),
(2, 'PIZZA', '2020-09-17 08:08:00', '2020-09-18 05:59:41'),
(12, 'HOTDOG', '2020-10-05 16:13:19', '2020-10-05 16:13:19'),
(13, 'GÀ RÁN', '2020-10-05 16:14:13', '2020-10-05 16:14:13'),
(14, 'KHOAI TÂY CHIÊN', '2020-10-05 16:14:42', '2020-10-05 16:14:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngay_nhap_sp`
--

CREATE TABLE `ngay_nhap_sp` (
  `ngay_nhap` datetime NOT NULL,
  `soluong_nhap` int(11) NOT NULL,
  `ngay_het_han` datetime NOT NULL,
  `soluong_hong` int(11) NOT NULL DEFAULT 0,
  `ma_sp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `ngay_nhap_sp`
--

INSERT INTO `ngay_nhap_sp` (`ngay_nhap`, `soluong_nhap`, `ngay_het_han`, `soluong_hong`, `ma_sp`) VALUES
('2021-01-05 02:49:52', 16, '2021-01-10 02:49:00', 0, 33),
('2021-01-05 02:50:51', 10, '2021-01-10 02:50:00', 0, 32),
('2021-01-05 02:50:58', 10, '2021-01-10 02:50:00', 0, 31),
('2021-01-05 02:51:10', 7, '2021-01-10 02:51:00', 0, 30),
('2021-01-05 02:51:20', 8, '2021-01-10 02:51:00', 0, 29),
('2021-01-05 02:51:31', 8, '2021-01-10 02:51:00', 0, 28),
('2021-01-05 02:52:14', 10, '2021-01-10 02:52:00', 0, 27),
('2021-01-05 02:52:23', 8, '2021-01-10 02:52:00', 0, 26),
('2021-01-05 02:52:34', 11, '2021-01-10 02:52:00', 0, 25),
('2021-01-05 02:52:52', 15, '2021-01-10 02:52:00', 0, 24),
('2021-01-05 02:53:08', 9, '2021-01-10 02:53:00', 0, 23),
('2021-01-05 02:53:18', 10, '2021-01-10 02:53:00', 0, 22),
('2021-01-05 02:53:26', 7, '2021-01-10 02:53:00', 0, 21),
('2021-01-05 02:53:37', 8, '2021-01-10 02:53:00', 0, 20),
('2021-01-05 02:53:54', 5, '2021-01-10 02:53:00', 0, 19),
('2021-01-05 02:54:14', 10, '2021-01-10 02:54:00', 0, 18),
('2021-01-05 02:54:23', 8, '2021-01-10 02:54:00', 0, 17),
('2021-01-05 02:54:38', 8, '2021-01-10 02:54:00', 0, 16),
('2021-01-05 02:55:29', 9, '2021-01-10 02:55:00', 0, 15),
('2021-01-05 02:55:44', 8, '2021-01-10 02:55:00', 0, 14),
('2021-01-05 02:56:03', 15, '2021-01-10 02:56:00', 0, 13),
('2021-01-05 02:56:14', 10, '2021-01-10 02:56:00', 0, 12),
('2021-01-05 02:56:24', 16, '2021-01-10 02:56:00', 0, 11),
('2021-01-05 02:56:36', 20, '2021-01-10 02:56:00', 0, 10),
('2021-01-05 02:56:48', 12, '2021-01-10 02:56:00', 0, 9),
('2021-01-05 02:56:58', 13, '2021-01-10 02:56:00', 0, 8),
('2021-01-05 02:57:15', 13, '2021-01-10 02:57:00', 0, 7),
('2021-01-05 02:57:26', 19, '2021-01-10 02:57:00', 0, 6),
('2021-01-05 02:57:39', 16, '2021-01-10 02:57:00', 0, 5),
('2021-01-05 02:57:49', 15, '2021-01-10 02:57:00', 0, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phan_hoi`
--

CREATE TABLE `phan_hoi` (
  `ma_tv` int(11) NOT NULL,
  `ma_bl` int(11) NOT NULL,
  `noidung_ph` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `phan_hoi`
--

INSERT INTO `phan_hoi` (`ma_tv`, `ma_bl`, `noidung_ph`, `created_at`, `updated_at`) VALUES
(4, 1, 'Nói thật không vậy bạn Nghĩa... hihi', '2020-09-28 14:41:38', '2020-09-28 14:41:38'),
(3, 1, 'Tôi nói thiệt mà. Nếu không tin thì mua ăn thử. kkk', '2020-09-28 14:56:07', '2020-09-28 14:56:07'),
(3, 2, 'Tôi là chó... Gâu gâu gâu!', '2020-09-28 14:57:16', '2020-09-28 14:57:16'),
(4, 2, 'Haha... Bạn Nghĩa dễ thương quá hà :)', '2020-09-28 14:57:58', '2020-09-28 14:57:58'),
(3, 3, 'Tôi thì yêu bạn mất rồi! Haaaha', '2020-09-28 14:59:48', '2020-09-28 14:59:48'),
(3, 2, 'Cảm ơn bạn nha!', '2020-10-10 13:02:52', '2020-10-10 13:02:52'),
(3, 2, 'Bạn cũng dễ thương mà', '2020-10-10 13:03:01', '2020-10-10 13:03:01'),
(5, 38, 'ahihi', '2020-10-30 17:23:51', '2020-10-30 17:23:51'),
(3, 76, 'Ngon lắm bạn ơi! Mua ăn thử đi.', '2021-01-01 08:46:25', '2021-01-01 08:46:25'),
(4, 76, 'Okee. Để mình mua ăn thử.', '2021-01-01 08:47:13', '2021-01-01 08:47:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `ma_sp` int(11) NOT NULL,
  `ten_sp` char(250) NOT NULL,
  `hinh_sp` char(250) NOT NULL,
  `chitiet_sp` text NOT NULL,
  `gia_sp` float NOT NULL,
  `soluong_sp` int(11) NOT NULL DEFAULT 0,
  `ma_loaisp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`ma_sp`, `ten_sp`, `hinh_sp`, `chitiet_sp`, `gia_sp`, `soluong_sp`, `ma_loaisp`, `created_at`, `updated_at`) VALUES
(4, 'Pizza loại 1', 'public/frontend/images/pizza.jpg', 'Đây là pizza loại 1', 150000, 15, 2, '2020-09-20 23:25:04', '2021-01-04 19:57:50'),
(5, 'Hamburger loại 1', 'public/frontend/images/hamburger.jpg', 'Là lá la là la', 50000, 16, 1, '2020-09-20 23:27:52', '2021-01-04 19:57:39'),
(6, 'Hamburger loại 2', 'public/frontend/images/hamburger1.jpg', 'Ahihi đồ ngốc', 155000, 19, 1, '2020-09-20 23:33:30', '2021-01-04 19:57:26'),
(7, 'Hotdog loại 1', 'public/frontend/images/hotdog.jpg', 'hotdog này ngon lắm á', 35000, 13, 12, '2020-10-08 13:45:26', '2021-01-04 19:57:16'),
(8, 'Hotdog loại 2', 'public/frontend/images/hotdog1.jpg', 'Ahihi đồ ngốc', 40000, 13, 12, '2020-10-08 13:47:34', '2021-01-04 19:56:58'),
(9, 'Hotdog loại 3', 'public/frontend/images/hotdog2.jpg', 'Không biết nói gì luôn', 50000, 12, 12, '2020-10-08 13:49:35', '2021-01-04 19:56:48'),
(10, 'Gà rán loại 1', 'public/frontend/images/garan.jpg', 'Đây là gà rán loại 1', 50000, 20, 13, '2020-10-08 13:54:35', '2021-01-04 19:56:36'),
(11, 'Gà rán loại 2', 'public/frontend/images/garan1.jpg', 'Đây là gà rán loại 2', 55000, 16, 13, '2020-10-08 13:55:35', '2021-01-04 19:56:24'),
(12, 'Gà rán loại 3', 'public/frontend/images/garan2.jpg', 'Đây là gà rán loại 3', 60000, 10, 13, '2020-10-08 13:56:52', '2021-01-04 19:56:14'),
(13, 'Gà rán loại 4', 'public/frontend/images/garan3.jpg', 'Đây là gà rán loại 4', 65000, 15, 13, '2020-10-08 13:57:43', '2021-01-04 19:56:03'),
(14, 'Khoai tây chiên loại 1', 'public/frontend/images/khoaitaychien.jpg', 'Đây là khoai tây chiên loại 1', 35000, 8, 14, '2020-10-08 14:04:15', '2021-01-04 19:55:44'),
(15, 'Khoai tây chiên loại 2', 'public/frontend/images/khoaitaychien1.jpg', 'Đây là khoai tây chiên loại 2', 40000, 9, 14, '2020-10-08 14:05:34', '2021-01-04 19:55:29'),
(16, 'Khoai tây chiên loại 3', 'public/frontend/images/khoaitaychien2.jpg', 'Đây là khoai tây chiên loại 3', 50000, 6, 14, '2020-10-08 14:06:46', '2021-01-05 14:06:16'),
(17, 'Khoai tây chiên loại 4', 'public/frontend/images/khoaitaychien3.jpg', 'Đây là khoai tây chiên loại 4', 50000, 7, 14, '2020-10-08 14:08:09', '2021-01-05 14:06:16'),
(18, 'Khoai tây chiên loại 5', 'public/frontend/images/khoaitaychien4.jpg', 'Đây là khoai tây chiên loại 5', 45000, 9, 14, '2020-10-08 14:08:54', '2021-01-05 14:06:16'),
(19, 'Pizza loại 2', 'public/frontend/images/pizza1.jpg', 'Đây là Pizza loại 2', 35000, 5, 2, '2020-10-10 16:12:39', '2021-01-04 19:53:54'),
(20, 'Pizza loại 3', 'public/frontend/images/pizza2.jpg', 'Đây là pizza loại 3', 80000, 8, 2, '2020-10-10 16:14:23', '2021-01-04 19:53:37'),
(21, 'Pizza loại 4', 'public/frontend/images/pizza3.jpg', 'Đây là pizza loại 4', 90000, 7, 2, '2020-10-10 16:15:20', '2021-01-04 19:53:26'),
(22, 'Pizza loại 5', 'public/frontend/images/pizza4.jpg', 'Đây là pizza loại 5', 90000, 10, 2, '2020-10-10 16:16:11', '2021-01-04 19:53:18'),
(23, 'Pizza loại 6', 'public/frontend/images/pizza5.jpg', 'Đây là pizza loại 6, thơm ngon bỗ dưỡng luôn nha', 90000, 9, 2, '2020-10-10 16:17:28', '2021-01-04 19:53:08'),
(24, 'Hamburger loại 3', 'public/frontend/images/hamburger2.jpg', 'Đây là hamburger loại 2', 80000, 15, 1, '2020-10-10 16:20:35', '2021-01-04 19:52:52'),
(25, 'Hamburger loại 4', 'public/frontend/images/hamburger3.jpg', 'Đây là hamburger loại 4', 99000, 11, 1, '2020-10-10 16:22:25', '2021-01-04 19:52:34'),
(26, 'Hamburger loại 5', 'public/frontend/images/hamburger4.jpg', 'Đây là hamburger loại 5', 98000, 7, 1, '2020-10-10 16:24:46', '2021-01-05 14:04:56'),
(27, 'Hamburger loại 6', 'public/frontend/images/hamburger5.jpg', 'Đây là hamburger loại 6 đó nha', 100000, 10, 1, '2020-10-10 16:25:46', '2021-01-04 19:52:14'),
(28, 'Hotdog loại 4', 'public/frontend/images/hotdog3.jpg', 'Đây là hot dog loại 4', 50000, 4, 12, '2020-10-10 16:29:05', '2021-01-05 13:54:49'),
(29, 'Hotdog loại 5', 'public/frontend/images/hotdog4.jpg', 'Đây là hotdog loại 5 mlem mlem', 56000, 6, 12, '2020-10-10 16:32:26', '2021-01-05 16:12:05'),
(30, 'Hotdog loại 6', 'public/frontend/images/hotdog5.jpg', 'Đây là hotdog loại 6', 60000, 6, 12, '2020-10-10 16:33:26', '2021-01-05 14:04:56'),
(31, 'Gà rán loại 5', 'public/frontend/images/garan4.jpg', 'Đây là gà rán loại 5', 70000, 9, 13, '2020-10-10 16:39:29', '2021-01-05 16:11:51'),
(32, 'Gà rán loại 6', 'public/frontend/images/garan5.jpg', 'Đây là gà rán loại 6', 70000, 9, 13, '2020-10-10 16:40:17', '2021-01-05 14:00:15'),
(33, 'Khoai tây chiên loại 6', 'public/frontend/images/khoaitaychien5.jpg', 'Đây là khoai tây chiên loại 6', 55000, 13, 14, '2020-10-10 16:41:13', '2021-01-07 14:56:57');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham_khuyen_mai`
--

CREATE TABLE `san_pham_khuyen_mai` (
  `ma_km` int(11) NOT NULL,
  `ma_sp` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `san_pham_khuyen_mai`
--

INSERT INTO `san_pham_khuyen_mai` (`ma_km`, `ma_sp`, `created_at`, `updated_at`) VALUES
(1, 4, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(1, 19, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(1, 20, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(1, 21, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(1, 22, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(1, 23, '2021-01-07 14:27:47', '2021-01-07 14:27:47'),
(3, 5, '2021-01-07 14:28:00', '2021-01-07 14:28:00'),
(3, 6, '2021-01-07 14:28:00', '2021-01-07 14:28:00'),
(3, 24, '2021-01-07 14:28:00', '2021-01-07 14:28:00'),
(3, 25, '2021-01-07 14:28:00', '2021-01-07 14:28:00'),
(3, 26, '2021-01-07 14:28:00', '2021-01-07 14:28:00'),
(3, 27, '2021-01-07 14:28:00', '2021-01-07 14:28:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slideshow`
--

CREATE TABLE `slideshow` (
  `ma_slides` int(11) NOT NULL,
  `hinh_slides` char(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `slideshow`
--

INSERT INTO `slideshow` (`ma_slides`, `hinh_slides`, `created_at`, `updated_at`) VALUES
(4, 'public/frontend/images/slides3.jpg', '2020-09-18 05:55:02', '2020-10-26 15:03:49'),
(5, 'public/frontend/images/slides5.jpg', '2020-09-23 06:05:05', '2020-10-26 15:03:58');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanh_phan_dinh_duong`
--

CREATE TABLE `thanh_phan_dinh_duong` (
  `ma_tpdd` int(11) NOT NULL,
  `ten_tpdd` char(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thanh_phan_dinh_duong`
--

INSERT INTO `thanh_phan_dinh_duong` (`ma_tpdd`, `ten_tpdd`, `created_at`, `updated_at`) VALUES
(1, 'PROTEIN', '2020-09-18 06:11:48', '2020-09-18 06:23:06'),
(4, 'CHẤT BÉO', '2020-09-18 06:51:49', '2020-09-18 06:51:49'),
(5, 'ĐƯỜNG', '2020-09-18 06:56:15', '2020-10-05 16:19:44'),
(6, 'CALORIES', '2020-10-05 09:59:12', '2020-10-05 09:59:12'),
(7, 'CHẤT ĐẠM', '2020-10-05 16:19:56', '2020-10-05 16:19:56');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thanh_vien`
--

CREATE TABLE `thanh_vien` (
  `ma_tv` int(11) NOT NULL,
  `ten_tv` char(50) NOT NULL,
  `hinh_tv` char(250) NOT NULL DEFAULT 'public/frontend/images/ff.jpg',
  `email_tv` char(250) NOT NULL,
  `sdt_tv` char(15) NOT NULL,
  `matkhau` char(250) NOT NULL,
  `vaitro` int(11) NOT NULL DEFAULT 0,
  `trangthai` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `thanh_vien`
--

INSERT INTO `thanh_vien` (`ma_tv`, `ten_tv`, `hinh_tv`, `email_tv`, `sdt_tv`, `matkhau`, `vaitro`, `trangthai`, `created_at`, `updated_at`) VALUES
(3, 'Hà Trọng Nghĩa', 'public/frontend/images/anh1.jpg', 'nghiahavl2@gmail.com', '0332370223', '990a681884f06e62a866394596809141', 2, 0, '2020-09-24 03:16:50', '2020-12-30 16:45:01'),
(4, 'Trần Thị Yến Nhi', 'public/frontend/images/b.jpg', 'htnghia120898@gmail.com', '123456789', 'c4993b8905b66ebd5df863883357a749', 1, 0, '2020-09-28 14:36:29', '2021-01-06 11:32:11'),
(5, 'Hà Trọng Nghĩa', 'public/frontend/images/ff.jpg', 'nghiab1606914@student.ctu.edu.vn', '0332370223', 'c4993b8905b66ebd5df863883357a749', 0, 1, '2020-09-30 09:27:56', '2021-01-06 11:32:25');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`ma_bl`),
  ADD KEY `ma_tv` (`ma_tv`),
  ADD KEY `ma_sp` (`ma_sp`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD KEY `ma_sp` (`ma_sp`),
  ADD KEY `chi_tiet_don_hang_ibfk_1` (`ma_dh`);

--
-- Chỉ mục cho bảng `chi_tiet_tpdd`
--
ALTER TABLE `chi_tiet_tpdd`
  ADD KEY `ma_tpdd` (`ma_tpdd`),
  ADD KEY `chi_tiet_tpdd_ibfk_1` (`ma_sp`);

--
-- Chỉ mục cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD PRIMARY KEY (`ma_tv`,`ma_sp`);

--
-- Chỉ mục cho bảng `devvn_quanhuyen`
--
ALTER TABLE `devvn_quanhuyen`
  ADD PRIMARY KEY (`maqh`),
  ADD KEY `devvn_quanhuyen_ibfk_1` (`matp`);

--
-- Chỉ mục cho bảng `devvn_tinhthanhpho`
--
ALTER TABLE `devvn_tinhthanhpho`
  ADD PRIMARY KEY (`matp`);

--
-- Chỉ mục cho bảng `devvn_xaphuongthitran`
--
ALTER TABLE `devvn_xaphuongthitran`
  ADD PRIMARY KEY (`maxptt`),
  ADD KEY `devvn_xaphuongthitran_ibfk_1` (`maqh`);

--
-- Chỉ mục cho bảng `doi_mat_khau`
--
ALTER TABLE `doi_mat_khau`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`ma_dh`),
  ADD KEY `ma_tv` (`ma_tv`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`ma_km`);

--
-- Chỉ mục cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  ADD PRIMARY KEY (`ma_loaisp`);

--
-- Chỉ mục cho bảng `ngay_nhap_sp`
--
ALTER TABLE `ngay_nhap_sp`
  ADD PRIMARY KEY (`ngay_nhap`),
  ADD KEY `ngay_nhap_sp_ibfk_1` (`ma_sp`);

--
-- Chỉ mục cho bảng `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD KEY `ma_tv` (`ma_tv`),
  ADD KEY `phan_hoi_ibfk_1` (`ma_bl`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`ma_sp`),
  ADD KEY `ma_loaisp` (`ma_loaisp`);

--
-- Chỉ mục cho bảng `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD PRIMARY KEY (`ma_km`,`ma_sp`),
  ADD KEY `san_pham_khuyen_mai_ibfk_2` (`ma_sp`);

--
-- Chỉ mục cho bảng `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`ma_slides`);

--
-- Chỉ mục cho bảng `thanh_phan_dinh_duong`
--
ALTER TABLE `thanh_phan_dinh_duong`
  ADD PRIMARY KEY (`ma_tpdd`);

--
-- Chỉ mục cho bảng `thanh_vien`
--
ALTER TABLE `thanh_vien`
  ADD PRIMARY KEY (`ma_tv`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `ma_bl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT cho bảng `doi_mat_khau`
--
ALTER TABLE `doi_mat_khau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `ma_dh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `ma_km` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `loai_san_pham`
--
ALTER TABLE `loai_san_pham`
  MODIFY `ma_loaisp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `ma_sp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT cho bảng `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `ma_slides` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `thanh_phan_dinh_duong`
--
ALTER TABLE `thanh_phan_dinh_duong`
  MODIFY `ma_tpdd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `thanh_vien`
--
ALTER TABLE `thanh_vien`
  MODIFY `ma_tv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`ma_tv`) REFERENCES `thanh_vien` (`ma_tv`),
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`ma_dh`) REFERENCES `don_hang` (`ma_dh`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`);

--
-- Các ràng buộc cho bảng `chi_tiet_tpdd`
--
ALTER TABLE `chi_tiet_tpdd`
  ADD CONSTRAINT `chi_tiet_tpdd_ibfk_1` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_tpdd_ibfk_2` FOREIGN KEY (`ma_tpdd`) REFERENCES `thanh_phan_dinh_duong` (`ma_tpdd`);

--
-- Các ràng buộc cho bảng `danh_gia`
--
ALTER TABLE `danh_gia`
  ADD CONSTRAINT `danh_gia_ibfk_1` FOREIGN KEY (`ma_tv`) REFERENCES `thanh_vien` (`ma_tv`);

--
-- Các ràng buộc cho bảng `devvn_quanhuyen`
--
ALTER TABLE `devvn_quanhuyen`
  ADD CONSTRAINT `devvn_quanhuyen_ibfk_1` FOREIGN KEY (`matp`) REFERENCES `devvn_tinhthanhpho` (`matp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `devvn_xaphuongthitran`
--
ALTER TABLE `devvn_xaphuongthitran`
  ADD CONSTRAINT `devvn_xaphuongthitran_ibfk_1` FOREIGN KEY (`maqh`) REFERENCES `devvn_quanhuyen` (`maqh`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`ma_tv`) REFERENCES `thanh_vien` (`ma_tv`);

--
-- Các ràng buộc cho bảng `ngay_nhap_sp`
--
ALTER TABLE `ngay_nhap_sp`
  ADD CONSTRAINT `ngay_nhap_sp_ibfk_1` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `phan_hoi`
--
ALTER TABLE `phan_hoi`
  ADD CONSTRAINT `phan_hoi_ibfk_1` FOREIGN KEY (`ma_bl`) REFERENCES `binh_luan` (`ma_bl`) ON DELETE CASCADE,
  ADD CONSTRAINT `phan_hoi_ibfk_2` FOREIGN KEY (`ma_tv`) REFERENCES `thanh_vien` (`ma_tv`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`ma_loaisp`) REFERENCES `loai_san_pham` (`ma_loaisp`);

--
-- Các ràng buộc cho bảng `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_1` FOREIGN KEY (`ma_km`) REFERENCES `khuyen_mai` (`ma_km`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_2` FOREIGN KEY (`ma_sp`) REFERENCES `san_pham` (`ma_sp`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
