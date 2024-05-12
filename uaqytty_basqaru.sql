-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 12 2024 г., 18:12
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `uaqytty basqaru`
--

-- --------------------------------------------------------

--
-- Структура таблицы `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `classes`
--

INSERT INTO `classes` (`class_id`, `class_name`) VALUES
(1, '7A'),
(2, '7B'),
(3, '7C'),
(4, '7D'),
(5, '7E'),
(6, '7F'),
(7, '8A'),
(8, '8B'),
(9, '8C'),
(10, '8D'),
(11, '8E'),
(12, '9A'),
(13, '9B'),
(14, '9C'),
(15, '9D'),
(16, '9E'),
(17, '10A'),
(18, '10B'),
(19, '10C'),
(20, '10D'),
(21, '10E');

-- --------------------------------------------------------

--
-- Структура таблицы `meeting_requests`
--

CREATE TABLE `meeting_requests` (
  `meetID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `time_slot` varchar(20) DEFAULT NULL,
  `topic` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` enum('pending','confirmed','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `subgroup` int(11) DEFAULT NULL,
  `day` varchar(30) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `schedule`
--

INSERT INTO `schedule` (`id`, `class_id`, `subgroup`, `day`, `time_slot`, `subject_id`) VALUES
(353, 17, 1, 'Пн', '8:30 - 9:10', 8),
(354, 17, 1, 'Пн', '9:25 - 10:05', 8),
(355, 17, 1, 'Пн', '10:20 - 11:00', 1),
(356, 17, 1, 'Пн', '11:05 - 11:45', 1),
(357, 17, 1, 'Пн', '12:05 - 12:45', 12),
(358, 17, 1, 'Пн', '13:05 - 13:45', 12),
(359, 17, 1, 'Пн', '13:50 - 14:30', 9),
(360, 17, 1, 'Пн', '14:45 - 15:25', 9),
(361, 17, 1, 'Вт', '8:30 - 9:10', 14),
(362, 17, 1, 'Вт', '9:25 - 10:05', 14),
(363, 17, 1, 'Вт', '10:20 - 11:00', 5),
(364, 17, 1, 'Вт', '11:05 - 11:45', 5),
(365, 17, 1, 'Вт', '12:05 - 12:45', 3),
(366, 17, 1, 'Вт', '13:05 - 13:45', 3),
(367, 17, 1, 'Вт', '13:50 - 14:30', 13),
(368, 17, 1, 'Ср', '8:30 - 9:10', 1),
(369, 17, 1, 'Ср', '9:25 - 10:05', 1),
(370, 17, 1, 'Ср', '10:20 - 11:00', 4),
(371, 17, 1, 'Ср', '11:05 - 11:45', 4),
(372, 17, 1, 'Ср', '12:05 - 12:45', 2),
(373, 17, 1, 'Ср', '13:05 - 13:45', 2),
(374, 17, 1, 'Ср', '13:50 - 14:30', 6),
(375, 17, 1, 'Ср', '14:45 - 15:25', 6),
(376, 17, 1, 'Чт', '8:30 - 9:10', 1),
(377, 17, 1, 'Чт', '9:25 - 10:05', 1),
(378, 17, 1, 'Чт', '10:20 - 11:00', 4),
(379, 17, 1, 'Чт', '11:05 - 11:45', 4),
(380, 17, 1, 'Чт', '12:05 - 12:45', 5),
(381, 17, 1, 'Чт', '13:05 - 13:45', 7),
(382, 17, 1, 'Чт', '13:50 - 14:30', 11),
(383, 17, 1, 'Чт', '14:45 - 15:25', 11),
(384, 17, 1, 'Пт', '8:30 - 9:10', 7),
(385, 17, 1, 'Пт', '9:25 - 10:05', 7),
(386, 17, 1, 'Пт', '10:20 - 11:00', 2),
(387, 17, 1, 'Пт', '12:05 - 12:45', 6),
(388, 17, 1, 'Пт', '13:05 - 13:45', 10),
(389, 17, 1, 'Пт', '13:50 - 14:30', 10),
(390, 17, 1, 'Пт', '14:45 - 15:25', 3),
(406, 17, 1, 'Вт', '15:40 - 16:20', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `studID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subgroup` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`studID`, `userID`, `class_id`, `subgroup`) VALUES
(1, 10, 4, 2),
(2, 11, 4, 2),
(3, 12, 4, 1),
(4, 13, 5, 2),
(5, 23, 17, 1),
(6, 24, 17, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `student_schedule`
--

CREATE TABLE `student_schedule` (
  `scheduleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL,
  `subject` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `student_schedule`
