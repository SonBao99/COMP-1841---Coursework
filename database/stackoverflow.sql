-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 12:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stackoverflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `answer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `user_id`, `question_id`, `body`, `created_at`) VALUES
(10, 3, 35, 'hi\r\n', '2024-04-20 15:41:54'),
(19, 3, 72, 'Hi!', '2024-04-29 18:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `question_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `user_id`, `title`, `body`, `question_image`, `created_at`, `views`, `tag_id`) VALUES
(16, 4, 'The truth about love?', '5 Things you like about me? What are they?', 'images/question/Screenshot_20230301_012614.png', '2024-04-01 07:19:33', 6, 14),
(35, 4, 'Are there any way to make money fast?', 'List them all here', NULL, '2024-04-20 13:42:59', 6, 1),
(64, 3, 'How can I optimize my SQL queries for better performance?', 'I\'m struggling with slow database performance and need some tips on optimizing my SQL queries. Any suggestions?', NULL, '2024-04-21 06:47:00', 0, 1),
(65, 3, 'What are the best practices for securing a PHP web application?', 'I\'m developing a PHP-based web application and want to ensure it\'s secure against common vulnerabilities. What are the best practices I should follow?', NULL, '2024-04-21 06:47:00', 0, 3),
(66, 3, 'How do I deploy a Laravel application on AWS Elastic Beanstalk?', 'I\'ve developed a Laravel application and want to deploy it on AWS Elastic Beanstalk. Can someone provide a step-by-step guide or point me to relevant resources?', NULL, '2024-04-21 06:47:00', 1, 2),
(67, 4, 'How can I improve the speed of my Python script for data processing?', 'I have a Python script for data processing, but it\'s running slower than I\'d like. Are there any optimization techniques or libraries I can use to improve its speed?', NULL, '2024-04-21 06:47:00', 0, 3),
(68, 10, 'What are the advantages of using NoSQL databases over traditional SQL databases?', 'I\'m considering using a NoSQL database for my project, but I\'m not sure about the benefits compared to traditional SQL databases. Can someone explain the advantages?', NULL, '2024-04-21 06:47:00', 1, 3),
(69, 3, 'SQL', 'SQL', 'images/question/card.jpg', '2024-04-24 02:13:50', 1, 3),
(71, 3, 'Last Question ', 'This is COMP 1841', 'images/question/IMG_0035.JPG', '2024-04-29 16:52:41', 0, 17),
(72, 3, 'Hi everyone, my name is Son', 'This is COMP 1841', '../assets/img/question/WDRK6756.JPG', '2024-04-29 16:59:09', 97, 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `name`, `description`) VALUES
(1, 'SQL', 'Structured Query Language is a domain-specific language used in programming and designed for managing data held in a relational database management system, or for stream processing in a relational data stream management system.'),
(2, 'Language', 'Programming languages are formal languages comprising a set of instructions that produce various kinds of output. Programming languages are used in computer programming to implement algorithms.'),
(3, 'Security', 'Web application security refers to the process of securing web applications and web services against different security threats that exploit vulnerabilities in an application\'s code.'),
(4, 'AWS', 'Amazon Web Services (AWS) is a subsidiary of Amazon providing on-demand cloud computing platforms and APIs to individuals, companies, and governments, on a metered pay-as-you-go basis.'),
(13, 'Python', 'Python is a high-level programming language known for its simplicity and versatility. It\'s widely used in various domains, including web development, data analysis, artificial intelligence, and more.'),
(14, 'Laravel', 'Laravel is a popular PHP framework known for its elegant syntax and powerful features. It simplifies the development process and offers a wide range of tools for building modern web applications.'),
(16, 'Data Science', 'Data science involves extracting insights and knowledge from structured and unstructured data through various techniques, including statistical analysis, machine learning, data mining, and visualization.'),
(17, 'Web Development', 'Web development encompasses the tasks associated with developing websites and web applications. It includes frontend development, backend development, and server-side scripting.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `fullName` varchar(255) DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `twitterURL` varchar(255) DEFAULT NULL,
  `facebookURL` varchar(255) DEFAULT NULL,
  `instagramURL` varchar(255) DEFAULT NULL,
  `linkedinURL` varchar(255) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`, `fullName`, `jobTitle`, `about`, `company`, `country`, `address`, `phone`, `email`, `twitterURL`, `facebookURL`, `instagramURL`, `linkedinURL`, `profile_image`, `role_id`) VALUES
(3, 'helo321', '$2y$10$jsa8Ju/VeynS3ECnR7OQY.mH7O9UCNWNQFtwFv8xNlDWdHhrw0Fya', '2024-03-25 08:55:51', 'Dương Quỳnh Anh', 'CEO Kẻ Sặt', 'A Student', 'SonBit And QuinZin Enterprises', 'VietNam', 'Kẻ Sặt, Bình Giang, Hải Dương', '096 754 3821', 'qzin@example.com', 'https://twitter.com/#', 'https://facebook.com/#', 'https://instagram.com/#', 'https://linkedin.com/#', '../assets/img/profile/mywife.jpg', 1),
(4, 'hihi123', '$2y$10$hDB3YivNZZhjNfYF97i0zuYxWs.YJYRUKo0/q.pQtbONG1WXtOpw2', '2024-03-28 09:03:32', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'hei@email.com', NULL, NULL, NULL, NULL, NULL, 2),
(10, 'sunny89', '$2y$10$VsbG.KZw27pJLbZs3vpgCe39RUf3QMePGWWOIjObXDsPE/O9f6D16', '2024-04-21 06:47:00', 'Sunil Sharma', 'Software Engineer', 'Passionate about coding and exploring new technologies.', NULL, 'India', NULL, NULL, 'code@email.com', NULL, NULL, NULL, NULL, 'images/profile/default.jpg', 2),
(11, 'coder_girl', '$2y$10$VsbG.KZw27pJLbZs3vpgCe39RUf3QMePGWWOIjObXDsPE/O9f6D16', '2024-04-21 06:47:00', 'Emily Johnson', 'Full-stack Developer', 'Enthusiastic coder with a love for problem-solving and creative solutions.', NULL, 'United States', NULL, NULL, 'girl@email.com', NULL, NULL, NULL, NULL, 'images/profile/default.jpg', 2),
(12, 'tech_wiz', '$2y$10$VsbG.KZw27pJLbZs3vpgCe39RUf3QMePGWWOIjObXDsPE/O9f6D16', '2024-04-21 06:47:00', 'Alex Lee', 'Tech Lead', 'Experienced in leading development teams and architecting scalable solutions.', NULL, 'Canada', NULL, NULL, 'tech@email.com', NULL, NULL, NULL, NULL, 'images/profile/default.jpg', 2),
(13, 'data_ninja', '$2y$10$VsbG.KZw27pJLbZs3vpgCe39RUf3QMePGWWOIjObXDsPE/O9f6D16', '2024-04-21 06:47:00', 'Priya Patel', 'Data Scientist', 'Analyzing data to uncover insights and drive decision-making.', NULL, 'Australia', NULL, NULL, 'ninja@email.com', NULL, NULL, NULL, NULL, 'images/profile/default.jpg', 2),
(15, 'son123', '$2y$10$mMNqzcN9ykEEBrMq/vWA8enWLhgWoamO/IVpxyMfF8ZlnXcyeb/BO', '2024-04-21 12:00:17', 'Nguyễn Bảo Sơn', NULL, NULL, NULL, NULL, NULL, NULL, 'son@email.com', NULL, NULL, NULL, NULL, NULL, 2),
(17, 'hehiho123333', '$2y$10$7d9KLWNWDd9yISFh83F0iuMt4iIyhZG8kb0dxEF4Q3Uf54TsZFiRO', '2024-04-21 12:01:47', 'NBS', NULL, NULL, NULL, NULL, NULL, NULL, 'NBS@email.com', NULL, NULL, NULL, NULL, NULL, 2),
(19, '123123123', '$2y$10$zrnfZmRiPiaj59HaF.SmKOmEFmaBgYU8.7Nm790rqsJxw9NwTrIB2', '2024-04-21 12:03:25', 'NBS', NULL, NULL, NULL, NULL, NULL, NULL, 'NBS@email.com', NULL, NULL, NULL, NULL, NULL, 2),
(22, '1233321', '$2y$10$A9lWmuV.Th.aRFOskWhOder6BvpYFjpGPShNQrc.3jzEqI5TWDxcO', '2024-04-21 12:04:50', '123', NULL, NULL, NULL, NULL, NULL, NULL, '123@emial.com', NULL, NULL, NULL, NULL, NULL, 2),
(23, '12333212', '$2y$10$NNp62mYIr69jXgrYL4mxcuWeARcyYzNDFtqMsUkNqEI6kPM3l1Tgm', '2024-04-21 12:06:55', '123', NULL, NULL, NULL, NULL, NULL, NULL, '123@emial.com', NULL, NULL, NULL, NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `questions_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
