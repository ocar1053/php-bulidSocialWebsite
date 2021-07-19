-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- 主機： localhost:3306
-- 產生時間： 2021 年 06 月 15 日 11:29
-- 伺服器版本： 10.3.16-MariaDB
-- PHP 版本： 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `id16525717_forum`
--

-- --------------------------------------------------------

--
-- 資料表結構 `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `nickname` varchar(512) NOT NULL,
  `msg` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_nopad_ci NOT NULL,
  `ip` varchar(64) NOT NULL,
  `pairid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `chat`
--

INSERT INTO `chat` (`id`, `time`, `nickname`, `msg`, `ip`, `pairid`) VALUES
(2, '2021-06-08 14:33:07', 'pan', 'dasdsa', '::1', 882),
(3, '2021-06-08 14:38:38', 'pan', 'asza', '::1', 882),
(4, '2021-06-08 14:48:11', 'panpan', 'kando', '::1', 1014),
(5, '2021-06-10 06:08:56', 'pan', 'sdfd', '::1', 882),
(6, '2021-06-10 06:10:05', 'pan', 'asdda', '::1', 882),
(7, '2021-06-10 06:11:19', 'pan', '安安', '::1', 882),
(8, '2021-06-10 06:11:26', 'pan', '^^', '::1', 882),
(9, '2021-06-10 06:12:27', 'pan', 'asd', '::1', 882),
(10, '2021-06-10 06:24:34', 'gg', 'asdsad', '::1', 1014),
(11, '2021-06-10 06:49:33', 'pjy', '1u3rhdfkjheswrf', '220.133.98.107', 1409),
(12, '2021-06-10 06:49:37', 'pan', 'waht the guvcl', '220.133.98.107', 1409),
(13, '2021-06-10 06:49:38', 'pjy', '幹你娘', '220.133.98.107', 1409),
(14, '2021-06-10 06:49:44', 'pjy', 'jriewrjoiwjerw', '220.133.98.107', 1409),
(15, '2021-06-10 06:49:44', 'pan', 'come on', '220.133.98.107', 1409),
(16, '2021-06-10 06:49:46', 'pjy', 'rewrjewrewrljlwrjlwerjlwer', '220.133.98.107', 1409),
(17, '2021-06-10 06:49:47', 'pan', 'fucxasjdlksa', '220.133.98.107', 1409),
(18, '2021-06-10 06:49:49', 'pjy', 'djfkdsf\\dsfd\\fdsw\\f\\ds', '220.133.98.107', 1409),
(19, '2021-06-10 06:49:51', 'pjy', 'jfkldjsfljsfljsdlfsd', '220.133.98.107', 1409),
(20, '2021-06-10 06:49:53', 'pjy', 'jsfkljsd', '220.133.98.107', 1409),
(21, '2021-06-10 06:49:55', 'pjy', 'djsklfjsl', '220.133.98.107', 1409),
(22, '2021-06-10 06:49:55', 'pjy', 'fsdkfjsdlfd', '220.133.98.107', 1409),
(23, '2021-06-10 06:49:56', 'pjy', 'sfdsfdsfds', '220.133.98.107', 1409),
(24, '2021-06-10 06:49:56', 'pjy', 'fds', '220.133.98.107', 1409),
(25, '2021-06-10 06:49:57', 'pjy', 'd', '220.133.98.107', 1409),
(26, '2021-06-10 06:49:57', 'pjy', 'df', '220.133.98.107', 1409),
(27, '2021-06-10 06:49:57', 'pjy', 'd', '220.133.98.107', 1409),
(28, '2021-06-10 06:49:57', 'pjy', 'd', '220.133.98.107', 1409),
(29, '2021-06-10 06:49:57', 'pjy', 'd', '220.133.98.107', 1409),
(30, '2021-06-10 06:49:57', 'pjy', 'd', '220.133.98.107', 1409),
(31, '2021-06-10 06:49:58', 'pjy', 'd', '220.133.98.107', 1409),
(32, '2021-06-10 06:49:58', 'pjy', 'd', '220.133.98.107', 1409),
(33, '2021-06-10 06:49:58', 'pjy', 'd', '220.133.98.107', 1409),
(34, '2021-06-10 06:49:58', 'pjy', 'd', '220.133.98.107', 1409),
(35, '2021-06-10 06:49:58', 'pjy', 'd', '220.133.98.107', 1409),
(36, '2021-06-10 06:49:59', 'pjy', 'd', '220.133.98.107', 1409),
(37, '2021-06-10 06:49:59', 'pjy', 'd', '220.133.98.107', 1409),
(38, '2021-06-10 06:49:59', 'pjy', 'd', '220.133.98.107', 1409),
(39, '2021-06-10 06:49:59', 'pjy', 'd', '220.133.98.107', 1409),
(40, '2021-06-10 06:50:00', 'pjy', 'd', '220.133.98.107', 1409),
(41, '2021-06-10 06:50:00', 'pjy', 'd', '220.133.98.107', 1409),
(42, '2021-06-10 06:50:01', 'pjy', 'd', '220.133.98.107', 1409),
(43, '2021-06-10 06:50:02', 'pjy', 'd', '220.133.98.107', 1409),
(44, '2021-06-10 06:50:03', 'pjy', 'd', '220.133.98.107', 1409),
(45, '2021-06-10 06:50:04', 'pjy', 'f', '220.133.98.107', 1409),
(46, '2021-06-10 06:50:05', 'pjy', 'we', '220.133.98.107', 1409),
(47, '2021-06-10 06:50:06', 'pjy', 'e', '220.133.98.107', 1409),
(48, '2021-06-10 06:50:07', 'pjy', 'e', '220.133.98.107', 1409),
(49, '2021-06-10 07:22:27', 'OUO', '...', '2001:b400:e2a8:1ccf:6052:fcd9:2074:b12f', 1463),
(50, '2021-06-10 07:22:27', 'pan', '安安', '220.133.98.107', 1463),
(51, '2021-06-10 07:23:08', 'pan', '甚麼時候要', '220.133.98.107', 1463),
(52, '2021-06-10 07:23:16', 'OUO', '?', '2001:b400:e2a8:1ccf:6052:fcd9:2074:b12f', 1463),
(53, '2021-06-10 07:23:28', 'pan', '幫你上課', '220.133.98.107', 1463),
(54, '2021-06-10 07:23:54', 'OUO', '不知道，老師還沒回', '2001:b400:e2a8:1ccf:6052:fcd9:2074:b12f', 1463),
(55, '2021-06-10 07:24:00', 'OUO', '我看今天晚上會不會練口說', '2001:b400:e2a8:1ccf:6052:fcd9:2074:b12f', 1463),
(56, '2021-06-10 07:24:08', 'OUO', '你這個聊天記錄會備份ㄇ', '2001:b400:e2a8:1ccf:6052:fcd9:2074:b12f', 1463),
(57, '2021-06-13 11:04:10', 'hsiaoyang', 'hello nice to meet you', '123.192.138.128', 1518),
(58, '2021-06-13 11:04:51', 'pan', 'hello~~~', '123.192.138.128', 1518),
(59, '2021-06-15 09:45:37', 'slmt', 'hi', '114.37.136.239', 3874),
(60, '2021-06-15 09:45:45', 'test2', 'wow', '114.37.136.239', 3874),
(61, '2021-06-15 09:45:51', 'slmt', '斯溝已!', '114.37.136.239', 3874);