--

INSERT INTO `student_schedule` (`scheduleID`, `userID`, `day`, `time_slot`, `subject`) VALUES
(1, 23, 'Пн', '8:30 - 9:10', 8),
(2, 24, 'Пн', '8:30 - 9:10', 8),
(3, 23, 'Пн', '9:25 - 10:05', 8),
(4, 24, 'Пн', '9:25 - 10:05', 8),
(5, 23, 'Пн', '10:20 - 11:00', 1),
(6, 24, 'Пн', '10:20 - 11:00', 1),
(7, 23, 'Пн', '11:05 - 11:45', 1),
(8, 24, 'Пн', '11:05 - 11:45', 1),
(9, 23, 'Пн', '12:05 - 12:45', 12),
(10, 24, 'Пн', '12:05 - 12:45', 12),
(11, 23, 'Пн', '13:05 - 13:45', 12),
(12, 24, 'Пн', '13:05 - 13:45', 12),
(13, 23, 'Пн', '13:50 - 14:30', 9),
(14, 24, 'Пн', '13:50 - 14:30', 9),
(15, 23, 'Пн', '14:45 - 15:25', 9),
(16, 24, 'Пн', '14:45 - 15:25', 9),
(17, 23, 'Вт', '8:30 - 9:10', 14),
(18, 24, 'Вт', '8:30 - 9:10', 14),
(19, 23, 'Вт', '9:25 - 10:05', 14),
(20, 24, 'Вт', '9:25 - 10:05', 14),
(21, 23, 'Вт', '10:20 - 11:00', 5),
(22, 24, 'Вт', '10:20 - 11:00', 5),
(23, 23, 'Вт', '11:05 - 11:45', 5),
(24, 24, 'Вт', '11:05 - 11:45', 5),
(25, 23, 'Вт', '12:05 - 12:45', 3),
(26, 24, 'Вт', '12:05 - 12:45', 3),
(27, 23, 'Вт', '13:05 - 13:45', 3),
(28, 24, 'Вт', '13:05 - 13:45', 3),
(29, 23, 'Вт', '13:50 - 14:30', 13),
(30, 24, 'Вт', '13:50 - 14:30', 13),
(31, 23, 'Ср', '8:30 - 9:10', 1),
(32, 24, 'Ср', '8:30 - 9:10', 1),
(33, 23, 'Ср', '9:25 - 10:05', 1),
(34, 24, 'Ср', '9:25 - 10:05', 1),
(35, 23, 'Ср', '10:20 - 11:00', 4),
(36, 24, 'Ср', '10:20 - 11:00', 4),
(37, 23, 'Ср', '11:05 - 11:45', 4),
(38, 24, 'Ср', '11:05 - 11:45', 4),
(39, 23, 'Ср', '12:05 - 12:45', 2),
(40, 24, 'Ср', '12:05 - 12:45', 2),
(41, 23, 'Ср', '13:05 - 13:45', 2),
(42, 24, 'Ср', '13:05 - 13:45', 2),
(43, 23, 'Ср', '13:50 - 14:30', 6),
(44, 24, 'Ср', '13:50 - 14:30', 6),
(45, 23, 'Ср', '14:45 - 15:25', 6),
(46, 24, 'Ср', '14:45 - 15:25', 6),
(47, 23, 'Чт', '8:30 - 9:10', 1),
(48, 24, 'Чт', '8:30 - 9:10', 1),
(49, 23, 'Чт', '9:25 - 10:05', 1),
(50, 24, 'Чт', '9:25 - 10:05', 1),
(51, 23, 'Чт', '10:20 - 11:00', 4),
(52, 24, 'Чт', '10:20 - 11:00', 4),
(53, 23, 'Чт', '11:05 - 11:45', 4),
(54, 24, 'Чт', '11:05 - 11:45', 4),
(55, 23, 'Чт', '12:05 - 12:45', 5),
(56, 24, 'Чт', '12:05 - 12:45', 5),
(57, 23, 'Чт', '13:05 - 13:45', 7),
(58, 24, 'Чт', '13:05 - 13:45', 7),
(59, 23, 'Чт', '13:50 - 14:30', 11),
(60, 24, 'Чт', '13:50 - 14:30', 11),
(61, 23, 'Чт', '14:45 - 15:25', 11),
(62, 24, 'Чт', '14:45 - 15:25', 11),
(63, 23, 'Пт', '8:30 - 9:10', 7),
(64, 24, 'Пт', '8:30 - 9:10', 7),
(65, 23, 'Пт', '9:25 - 10:05', 7),
(66, 24, 'Пт', '9:25 - 10:05', 7),
(67, 23, 'Пт', '10:20 - 11:00', 2),
(68, 24, 'Пт', '10:20 - 11:00', 2),
(69, 23, 'Пт', '12:05 - 12:45', 6),
(70, 24, 'Пт', '12:05 - 12:45', 6),
(71, 23, 'Пт', '13:05 - 13:45', 10),
(72, 24, 'Пт', '13:05 - 13:45', 10),
(73, 23, 'Пт', '13:50 - 14:30', 10),
(74, 24, 'Пт', '13:50 - 14:30', 10),
(75, 23, 'Пт', '14:45 - 15:25', 3),
(76, 24, 'Пт', '14:45 - 15:25', 3),
(77, 23, 'Пн', '8:30 - 9:10', 8),
(78, 24, 'Пн', '8:30 - 9:10', 8),
(79, 23, 'Пн', '9:25 - 10:05', 8),
(80, 24, 'Пн', '9:25 - 10:05', 8),
(81, 23, 'Пн', '10:20 - 11:00', 1),
(82, 24, 'Пн', '10:20 - 11:00', 1),
(83, 23, 'Пн', '11:05 - 11:45', 1),
(84, 24, 'Пн', '11:05 - 11:45', 1),
(85, 23, 'Пн', '12:05 - 12:45', 12),
(86, 24, 'Пн', '12:05 - 12:45', 12),
(87, 23, 'Пн', '13:05 - 13:45', 12),
(88, 24, 'Пн', '13:05 - 13:45', 12),
(89, 23, 'Пн', '13:50 - 14:30', 9),
(90, 24, 'Пн', '13:50 - 14:30', 9),
(91, 23, 'Пн', '14:45 - 15:25', 9),
(92, 24, 'Пн', '14:45 - 15:25', 9),
(93, 23, 'Вт', '8:30 - 9:10', 14),
(94, 24, 'Вт', '8:30 - 9:10', 14),
(95, 23, 'Вт', '9:25 - 10:05', 14),
(96, 24, 'Вт', '9:25 - 10:05', 14),
(97, 23, 'Вт', '10:20 - 11:00', 5),
(98, 24, 'Вт', '10:20 - 11:00', 5),
(99, 23, 'Вт', '11:05 - 11:45', 5),
(100, 24, 'Вт', '11:05 - 11:45', 5),
(101, 23, 'Вт', '12:05 - 12:45', 3),
(102, 24, 'Вт', '12:05 - 12:45', 3),
(103, 23, 'Вт', '13:05 - 13:45', 3),
(104, 24, 'Вт', '13:05 - 13:45', 3),
(105, 23, 'Вт', '13:50 - 14:30', 13),
(106, 24, 'Вт', '13:50 - 14:30', 13),
(107, 23, 'Вт', '15:40 - 16:20', 4),
(108, 24, 'Вт', '15:40 - 16:20', 4),
(109, 23, 'Ср', '8:30 - 9:10', 1),
(110, 24, 'Ср', '8:30 - 9:10', 1),
(111, 23, 'Ср', '9:25 - 10:05', 1),
(112, 24, 'Ср', '9:25 - 10:05', 1),
(113, 23, 'Ср', '10:20 - 11:00', 4),
(114, 24, 'Ср', '10:20 - 11:00', 4),
(115, 23, 'Ср', '11:05 - 11:45', 4),
(116, 24, 'Ср', '11:05 - 11:45', 4),
(117, 23, 'Ср', '12:05 - 12:45', 2),
(118, 24, 'Ср', '12:05 - 12:45', 2),
(119, 23, 'Ср', '13:05 - 13:45', 2),
(120, 24, 'Ср', '13:05 - 13:45', 2),
(121, 23, 'Ср', '13:50 - 14:30', 6),
(122, 24, 'Ср', '13:50 - 14:30', 6),
(123, 23, 'Ср', '14:45 - 15:25', 6),
(124, 24, 'Ср', '14:45 - 15:25', 6),
(125, 23, 'Чт', '8:30 - 9:10', 1),
(126, 24, 'Чт', '8:30 - 9:10', 1),
(127, 23, 'Чт', '9:25 - 10:05', 1),
(128, 24, 'Чт', '9:25 - 10:05', 1),
(129, 23, 'Чт', '10:20 - 11:00', 4),
(130, 24, 'Чт', '10:20 - 11:00', 4),
(131, 23, 'Чт', '11:05 - 11:45', 4),
(132, 24, 'Чт', '11:05 - 11:45', 4),
(133, 23, 'Чт', '12:05 - 12:45', 5),
(134, 24, 'Чт', '12:05 - 12:45', 5),
(135, 23, 'Чт', '13:05 - 13:45', 7),
(136, 24, 'Чт', '13:05 - 13:45', 7),
(137, 23, 'Чт', '13:50 - 14:30', 11),
(138, 24, 'Чт', '13:50 - 14:30', 11),
(139, 23, 'Чт', '14:45 - 15:25', 11),
(140, 24, 'Чт', '14:45 - 15:25', 11),
(141, 23, 'Пт', '8:30 - 9:10', 7),
(142, 24, 'Пт', '8:30 - 9:10', 7),
(143, 23, 'Пт', '9:25 - 10:05', 7),
(144, 24, 'Пт', '9:25 - 10:05', 7),
(145, 23, 'Пт', '10:20 - 11:00', 2),
(146, 24, 'Пт', '10:20 - 11:00', 2),
(147, 23, 'Пт', '12:05 - 12:45', 6),
(148, 24, 'Пт', '12:05 - 12:45', 6),
(149, 23, 'Пт', '13:05 - 13:45', 10),
(150, 24, 'Пт', '13:05 - 13:45', 10),
(151, 23, 'Пт', '13:50 - 14:30', 10),
(152, 24, 'Пт', '13:50 - 14:30', 10),
(153, 23, 'Пт', '14:45 - 15:25', 3),
(154, 24, 'Пт', '14:45 - 15:25', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Математика'),
(2, 'Русский язык'),
(3, 'Казахский язык'),
(4, 'Английский язык'),
(5, 'Физика'),
(6, 'Химия'),
(7, 'Биология'),
(8, 'Информатика'),
(9, 'География'),
(10, 'Искусство'),
(11, 'Литература'),
(12, 'История Казахстана'),
(13, 'Всемирная история'),
(14, 'Физкультура'),
(16, 'Программирование');

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `teachID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`teachID`, `userID`) VALUES
(6, 18),
(7, 19),
(9, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher_schedule`
--

CREATE TABLE `teacher_schedule` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subgroup` int(11) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `teacher_schedule`
--

INSERT INTO `teacher_schedule` (`id`, `userID`, `class_id`, `subgroup`, `day`, `time_slot`) VALUES
(140, 22, 16, 1, 'Пн', '9:25 - 10:05'),
(143, 22, 14, 1, 'Пн', '10:20 - 11:00'),
(144, 22, 20, 2, 'Пн', '12:05 - 12:45'),
(145, 22, 11, 1, 'Пн', '13:05 - 13:45'),
(146, 22, 21, 2, 'Пн', '13:50 - 14:30'),
(147, 22, 21, 2, 'Пн', '14:45 - 15:25'),
(148, 22, 15, 1, 'Вт', '13:50 - 14:30'),
(149, 22, 20, 2, 'Вт', '14:45 - 15:25'),
(150, 22, 20, 2, 'Вт', '15:40 - 16:20'),
(151, 22, 15, 1, 'Ср', '8:30 - 9:10'),
(152, 22, 15, 1, 'Ср', '9:25 - 10:05'),
(153, 22, 14, 1, 'Ср', '12:05 - 12:45'),
(154, 22, 14, 1, 'Ср', '13:05 - 13:45'),
(155, 22, 21, 2, 'Чт', '8:30 - 9:10'),
(156, 22, 11, 1, 'Чт', '10:20 - 11:00'),
(157, 22, 11, 1, 'Чт', '11:05 - 11:45'),
(158, 22, 16, 1, 'Чт', '13:50 - 14:30'),
(159, 22, 16, 1, 'Чт', '14:45 - 15:25');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userfullname` varchar(60) NOT NULL,
  `userpassword` varchar(30) NOT NULL,
  `userlogin` varchar(50) NOT NULL,
  `userstatus` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`userID`, `userfullname`, `userpassword`, `userlogin`, `userstatus`) VALUES
