-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 28 2016 г., 14:51
-- Версия сервера: 5.6.24
-- Версия PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `Cost`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `timestamp`) VALUES
(1, 'пищевые продукты', '2016-01-26 19:11:42'),
(2, 'напитки', '2016-01-26 19:11:42'),
(3, 'лекарство', '2016-01-26 19:13:04'),
(4, 'косметика', '2016-01-26 19:13:04'),
(5, 'развлечения', '2016-01-26 19:13:31'),
(6, 'бытовая химия', '2016-01-26 19:13:31'),
(7, 'бытовые предметы', '2016-01-26 19:20:16'),
(8, 'другое', '2016-01-26 19:20:16');

-- --------------------------------------------------------

--
-- Структура таблицы `purchases_log`
--

CREATE TABLE IF NOT EXISTS `purchases_log` (
  `id` int(11) NOT NULL,
  `product` varchar(64) COLLATE utf8mb4_bin NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `shop` varchar(36) COLLATE utf8mb4_bin NOT NULL,
  `comment` text COLLATE utf8mb4_bin NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Дамп данных таблицы `purchases_log`
--

INSERT INTO `purchases_log` (`id`, `product`, `category_id`, `price`, `date`, `shop`, `comment`, `timestamp`) VALUES
(1, 'Мандарины', 1, '22.96', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:03:01'),
(2, 'Тесто листкове', 1, '22.99', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:03:19'),
(3, 'Молоко простоквашино', 1, '13.85', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:03:51'),
(4, 'Халва, 2шт', 1, '11.98', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:04:53'),
(5, 'Кефир, волошкове поле', 2, '11.85', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:05:33'),
(6, 'Чеснок', 1, '7.16', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:05:55'),
(7, 'Яйца', 1, '29.99', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:06:27'),
(8, 'Сыр вершковий', 1, '29.65', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:06:53'),
(9, 'Творог президент', 1, '28.99', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:07:15'),
(10, 'Хлеб ', 1, '5.33', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:07:37'),
(11, 'Сосиски ятрань', 1, '55.05', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:07:57'),
(12, 'Яблоки', 1, '8.81', '2016-01-20 13:03:57', 'Варус', '', '2016-01-22 15:08:11'),
(13, 'Вода', 2, '27.00', '2016-01-21 13:40:00', 'Курьер', '', '2016-01-22 15:09:11'),
(14, 'Молоко волошкове поле', 1, '11.95', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:10:05'),
(15, 'Клетчатка', 1, '12.20', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:10:36'),
(16, 'Шоколад миллениум', 1, '20.40', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:10:58'),
(17, 'Чай черный', 2, '14.30', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:11:23'),
(18, 'Мыло детское', 6, '5.05', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:11:47'),
(19, 'Морковь', 1, '2.59', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:13:01'),
(20, 'Хлеб ', 1, '10.35', '2016-01-22 11:51:32', 'АТБ', '', '2016-01-22 15:13:16'),
(21, 'Картошка', 1, '15.65', '2016-01-22 11:51:32', 'Базар', '', '2016-01-22 15:14:01'),
(22, 'Мандарины', 1, '18.87', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:30:31'),
(23, 'Лимоны', 1, '9.15', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:30:51'),
(24, 'Киндер сюрприз', 1, '23.47', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:31:08'),
(25, 'Кофе львовское', 2, '52.99', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:31:28'),
(26, 'Пудинг шоколадный', 1, '6.35', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:31:47'),
(27, 'Кетчуп Хайнц', 1, '36.31', '2016-01-23 16:00:00', 'Караван', '', '2016-01-23 19:32:12'),
(28, 'Чай липовый', 2, '16.18', '2016-01-23 00:00:00', 'Караван', '', '2016-01-23 19:33:04'),
(29, 'Энтерол Капсулы', 3, '142.30', '2016-01-23 00:00:00', 'Аптека варус', '', '2016-01-23 19:33:45'),
(30, 'Стейк телячий', 1, '46.35', '2016-01-23 00:00:00', 'Мясо магазин', '', '2016-01-23 19:44:33'),
(31, 'Боулинг', 5, '90.00', '2016-01-24 00:00:00', 'Панорама', '', '2016-01-24 17:13:12'),
(32, 'Обед в кафе', 5, '118.00', '2016-01-24 00:00:00', 'Гавинда', '', '2016-01-24 17:13:40'),
(33, 'Какао', 1, '41.00', '2016-01-24 00:00:00', 'Кофе лайф', '', '2016-01-24 17:14:12'),
(34, 'Конфеты органические', 1, '28.80', '2016-01-24 00:00:00', 'Вита Натура', '', '2016-01-24 17:14:53'),
(35, 'Пополнение счета', 8, '62.00', '2016-01-24 00:00:00', 'Киевстар', '', '2016-01-24 17:15:35'),
(36, 'Молоко волошкове поле', 1, '11.95', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:21:43'),
(37, 'Капуста квашеная ', 1, '22.40', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:22:12'),
(38, 'Апельсины', 1, '15.99', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:23:02'),
(39, 'Фасоль в томате', 1, '14.70', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:23:47'),
(40, 'Лук репчатый', 1, '7.99', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:24:40'),
(41, 'Буряк', 1, '1.53', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:25:07'),
(42, 'Сыр голландский', 1, '22.95', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:26:01'),
(43, 'Сыр вершковий', 1, '21.95', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:26:30'),
(44, 'Творог простоквашино', 1, '22.70', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:26:55'),
(45, 'Конфеты шарм', 1, '10.30', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:27:25'),
(46, 'Томатная паста чумак 2 шт', 1, '8.80', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:27:59'),
(47, 'Шоколад миллениум', 1, '20.40', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:28:24'),
(48, 'Торт вафельный', 1, '17.95', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:28:55'),
(49, 'Яйца ', 1, '23.90', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:29:16'),
(50, 'Вода моршинская', 2, '15.38', '2016-01-25 00:00:00', 'АТБ', '', '2016-01-25 14:30:17'),
(51, 'Шампунь Ив Роше', 4, '96.50', '2016-01-25 00:00:00', 'Интернет-магазин', '+7.50 за доставку на почту(включено)', '2016-01-25 14:31:19'),
(52, 'Сыворотка для волос', 4, '286.50', '2016-01-25 00:00:00', 'Интернет-магазин', '+7.50 за доставку(включено)', '2016-01-25 14:32:07'),
(53, 'Молоко волошкове поле', 1, '11.95', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:33:48'),
(54, 'Салфетки для стола', 7, '9.99', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:34:13'),
(55, 'Какао', 1, '16.99', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:34:57'),
(56, 'Туалетная бумага', 7, '13.79', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:37:04'),
(57, 'Лаваш на кефире', 1, '10.62', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:37:29'),
(58, 'Багет гречаный ', 1, '9.64', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:37:57'),
(59, 'Туалетная бумага простая', 7, '1.75', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:38:28'),
(60, 'Томаты консервированные ', 1, '17.99', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:39:09'),
(61, 'Оливки ', 1, '23.99', '2016-01-26 00:00:00', 'Варус', 'Акция', '2016-01-26 14:39:58'),
(62, 'Гранат ', 1, '14.00', '2016-01-26 00:00:00', 'Варус', '', '2016-01-26 14:40:13'),
(63, 'Спирт этиловый', 3, '18.80', '2016-01-26 00:00:00', 'Аптека не болей', '', '2016-01-26 14:41:30'),
(64, 'Угрин', 3, '25.20', '2016-01-26 00:00:00', 'Аптека не болей', '', '2016-01-26 14:41:43'),
(65, 'Пазл', 8, '131.00', '2016-01-26 00:00:00', 'Диволенд', '', '2016-01-26 14:42:12'),
(66, 'Вода', 2, '27.00', '2016-01-28 00:00:00', 'Курьер', '', '2016-01-28 13:28:18');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `purchases_log`
--
ALTER TABLE `purchases_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `purchases_log`
--
ALTER TABLE `purchases_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=67;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
