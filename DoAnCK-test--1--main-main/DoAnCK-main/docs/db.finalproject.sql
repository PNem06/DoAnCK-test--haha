-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2026 at 07:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_finalassignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account`
--

CREATE TABLE `tbl_account` (
  `Account_ID` int(10) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `Role_ID` enum('member','author','author-member') NOT NULL DEFAULT 'member',
  `Mail` varchar(64) NOT NULL,
  `Tel` int(10) DEFAULT NULL,
  `Account_Img` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_actor`
--

CREATE TABLE `tbl_actor` (
  `Actor_ID` int(10) NOT NULL,
  `Actor_Name` varchar(64) NOT NULL,
  `Actor_Info` text DEFAULT NULL,
  `Actor_Social` varchar(225) DEFAULT NULL,
  `Character_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award`
--

CREATE TABLE `tbl_award` (
  `Award_ID` int(10) NOT NULL,
  `Award_Name` varchar(64) NOT NULL,
  `Award_Info` text DEFAULT NULL,
  `Award_Date` int(11) DEFAULT NULL,
  `Studio_ID` int(10) DEFAULT NULL,
  `Director_ID` int(10) DEFAULT NULL,
  `Actor_ID` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award-actor`
--

CREATE TABLE `tbl_award-actor` (
  `Award_ID` int(10) NOT NULL,
  `Actor_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award-studio`
--

CREATE TABLE `tbl_award-studio` (
  `Award_ID` int(10) NOT NULL,
  `Studio_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award_director`
--

CREATE TABLE `tbl_award_director` (
  `Award_ID` int(10) NOT NULL,
  `Director_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_character`
--

CREATE TABLE `tbl_character` (
  `Character_ID` int(10) NOT NULL,
  `Character_Name` varchar(32) NOT NULL,
  `Movie_ID` int(10) NOT NULL,
  `Actor_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `Comment_ID` int(16) NOT NULL,
  `Comment_Date` date NOT NULL,
  `Comment_Data` text NOT NULL,
  `Account_ID` int(10) NOT NULL,
  `New_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_director`
--

CREATE TABLE `tbl_director` (
  `Director_ID` int(10) NOT NULL,
  `Director_Name` varchar(64) NOT NULL,
  `Director_Info` text DEFAULT NULL,
  `Director_Social` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `Feedback_ID` int(16) NOT NULL,
  `Feedback_Date` date NOT NULL,
  `Feedback_Data` text NOT NULL,
  `Account_ID` int(10) NOT NULL,
  `Movie_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_genre`
--

CREATE TABLE `tbl_genre` (
  `Genre_ID` int(10) NOT NULL,
  `Genre_Name` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie`
--

CREATE TABLE `tbl_movie` (
  `Movie_ID` int(10) NOT NULL,
  `Movie_Title` varchar(128) NOT NULL,
  `Movie_Description` varchar(512) DEFAULT NULL,
  `Movie_Img` varchar(225) DEFAULT NULL,
  `Genre_ID` int(10) NOT NULL,
  `Movie_ReleaseDate` date DEFAULT NULL,
  `Movie_StreamingDate` date DEFAULT NULL,
  `Studio_ID` int(10) NOT NULL,
  `Director_ID` int(10) NOT NULL,
  `Actor_ID` int(10) NOT NULL,
  `Account_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie-director`
--

CREATE TABLE `tbl_movie-director` (
  `Movie_ID` int(10) NOT NULL,
  `Director_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie-genre`
--

CREATE TABLE `tbl_movie-genre` (
  `Movie_ID` int(10) NOT NULL,
  `Genre_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie-studio`
--

CREATE TABLE `tbl_movie-studio` (
  `Movie_ID` int(10) NOT NULL,
  `Studio_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_movie-watchlist`
--

CREATE TABLE `tbl_movie-watchlist` (
  `Movie_ID` int(10) NOT NULL,
  `Watchlist_ID` int(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_new`
--

CREATE TABLE `tbl_new` (
  `New_ID` int(10) NOT NULL,
  `New_Title` varchar(225) NOT NULL,
  `New_Description` text DEFAULT NULL,
  `New_Content` text NOT NULL,
  `New_Img` varchar(225) DEFAULT NULL,
  `New_PublishDate` date NOT NULL,
  `New_Status` enum('Under Review','Publish','Banned') NOT NULL DEFAULT 'Under Review',
  `Account_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_studio`
--

CREATE TABLE `tbl_studio` (
  `Studio_ID` int(10) NOT NULL,
  `Studio_Name` varchar(32) NOT NULL,
  `Studio_Info` varchar(225) DEFAULT NULL,
  `Studio_Social` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_watchlist`
--

CREATE TABLE `tbl_watchlist` (
  `Watchlist_ID` int(16) NOT NULL,
  `Watchlist_Name` varchar(64) NOT NULL,
  `Watchlist_Date` date NOT NULL,
  `Account_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account`
--
ALTER TABLE `tbl_account`
  ADD PRIMARY KEY (`Account_ID`);

--
-- Indexes for table `tbl_actor`
--
ALTER TABLE `tbl_actor`
  ADD PRIMARY KEY (`Actor_ID`),
  ADD KEY `FK_Character_ID` (`Character_ID`) USING BTREE;

--
-- Indexes for table `tbl_award`
--
ALTER TABLE `tbl_award`
  ADD PRIMARY KEY (`Award_ID`),
  ADD KEY `FK_Actor_ID` (`Actor_ID`) USING BTREE,
  ADD KEY `FK_Director_ID` (`Director_ID`) USING BTREE,
  ADD KEY `FK_Studio_ID` (`Studio_ID`) USING BTREE;

--
-- Indexes for table `tbl_award-actor`
--
ALTER TABLE `tbl_award-actor`
  ADD PRIMARY KEY (`Award_ID`,`Actor_ID`),
  ADD KEY `FK_Actor_ID` (`Actor_ID`) USING BTREE,
  ADD KEY `FK_Award_ID` (`Award_ID`) USING BTREE;

--
-- Indexes for table `tbl_award-studio`
--
ALTER TABLE `tbl_award-studio`
  ADD PRIMARY KEY (`Award_ID`,`Studio_ID`),
  ADD KEY `FK_Studio_ID` (`Studio_ID`) USING BTREE,
  ADD KEY `FK_Award_ID` (`Award_ID`) USING BTREE;

--
-- Indexes for table `tbl_award_director`
--
ALTER TABLE `tbl_award_director`
  ADD PRIMARY KEY (`Award_ID`,`Director_ID`),
  ADD KEY `FK_Director_ID` (`Director_ID`) USING BTREE,
  ADD KEY `FK_Award_ID` (`Award_ID`) USING BTREE;

--
-- Indexes for table `tbl_character`
--
ALTER TABLE `tbl_character`
  ADD PRIMARY KEY (`Character_ID`),
  ADD KEY `FK_Actor_ID` (`Actor_ID`) USING BTREE,
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD KEY `FK_New_ID` (`New_ID`) USING BTREE,
  ADD KEY `FK_Account_ID` (`Account_ID`) USING BTREE;

--
-- Indexes for table `tbl_director`
--
ALTER TABLE `tbl_director`
  ADD PRIMARY KEY (`Director_ID`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`Feedback_ID`),
  ADD UNIQUE KEY `FK_Account_ID` (`Account_ID`),
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  ADD PRIMARY KEY (`Genre_ID`);

--
-- Indexes for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  ADD PRIMARY KEY (`Movie_ID`),
  ADD KEY `FK_Account_ID` (`Account_ID`) USING BTREE,
  ADD KEY `FK_Actor_ID` (`Actor_ID`) USING BTREE,
  ADD KEY `FK_Director_ID` (`Director_ID`) USING BTREE,
  ADD KEY `FK_Studio_ID` (`Studio_ID`) USING BTREE,
  ADD KEY `FK_Genre_ID` (`Genre_ID`) USING BTREE;

--
-- Indexes for table `tbl_movie-director`
--
ALTER TABLE `tbl_movie-director`
  ADD PRIMARY KEY (`Movie_ID`,`Director_ID`),
  ADD KEY `FK_Director_ID` (`Director_ID`) USING BTREE,
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_movie-genre`
--
ALTER TABLE `tbl_movie-genre`
  ADD PRIMARY KEY (`Movie_ID`,`Genre_ID`),
  ADD KEY `FK_Genre_ID` (`Genre_ID`) USING BTREE,
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_movie-studio`
--
ALTER TABLE `tbl_movie-studio`
  ADD PRIMARY KEY (`Movie_ID`,`Studio_ID`),
  ADD KEY `FK_Studio_ID` (`Studio_ID`) USING BTREE,
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_movie-watchlist`
--
ALTER TABLE `tbl_movie-watchlist`
  ADD PRIMARY KEY (`Movie_ID`,`Watchlist_ID`),
  ADD KEY `FK_Watchlist_ID` (`Watchlist_ID`) USING BTREE,
  ADD KEY `FK_Movie_ID` (`Movie_ID`) USING BTREE;

--
-- Indexes for table `tbl_new`
--
ALTER TABLE `tbl_new`
  ADD PRIMARY KEY (`New_ID`),
  ADD KEY `FK_Account_Name` (`Account_ID`) USING BTREE;

--
-- Indexes for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  ADD PRIMARY KEY (`Studio_ID`);

--
-- Indexes for table `tbl_watchlist`
--
ALTER TABLE `tbl_watchlist`
  ADD PRIMARY KEY (`Watchlist_ID`),
  ADD KEY `FK_Account_ID` (`Account_ID`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account`
--
ALTER TABLE `tbl_account`
  MODIFY `Account_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_actor`
--
ALTER TABLE `tbl_actor`
  MODIFY `Actor_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_award`
--
ALTER TABLE `tbl_award`
  MODIFY `Award_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_character`
--
ALTER TABLE `tbl_character`
  MODIFY `Character_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `Comment_ID` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_director`
--
ALTER TABLE `tbl_director`
  MODIFY `Director_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `Feedback_ID` int(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_genre`
--
ALTER TABLE `tbl_genre`
  MODIFY `Genre_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  MODIFY `Movie_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_new`
--
ALTER TABLE `tbl_new`
  MODIFY `New_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_studio`
--
ALTER TABLE `tbl_studio`
  MODIFY `Studio_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_watchlist`
--
ALTER TABLE `tbl_watchlist`
  MODIFY `Watchlist_ID` int(16) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_award-actor`
--
ALTER TABLE `tbl_award-actor`
  ADD CONSTRAINT `fk_aa_actor` FOREIGN KEY (`Actor_ID`) REFERENCES `tbl_actor` (`Actor_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_aa_award` FOREIGN KEY (`Award_ID`) REFERENCES `tbl_award` (`Award_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_award-studio`
--
ALTER TABLE `tbl_award-studio`
  ADD CONSTRAINT `fk_as_award` FOREIGN KEY (`Award_ID`) REFERENCES `tbl_award` (`Award_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_as_studio` FOREIGN KEY (`Studio_ID`) REFERENCES `tbl_studio` (`Studio_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_award_director`
--
ALTER TABLE `tbl_award_director`
  ADD CONSTRAINT `fk_ad_award` FOREIGN KEY (`Award_ID`) REFERENCES `tbl_award` (`Award_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ad_director` FOREIGN KEY (`Director_ID`) REFERENCES `tbl_director` (`Director_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_character`
--
ALTER TABLE `tbl_character`
  ADD CONSTRAINT `fk_character_actor` FOREIGN KEY (`Actor_ID`) REFERENCES `tbl_actor` (`Actor_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_character_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD CONSTRAINT `fk_comment_account` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `fk_feedback_account` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_feedback_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_movie`
--
ALTER TABLE `tbl_movie`
  ADD CONSTRAINT `fk_movie_account` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_movie-director`
--
ALTER TABLE `tbl_movie-director`
  ADD CONSTRAINT `fk_md_director` FOREIGN KEY (`Director_ID`) REFERENCES `tbl_director` (`Director_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_md_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_movie-genre`
--
ALTER TABLE `tbl_movie-genre`
  ADD CONSTRAINT `fk_mg_genre` FOREIGN KEY (`Genre_ID`) REFERENCES `tbl_genre` (`Genre_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_mg_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_movie-studio`
--
ALTER TABLE `tbl_movie-studio`
  ADD CONSTRAINT `fk_ms_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_ms_studio` FOREIGN KEY (`Studio_ID`) REFERENCES `tbl_studio` (`Studio_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_movie-watchlist`
--
ALTER TABLE `tbl_movie-watchlist`
  ADD CONSTRAINT `fk_wlm_movie` FOREIGN KEY (`Movie_ID`) REFERENCES `tbl_movie` (`Movie_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_wlm_watchlist` FOREIGN KEY (`Watchlist_ID`) REFERENCES `tbl_watchlist` (`Watchlist_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_new`
--
ALTER TABLE `tbl_new`
  ADD CONSTRAINT `fk_new_account` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbl_watchlist`
--
ALTER TABLE `tbl_watchlist`
  ADD CONSTRAINT `fk_watchlist_account` FOREIGN KEY (`Account_ID`) REFERENCES `tbl_account` (`Account_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
