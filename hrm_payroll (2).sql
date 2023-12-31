-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 02, 2023 at 08:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrm_payroll`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `date` date NOT NULL,
  `timeIn` datetime NOT NULL,
  `timeOut` datetime DEFAULT NULL,
  `overTime` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `approvel` varchar(255) DEFAULT NULL,
  `approvel_id` int(11) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL,
  `change_status` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `company_account` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `bank_type` varchar(100) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `routing_number` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banks`
--

INSERT INTO `banks` (`id`, `name`, `company_account`, `branch_name`, `bank_type`, `company_id`, `routing_number`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Brac', '1234567', 'Mirpur12', 'Commercial', 1, 'r001', NULL, NULL, NULL, '2023-07-16 03:58:48'),
(2, 'city', '11198745', 'Mirpur', 'Ecommerce', 11, 'eeer221', NULL, NULL, NULL, '2023-07-13 05:17:53'),
(3, 'DBBL', '41563123', 'asdhsecbhj', 'jdvweghfv', 1, 'e5513', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `short_name` varchar(30) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `address`, `phone`, `email`, `logo`, `short_name`, `is_active`, `created_by`, `created_date`, `updated_by`, `updated_date`, `updated_at`) VALUES
(7, '4axiz', '4axiz', 'Mirpur12', '0123654789', '4axiz@gmail.com', NULL, NULL, 1, NULL, NULL, NULL, NULL, '2023-07-18 23:48:20');

-- --------------------------------------------------------

--
-- Table structure for table `confirmattendances`
--

CREATE TABLE `confirmattendances` (
  `id` int(11) NOT NULL,
  `emId` int(11) NOT NULL,
  `month` varchar(50) DEFAULT NULL,
  `working_days` int(2) DEFAULT NULL,
  `present_days` int(2) DEFAULT NULL,
  `absent_days` int(2) DEFAULT NULL,
  `total_leave` int(2) DEFAULT NULL,
  `absent_reduce` int(2) DEFAULT NULL,
  `cl_deduction` int(2) DEFAULT NULL,
  `ml_deduction` int(2) DEFAULT NULL,
  `absent_for_early` int(2) DEFAULT NULL,
  `absent_for_late` int(2) DEFAULT NULL,
  `companyId` int(2) DEFAULT NULL,
  `holiday` int(2) DEFAULT NULL,
  `payable_days` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `dept_name` varchar(255) NOT NULL,
  `dept_short_name` varchar(50) DEFAULT NULL,
  `dep_description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dept_name`, `dept_short_name`, `dep_description`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(2, 'Computer Science & Engineering', 'CSE', 'cseeeee', NULL, NULL, '2023-07-19 00:03:00', NULL),
(3, 'BBA', 'BA', 'awer', NULL, NULL, '2023-07-13 04:25:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `desig_name` varchar(255) NOT NULL,
  `desig_description` text DEFAULT NULL,
  `desig_short_name` varchar(50) DEFAULT NULL,
  `desig_rank` int(11) DEFAULT NULL,
  `company_id` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `desig_name`, `desig_description`, `desig_short_name`, `desig_rank`, `company_id`, `created_by`, `created_date`, `updated_date`, `updated_by`, `updated_at`) VALUES
(1, 'test', 'test des', 'sm', 1, 1, NULL, NULL, NULL, NULL, '2023-07-13 03:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `fatherName` varchar(255) DEFAULT NULL,
  `motherName` varchar(255) DEFAULT NULL,
  `employeeId` varchar(50) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `department` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `sub_section` int(11) DEFAULT NULL,
  `designation` int(11) DEFAULT NULL,
  `shift` int(11) DEFAULT NULL,
  `joinDate` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `permanentAddress` text DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `salary` decimal(14,2) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `bloodGroup` varchar(30) DEFAULT NULL,
  `workerType` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `maritial_status` varchar(9) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `ot_rate` decimal(10,2) DEFAULT NULL,
  `key_skill` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `metarials` text DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `presentAddress` text DEFAULT NULL,
  `voterId` varchar(100) DEFAULT NULL,
  `voterImage` varchar(255) DEFAULT NULL,
  `weekend` varchar(30) DEFAULT NULL,
  `mark` decimal(10,2) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `religion` varchar(30) DEFAULT NULL,
  `confirmation` varchar(5) DEFAULT NULL,
  `home_phone` varchar(50) DEFAULT NULL,
  `office_phone` varchar(50) DEFAULT NULL,
  `office_tnt1` varchar(50) DEFAULT NULL,
  `office_tnt2` varchar(50) DEFAULT NULL,
  `office_tnt3` varchar(50) DEFAULT NULL,
  `tin_no` varchar(255) DEFAULT NULL,
  `bank_acct_no` varchar(100) DEFAULT NULL,
  `pabx` varchar(255) DEFAULT NULL,
  `serialNo` varchar(100) DEFAULT NULL,
  `meal_member_status` tinyint(2) DEFAULT NULL,
  `salary_unit` int(11) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `rank` tinyint(4) DEFAULT NULL,
  `bank_portion` decimal(14,2) DEFAULT NULL,
  `cash_portion` decimal(14,2) DEFAULT NULL,
  `salary_held_up` varchar(50) DEFAULT NULL,
  `one_punch` varchar(30) DEFAULT NULL,
  `distribution_type` varchar(30) DEFAULT NULL,
  `basic_percent` decimal(10,2) DEFAULT NULL,
  `house_rent_percent` decimal(10,2) DEFAULT NULL,
  `medical_percent` decimal(10,2) DEFAULT NULL,
  `e_category` varchar(100) DEFAULT NULL,
  `meal_deduction` varchar(10) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `first_approver_name` varchar(255) DEFAULT NULL,
  `second_approver_name` varchar(255) DEFAULT NULL,
  `third_approver_name` varchar(255) DEFAULT NULL,
  `fourth_approver_name` varchar(255) DEFAULT NULL,
  `shift_name` varchar(255) DEFAULT NULL,
  `bonus_type` varchar(30) DEFAULT NULL,
  `activationDate` date DEFAULT NULL,
  `is_approver` varchar(30) DEFAULT NULL,
  `bonus_held_up` varchar(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `fatherName`, `motherName`, `employeeId`, `gender`, `department`, `section`, `sub_section`, `designation`, `shift`, `joinDate`, `dob`, `phone`, `permanentAddress`, `company`, `salary`, `grade`, `bloodGroup`, `workerType`, `email`, `maritial_status`, `photo`, `resume`, `qualification`, `ot_rate`, `key_skill`, `note`, `metarials`, `status`, `presentAddress`, `voterId`, `voterImage`, `weekend`, `mark`, `nationality`, `religion`, `confirmation`, `home_phone`, `office_phone`, `office_tnt1`, `office_tnt2`, `office_tnt3`, `tin_no`, `bank_acct_no`, `pabx`, `serialNo`, `meal_member_status`, `salary_unit`, `bank_id`, `resign_date`, `reason`, `rank`, `bank_portion`, `cash_portion`, `salary_held_up`, `one_punch`, `distribution_type`, `basic_percent`, `house_rent_percent`, `medical_percent`, `e_category`, `meal_deduction`, `user_name`, `first_approver_name`, `second_approver_name`, `third_approver_name`, `fourth_approver_name`, `shift_name`, `bonus_type`, `activationDate`, `is_approver`, `bonus_held_up`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_active`) VALUES
(1, 'Tanvir', NULL, NULL, '1', 'Male', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '963214785', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 25000.00, 10000.00, 'no', NULL, 'fixed', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-08-01 06:17:47', 1),
(2, 'Hassan', NULL, NULL, '2', 'Male', 2, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '38', NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 0.00, 0.00, 'no', NULL, 'percent', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-31 04:21:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `employeesalaries`
--

CREATE TABLE `employeesalaries` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `Basic` decimal(10,2) DEFAULT NULL,
  `dearness_allow` decimal(10,2) DEFAULT NULL,
  `house_rent` decimal(10,2) DEFAULT NULL,
  `special_allow` decimal(10,2) DEFAULT NULL,
  `mobile_allow` decimal(10,2) DEFAULT NULL,
  `incentive_allow` decimal(10,2) DEFAULT NULL,
  `food_allow` decimal(10,2) DEFAULT NULL,
  `performance_allow` decimal(10,2) DEFAULT NULL,
  `ot_rate` decimal(10,2) DEFAULT NULL,
  `salaryGrad` int(11) DEFAULT NULL,
  `medical_allow` decimal(10,2) DEFAULT NULL,
  `attendance_bonus` int(11) DEFAULT NULL,
  `meal_deduction` decimal(10,2) DEFAULT NULL,
  `house_deduction` decimal(10,2) DEFAULT NULL,
  `transport_deduction` decimal(10,2) DEFAULT NULL,
  `TDS` decimal(10,2) DEFAULT NULL,
  `provident_fund` decimal(10,2) DEFAULT NULL,
  `benefit_value` varchar(255) DEFAULT NULL,
  `deduction_value` varchar(255) DEFAULT NULL,
  `HouseRent` decimal(10,2) DEFAULT NULL,
  `Medical` decimal(10,2) DEFAULT NULL,
  `Transport` decimal(10,2) DEFAULT NULL,
  `Others` int(11) DEFAULT NULL,
  `Lunch` decimal(10,2) DEFAULT NULL,
  `Stamp` decimal(10,2) DEFAULT NULL,
  `submit` varchar(50) DEFAULT NULL,
  `gross` decimal(10,2) DEFAULT NULL,
  `Tax` decimal(10,2) DEFAULT NULL,
  `net_gross` decimal(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `security_amount` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employeesalaries`
--

INSERT INTO `employeesalaries` (`id`, `employeeId`, `Basic`, `dearness_allow`, `house_rent`, `special_allow`, `mobile_allow`, `incentive_allow`, `food_allow`, `performance_allow`, `ot_rate`, `salaryGrad`, `medical_allow`, `attendance_bonus`, `meal_deduction`, `house_deduction`, `transport_deduction`, `TDS`, `provident_fund`, `benefit_value`, `deduction_value`, `HouseRent`, `Medical`, `Transport`, `Others`, `Lunch`, `Stamp`, `submit`, `gross`, `Tax`, `net_gross`, `status`, `approver_id`, `security_amount`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(11, 1, 15000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7500.00, 1500.00, 1000.00, 2000, NULL, 1500.00, NULL, 25000.00, 700.00, 8000.00, NULL, NULL, 3000, NULL, NULL, '2023-08-02 00:37:14', NULL),
(12, 2, 26.40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 13.20, 2.64, 1.76, 33, NULL, 49.00, NULL, 44.00, 7.00, 66.00, NULL, NULL, 31, NULL, NULL, '2023-08-01 06:25:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE `festivals` (
  `id` int(11) NOT NULL,
  `f_name` varchar(30) NOT NULL,
  `disbursement_date` date NOT NULL,
  `year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `halfleaves`
--

CREATE TABLE `halfleaves` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `day` tinyint(4) DEFAULT NULL,
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `category` varchar(150) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `the_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `day`, `startDate`, `endDate`, `category`, `remarks`, `company`, `the_date`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-07-29', '2023-07-29', 'Govt Holiday', NULL, NULL, '2023-07-29', NULL, NULL),
(2, 1, '2023-08-15', '2023-08-15', 'Govt Holiday', NULL, NULL, '2023-08-15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `increments`
--

CREATE TABLE `increments` (
  `id` int(11) NOT NULL,
  `emId` int(11) NOT NULL,
  `gross` int(11) DEFAULT NULL,
  `Basic` decimal(10,2) DEFAULT NULL,
  `HouseRent` decimal(10,2) DEFAULT NULL,
  `Medical` decimal(10,2) DEFAULT NULL,
  `Transport` decimal(10,2) DEFAULT NULL,
  `Others` decimal(10,2) DEFAULT NULL,
  `Stamp` decimal(10,2) DEFAULT NULL,
  `Tax` decimal(10,2) DEFAULT NULL,
  `increment_date` date DEFAULT NULL,
  `created_date` date DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `designation_to` int(11) DEFAULT NULL,
  `salary_increment_amount` decimal(10,2) DEFAULT NULL,
  `others_increment_amount` decimal(10,2) DEFAULT NULL,
  `net_gross` decimal(10,2) DEFAULT NULL,
  `bank_amount` decimal(10,2) DEFAULT NULL,
  `cash_amount` decimal(10,2) DEFAULT NULL,
  `effective_month` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_date` date DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `companyId` int(11) DEFAULT NULL,
  `total_increment_amount` decimal(10,2) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL,
  `effective_date` date DEFAULT NULL,
  `adjust_month` varchar(50) DEFAULT NULL,
  `reject_reason` text DEFAULT NULL,
  `first_approver_id` int(11) DEFAULT NULL,
  `second_approver_id` int(11) DEFAULT NULL,
  `third_approver_id` int(11) DEFAULT NULL,
  `fourth_approver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `startDateLeave` date NOT NULL,
  `endDateLeave` date NOT NULL,
  `leaveDay` decimal(4,2) NOT NULL,
  `remarks` text DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Pending',
  `year` int(4) DEFAULT NULL,
  `applicant_designation` int(11) DEFAULT NULL,
  `applicant_department` int(11) DEFAULT NULL,
  `leave_reason` text DEFAULT NULL,
  `applicant_address` text DEFAULT NULL,
  `applicant_contact_no` varchar(50) DEFAULT NULL,
  `applicant_name` varchar(255) DEFAULT NULL,
  `responsibility_name` varchar(255) DEFAULT NULL,
  `responsibilty_employee_id` int(11) DEFAULT NULL,
  `responsibilty_designation` int(11) DEFAULT NULL,
  `responsibility_contact_no` varchar(50) DEFAULT NULL,
  `appliedDate` date DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `medical_doc` varchar(255) DEFAULT NULL,
  `reject_reason` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `employeeId`, `leave_type`, `startDateLeave`, `endDateLeave`, `leaveDay`, `remarks`, `status`, `year`, `applicant_designation`, `applicant_department`, `leave_reason`, `applicant_address`, `applicant_contact_no`, `applicant_name`, `responsibility_name`, `responsibilty_employee_id`, `responsibilty_designation`, `responsibility_contact_no`, `appliedDate`, `approver_name`, `approver_id`, `medical_doc`, `reject_reason`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 1, 1, '2023-07-25', '2023-07-27', 3.00, '1', 'Pending', NULL, NULL, NULL, 'N/A', NULL, '01925532372', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 00:08:16'),
(2, 1, 2, '2023-07-31', '2023-07-31', 1.00, NULL, 'Pending', NULL, NULL, NULL, 'Null', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 00:09:09'),
(3, 1, 1, '2023-07-28', '2023-07-31', 3.00, NULL, 'Pending', NULL, NULL, NULL, 'Bolbo na', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-24 23:33:34'),
(4, 2, 4, '2023-07-26', '2023-08-05', 11.00, NULL, 'Pending', NULL, NULL, NULL, 'N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-25 00:09:27'),
(5, 1, 2, '2023-07-27', '2023-07-27', 1.00, NULL, NULL, NULL, NULL, NULL, 'assd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, 1, '2023-07-27', '2023-07-30', 2.00, NULL, NULL, NULL, NULL, NULL, 'ss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-07-30 22:42:21'),
(10, 2, 2, '2023-07-27', '2023-07-30', 2.00, NULL, NULL, NULL, NULL, NULL, 'qede', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `leavetypes`
--

CREATE TABLE `leavetypes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `allowedLeave` tinyint(2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leavetypes`
--

INSERT INTO `leavetypes` (`id`, `name`, `short_name`, `description`, `allowedLeave`, `created_by`, `created_at`, `updated_by`, `updated_at`, `is_active`) VALUES
(1, 'Casual Leave', 'CL', 'Descriptions', 10, NULL, NULL, NULL, '2023-07-18 03:55:38', 1),
(2, 'Personal Leave', 'PL', 'des', 10, NULL, NULL, NULL, NULL, 1),
(4, 'Sick Leave', 'SL', 'des', 10, NULL, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `movementregisterdeatials`
--

CREATE TABLE `movementregisterdeatials` (
  `id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `movement_id` int(11) DEFAULT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movementregisters`
--

CREATE TABLE `movementregisters` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT 'Pending',
  `approver_name` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL,
  `fromDate` date DEFAULT NULL,
  `toDate` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `task_status` varchar(100) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `reject_reason` text DEFAULT NULL,
  `first_approver_id` int(11) DEFAULT NULL,
  `second_approver_id` int(11) DEFAULT NULL,
  `third_approver_id` int(11) DEFAULT NULL,
  `fourth_approver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `salaryarrears`
--

CREATE TABLE `salaryarrears` (
  `id` int(11) NOT NULL,
  `emId` int(11) NOT NULL,
  `adjust_month` varchar(30) DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `companyId` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `payable_days` int(11) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salaryarrears`
--

INSERT INTO `salaryarrears` (`id`, `emId`, `adjust_month`, `amount`, `companyId`, `created_by`, `updated_by`, `created_at`, `updated_at`, `payable_days`, `status`, `approver_name`) VALUES
(1, 1, '2023-12', 10000, NULL, NULL, NULL, NULL, '2023-08-02 00:32:58', 10, NULL, NULL),
(2, 2, '2023-08', 30000, NULL, NULL, NULL, NULL, NULL, 30, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `department` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `section_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` int(11) NOT NULL,
  `shift` varchar(255) NOT NULL,
  `shiftCode` varchar(255) NOT NULL,
  `startTime` time(6) NOT NULL,
  `endTime` time(6) NOT NULL,
  `weekend` tinyint(1) NOT NULL DEFAULT 1,
  `toShift` tinyint(4) DEFAULT NULL,
  `intimeRange` time(6) DEFAULT NULL,
  `outtimeRange` time(6) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `shift`, `shiftCode`, `startTime`, `endTime`, `weekend`, `toShift`, `intimeRange`, `outtimeRange`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, 'day', 'd123345', '18:19:00.000000', '20:19:00.000000', 1, 10, '18:19:00.000000', '22:19:00.000000', NULL, NULL, '2023-07-16 03:19:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shortleaves`
--

CREATE TABLE `shortleaves` (
  `id` int(11) NOT NULL,
  `employeeId` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `approver_name` varchar(255) DEFAULT NULL,
  `approver_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subsections`
--

CREATE TABLE `subsections` (
  `id` int(11) NOT NULL,
  `section` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workprograms`
--

CREATE TABLE `workprograms` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `organization` int(11) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `concern_type` varchar(255) DEFAULT NULL,
  `concern_employee` int(11) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `creatd_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`,`code`);

--
-- Indexes for table `confirmattendances`
--
ALTER TABLE `confirmattendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employeesalaries`
--
ALTER TABLE `employeesalaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `increments`
--
ALTER TABLE `increments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leavetypes`
--
ALTER TABLE `leavetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movementregisterdeatials`
--
ALTER TABLE `movementregisterdeatials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movementregisters`
--
ALTER TABLE `movementregisters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `salaryarrears`
--
ALTER TABLE `salaryarrears`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`,`shiftCode`);

--
-- Indexes for table `shortleaves`
--
ALTER TABLE `shortleaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subsections`
--
ALTER TABLE `subsections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workprograms`
--
ALTER TABLE `workprograms`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `confirmattendances`
--
ALTER TABLE `confirmattendances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employeesalaries`
--
ALTER TABLE `employeesalaries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `increments`
--
ALTER TABLE `increments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leavetypes`
--
ALTER TABLE `leavetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movementregisterdeatials`
--
ALTER TABLE `movementregisterdeatials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `movementregisters`
--
ALTER TABLE `movementregisters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salaryarrears`
--
ALTER TABLE `salaryarrears`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shortleaves`
--
ALTER TABLE `shortleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subsections`
--
ALTER TABLE `subsections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workprograms`
--
ALTER TABLE `workprograms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
