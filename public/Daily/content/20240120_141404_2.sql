-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2024 at 05:53 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `schoolideaux_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `staff_id` varchar(255) DEFAULT NULL,
  `sf_firstname` varchar(255) DEFAULT NULL,
  `sf_lastname` varchar(255) DEFAULT NULL,
  `sf_name` varchar(255) DEFAULT NULL,
  `sf_dob` date DEFAULT NULL,
  `sf_gender` varchar(255) DEFAULT NULL,
  `sf_email` varchar(255) DEFAULT NULL,
  `sf_religion` varchar(255) DEFAULT NULL,
  `sf_aadharno` varchar(255) DEFAULT NULL,
  `sf_bloodgroup` varchar(255) DEFAULT NULL,
  `sf_nationality` varchar(255) DEFAULT NULL,
  `sf_state` varchar(255) DEFAULT NULL,
  `sf_permanentaddress` varchar(255) DEFAULT NULL,
  `sf_presentaddress` varchar(255) DEFAULT NULL,
  `sf_fathername` varchar(255) DEFAULT NULL,
  `sf_fatheroccupation` varchar(255) DEFAULT NULL,
  `sf_mothername` varchar(255) DEFAULT NULL,
  `sf_motheroccupation` varchar(255) DEFAULT NULL,
  `sf_phone` varchar(255) DEFAULT NULL,
  `sf_qualification` varchar(255) DEFAULT NULL,
  `sf_experience` varchar(255) DEFAULT NULL,
  `sf_language` varchar(255) DEFAULT NULL,
  `sf_position` varchar(255) DEFAULT NULL,
  `sf_subject_taken` varchar(255) DEFAULT NULL,
  `sf_disabledperson` varchar(255) DEFAULT NULL,
  `sf_profile` varchar(255) DEFAULT NULL,
  `sf_image_path` varchar(255) DEFAULT NULL,
  `sf_classid` varchar(255) DEFAULT NULL,
  `sf_account_details` varchar(255) DEFAULT NULL,
  `sf_certificate` varchar(255) DEFAULT NULL,
  `sf_file_path` varchar(255) DEFAULT NULL,
  `login_id` varchar(255) DEFAULT NULL,
  `sf_joindate` date DEFAULT NULL,
  `sf_status` varchar(255) NOT NULL DEFAULT '1',
  `sf_delete` varchar(255) NOT NULL DEFAULT '1',
  `salary_status` varchar(255) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `staff_id`, `sf_firstname`, `sf_lastname`, `sf_name`, `sf_dob`, `sf_gender`, `sf_email`, `sf_religion`, `sf_aadharno`, `sf_bloodgroup`, `sf_nationality`, `sf_state`, `sf_permanentaddress`, `sf_presentaddress`, `sf_fathername`, `sf_fatheroccupation`, `sf_mothername`, `sf_motheroccupation`, `sf_phone`, `sf_qualification`, `sf_experience`, `sf_language`, `sf_position`, `sf_subject_taken`, `sf_disabledperson`, `sf_profile`, `sf_image_path`, `sf_classid`, `sf_account_details`, `sf_certificate`, `sf_file_path`, `login_id`, `sf_joindate`, `sf_status`, `sf_delete`, `salary_status`, `created_at`, `updated_at`) VALUES
(1, '1', 'sam', 'raja', 'sam raja', '2014-02-26', 'male', 'samraja@gmail.com', NULL, NULL, NULL, '13', NULL, 'rwterteytry', NULL, 'fdydyhfg', NULL, NULL, NULL, '9876543210', 'mhg', NULL, NULL, '1', 'English', NULL, NULL, '', NULL, NULL, NULL, NULL, '3', '2023-12-19', '1', '1', '1', '2023-12-19 09:47:20', '2023-12-19 09:50:30'),
(2, '2', 'Sujin', 'Christ', 'Sujin Christ', '2022-11-29', 'male', 'bala@gmail.com', NULL, NULL, NULL, '99', '24', 'ghjkljkl;jkl;j;l', NULL, 'eretyuyiop', NULL, NULL, NULL, '9876543211', '36', NULL, NULL, '1', 'English', NULL, '1703158018.sujin.jpg', 'staff/profile\\65842102abdf4.1703158018.sujin.jpg', NULL, NULL, NULL, NULL, '4', '2023-12-19', '1', '1', '1', '2023-12-19 09:52:08', '2023-12-21 11:26:58'),
(3, '3', 'Jerin', 'Anto', 'Jerin Anto', '2022-12-06', 'male', 'jerin@gmail.com', NULL, NULL, NULL, NULL, NULL, 'trhuyutyutyu', NULL, 'sgsgfhj', NULL, NULL, NULL, '1234567890', 'hj', NULL, NULL, '1', 'Tamil', NULL, '1703157967.jerin.jpg', 'staff/profile\\658420cfe5861.1703157967.jerin.jpg', NULL, NULL, NULL, '', '5', '2023-12-19', '1', '1', '1', '2023-12-19 09:53:23', '2023-12-27 08:16:17'),
(4, '4', 'hlo', 'hiii', 'hlo hiii', '2022-12-22', 'male', 'hlo@gmail.com', NULL, NULL, NULL, NULL, NULL, 'zxhjk', NULL, 'erdftghjk', NULL, NULL, NULL, '9445263569', 'BE', NULL, NULL, '1', 'Tamil', NULL, NULL, '', NULL, NULL, NULL, NULL, '6', '2023-12-23', '1', '1', '1', '2023-12-22 06:00:40', '2023-12-22 06:00:56'),
(5, '5', 'danger', 'hFGQF23lOk', 'danger hFGQF23lOk', '2022-12-23', 'male', 'z3vjk@klgv.com', 'uT7OZQMFD0', NULL, NULL, '99', NULL, 'MbX7SGk6JL', 'qGDe1eez6H', 'C7HIr50cIa', '9Ys9pwCCJU', 'Ic0CbR4VHV', 'eOhKzEIogx', '9636968552', 'vzNnaREiXU', 'wBFQtlcDTA', '4UkJaBvL29', '2', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-23', '1', '1', '1', '2023-12-23 09:00:16', '2023-12-23 09:00:16'),
(6, '6', 'zZsqyxyZuC', 'agmPL3Ocuf', 'zZsqyxyZuC agmPL3Ocuf', '2022-11-29', 'male', 'osjfg@t0aw.com', '7zcxKXZDOK', NULL, NULL, '99', NULL, 'Z3O0FuiAso', 'VWh2NMvYC7', 'cw9a8pb4MR', 'qp06MJnD5E', 'RHLBpSmBnV', 'rlPhC5ApHI', '385469', 'W3DBO2592b', 'lksxJ0H8Eb', '6cveCNyAsr', '2', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-11-28', '1', '1', '1', '2023-12-23 09:00:34', '2023-12-23 09:00:34'),
(7, '7', 'x8ICdhHe0v', 'h0f7w9s0gM', 'x8ICdhHe0v h0f7w9s0gM', '2022-12-23', 'female', '5ju2x@zywz.com', 'RA6cpT0H8W', NULL, NULL, '99', NULL, 'LEOmJoiKTV', 'wwd7Bm2Wg2', 'DXBF6S7b0M', 'St7CfzXhVu', '1X0ySMe5Zx', 'dQWTgyV3Mo', '298343', 'mufJDh3FeG', 'wxktpPhvci', '8iQWDfKDyw', '2', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-22', '1', '1', '1', '2023-12-23 09:00:59', '2023-12-23 09:00:59'),
(8, '8', 'saTYeOKHjZ', '87ZLtwciVJ', 'saTYeOKHjZ 87ZLtwciVJ', '2022-12-22', 'male', 'rmwni@utq1.com', 'eRmF2vU2WV', NULL, NULL, '99', NULL, 'mu4gnEoLxB', '7Z8IfJSBAO', '0orxnYuy7x', 'JoqNSb4xoQ', '9DWy8nw787', 'Rai61skCHm', '271214', 'HTWUKxTkY6', 'efDyRH4Ro9', 'qLX3R50o2R', '3', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-22', '1', '1', '1', '2023-12-23 09:01:25', '2023-12-23 09:01:25'),
(9, '9', 'gN6o5H8694', 'b6frvS6dXv', 'gN6o5H8694 b6frvS6dXv', '2022-12-22', 'male', 'xjxfw@s9rn.com', '2ILWEMLCzR', NULL, NULL, '99', NULL, 'ycaUE5J9Z8', 'HfGwVIw05j', 'Y7EmlrYxec', 'XYBOhidsIt', '3eoBHlMRWe', 'EPoG4jX9Qe', '303798', 'u327kZ0TFv', '5wlSHGitMQ', 'hzi3kjWMrZ', '3', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-29', '1', '1', '1', '2023-12-23 09:01:39', '2023-12-23 09:01:39'),
(10, '10', 'iKslBdb8vZ', 'TkFlfvYm9y', 'iKslBdb8vZ TkFlfvYm9y', '2022-12-09', 'male', 'mhxe7@vcvo.com', 'HPmyjq2Uat', NULL, NULL, '99', NULL, '471bXopSSr', '5X16zVdf1L', '9rUGzavh58', 'dQ2Q1pmacC', 'JHhbwKuFQC', 'VtiZTEFwsb', '075768', '8Wnk1YC2qC', 'dFtlk0l2Hy', 'sUHF7qpAdo', '3', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-23', '1', '1', '1', '2023-12-23 09:01:58', '2023-12-23 09:01:58'),
(11, '11', 'uCrUb6wDTn', 'fYYQAHn9sg', 'uCrUb6wDTn fYYQAHn9sg', '2022-12-23', 'male', 'lhcza@lmoe.com', 'LAvFzpvuGV', NULL, NULL, '99', NULL, 'KKSYkx04pM', 'ACqXDFVsfm', 'DLfOtDpqPv', 'uZL72OWUMm', 'Xruh8JINOR', 'uZ9BHE7mrP', '576854', 'oSX181eurQ', '01a9hraQDG', 'FuHrIPVqIY', '4', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-23', '1', '1', '1', '2023-12-23 09:02:18', '2023-12-23 09:02:18'),
(12, '12', 'O27aV97zE7', 'WPNoyN3jEJ', 'O27aV97zE7 WPNoyN3jEJ', '2022-12-22', 'female', 'ifvyw@yqis.com', 'XkjVyTSPGC', NULL, NULL, '99', NULL, 'oUtAx2xWaI', 'pSqcXzgJAL', 'uxJbRfYRfL', '7HMqCA66vA', '4PEGEghUNX', 'nkIhophgoE', '355041', 'tu1cWjh8xp', 'XnElFmFbu0', 'QU72i4Vu98', '4', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-29', '1', '1', '1', '2023-12-23 09:02:32', '2023-12-23 09:02:32'),
(13, '13', 'noOs4WQZB3', 'LVLHGqu3sq', 'noOs4WQZB3 LVLHGqu3sq', '2022-12-15', 'male', 'intbz@xjnz.com', 'fzcaH2Cqme', NULL, NULL, '99', NULL, 'mvZujlBzkz', 'VBBr0LEnIa', 'vLAaikTJ6s', 'sPWZ4yeib8', 'N0anN1TqMr', 'yFfbE2x5y7', '481155', 'bAnNwhLUB7', '95QmWOUesl', 'q0AVg1j3mC', '4', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-28', '1', '1', '1', '2023-12-23 09:02:44', '2023-12-23 09:02:44'),
(14, '14', '9GxkAlhUZs', 'ItKBVA7jCG', '9GxkAlhUZs ItKBVA7jCG', '2022-12-23', 'male', 'd95at@0cy5.com', 'FBym3Gy6RV', NULL, NULL, '99', NULL, 'hR5z4wnYFG', '1fQEMYsNBk', '7FUs3CQijC', 'BQvpfYUDKf', 'NXpDf5tEH4', 'cT5baRHWbn', '032807', 'TnNymblEIV', 'Z7jlo1TRmr', 'eXePeAsHlC', '4', NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, '2023-12-23', '1', '1', '1', '2023-12-23 09:19:40', '2023-12-23 09:19:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
