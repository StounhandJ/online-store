-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 17 2020 г., 08:52
-- Версия сервера: 5.7.30-33
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `cn61693_shope`
--

-- --------------------------------------------------------

--
-- Структура таблицы `goods`
--

CREATE TABLE IF NOT EXISTS `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0.0р',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facade` tinyint(1) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `goods`
--

INSERT INTO `goods` (`id`, `name`, `price`, `description`, `category`, `facade`, `img`) VALUES
(1, 'Шкаф', '32 500 р.', 'Очень хороший шкаф за свои деньги!', 'Шкафы', 1, 'e6fd2ead61acb7c0d95e8aec97170bc1'),
(20, 'Винтажный', '25 500 р.', 'Много текста, но еще не решил какого', 'Стулья', 0, '700e75d9b703ebae001b7bc825c61745'),
(21, 'Люкс кровать', '250 000 р.', 'Опять же много текста. Это все не я!!!', 'Кровати', 0, '37d5e007515065252b517c58ebdd422b'),
(23, 'Тестовы', '100 р.', 'Много тектсат оапоааащжэ', 'Стулья', 0, 'a475079b0604b0e55e2cff3e774196a9'),
(24, 'Тесте 2', '200 р.', 'Больше такого не будет', 'Стулья', 0, '75cb3df29f837b362d1bffdc806c6a72'),
(25, 'Не знаю', '34 500 р.', 'Все так говорят, а ты купи кровать', 'Кровати', 1, '9a390fe69c28abe337050175a601f2b7'),
(26, 'Тест Алина 1337', '100 500 р.', 'Красивая кроватб', 'Кровати', 0, 'a9dde99d7c71bde13d64654391bb3860'),
(27, 'Тест 9', '45 000 р.', 'Много букв', 'Кровати', 0, '799a0f8ac191d5c9a45cd4e2851ab9da'),
(31, 'Тест 82', '45 000 р.', 'Текст тут', 'Кровати', 0, '2531c512bedb1813b6e8f72cb4f7a689');

-- --------------------------------------------------------

--
-- Структура таблицы `info`
--

CREATE TABLE IF NOT EXISTS `info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `info`
--

INSERT INTO `info` (`id`, `name`, `text`) VALUES
(1, 'telephone', '89588056163'),
(2, 'email', '89588056163@mail.ru'),
(3, 'vk', 'https://vk.com/maksimka9952'),
(4, 'instagram', 'https://www.instagram.com'),
(5, 'montage', '<b>Сборка шкафа</b> <br>Шкаф из МДФ в ванную<br><br>Сборка шкафа подразумевает скрепление всех присаженных(просверленных) деталей изделия корпусной мебели, навешивание дверей. <br><br>В сборку шкафа не входит: - подвешивание; - выравнивание по уровню; крепление к стене.<br><br>Сборка новых и старых распашных шкафов и шкафов-купе с чертежами и без.<br><br> <br><br>Собираем корпусные шкафы и шкафы купе из ЛДСП, МДФ, массива дерева, фанеры, стекла.<br><br>Монтаж шкафа<br>Наполнение встроенного шкафа купе<br><br>Монтаж(установка) шкафа подразумевает скрепление всех деталей изделия корпусной и встроенной мебели, навешивание дверей, крепление к стене, полу и потолку, выравнивание в уровень, подгонка деталей под стены, пол и потолок, регулировка дверей после установки, установка ручек и прочей фурнитуры необходимой для эксплуатации.<br><br> <br><br>Устанавливаем новые и старые распашные и встроенные шкафы и шкафы-купе с чертежами и без.<br><br>Сборка кухни<br>Кухонные корпуса<br><br>Сборка кухни подразумевает сборку кухонных корпусов(тумб), навешевание дверей, без дальнешей установки и навески.<br><br>В сборку кухни не входит: - навеска тумб; - выравнивание по уровню; - крепление к стене.<br><br>Собираем новые и старые кухни с чертежами и без.<br><br> <br><br>Профессиональная сборка кухонь из ЛДСП, МДФ, массива дерева и фанеры<br><br>Монтаж кухонь<br>Кухонные корпуса, напольные и навесные<br><br>Монтаж(установка) кухни подразумевает скрепление всех присаженных(просверленных) деталей изделия корпусной и встроенной мебели, навешевание дверей, подвеска коробов(крепление к стене), при необходимости крепление полу и потолку, выравнивание в уровень, подгонка деталей под стены, пол и потолок, регулировка дверей после установки, установка ручек и прочей фурнитуры необходимой для эксплуатации, установка встроенной бытовой техники, установка столешницы. Работа под ключ.<br><br>Устанавливаем новые и старые кухонные гарнитуры из массива дерева, ЛДСП, МДФ и фанеры с чертежами и без<br><br>Сборка тумб<br>Тумба 3 ящика, мебель серии Сапсан<br><br>Сборка тумб. Собираем тумбы различного предназначения. Тумбы в ванную, в спальню, комоды, подвесные тумбы. Сборка тумбы из массива дерева, МДФ, ЛДСП, фанеры и стекла. Качественно, быстро и недорого от мебельщиков профессионалов.<br><br>Сборка - соединение всех деталей изделия до придания конечного результата.<br><br> <br><br>Собираем новые и старые тумбы с чертежами и без<br><br>Монтаж тумбы<br>Подвесная тумба для ванной комнаты<br><br>Монтаж тумб. Устанавливаем тумбы различного предназначения. Тумбы в ванную, в спальню, комоды, подвесные тумбы. Установка тумбы из массива дерева, МДФ, ЛДСП, фанеры и стекла. Качественно, быстро и недорого от мебельщиков профессионалов.<br><br>Монтаж собранной тумбы - подвешивание(часто в ванной), крепление тумбы к стене, выравнивание по уровню.<br><br> <br><br>Сборка мягкой мебели<br>Сборка мягкой мебели<br><br>Сборка мягкой мебели различного назначения. Наши сборщики могут собрать для вас диван, кровать, кресло, пуфик, софу и другую мягкую мебель с профессиональным подходом. Качественно, быстро и недорого. Материал покрытия и декоративных деталей не важен.'),
(6, 'officeHours', '8:00 - 18:00'),
(7, 'descriptionProduct', '{name} на заказа по размеру и выбранному цвету. В Москве изготовление под заказ мебели с доставкой'),
(8, 'descriptionMaterial', 'Выбор материалов для мебели под заказ. Список доступных материалов для фасадов и корпуса.'),
(9, 'descriptionMontage', 'Монтаж. Сборка шкафа Шкаф из МДФ в ванную. Сборка шкафа подразумевает скрепление всех присаженных(просверленных) деталей изделия корпусной мебели. '),
(10, 'descriptionMain', 'Заказ мебели на заказ на ваш выбор. Любой конструкции и внешнего вида. Для отображения нужно 80+ символов');

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`id`, `name`, `description`, `img`) VALUES
(3, 'ОСБ-3', 'Разработан для наружного использования и эксплуатации в условиях умеренной или повышенной влажности', '821397cd2fd12448a25680cd35bddb13'),
(4, 'Фанера хвойная', 'Безупречный внешний вид. Смолистая структура. Лёгкость.', '3b2dd5bec7ad986fce3345b0e1649ce0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
