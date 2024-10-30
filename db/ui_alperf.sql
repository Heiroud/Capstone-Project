-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 09:30 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ui_alperf`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` int(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0=pending,1=started,2=closed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `year`, `semester`, `status`) VALUES
(2, '2022-2023', 'Second Semester', 2),
(3, '2023-2024', 'First Semester', 1),
(4, '2023-2024', 'Second Semester', 0),
(5, '2024-2025', 'First Semester', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Seth', 'Nono', 'dean@gmail.com', '12345'),
(2, 'Arnold', 'Fuentes', 'doc@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `admin_pic`
--

CREATE TABLE `admin_pic` (
  `admin_pic_id` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `admin_pic_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_report_com`
--

CREATE TABLE `class_report_com` (
  `report_com_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `faculty_id` int(255) NOT NULL,
  `comment` text DEFAULT NULL,
  `admin_archive` tinyint(1) DEFAULT 1,
  `faculty_archive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_report_com`
--

INSERT INTO `class_report_com` (`report_com_id`, `admin_id`, `faculty_id`, `comment`, `admin_archive`, `faculty_archive`) VALUES
(18, 1, 1, 'iuuiiuiuiuiu', 1, 1),
(20, 1, 2, 'very good', 1, 1),
(23, 1, 2, '', 0, 1),
(25, 1, 1, '🫡🫡', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_report_info`
--

CREATE TABLE `class_report_info` (
  `report_info_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `faculty_id` int(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `instructor` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `observer_name` varchar(255) NOT NULL,
  `admin_archive` tinyint(1) DEFAULT 1,
  `faculty_archive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_report_info`
--

INSERT INTO `class_report_info` (`report_info_id`, `admin_id`, `faculty_id`, `section`, `instructor`, `subject`, `date`, `school_year`, `semester`, `observer_name`, `admin_archive`, `faculty_archive`) VALUES
(18, 1, 1, 'UI-FC1-BSIT3-2', 'Valeriano, Ryan Rain', 'ITE 310 Capstone Project and Research 2', '2024-08-21', '2022-2023', 'First Semester', 'Nono, Seth', 1, 1),
(20, 1, 2, 'UI-FC1-BSIT3-1', 'Velasco, Kristille Mae', 'ITE 308 Web System and Technologies', '2024-08-21', '2023-2024', 'First Semester', 'Nono, Seth', 1, 1),
(23, 1, 2, 'UI-FC1-BSIT3-2', 'Velasco, Kristille Mae', 'ITE 301 Application Development and Emerging Technologies', '2024-10-06', '2023-2024', 'First Semester', 'Nono, Seth', 0, 1),
(25, 1, 1, 'UI-FC1-BSIT3-1', 'Valeriano, Ryan Rain', 'ITE 308 Web System and Technologies', '2024-10-09', '2023-2024', 'First Semester', 'Nono, Seth', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_report_ins`
--

CREATE TABLE `class_report_ins` (
  `report_ins_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `faculty_id` int(255) NOT NULL,
  `i_lec_2` int(255) DEFAULT NULL,
  `i_rtw_2` int(255) DEFAULT NULL,
  `i_fup_2` int(255) DEFAULT NULL,
  `i_anq_2` int(255) DEFAULT NULL,
  `i_pq_2` int(255) DEFAULT NULL,
  `i_mg_2` int(255) DEFAULT NULL,
  `i_1o1_2` int(255) DEFAULT NULL,
  `i_dv_2` int(255) DEFAULT NULL,
  `i_w_2` int(255) DEFAULT NULL,
  `i_o_2` int(255) DEFAULT NULL,
  `i_lec_4` int(255) DEFAULT NULL,
  `i_rtw_4` int(255) DEFAULT NULL,
  `i_fup_4` int(255) DEFAULT NULL,
  `i_anq_4` int(255) DEFAULT NULL,
  `i_pq_4` int(255) DEFAULT NULL,
  `i_mg_4` int(255) DEFAULT NULL,
  `i_1o1_4` int(255) DEFAULT NULL,
  `i_dv_4` int(255) DEFAULT NULL,
  `i_w_4` int(255) DEFAULT NULL,
  `i_o_4` int(255) DEFAULT NULL,
  `i_lec_6` int(255) DEFAULT NULL,
  `i_rtw_6` int(255) DEFAULT NULL,
  `i_fup_6` int(255) DEFAULT NULL,
  `i_anq_6` int(255) DEFAULT NULL,
  `i_pq_6` int(255) DEFAULT NULL,
  `i_mg_6` int(255) DEFAULT NULL,
  `i_1o1_6` int(255) DEFAULT NULL,
  `i_dv_6` int(255) DEFAULT NULL,
  `i_w_6` int(255) DEFAULT NULL,
  `i_o_6` int(255) DEFAULT NULL,
  `i_lec_8` int(255) DEFAULT NULL,
  `i_rtw_8` int(255) DEFAULT NULL,
  `i_fup_8` int(255) DEFAULT NULL,
  `i_anq_8` int(255) DEFAULT NULL,
  `i_pq_8` int(255) DEFAULT NULL,
  `i_mg_8` int(255) DEFAULT NULL,
  `i_1o1_8` int(255) DEFAULT NULL,
  `i_dv_8` int(255) DEFAULT NULL,
  `i_w_8` int(255) DEFAULT NULL,
  `i_o_8` int(255) DEFAULT NULL,
  `i_lec_10` int(255) DEFAULT NULL,
  `i_rtw_10` int(255) DEFAULT NULL,
  `i_fup_10` int(255) DEFAULT NULL,
  `i_anq_10` int(255) DEFAULT NULL,
  `i_pq_10` int(255) DEFAULT NULL,
  `i_mg_10` int(255) DEFAULT NULL,
  `i_1o1_10` int(255) DEFAULT NULL,
  `i_dv_10` int(255) DEFAULT NULL,
  `i_w_10` int(255) DEFAULT NULL,
  `i_o_10` int(255) DEFAULT NULL,
  `i_lec_12` int(255) DEFAULT NULL,
  `i_rtw_12` int(255) DEFAULT NULL,
  `i_fup_12` int(255) DEFAULT NULL,
  `i_anq_12` int(255) DEFAULT NULL,
  `i_pq_12` int(255) DEFAULT NULL,
  `i_mg_12` int(255) DEFAULT NULL,
  `i_1o1_12` int(255) DEFAULT NULL,
  `i_dv_12` int(255) DEFAULT NULL,
  `i_w_12` int(255) DEFAULT NULL,
  `i_o_12` int(255) DEFAULT NULL,
  `i_lec_14` int(255) DEFAULT NULL,
  `i_rtw_14` int(255) DEFAULT NULL,
  `i_fup_14` int(255) DEFAULT NULL,
  `i_anq_14` int(255) DEFAULT NULL,
  `i_pq_14` int(255) DEFAULT NULL,
  `i_mg_14` int(255) DEFAULT NULL,
  `i_1o1_14` int(255) DEFAULT NULL,
  `i_dv_14` int(255) DEFAULT NULL,
  `i_w_14` int(255) DEFAULT NULL,
  `i_o_14` int(255) DEFAULT NULL,
  `i_lec_16` int(255) DEFAULT NULL,
  `i_rtw_16` int(255) DEFAULT NULL,
  `i_fup_16` int(255) DEFAULT NULL,
  `i_anq_16` int(255) DEFAULT NULL,
  `i_pq_16` int(255) DEFAULT NULL,
  `i_mg_16` int(255) DEFAULT NULL,
  `i_1o1_16` int(255) DEFAULT NULL,
  `i_dv_16` int(255) DEFAULT NULL,
  `i_w_16` int(255) DEFAULT NULL,
  `i_o_16` int(255) DEFAULT NULL,
  `i_lec_18` int(255) DEFAULT NULL,
  `i_rtw_18` int(255) DEFAULT NULL,
  `i_fup_18` int(255) DEFAULT NULL,
  `i_anq_18` int(255) DEFAULT NULL,
  `i_pq_18` int(255) DEFAULT NULL,
  `i_mg_18` int(255) DEFAULT NULL,
  `i_1o1_18` int(255) DEFAULT NULL,
  `i_dv_18` int(255) DEFAULT NULL,
  `i_w_18` int(255) DEFAULT NULL,
  `i_o_18` int(255) DEFAULT NULL,
  `i_lec_20` int(255) DEFAULT NULL,
  `i_rtw_20` int(255) DEFAULT NULL,
  `i_fup_20` int(255) DEFAULT NULL,
  `i_anq_20` int(255) DEFAULT NULL,
  `i_pq_20` int(255) DEFAULT NULL,
  `i_mg_20` int(255) DEFAULT NULL,
  `i_1o1_20` int(255) DEFAULT NULL,
  `i_dv_20` int(255) DEFAULT NULL,
  `i_w_20` int(255) DEFAULT NULL,
  `i_o_20` int(255) DEFAULT NULL,
  `i_lec_22` int(255) DEFAULT NULL,
  `i_rtw_22` int(255) DEFAULT NULL,
  `i_fup_22` int(255) DEFAULT NULL,
  `i_anq_22` int(255) DEFAULT NULL,
  `i_pq_22` int(255) DEFAULT NULL,
  `i_mg_22` int(255) DEFAULT NULL,
  `i_1o1_22` int(255) DEFAULT NULL,
  `i_dv_22` int(255) DEFAULT NULL,
  `i_w_22` int(255) DEFAULT NULL,
  `i_o_22` int(255) DEFAULT NULL,
  `i_lec_24` int(255) DEFAULT NULL,
  `i_rtw_24` int(255) DEFAULT NULL,
  `i_fup_24` int(255) DEFAULT NULL,
  `i_anq_24` int(255) DEFAULT NULL,
  `i_pq_24` int(255) DEFAULT NULL,
  `i_mg_24` int(255) DEFAULT NULL,
  `i_1o1_24` int(255) DEFAULT NULL,
  `i_dv_24` int(255) DEFAULT NULL,
  `i_w_24` int(255) DEFAULT NULL,
  `i_o_24` int(255) DEFAULT NULL,
  `i_lec_26` int(255) DEFAULT NULL,
  `i_rtw_26` int(255) DEFAULT NULL,
  `i_fup_26` int(255) DEFAULT NULL,
  `i_anq_26` int(255) DEFAULT NULL,
  `i_pq_26` int(255) DEFAULT NULL,
  `i_mg_26` int(255) DEFAULT NULL,
  `i_1o1_26` int(255) DEFAULT NULL,
  `i_dv_26` int(255) DEFAULT NULL,
  `i_w_26` int(255) DEFAULT NULL,
  `i_o_26` int(255) DEFAULT NULL,
  `i_lec_28` int(255) DEFAULT NULL,
  `i_rtw_28` int(255) DEFAULT NULL,
  `i_fup_28` int(255) DEFAULT NULL,
  `i_anq_28` int(255) DEFAULT NULL,
  `i_pq_28` int(255) DEFAULT NULL,
  `i_mg_28` int(255) DEFAULT NULL,
  `i_1o1_28` int(255) DEFAULT NULL,
  `i_dv_28` int(255) DEFAULT NULL,
  `i_w_28` int(255) DEFAULT NULL,
  `i_o_28` int(255) DEFAULT NULL,
  `i_lec_30` int(255) DEFAULT NULL,
  `i_rtw_30` int(255) DEFAULT NULL,
  `i_fup_30` int(255) DEFAULT NULL,
  `i_anq_30` int(255) DEFAULT NULL,
  `i_pq_30` int(255) DEFAULT NULL,
  `i_mg_30` int(255) DEFAULT NULL,
  `i_1o1_30` int(255) DEFAULT NULL,
  `i_dv_30` int(255) DEFAULT NULL,
  `i_w_30` int(255) DEFAULT NULL,
  `i_o_30` int(255) DEFAULT NULL,
  `admin_archive` tinyint(1) DEFAULT 1,
  `faculty_archive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_report_ins`
--

INSERT INTO `class_report_ins` (`report_ins_id`, `admin_id`, `faculty_id`, `i_lec_2`, `i_rtw_2`, `i_fup_2`, `i_anq_2`, `i_pq_2`, `i_mg_2`, `i_1o1_2`, `i_dv_2`, `i_w_2`, `i_o_2`, `i_lec_4`, `i_rtw_4`, `i_fup_4`, `i_anq_4`, `i_pq_4`, `i_mg_4`, `i_1o1_4`, `i_dv_4`, `i_w_4`, `i_o_4`, `i_lec_6`, `i_rtw_6`, `i_fup_6`, `i_anq_6`, `i_pq_6`, `i_mg_6`, `i_1o1_6`, `i_dv_6`, `i_w_6`, `i_o_6`, `i_lec_8`, `i_rtw_8`, `i_fup_8`, `i_anq_8`, `i_pq_8`, `i_mg_8`, `i_1o1_8`, `i_dv_8`, `i_w_8`, `i_o_8`, `i_lec_10`, `i_rtw_10`, `i_fup_10`, `i_anq_10`, `i_pq_10`, `i_mg_10`, `i_1o1_10`, `i_dv_10`, `i_w_10`, `i_o_10`, `i_lec_12`, `i_rtw_12`, `i_fup_12`, `i_anq_12`, `i_pq_12`, `i_mg_12`, `i_1o1_12`, `i_dv_12`, `i_w_12`, `i_o_12`, `i_lec_14`, `i_rtw_14`, `i_fup_14`, `i_anq_14`, `i_pq_14`, `i_mg_14`, `i_1o1_14`, `i_dv_14`, `i_w_14`, `i_o_14`, `i_lec_16`, `i_rtw_16`, `i_fup_16`, `i_anq_16`, `i_pq_16`, `i_mg_16`, `i_1o1_16`, `i_dv_16`, `i_w_16`, `i_o_16`, `i_lec_18`, `i_rtw_18`, `i_fup_18`, `i_anq_18`, `i_pq_18`, `i_mg_18`, `i_1o1_18`, `i_dv_18`, `i_w_18`, `i_o_18`, `i_lec_20`, `i_rtw_20`, `i_fup_20`, `i_anq_20`, `i_pq_20`, `i_mg_20`, `i_1o1_20`, `i_dv_20`, `i_w_20`, `i_o_20`, `i_lec_22`, `i_rtw_22`, `i_fup_22`, `i_anq_22`, `i_pq_22`, `i_mg_22`, `i_1o1_22`, `i_dv_22`, `i_w_22`, `i_o_22`, `i_lec_24`, `i_rtw_24`, `i_fup_24`, `i_anq_24`, `i_pq_24`, `i_mg_24`, `i_1o1_24`, `i_dv_24`, `i_w_24`, `i_o_24`, `i_lec_26`, `i_rtw_26`, `i_fup_26`, `i_anq_26`, `i_pq_26`, `i_mg_26`, `i_1o1_26`, `i_dv_26`, `i_w_26`, `i_o_26`, `i_lec_28`, `i_rtw_28`, `i_fup_28`, `i_anq_28`, `i_pq_28`, `i_mg_28`, `i_1o1_28`, `i_dv_28`, `i_w_28`, `i_o_28`, `i_lec_30`, `i_rtw_30`, `i_fup_30`, `i_anq_30`, `i_pq_30`, `i_mg_30`, `i_1o1_30`, `i_dv_30`, `i_w_30`, `i_o_30`, `admin_archive`, `faculty_archive`) VALUES
(18, 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 0, 1, 0, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 0, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 1),
(20, 1, 2, 0, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 1, 0, 0, 1, 1, 1, 0, 1, 0, 0, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 0, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 0, 1, 1),
(23, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(25, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_report_stu`
--

CREATE TABLE `class_report_stu` (
  `report_stu_id` int(255) NOT NULL,
  `admin_id` int(255) NOT NULL,
  `faculty_id` int(255) NOT NULL,
  `s_l_2` int(255) DEFAULT NULL,
  `s_ind_2` int(255) DEFAULT NULL,
  `s_wg_2` int(255) DEFAULT NULL,
  `s_anq_2` int(255) DEFAULT NULL,
  `s_sq_2` int(255) DEFAULT NULL,
  `s_wc_2` int(255) DEFAULT NULL,
  `s_sp_2` int(255) DEFAULT NULL,
  `s_tq_2` int(255) DEFAULT NULL,
  `s_w_2` int(255) DEFAULT NULL,
  `s_o_2` int(255) DEFAULT NULL,
  `s_l_4` int(255) DEFAULT NULL,
  `s_ind_4` int(255) DEFAULT NULL,
  `s_wg_4` int(255) DEFAULT NULL,
  `s_anq_4` int(255) DEFAULT NULL,
  `s_sq_4` int(255) DEFAULT NULL,
  `s_wc_4` int(255) DEFAULT NULL,
  `s_sp_4` int(255) DEFAULT NULL,
  `s_tq_4` int(255) DEFAULT NULL,
  `s_w_4` int(255) DEFAULT NULL,
  `s_o_4` int(255) DEFAULT NULL,
  `s_l_6` int(255) DEFAULT NULL,
  `s_ind_6` int(255) DEFAULT NULL,
  `s_wg_6` int(255) DEFAULT NULL,
  `s_anq_6` int(255) DEFAULT NULL,
  `s_sq_6` int(255) DEFAULT NULL,
  `s_wc_6` int(255) DEFAULT NULL,
  `s_sp_6` int(255) DEFAULT NULL,
  `s_tq_6` int(255) DEFAULT NULL,
  `s_w_6` int(255) DEFAULT NULL,
  `s_o_6` int(255) DEFAULT NULL,
  `s_l_8` int(255) DEFAULT NULL,
  `s_ind_8` int(255) DEFAULT NULL,
  `s_wg_8` int(255) DEFAULT NULL,
  `s_anq_8` int(255) DEFAULT NULL,
  `s_sq_8` int(255) DEFAULT NULL,
  `s_wc_8` int(255) DEFAULT NULL,
  `s_sp_8` int(255) DEFAULT NULL,
  `s_tq_8` int(255) DEFAULT NULL,
  `s_w_8` int(255) DEFAULT NULL,
  `s_o_8` int(255) DEFAULT NULL,
  `s_l_10` int(255) DEFAULT NULL,
  `s_ind_10` int(255) DEFAULT NULL,
  `s_wg_10` int(255) DEFAULT NULL,
  `s_anq_10` int(255) DEFAULT NULL,
  `s_sq_10` int(255) DEFAULT NULL,
  `s_wc_10` int(255) DEFAULT NULL,
  `s_sp_10` int(255) DEFAULT NULL,
  `s_tq_10` int(255) DEFAULT NULL,
  `s_w_10` int(255) DEFAULT NULL,
  `s_o_10` int(255) DEFAULT NULL,
  `s_l_12` int(255) DEFAULT NULL,
  `s_ind_12` int(255) DEFAULT NULL,
  `s_wg_12` int(255) DEFAULT NULL,
  `s_anq_12` int(255) DEFAULT NULL,
  `s_sq_12` int(255) DEFAULT NULL,
  `s_wc_12` int(255) DEFAULT NULL,
  `s_sp_12` int(255) DEFAULT NULL,
  `s_tq_12` int(255) DEFAULT NULL,
  `s_w_12` int(255) DEFAULT NULL,
  `s_o_12` int(255) DEFAULT NULL,
  `s_l_14` int(255) DEFAULT NULL,
  `s_ind_14` int(255) DEFAULT NULL,
  `s_wg_14` int(255) DEFAULT NULL,
  `s_anq_14` int(255) DEFAULT NULL,
  `s_sq_14` int(255) DEFAULT NULL,
  `s_wc_14` int(255) DEFAULT NULL,
  `s_sp_14` int(255) DEFAULT NULL,
  `s_tq_14` int(255) DEFAULT NULL,
  `s_w_14` int(255) DEFAULT NULL,
  `s_o_14` int(255) DEFAULT NULL,
  `s_l_16` int(255) DEFAULT NULL,
  `s_ind_16` int(255) DEFAULT NULL,
  `s_wg_16` int(255) DEFAULT NULL,
  `s_anq_16` int(255) DEFAULT NULL,
  `s_sq_16` int(255) DEFAULT NULL,
  `s_wc_16` int(255) DEFAULT NULL,
  `s_sp_16` int(255) DEFAULT NULL,
  `s_tq_16` int(255) DEFAULT NULL,
  `s_w_16` int(255) DEFAULT NULL,
  `s_o_16` int(255) DEFAULT NULL,
  `s_l_18` int(255) DEFAULT NULL,
  `s_ind_18` int(255) DEFAULT NULL,
  `s_wg_18` int(255) DEFAULT NULL,
  `s_anq_18` int(255) DEFAULT NULL,
  `s_sq_18` int(255) DEFAULT NULL,
  `s_wc_18` int(255) DEFAULT NULL,
  `s_sp_18` int(255) DEFAULT NULL,
  `s_tq_18` int(255) DEFAULT NULL,
  `s_w_18` int(255) DEFAULT NULL,
  `s_o_18` int(255) DEFAULT NULL,
  `s_l_20` int(255) DEFAULT NULL,
  `s_ind_20` int(255) DEFAULT NULL,
  `s_wg_20` int(255) DEFAULT NULL,
  `s_anq_20` int(255) DEFAULT NULL,
  `s_sq_20` int(255) DEFAULT NULL,
  `s_wc_20` int(255) DEFAULT NULL,
  `s_sp_20` int(255) DEFAULT NULL,
  `s_tq_20` int(255) DEFAULT NULL,
  `s_w_20` int(255) DEFAULT NULL,
  `s_o_20` int(255) DEFAULT NULL,
  `s_l_22` int(255) DEFAULT NULL,
  `s_ind_22` int(255) DEFAULT NULL,
  `s_wg_22` int(255) DEFAULT NULL,
  `s_anq_22` int(255) DEFAULT NULL,
  `s_sq_22` int(255) DEFAULT NULL,
  `s_wc_22` int(255) DEFAULT NULL,
  `s_sp_22` int(255) DEFAULT NULL,
  `s_tq_22` int(255) DEFAULT NULL,
  `s_w_22` int(255) DEFAULT NULL,
  `s_o_22` int(255) DEFAULT NULL,
  `s_l_24` int(255) DEFAULT NULL,
  `s_ind_24` int(255) DEFAULT NULL,
  `s_wg_24` int(255) DEFAULT NULL,
  `s_anq_24` int(255) DEFAULT NULL,
  `s_sq_24` int(255) DEFAULT NULL,
  `s_wc_24` int(255) DEFAULT NULL,
  `s_sp_24` int(255) DEFAULT NULL,
  `s_tq_24` int(255) DEFAULT NULL,
  `s_w_24` int(255) DEFAULT NULL,
  `s_o_24` int(255) DEFAULT NULL,
  `s_l_26` int(255) DEFAULT NULL,
  `s_ind_26` int(255) DEFAULT NULL,
  `s_wg_26` int(255) DEFAULT NULL,
  `s_anq_26` int(255) DEFAULT NULL,
  `s_sq_26` int(255) DEFAULT NULL,
  `s_wc_26` int(255) DEFAULT NULL,
  `s_sp_26` int(255) DEFAULT NULL,
  `s_tq_26` int(255) DEFAULT NULL,
  `s_w_26` int(255) DEFAULT NULL,
  `s_o_26` int(255) DEFAULT NULL,
  `s_l_28` int(255) DEFAULT NULL,
  `s_ind_28` int(255) DEFAULT NULL,
  `s_wg_28` int(255) DEFAULT NULL,
  `s_anq_28` int(255) DEFAULT NULL,
  `s_sq_28` int(255) DEFAULT NULL,
  `s_wc_28` int(255) DEFAULT NULL,
  `s_sp_28` int(255) DEFAULT NULL,
  `s_tq_28` int(255) DEFAULT NULL,
  `s_w_28` int(255) DEFAULT NULL,
  `s_o_28` int(255) DEFAULT NULL,
  `s_l_30` int(255) DEFAULT NULL,
  `s_ind_30` int(255) DEFAULT NULL,
  `s_wg_30` int(255) DEFAULT NULL,
  `s_anq_30` int(255) DEFAULT NULL,
  `s_sq_30` int(255) DEFAULT NULL,
  `s_wc_30` int(255) DEFAULT NULL,
  `s_sp_30` int(255) DEFAULT NULL,
  `s_tq_30` int(255) DEFAULT NULL,
  `s_w_30` int(255) DEFAULT NULL,
  `s_o_30` int(255) DEFAULT NULL,
  `admin_archive` tinyint(1) DEFAULT 1,
  `faculty_archive` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_report_stu`
--

INSERT INTO `class_report_stu` (`report_stu_id`, `admin_id`, `faculty_id`, `s_l_2`, `s_ind_2`, `s_wg_2`, `s_anq_2`, `s_sq_2`, `s_wc_2`, `s_sp_2`, `s_tq_2`, `s_w_2`, `s_o_2`, `s_l_4`, `s_ind_4`, `s_wg_4`, `s_anq_4`, `s_sq_4`, `s_wc_4`, `s_sp_4`, `s_tq_4`, `s_w_4`, `s_o_4`, `s_l_6`, `s_ind_6`, `s_wg_6`, `s_anq_6`, `s_sq_6`, `s_wc_6`, `s_sp_6`, `s_tq_6`, `s_w_6`, `s_o_6`, `s_l_8`, `s_ind_8`, `s_wg_8`, `s_anq_8`, `s_sq_8`, `s_wc_8`, `s_sp_8`, `s_tq_8`, `s_w_8`, `s_o_8`, `s_l_10`, `s_ind_10`, `s_wg_10`, `s_anq_10`, `s_sq_10`, `s_wc_10`, `s_sp_10`, `s_tq_10`, `s_w_10`, `s_o_10`, `s_l_12`, `s_ind_12`, `s_wg_12`, `s_anq_12`, `s_sq_12`, `s_wc_12`, `s_sp_12`, `s_tq_12`, `s_w_12`, `s_o_12`, `s_l_14`, `s_ind_14`, `s_wg_14`, `s_anq_14`, `s_sq_14`, `s_wc_14`, `s_sp_14`, `s_tq_14`, `s_w_14`, `s_o_14`, `s_l_16`, `s_ind_16`, `s_wg_16`, `s_anq_16`, `s_sq_16`, `s_wc_16`, `s_sp_16`, `s_tq_16`, `s_w_16`, `s_o_16`, `s_l_18`, `s_ind_18`, `s_wg_18`, `s_anq_18`, `s_sq_18`, `s_wc_18`, `s_sp_18`, `s_tq_18`, `s_w_18`, `s_o_18`, `s_l_20`, `s_ind_20`, `s_wg_20`, `s_anq_20`, `s_sq_20`, `s_wc_20`, `s_sp_20`, `s_tq_20`, `s_w_20`, `s_o_20`, `s_l_22`, `s_ind_22`, `s_wg_22`, `s_anq_22`, `s_sq_22`, `s_wc_22`, `s_sp_22`, `s_tq_22`, `s_w_22`, `s_o_22`, `s_l_24`, `s_ind_24`, `s_wg_24`, `s_anq_24`, `s_sq_24`, `s_wc_24`, `s_sp_24`, `s_tq_24`, `s_w_24`, `s_o_24`, `s_l_26`, `s_ind_26`, `s_wg_26`, `s_anq_26`, `s_sq_26`, `s_wc_26`, `s_sp_26`, `s_tq_26`, `s_w_26`, `s_o_26`, `s_l_28`, `s_ind_28`, `s_wg_28`, `s_anq_28`, `s_sq_28`, `s_wc_28`, `s_sp_28`, `s_tq_28`, `s_w_28`, `s_o_28`, `s_l_30`, `s_ind_30`, `s_wg_30`, `s_anq_30`, `s_sq_30`, `s_wc_30`, `s_sp_30`, `s_tq_30`, `s_w_30`, `s_o_30`, `admin_archive`, `faculty_archive`) VALUES
(18, 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 0, 0, 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 0, 1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, 1, 1, 0, 0, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 0, 1, 1, 0, 1, 0, 0, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 1, 1),
(20, 1, 2, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 0, 1, 1, 1, 0, 0, 0, 1, 0, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 0, 1, 1, 1, 1, 0, 1, 1),
(23, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(25, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 0, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 0, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Ryan Rain', 'Valeriano', 'valeriano@gmail.com', '12345'),
(2, 'Kristille Mae', 'Velasco', 'velasco@gmail.com', '1234567');

-- --------------------------------------------------------

--
-- Table structure for table `faculty_pic`
--

CREATE TABLE `faculty_pic` (
  `faculty_pic_id` int(255) NOT NULL,
  `id` int(255) NOT NULL,
  `faculty_pic_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(255) NOT NULL,
  `sub_code` varchar(255) NOT NULL,
  `sub_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `sub_code`, `sub_desc`) VALUES
(1, 'ITE 310', 'Capstone Project and Research 2'),
(2, 'ITE 305', 'Information Assurance and Security 2'),
(3, 'ITE 401', 'Platform Technologies'),
(4, 'ITE 382', 'Intelligent Systems'),
(5, 'ITE 301', 'Application Development and Emerging Technologies'),
(7, 'ITE 308', 'Web System and Technologies');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_pic`
--
ALTER TABLE `admin_pic`
  ADD PRIMARY KEY (`admin_pic_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `class_report_com`
--
ALTER TABLE `class_report_com`
  ADD PRIMARY KEY (`report_com_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `class_report_info`
--
ALTER TABLE `class_report_info`
  ADD PRIMARY KEY (`report_info_id`),
  ADD KEY `id` (`admin_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `class_report_ins`
--
ALTER TABLE `class_report_ins`
  ADD PRIMARY KEY (`report_ins_id`),
  ADD KEY `id` (`admin_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `class_report_stu`
--
ALTER TABLE `class_report_stu`
  ADD PRIMARY KEY (`report_stu_id`),
  ADD KEY `id` (`admin_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_pic`
--
ALTER TABLE `faculty_pic`
  ADD PRIMARY KEY (`faculty_pic_id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `admin_pic`
--
ALTER TABLE `admin_pic`
  MODIFY `admin_pic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `class_report_com`
--
ALTER TABLE `class_report_com`
  MODIFY `report_com_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_report_info`
--
ALTER TABLE `class_report_info`
  MODIFY `report_info_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_report_ins`
--
ALTER TABLE `class_report_ins`
  MODIFY `report_ins_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `class_report_stu`
--
ALTER TABLE `class_report_stu`
  MODIFY `report_stu_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `faculty_pic`
--
ALTER TABLE `faculty_pic`
  MODIFY `faculty_pic_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_pic`
--
ALTER TABLE `admin_pic`
  ADD CONSTRAINT `admin_pic_ibfk_1` FOREIGN KEY (`id`) REFERENCES `admin` (`id`);

--
-- Constraints for table `class_report_com`
--
ALTER TABLE `class_report_com`
  ADD CONSTRAINT `class_report_com_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `class_report_com_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `class_report_info`
--
ALTER TABLE `class_report_info`
  ADD CONSTRAINT `class_report_info_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `class_report_info_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `class_report_ins`
--
ALTER TABLE `class_report_ins`
  ADD CONSTRAINT `class_report_ins_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `class_report_ins_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `class_report_stu`
--
ALTER TABLE `class_report_stu`
  ADD CONSTRAINT `class_report_stu_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `class_report_stu_ibfk_2` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `faculty_pic`
--
ALTER TABLE `faculty_pic`
  ADD CONSTRAINT `faculty_pic_ibfk_1` FOREIGN KEY (`id`) REFERENCES `faculty` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
