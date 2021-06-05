-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2021-06-05 08:41:00
-- 伺服器版本： 10.4.18-MariaDB
-- PHP 版本： 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `finalproject`
--

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
(284, 0, 2, '2021-05-28 02:53:50', 'panpan', 'cute aniaml', 'cat or panda?\r\nchoose one', '::1', '60b05b3e4accb2.34932908.png'),
(287, 0, 1, '2021-05-28 04:16:33', 'panpan', 'which one?', 'breaking bad movie?\r\nor lionking ???', '::1', NULL),
(290, 287, 0, '2021-05-28 06:13:31', 'panpan', NULL, 'stop ok?', '::1', ''),
(291, 287, 0, '2021-05-28 06:14:07', 'panpan', NULL, 'what is wrong with you?', '::1', ''),
(293, 287, 0, '2021-05-28 06:14:11', 'panpan', NULL, 'where si it?', '::1', ''),
(299, 0, 5, '2021-05-28 06:37:56', 'panpan', 'panda ', 'memeforgod', '::1', NULL),
(300, 0, 1, '2021-05-28 07:06:46', 'panpan', 'beatiful', 'really!?', '::1', '60b09686a84e39.13024438.jpg'),
(301, 0, 1, '2021-05-28 07:28:33', 'panpan', 'panda', '美女', '::1', '60b09ba1c63c26.51570826.jpg'),
(306, 0, 5, '2021-05-28 08:04:59', 'panpan', 'WTF', 'what is wrong with you bro?', '::1', '60b0a42bea8c61.59287286.jpg'),
(307, 0, 4, '2021-05-28 08:07:37', 'panpan', 'nccu ', 'nice or not?', '::1', '60b0a4c9e2ca21.66628067.jpg'),
(308, 287, 0, '2021-05-29 03:19:25', 'pan', NULL, 'all ok oko ', '::1', NULL);

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
(13, 21, 20),
(15, 24, 21),
(16, 20, 24);

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
(20, 287, 'like'),
(20, 300, 'like'),
(20, 301, 'like'),
(21, 284, 'like'),
(21, 287, 'dislike');

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
  `image` text NOT NULL,
  `profile` text NOT NULL,
  `adminControl` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`id`, `username`, `realName`, `birth`, `age`, `password`, `image`, `profile`, `adminControl`) VALUES
(20, 'panpan', 'ncie', '2021-06-01', 3, '$2y$10$fWyb4cC5DrP.XRsAwR7wp..uZogmg9LEnxqDudRm0jHdycbYChvRa', '60b24dd3906f49.67143803.png', '0', 0),
(21, 'pan', 'smallpan', '2021-04-27', 21, '$2y$10$CUdelwU200xrRP8.7RlMFuqQlSt4KvpyZIB1siNiiDEy1T1saQngm', '60b1b2ab956774.31240332.jpg', '0', 0),
(24, 'gg', 'ggg', '2021-06-02', 2, '$2y$10$htYShpOaAsVe.IZNirsgTehJmw4DFr7oemteQqGlVpSchL7lAj2mi', '60ba2e9e4c8912.24408821.jpg', '', 0);

--
-- 已傾印資料表的索引
--

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `dz_board`
--
ALTER TABLE `dz_board`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `dz_thread`
--
ALTER TABLE `dz_thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=310;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `friend_request`
--
ALTER TABLE `friend_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
