-- --------------------------------------------------------
-- Хост:                         193.232.179.148
-- Версия сервера:               10.5.18-MariaDB-0+deb11u1 - Debian 11
-- Операционная система:         debian-linux-gnu
-- HeidiSQL Версия:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Дамп структуры базы данных redmine
DROP DATABASE IF EXISTS `redmine`;
CREATE DATABASE IF NOT EXISTS `redmine` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `redmine`;

-- Дамп структуры для таблица redmine.category_news
DROP TABLE IF EXISTS `category_news`;
CREATE TABLE IF NOT EXISTS `category_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы redmine.category_news: ~0 rows (приблизительно)

-- Дамп структуры для таблица redmine.comments
DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы redmine.comments: ~0 rows (приблизительно)

-- Дамп структуры для таблица redmine.labor_costs
DROP TABLE IF EXISTS `labor_costs`;
CREATE TABLE IF NOT EXISTS `labor_costs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `comment` text DEFAULT NULL,
  `time` varchar(50) NOT NULL,
  `task_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы redmine.labor_costs: ~0 rows (приблизительно)

-- Дамп структуры для таблица redmine.migration
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы redmine.migration: ~6 rows (приблизительно)
REPLACE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1685446304),
	('m130524_201442_init', 1685446306),
	('m190124_110200_add_verification_token_column_to_user_table', 1685446306),
	('m230504_182021_news', 1685446306),
	('m230506_131224_categoryNews', 1685446306),
	('m230506_134216_comments', 1685446306);

-- Дамп структуры для таблица redmine.news
DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `text` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `status` int(1) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `date_update` datetime DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы redmine.news: ~0 rows (приблизительно)

-- Дамп структуры для таблица redmine.task
DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `prioritet` int(11) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `text` text DEFAULT NULL,
  `ocenka_truda` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `readliness` int(2) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Дамп данных таблицы redmine.task: ~18 rows (приблизительно)
REPLACE INTO `task` (`id`, `name`, `status`, `prioritet`, `date_add`, `date_end`, `text`, `ocenka_truda`, `user_id`, `readliness`, `author_id`, `parent_id`) VALUES
	(19, 'Сделать вложенность задач (parent_id)', 5, 0, '2023-06-04 21:42:50', '2023-06-07 21:42:53', 'Сделать возможность вложить в задачу подзадачу', '', 3, NULL, 1, NULL),
	(20, 'Поменять ссылки в меню на правильные', 0, 0, '2023-06-04 21:46:47', '2023-06-07 21:46:49', 'Поменять ссылки в верхнем меню.', '', 4, NULL, 1, NULL),
	(21, 'Изменить шаблон в demo-spiker.ru', 0, 0, '2023-06-04 21:48:11', '2023-06-16 21:48:18', 'Сделать новый шаблон в demo-spiker.ru', '', 4, NULL, 1, NULL),
	(22, 'Список задач ', 5, 0, '2023-06-04 21:54:52', '2023-06-07 21:54:51', '1) вывести на главной и в users автора задачи и кому предназначается задача +\r\n2) Поправить (Приоритет) сделать выпадающий список массивом +\r\n3) Исправить название (id Пользователя)  переименовать на  (Исполнитель) +\r\n4) Переименовать (Оценка труда) на (время выполнения в часах) +\r\n5) Имя пользователя сделать на Русском - переименовать это в базе, в таблице users \r\nДоступ к базе -\r\nhttps://193.232.179.148:1501/hwiT0caeFehnaJS9/phpmyadmin/sql.php?server=1&db=redmine&table=user&pos=0\r\nЛогин: redmine\r\nпароль: vR9hI9qA5r', '', 3, NULL, 1, NULL),
	(23, 'Сделать возможность видеть редактирование задачи в общем списке задач для автора задачи и для исполнителя', 5, 0, '2023-06-04 22:25:58', '2023-06-07 22:26:22', 'Сделать возможность видеть редактирование задачи в общем списке задач для автора задачи и для исполнителя', '', 3, NULL, 1, NULL),
	(24, 'Сделать комментарии для задач', 0, 0, '2023-06-05 14:19:47', '2023-06-08 14:19:52', 'Сделать комментарии к задачам.\r\nВ таблице использовать эти поля\r\nid int 11\r\nuser_id int 11\r\ntext text\r\ndate_add datetime\r\n\r\n', NULL, 2, NULL, 1, NULL),
	(25, 'План 6.06- 10.06.2023', 1, 0, '2023-06-05 21:51:46', '2023-06-10 21:51:53', '', NULL, 3, NULL, 3, NULL),
	(26, 'Закрыть все контроллеры от гостей сайта', 0, 0, '2023-06-05 21:52:49', '2023-06-07 21:53:30', '', NULL, 3, NULL, 1, 25),
	(27, 'Поиск только своих задач в трудозатратах', 3, 0, NULL, NULL, 'Сделать поиск задач в трудозатратах и в родительских задачах, только свои.', NULL, 3, NULL, 3, 25),
	(28, 'Сделать сортировку на странице users и на главной в обратном порядке ', 3, 0, '2023-06-05 21:59:30', NULL, 'Сделать сортировку - новые и открытые сверху', NULL, 3, NULL, 3, NULL),
	(29, 'Сделать быстрый переход с задачи на трудозатраты', 3, 0, '2023-06-07 22:32:08', NULL, 'Сделать быстрый переход со страницы задачи ,на страницу трудозатрат, передать параметр id задачи Get  параметром', NULL, 3, 1, 3, NULL),
	(30, 'Уменьшить название задачи', 0, 0, NULL, NULL, 'Уменьшить название задачи на странице задачи', NULL, 4, NULL, 1, NULL),
	(31, 'Закомментировать надписи в подвале', 0, 0, '2023-06-05 22:50:50', NULL, 'Закомментировать надписи в подвале', NULL, 4, NULL, 1, NULL),
	(32, 'Разобраться с хлебными крошками', 0, 0, NULL, NULL, 'Разобраться с хлебными крошками, чтобы работали все переходы', NULL, 2, NULL, 1, NULL),
	(33, 'Убрать первую колонку в списке задач', 0, 0, '2023-06-05 22:12:50', NULL, 'Убрать первую колонку в списке задач', NULL, 2, NULL, 1, NULL),
	(34, 'Добавить в главное меню для зарегистрированных (создать задачу))', 0, 0, NULL, NULL, '', NULL, 2, NULL, 1, NULL),
	(35, 'Что-то не то с календарем, поправить', 1, 0, '2023-06-05 22:14:16', NULL, 'Обновление Задачу: Что-То Не То С Календарем, Поправить', NULL, 3, NULL, 3, 25),
	(36, 'Добавить к текстовым полям редактор', 0, 0, '2023-06-05 22:16:40', NULL, 'Добавить к текстовым полям редактор', NULL, 2, NULL, 1, NULL);

-- Дамп структуры для таблица redmine.user
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы redmine.user: ~7 rows (приблизительно)
REPLACE INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
	(1, 'admin', 'xRGAgdtqXukbaVkyMwSUuXxugXvl65GF', '$2y$13$WXcyVwrMRS29OvHEVkxsY./mWRAOhV8g0dBlobB2TNNhroWWQzlRa', NULL, 'web-spiker@mail.ru', 10, 1685446791, 1685446791, '_XRO60DJxYkEjMcQZPayyLZSYwjh9tah_1685446791'),
	(2, 'Дима', 'kMklF-5mhb60pc1uVitgwaNWRqSb4-CM', '$2y$13$c2/7PNQik4pWc6AP4s.A6OsDdQM/uUTyNo91Hpem3MeWZubJR5AQC', NULL, 'dmitriy@mail.ru', 10, 1685453127, 1685453127, 'Hdy1k_W-iSAen-nIDiuLTvPv1LCka-If_1685453127'),
	(3, 'Иван', 'jI44H2iFOhsJn3LiM-FdHuTwnFZKBkdb', '$2y$13$mh5ikIv2Y7oBWF2p8c/1GuBg0pdeZGIFcvNSN.RGElU396Qh0Grrq', NULL, 'vanguyrudskoy@gmail.com', 10, 1685903825, 1685903825, 'ZsWQdPJIcVv3eT0SBa51nDub27MqjuWp_1685903825'),
	(4, 'Александр', 'YrGk7aOZw983yJYWmcVKxLf2lUc44-bO', '$2y$13$wvLsLttBuNsP7ogc9M4/kO2CNXtJG6vQEbGI3bgxHyfAn5YpqGZym', NULL, 'alexandr@mail.ru', 10, 1685904223, 1685904223, 'N2YuJ0qXS-BkSPvAKHHyDcuYmbAadkwN_1685904223'),
	(5, 'Рифат', '5FhITIhLbky0JZ20kwhbd3dwEKrOtPaY', '$2y$13$UoIkSfPUl7XQlvulMT7H2.QCw66O7qO2RhJex5Aq2uR14gkNKgdAa', NULL, 'rifat@mail.ru', 9, 1685992338, 1685992338, 'kL3F-MkQwyiUx6Q6B-79PQSLmmSbEiuh_1685992338'),
	(6, 'grisha', 'iLoyKfuZTmRN5yZcnGAWjYvXlaIC4YOw', '$2y$13$uIcHLlV6FJQSwdmQkJm9DOcKFu7HtK/pZWu5U3sxQhgb/PvADmM72', NULL, 'grishavladimirov2009@gmail.com', 9, 1685993370, 1685993370, 'E3Lly22HlFQFxMdXUVIlwWS1pMnGloiY_1685993370'),
	(7, 'DEST', 'nupPk6eUjNcrZZZIUpQs7BE37k_INRLc', '$2y$13$fLyZMm6PEQI.6nMykRQspOxycUbemlfgDzjVXurGnQQ/VpgfhuYwa', NULL, 'destroyyy2022@gmail.com', 9, 1686035450, 1686035450, 'ih5DUKyWi35aVrZsYXQXlcB-kn8V1EZp_1686035450');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