-- --------------------------------------------------------

--
-- 資料表結構 `chatroomlist`
--

CREATE TABLE `chatroomlist` (
  `id` int(11) NOT NULL,
  `roomid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `chatroomlist`
--

INSERT INTO `chatroomlist` (`id`, `roomid`) VALUES
(2, 882),
(3, 1014),
(4, 1460),
(5, 1059),
(6, 1409),
(7, 1356),
(8, 1463),
(9, 1518),
(10, 3874);

-- --------------------------------------------------------

--
-- 資料表結構 `dz_board`
--

CREATE TABLE `dz_board` (
  `id` int(11) NOT NULL,
  `name` varchar(64) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `dz_board`
--

INSERT INTO `dz_board` (`id`, `name`) VALUES
(1, 'movie'),
(2, 'gossip'),
(3, 'joke\r\n'),
(4, 'school'),
(5, 'memes');

-- --------------------------------------------------------

--
-- 資料表結構 `dz_thread`
--

CREATE TABLE `dz_thread` (
  `id` int(11) NOT NULL,
  `root_thread_id` int(11) NOT NULL DEFAULT 0,
  `board_id` int(11) NOT NULL DEFAULT 0,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `username` varchar(32) CHARACTER SET utf8 DEFAULT NULL,
  `title` varchar(64) CHARACTER SET utf8 DEFAULT NULL,
  `content` varchar(1024) CHARACTER SET utf8 DEFAULT NULL,
  `ip` varchar(64) DEFAULT NULL,
  `fileupload` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `dz_thread`
--

INSERT INTO `dz_thread` (`id`, `root_thread_id`, `board_id`, `time`, `username`, `title`, `content`, `ip`, `fileupload`) VALUES
(312, 0, 4, '2021-06-10 06:14:35', 'pan', 'panda', 'asdasd', '::1', '60c1adcbeced49.06844497.jpg'),
(314, 312, 0, '2021-06-10 06:15:03', 'pan', NULL, 'aaa', '::1', NULL),
(315, 312, 0, '2021-06-10 06:15:06', 'pan', NULL, 'aa', '::1', NULL),
(316, 312, 0, '2021-06-10 06:15:09', 'pan', NULL, 'aa', '::1', NULL),
(317, 312, 0, '2021-06-10 06:15:13', 'pan', NULL, 'aa', '::1', NULL),
(318, 312, 0, '2021-06-10 06:15:17', 'pan', NULL, 'aa', '::1', NULL),
(319, 0, 2, '2021-06-10 06:27:54', 'gg', 'abcdsad', 'sadas', '::1', NULL),
(320, 319, 0, '2021-06-10 06:28:00', 'gg', NULL, 'aaaaaaaaaa', '::1', NULL),
(321, 0, 3, '2021-06-10 06:43:42', 'admin', 'panda', 'fds', '220.133.98.107', '60c1b49e8bc8b4.10709842.jpg'),
(324, 0, 3, '2021-06-10 06:48:05', 'pjy', '231', '2131', '220.133.98.107', '60c1b5a588b3c3.16352891.jpg'),
(325, 0, 1, '2021-06-13 08:34:24', 'aloha', '測試', '我更改內容了～', '123.192.138.128', '60c5c310a020b7.92621549.png'),
(328, 319, 0, '2021-06-13 10:04:53', 'pan', NULL, 'test', '140.119.97.22', NULL),
(329, 319, 0, '2021-06-13 10:06:02', 'pan', NULL, 'aaaaaaadsd', '140.119.97.22', NULL),
(330, 319, 0, '2021-06-13 10:06:52', 'pan', NULL, '編輯', '140.119.97.22', NULL),
(331, 0, 2, '2021-06-14 08:34:18', 'hsiaoyang', 'hello', 'hello', '123.192.138.128', '60c7148a57fd32.66141665.png'),
(334, 0, 1, '2021-06-14 15:34:05', 'TA', '<script>alert(\"OAO\");</script>', '<script>alert(\"OAO\");</script>', '106.105.103.145', NULL),
(336, 0, 3, '2021-06-14 15:46:38', 'TA', '測試', 'ＯＡＯ攻擊', '106.105.103.145', '60c779ded3c4f7.97503318.png'),
(337, 0, 3, '2021-06-15 07:59:10', 'slmt', 'Meow', 'Fine', '114.37.136.239', '60c85dcee693d4.93621010.jpg'),
(338, 337, 0, '2021-06-15 08:00:16', 'slmt', NULL, 'e', '114.37.136.239', NULL),
(339, 0, 3, '2021-06-15 08:00:34', 'slmt', 'Fine', 'It\'s fine', '114.37.136.239', '60c85e22c7cf90.81970087.jpg'),
(340, 0, 5, '2021-06-15 10:21:49', '123', '123', '123', '180.218.130.153', '60c87f3d2383f9.41069732.png'),
(341, 0, 1, '2021-06-15 10:35:00', 'pan', '<script>alert(\"OAO\");</script>', '<script>alert(\"OAO\");</script>\r\n', '220.133.98.107', NULL),
(342, 0, 1, '2021-06-15 11:03:51', 'classmate', '北野武', '大家喜歡北野武嗎', '123.110.215.91', NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `friends`
--

INSERT INTO `friends` (`id`, `user_one`, `user_two`) VALUES
(31, 20, 21),
(32, 24, 20),
(33, 24, 29),
(34, 24, 21),
(35, 31, 21),
(36, 21, 30),
(37, 32, 21),
(38, 21, 33),
(39, 41, 46);

-- --------------------------------------------------------

--
-- 資料表結構 `friend_request`
--

CREATE TABLE `friend_request` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `status` text NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `friend_request`
--

INSERT INTO `friend_request` (`id`, `sender`, `receiver`, `status`) VALUES
(56, 33, 32, 'pending'),
(57, 24, 33, 'pending'),
(58, 37, 20, 'pending'),
(60, 38, 39, 'pending'),
(61, 40, 38, 'pending'),
(62, 40, 39, 'pending'),
(63, 41, 24, 'pending'),
(65, 21, 46, 'pending'),
(66, 21, 42, 'pending'),
(67, 45, 44, 'pending');

-- --------------------------------------------------------

--
-- 資料表結構 `rating_info`
--

CREATE TABLE `rating_info` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `rating_info`
--

INSERT INTO `rating_info` (`user_id`, `post_id`, `rating_action`) VALUES
(1, 300, 'like'),
(2, 287, 'like'),
(2, 301, 'like'),
(20, 284, 'dislike'),
(20, 287, 'like'),
(20, 300, 'like'),
(20, 301, 'like'),
(20, 306, 'like'),
(21, 284, 'like'),
(21, 287, 'dislike'),
(21, 299, 'like'),
(21, 306, 'dislike'),
(21, 307, 'like'),
(21, 310, 'like'),
(21, 321, 'like'),
(21, 324, 'like'),
(21, 334, 'dislike'),
(21, 339, 'like'),
(21, 341, 'like'),
(24, 312, 'like'),
(31, 321, 'dislike'),
(33, 319, 'like'),
(33, 321, 'like'),
(33, 324, 'like'),
(33, 332, 'like'),
(40, 324, 'like'),
(40, 334, 'dislike'),
(41, 336, 'like'),
(41, 339, 'like'),
(48, 334, 'dislike'),
(49, 321, 'like'),
(49, 334, 'dislike'),
(49, 341, 'dislike'),
(50, 342, 'like');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `realName` varchar(255) NOT NULL,
  `birth` date DEFAULT NULL,
  `age` int(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` text NOT NULL DEFAULT '60c1a8a9bcba84.72114864.jpg',
  `adminControl` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `realName`, `birth`, `age`, `password`, `image`, `adminControl`) VALUES