(4, 'Админ Админович', '1234567890', 'admin@kst.nis.edu.kz', 'admin'),
(10, 'Жетпісбай Айнұр', '111', 'zhetpisbay_a7022@kst.nis.edu.kz', 'student'),
(11, 'Бектенбергенова Дильназ', '123', 'bektenbergenova_d6090@kst.nis.edu.kz', 'student'),
(12, 'Алибек Молдагалиев', '123', 'moldagaliyev_a6082@kst.nis.edu.kz', 'student'),
(13, 'Мирамова Жанэлла', '111', 'miramova_zh91@kst.nis.edu.kz', 'student'),
(18, 'Шерцер Александр Иванович', '111', 'shertser_a@kst.nis.edu.kz', 'teacher'),
(19, 'Зеленов Борис Александрович', '111', 'zelenov_b@kst.nis.edu.kz', 'teacher'),
(22, 'Аубакиров Багдат Мейрамович', '111', 'aubakirov_b@kst.nis.edu.kz', 'teacher'),
(23, 'Аружан Ахметова', '111', 'user@kst.nis.edu.kz', 'student'),
(24, 'Диас Оспанов', '111', 'user2@kst.nis.edu.kz', 'student');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`);

--
-- Индексы таблицы `meeting_requests`
--
ALTER TABLE `meeting_requests`
  ADD PRIMARY KEY (`meetID`),
  ADD KEY `userID` (`userID`);

--
-- Индексы таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_schedule` (`class_id`,`subgroup`,`day`,`time_slot`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`studID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `class_id` (`class_id`);

--
-- Индексы таблицы `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD PRIMARY KEY (`scheduleID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `subject` (`subject`);

--
-- Индексы таблицы `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teachID`),
  ADD KEY `userID` (`userID`);

--
-- Индексы таблицы `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`,`day`,`time_slot`),
  ADD KEY `class_id` (`class_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `meeting_requests`
--
ALTER TABLE `meeting_requests`
  MODIFY `meetID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=430;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `studID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `student_schedule`
--
ALTER TABLE `student_schedule`
  MODIFY `scheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT для таблицы `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teachID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `meeting_requests`
--
ALTER TABLE `meeting_requests`
  ADD CONSTRAINT `meeting_requests_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ограничения внешнего ключа таблицы `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`);

--
-- Ограничения внешнего ключа таблицы `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`class_id`);

--
-- Ограничения внешнего ключа таблицы `student_schedule`
--
ALTER TABLE `student_schedule`
  ADD CONSTRAINT `student_schedule_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `students` (`userID`),
  ADD CONSTRAINT `student_schedule_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subject_id`);

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Ограничения внешнего ключа таблицы `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  ADD CONSTRAINT `teacher_schedule_ibfk_4` FOREIGN KEY (`userID`) REFERENCES `teachers` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
