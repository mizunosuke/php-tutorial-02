-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2022 年 12 月 02 日 05:37
-- サーバのバージョン： 10.4.27-MariaDB
-- PHP のバージョン: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `newUser`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `mypageSetting`
--

CREATE TABLE `mypageSetting` (
  `nickname` varchar(25) NOT NULL,
  `area` varchar(150) NOT NULL,
  `favorite` varchar(150) NOT NULL,
  `prof_image` text NOT NULL,
  `introduction` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `mypageSetting`
--

INSERT INTO `mypageSetting` (`nickname`, `area`, `favorite`, `prof_image`, `introduction`) VALUES
('', '広島湾', '', '', 'F01BC8E0-8C49-4296-B773-BC15C5780961.jpeg'),
('ドラミドロ', '音戸の瀬戸', 'ジギング', 'F5E10BF8-6D8F-4935-A8C8-CC4DE474FC78.jpeg', '青物最高！！'),
('岸田文雄', '太田川', 'シーバス', '増税大好きです！\r\nよろしく！', 'F89AD323-CA63-45F5-85C7-61BD054E0D53.jpeg');

-- --------------------------------------------------------

--
-- テーブルの構造 `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- テーブルのデータのダンプ `user`
--

INSERT INTO `user` (`userid`, `name`, `email`, `password`) VALUES
(1, 'user01', 'aaaaa@gmail.com', '$2y$10$LY4WQG9EuAR0XB1xMRBQEOLZndV4THHYPcqolSQoHCVgLM2MCI/Oy'),
(2, 'user02', 'pppppp@gmail.com', '$2y$10$EfKrRHZF4DlzYYZ1uwDxEeAWRKRcJs6u0qEiEmBikOk6fr6tI5c7S'),
(3, 'user03', 'mimimimim@gmail.com', '$2y$10$iBYoRKNol03ztD2ZcLFXgu1rFXAKujvHqxxgg0ysOvu4NODQh8LYu'),
(4, 'user04', 'oooooo@gmail.com', '$2y$10$.ntxwMMvRMaSuSXA8GQY.O2gnxNOflJeRulhXRwzRizqA53AkSd6K'),
(5, 'user05', 'qqqqqq@gmail.com', '$2y$10$EZvlfJMmrEhQ3c2gOxgD7ueOVvuXy/584sUus5ZA3UxERU1mSnmlu'),
(6, 'user06', 'aaaaaa@gmail.com', '$2y$10$TwPptG8x8IPkOUfR/wn0oekwYiJ9hsj021sHA1ZKa/oIydlT4cCle'),
(7, 'user07', 'mizuki@gmail.com', '$2y$10$w92jGB9uCbj0fGqCQqG7Su/rycg3Sc2CoJJ0ktxbWKnkh5Z4/EYzK');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `mypageSetting`
--
ALTER TABLE `mypageSetting`
  ADD UNIQUE KEY `nickname` (`nickname`);

--
-- テーブルのインデックス `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