(20, 'panpan', 'ncie', '2021-06-01', 3, '$2y$10$fWyb4cC5DrP.XRsAwR7wp..uZogmg9LEnxqDudRm0jHdycbYChvRa', '60b24dd3906f49.67143803.png', 0),
(21, 'pan', 'pandow', '2021-05-30', 5, '$2y$10$Bz8xMpBtcblWDmYFRy7AdunPCAUBs6AH225EpLSZZlmHsLkZD4pjG', '60c1a8a9bcba84.72114864.jpg', 0),
(24, 'gg', 'ggg', '2021-06-02', 2, '$2y$10$htYShpOaAsVe.IZNirsgTehJmw4DFr7oemteQqGlVpSchL7lAj2mi', '60ba2e9e4c8912.24408821.jpg', 0),
(29, 'qwe', 'ewqee', '2021-06-09', 1, '$2y$10$t7gJB7QgUTgDViy5uRPbvOJPnkgTsqmbcY8VCSpe2mvU/TwCPRZGK', '60b1b2ab956774.31240332.jpg', 0),
(30, 'admin', 'dsadasd', '2021-06-01', 4, '$2y$10$wCr1GnuyIRigSdOxrP1lAOZTUDNS/ojrZ67e3krTtAm55rCwNN/.q', '60b1b2ab956774.31240332.jpg', 0),
(31, 'pjy', 'PJY', '2021-06-06', 12321, '$2y$10$xoNvrhou4JJkafWdT/ckRuRB8kBPU9hPNrU1MU6CHCkWd6QjRjnIK', '60b1b2ab956774.31240332.jpg', 0),
(32, 'OUO', 'a', '2021-06-09', 5, '$2y$10$vLaLTyy8O5Rb9GX00y07keQx0ORi7tuPHj42MoqDEwHFxF7eLtm4K', '60c1be6c5a3319.25403823.jpeg', 0),
(33, 'hsiaoyang', 'hsiaoyangggggg', '2014-02-14', 7, '$2y$10$F9ctVj1JBTvWMXeU4Zhm5uvj1rEAnnkPdkI4w3ZQH6pVltQA2VxdG', '60c5c081a195d5.41723214.png', 0),
(34, 'aaaa', 'sss', '2021-06-21', 4, '$2y$10$ZuVDiT0BH/Qo.7BIDj8gGuWlEek60yyS3UTIAniBi1NQMZZ5fezMC', '60c1a8a9bcba84.72114864.jpg', 0),
(35, 'aaa', 'bbbb', '2021-06-14', 3, '$2y$10$D8iUsWBc/DYLPwWqLSNBrOeqGCl47KIg8zQgAxhRjdFYxtyAnhge2', '60c1a8a9bcba84.72114864.jpg', 0),
(36, 'aaaaaaaaaa', 'ocar', '2021-05-30', 2, '$2y$10$4ZvmfbyW3Zng.YE2FGwt6OmfyHkJRjNmZ3HHE7SiH4rqcOQdh0P7u', '60c1a8a9bcba84.72114864.jpg', 0),
(37, 'aloha', 'alohaaaa', '2019-07-04', 3, '$2y$10$vy4FIdW.ojpTrHpP4u/lrei4EaO/fV8q.hPlVrK.jDoiaRD84JjzW', '60c1a8a9bcba84.72114864.jpg', 0),
(38, 'TA', 'TA', '1998-08-27', 18, '$2y$10$pn8ppzcKCvYfywbE4tZm8.rlvxNh1/9qHJUqWzdjfq/5ITd9uYGc6', '60c1a8a9bcba84.72114864.jpg', 0),
(39, 'cc125487', 'cc', '2021-06-07', 3, '$2y$10$sYB.J4N/CSW2JD4CyTMRueBla2Uxa0zn1k6g21lz.3AHx8DdRkeGa', '60c1a8a9bcba84.72114864.jpg', 0),
(40, 'nojob', 'nojob', '2021-06-01', 10, '$2y$10$Zx2MsMVWaFdQNUGb0bQBMeRMeJH2a.iZaVUkolP0H5RFS7/EMGn6a', '60c1a8a9bcba84.72114864.jpg', 0),
(41, 'slmt', 'meow', '1992-07-20', 18, '$2y$10$m3uFhuN0dojxYQbc1JXTvOpZeTIX3kKM3jLeEzS4gQLpZnhX1otkO', '60c876ea506082.68970932.jpg', 0),
(42, 'abc', 'AMM', '2021-06-10', 1, '$2y$10$ZLqw.Y/SHAo9tZ3HWqO1juvroAysroRL832.4ccrgJIDF.vFyaSc2', '60c1a8a9bcba84.72114864.jpg', 0),
(43, 'test011', 'lili', '2021-06-10', 21, '$2y$10$eMsU3iMZo3UtkHKdv67kLOcKGEUwTrzGSnDG73ZNtk0qWzrL2zsWi', '60c1a8a9bcba84.72114864.jpg', 0),
(44, 'test01', 'lili', '2021-06-14', 21, '$2y$10$NfwpRb2UcefQbA1Lksn4kOA88.58Tj2aaiaAP7JqDyDM7Lt0..awK', '60c1a8a9bcba84.72114864.jpg', 0),
(45, 'haha', 'hayu', '2000-01-11', 21, '$2y$10$Amkf6T3yxjyoUevB9G.OHOxiNQE.BjhKpKjBf7qQpjEhPYQIVfwke', '60c1a8a9bcba84.72114864.jpg', 0),
(46, 'test2', 'Tester', '1992-07-20', 29, '$2y$10$N2660sHB348PuAZ/iSAdsej0rt6FPONEhuqSjbkpD40H6vdGKB.02', '60c1a8a9bcba84.72114864.jpg', 0),
(47, 'a', 'aaa', '2019-07-30', 2, '$2y$10$W4xRVfG.qU7nkn6YIqUYMuIcDtq5U48/5ciwxZvB5beo8DwuQUdC6', '60c1a8a9bcba84.72114864.jpg', 0),
(48, '123', 'abc', '2020-06-04', 1, '$2y$10$8/1KoZ8UJ36VLVgK.No79.mLdk9YVnr/wWFewU92XmlRG.SqtXc3i', '60c1a8a9bcba84.72114864.jpg', 0),
(49, 'xxxx', 'xxxx', '1999-03-19', 22, '$2y$10$zNmDz2rmTJsR0Jm5o7nF5uz.aUG1cSMTLjXGn/jYnXE2x0UlT.wsO', '60c1a8a9bcba84.72114864.jpg', 0),
(50, 'classmate', 'classmate', '2001-01-31', 20, '$2y$10$KJxSX3ri98z0NLB23LJhpOGh58gNcQWRPBLJLjX8sUz4AKEmRK/Ii', '60c1a8a9bcba84.72114864.jpg', 0);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `chatroomlist`
--
ALTER TABLE `chatroomlist`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `dz_board`
--
ALTER TABLE `dz_board`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `dz_thread`
--
ALTER TABLE `dz_thread`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `friend_request`
--
ALTER TABLE `friend_request`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `rating_info`
--
ALTER TABLE `rating_info`
  ADD UNIQUE KEY `UC_rating_info` (`user_id`,`post_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `chatroomlist`
--
ALTER TABLE `chatroomlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dz_board`
--
ALTER TABLE `dz_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dz_thread`
--
ALTER TABLE `dz_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=343;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
