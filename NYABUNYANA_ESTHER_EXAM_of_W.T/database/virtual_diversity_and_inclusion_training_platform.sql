-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2024 at 06:24 PM
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
-- Database: `virtual_diversity_and_inclusion_training_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendeefeedback`
--

CREATE TABLE `attendeefeedback` (
  `FeedbackID` int(11) NOT NULL,
  `AttendeeID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendeefeedback`
--

INSERT INTO `attendeefeedback` (`FeedbackID`, `AttendeeID`, `WorkshopID`, `Rating`, `Comments`) VALUES
(9, 6, 12, 5, 'Great workshop! Learned a lot.'),
(10, 7, 11, 4, 'Enjoyed the techniques demonstrated.'),
(11, 5, 9, 4, 'Very helpful for managing finances.'),
(12, 8, 10, 5, 'Excellent introduction to machine learning.');

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `AttendeeID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `RegistrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` enum('Registered','Attended','Cancelled') DEFAULT 'Registered'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendees`
--

INSERT INTO `attendees` (`AttendeeID`, `UserID`, `WorkshopID`, `RegistrationDate`, `Status`) VALUES
(5, 1, 10, '2024-05-22 15:03:02', 'Registered'),
(6, 5, 9, '2024-05-22 15:03:02', 'Registered'),
(7, 6, 11, '2024-05-22 15:03:02', 'Registered'),
(8, 4, 12, '2024-05-22 15:03:02', 'Registered');

-- --------------------------------------------------------

--
-- Table structure for table `diversityandinclusionresources`
--

CREATE TABLE `diversityandinclusionresources` (
  `ResourceID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Link` varchar(255) DEFAULT NULL,
  `UploadedBy` int(11) DEFAULT NULL,
  `UploadDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diversityandinclusionresources`
--

INSERT INTO `diversityandinclusionresources` (`ResourceID`, `Title`, `Description`, `Link`, `UploadedBy`, `UploadDate`) VALUES
(5, 'Guide to Inclusive Language', 'Learn about the importance of inclusive language and how to use it effectively.', 'https://example.com/inclusive-language-guide', 1, '0000-00-00 00:00:00'),
(6, 'Diversity in Tech Report', 'A comprehensive report on diversity trends in the tech industry.', 'https://example.com/diversity-tech-report', 4, '2024-05-22 15:03:48'),
(7, 'Gender Equality in the Workplace', 'Strategies for promoting gender equality and creating inclusive work environments.', 'https://example.com/gender-equality-workplace', 6, '2024-05-22 15:03:48'),
(8, 'Cultural Sensitivity Training Resources', 'Resources and materials for conducting cultural sensitivity training sessions.', 'https://example.com/cultural-sensitivity-training', 4, '2024-05-22 15:03:48');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `InstructorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `ExpertiseArea` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`InstructorID`, `UserID`, `Bio`, `ExpertiseArea`) VALUES
(13, 6, 'Experienced educator with a focus on programming and web development.', 'Computer Science'),
(14, 5, 'Passionate about art and design, with years of teaching experience.', 'Art & Design'),
(15, 1, 'Industry professional with expertise in finance and business management.', 'Finance'),
(16, 4, 'Tech enthusiast and educator specializing in data science and machine learning.', 'Data Science');

-- --------------------------------------------------------

--
-- Table structure for table `resourcecomments`
--

CREATE TABLE `resourcecomments` (
  `CommentID` int(11) NOT NULL,
  `ResourceID` int(11) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `CommentText` text DEFAULT NULL,
  `CommentDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resourcecomments`
--

INSERT INTO `resourcecomments` (`CommentID`, `ResourceID`, `UserID`, `CommentText`, `CommentDate`) VALUES
(17, 7, 6, 'This guide is very informative.', '2024-05-22 15:12:15'),
(18, 5, 1, 'Interesting insights on diversity in tech.', '2024-05-22 15:12:15'),
(19, 8, 5, 'Useful strategies for promoting gender equality.', '2024-05-22 15:12:15'),
(20, 6, 4, 'Helpful resources for cultural sensitivity training.', '2024-05-22 15:12:15');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `TopicID` int(11) NOT NULL,
  `TopicName` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`TopicID`, `TopicName`) VALUES
(2, 'Digital Art'),
(3, 'Financial Planning'),
(4, 'Machine Learning'),
(1, 'Web Development');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `creationdate` timestamp NOT NULL DEFAULT current_timestamp(),
  `activation_code` varchar(50) DEFAULT NULL,
  `is_activated` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `firstname`, `lastname`, `username`, `email`, `telephone`, `password`, `creationdate`, `activation_code`, `is_activated`) VALUES
(1, 'NYABUNYANA ', 'ESTHER', 'NYABUNYANA07', 'esther@gmail.com', '0788903506', '$2y$10$DHcfIm6BcVEhG5BUi0QVdOCj4PGCslNEN7O.itfaGij1D5q1rCG46', '2024-05-22 11:26:12', '66', 0),
(4, 'ESTHER', 'NY', 'Esther09', 'NYABUNYANA@gmail.com', '0785976635', '$2y$10$p9iIwQoD/qY0XELg56u0k.Zmm/jqTtHyV6.wTjPrZ8IlMLi0K7lw6', '2024-05-22 11:29:05', '7', 0),
(5, 'DIDAS', 'BIRIMIMANA', 'Didas07', 'birimimanad@gmail.com', '0788903506', '$2y$10$NGW449eYK5aZ9FxiO4Qsm.EZfS5LdUPfsFwRo7OaX/FeAjg3eZG76', '2024-05-22 11:30:13', '8', 0),
(6, 'byemveni', 'turikumwe', 'byemveni', 'turikbyemv@gmail.com', '0788903506', '$2y$10$kLfjOJjJ8zoWu3xg4RA/5Okyl/oj2mT7BXkMT1qXrxK9B7BLRapZG', '2024-05-22 15:00:41', '7654', 0);

-- --------------------------------------------------------

--
-- Table structure for table `workshopmaterials`
--

CREATE TABLE `workshopmaterials` (
  `WorkshopMaterialID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `MaterialName` varchar(100) DEFAULT NULL,
  `MaterialDescription` text DEFAULT NULL,
  `MaterialLink` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshopmaterials`
--

INSERT INTO `workshopmaterials` (`WorkshopMaterialID`, `WorkshopID`, `MaterialName`, `MaterialDescription`, `MaterialLink`) VALUES
(5, 10, 'HTML Basics', 'Introduction to HTML tags and syntax.', 'https://example.com/html-basics'),
(6, 12, 'Digital Brushes', 'Different types of digital brushes and their applications.', 'https://example.com/digital-brushes'),
(7, 11, 'Budgeting Worksheet', 'A template for personal budgeting.', 'https://example.com/budgeting-worksheet'),
(8, 9, 'Python Notebook', 'A Jupyter notebook with examples of machine learning algorithms.', 'https://example.com/python-notebook');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `WorkshopID` int(11) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `Description` text DEFAULT NULL,
  `Duration` int(11) DEFAULT NULL,
  `InstructorID` int(11) DEFAULT NULL,
  `Location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`WorkshopID`, `Title`, `Description`, `Duration`, `InstructorID`, `Location`) VALUES
(9, 'Introduction to Web Development', 'Learn the basics of HTML, CSS, and JavaScript.', 120, 15, 'Virtual'),
(10, 'Digital Painting Techniques', 'Explore advanced digital painting techniques using popular software.', 90, 16, 'Art Studio'),
(11, 'Financial Planning for Young Professionals', 'Tips and strategies for managing finances effectively.', 60, 15, 'Conference Room'),
(12, 'Machine Learning Fundamentals', 'An introductory workshop to machine learning algorithms.', 150, 13, 'Virtual');

-- --------------------------------------------------------

--
-- Table structure for table `workshoptopics`
--

CREATE TABLE `workshoptopics` (
  `WorkshopTopicID` int(11) NOT NULL,
  `WorkshopID` int(11) DEFAULT NULL,
  `TopicID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workshoptopics`
--

INSERT INTO `workshoptopics` (`WorkshopTopicID`, `WorkshopID`, `TopicID`) VALUES
(1, 10, 1),
(2, 12, 2),
(3, 11, 3),
(4, 9, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendeefeedback`
--
ALTER TABLE `attendeefeedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `AttendeeID` (`AttendeeID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`AttendeeID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `diversityandinclusionresources`
--
ALTER TABLE `diversityandinclusionresources`
  ADD PRIMARY KEY (`ResourceID`),
  ADD KEY `UploadedBy` (`UploadedBy`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`InstructorID`),
  ADD UNIQUE KEY `UserID` (`UserID`);

--
-- Indexes for table `resourcecomments`
--
ALTER TABLE `resourcecomments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `ResourceID` (`ResourceID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`TopicID`),
  ADD UNIQUE KEY `TopicName` (`TopicName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workshopmaterials`
--
ALTER TABLE `workshopmaterials`
  ADD PRIMARY KEY (`WorkshopMaterialID`),
  ADD KEY `WorkshopID` (`WorkshopID`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`WorkshopID`),
  ADD KEY `InstructorID` (`InstructorID`);

--
-- Indexes for table `workshoptopics`
--
ALTER TABLE `workshoptopics`
  ADD PRIMARY KEY (`WorkshopTopicID`),
  ADD KEY `WorkshopID` (`WorkshopID`),
  ADD KEY `TopicID` (`TopicID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendeefeedback`
--
ALTER TABLE `attendeefeedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `AttendeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `diversityandinclusionresources`
--
ALTER TABLE `diversityandinclusionresources`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `InstructorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `resourcecomments`
--
ALTER TABLE `resourcecomments`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `TopicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `workshopmaterials`
--
ALTER TABLE `workshopmaterials`
  MODIFY `WorkshopMaterialID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `WorkshopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `workshoptopics`
--
ALTER TABLE `workshoptopics`
  MODIFY `WorkshopTopicID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendeefeedback`
--
ALTER TABLE `attendeefeedback`
  ADD CONSTRAINT `attendeefeedback_ibfk_1` FOREIGN KEY (`AttendeeID`) REFERENCES `attendees` (`AttendeeID`),
  ADD CONSTRAINT `attendeefeedback_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `attendees`
--
ALTER TABLE `attendees`
  ADD CONSTRAINT `attendees_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `attendees_ibfk_2` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `diversityandinclusionresources`
--
ALTER TABLE `diversityandinclusionresources`
  ADD CONSTRAINT `diversityandinclusionresources_ibfk_1` FOREIGN KEY (`UploadedBy`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `instructors`
--
ALTER TABLE `instructors`
  ADD CONSTRAINT `instructors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `resourcecomments`
--
ALTER TABLE `resourcecomments`
  ADD CONSTRAINT `resourcecomments_ibfk_1` FOREIGN KEY (`ResourceID`) REFERENCES `diversityandinclusionresources` (`ResourceID`),
  ADD CONSTRAINT `resourcecomments_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `workshopmaterials`
--
ALTER TABLE `workshopmaterials`
  ADD CONSTRAINT `workshopmaterials_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`);

--
-- Constraints for table `workshops`
--
ALTER TABLE `workshops`
  ADD CONSTRAINT `workshops_ibfk_1` FOREIGN KEY (`InstructorID`) REFERENCES `instructors` (`InstructorID`);

--
-- Constraints for table `workshoptopics`
--
ALTER TABLE `workshoptopics`
  ADD CONSTRAINT `workshoptopics_ibfk_1` FOREIGN KEY (`WorkshopID`) REFERENCES `workshops` (`WorkshopID`),
  ADD CONSTRAINT `workshoptopics_ibfk_2` FOREIGN KEY (`TopicID`) REFERENCES `topics` (`TopicID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
