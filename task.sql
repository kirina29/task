-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 10 2022 г., 13:42
-- Версия сервера: 5.7.33
-- Версия PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `textcomment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tasks` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `flags`
--

CREATE TABLE `flags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `flags_tasks`
--

CREATE TABLE `flags_tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_flags` int(10) UNSIGNED DEFAULT NULL,
  `id_tasks` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `links`
--

CREATE TABLE `links` (
  `id` int(11) NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `source` int(11) NOT NULL,
  `target` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_11_27_155723_create_statuses_table', 1),
(5, '2021_11_28_182334_create_spaces_table', 1),
(6, '2021_11_29_161926_create_flags_table', 1),
(7, '2021_11_29_161927_create_tasks_table', 1),
(8, '2021_11_29_161928_create_flags_tasks_table', 1),
(9, '2021_11_30_171544_create_comments_table', 1),
(10, '2021_12_03_144004_create_subtasks_table', 1),
(11, '2021_12_03_153000_create_users_table', 1),
(12, '2021_12_03_154231_create_users_subtasks_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `spaces`
--

CREATE TABLE `spaces` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `spaces`
--

INSERT INTO `spaces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Первое', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `statuses`
--

CREATE TABLE `statuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Новая', NULL, NULL),
(2, 'В работе', NULL, NULL),
(3, 'Готова', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `subtasks`
--

CREATE TABLE `subtasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `deadline_date` date NOT NULL,
  `id_tasks` int(10) UNSIGNED DEFAULT NULL,
  `id_statuses` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `subtasks`
--

INSERT INTO `subtasks` (`id`, `name`, `start_date`, `deadline_date`, `id_tasks`, `id_statuses`, `created_at`, `updated_at`) VALUES
(12, 'ааа', '2022-03-19', '2022-03-27', 14, 1, '2022-03-19 02:59:59', '2022-03-19 02:59:59'),
(21, 'Подзадача Таси', '2022-04-15', '2022-04-21', 17, 1, '2022-03-31 22:47:08', '2022-03-31 22:47:08'),
(23, 'ф', '2022-04-14', '2022-04-22', 17, 1, '2022-03-31 22:49:36', '2022-03-31 22:49:36'),
(42, 'Подзадача1', '2022-04-09', '2022-04-20', 21, 1, NULL, '2022-04-10 05:15:13'),
(44, 'qqq', '2022-04-10', '2022-04-15', 21, 1, '2022-04-10 03:34:31', '2022-04-10 05:16:38'),
(45, 'ertt', '2022-04-11', '2022-04-13', 21, 1, '2022-04-10 03:34:55', '2022-04-10 03:34:55'),
(46, 'ertt', '2022-04-11', '2022-04-13', 21, 1, '2022-04-10 03:34:55', '2022-04-10 03:34:55');

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `start_date` date NOT NULL,
  `deadline_date` date NOT NULL,
  `id_statuses` int(10) UNSIGNED DEFAULT NULL,
  `id_spaces` int(10) UNSIGNED DEFAULT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `descriptions`, `price`, `start_date`, `deadline_date`, `id_statuses`, `id_spaces`, `id_users`, `created_at`, `updated_at`) VALUES
(14, 'вторая', 'ааа', '234.00', '2022-03-19', '2022-03-26', 1, 1, 3, NULL, '2022-04-04 02:52:55'),
(17, 'Задача 1', 'з', '13.00', '2022-04-09', '2022-04-29', 1, 1, 5, NULL, NULL),
(21, 'q', 'q', '100.00', '2022-04-08', '2022-04-30', 1, 1, 4, NULL, NULL),
(22, 'Новая задачка', 'новая задачка', '130.00', '2022-04-03', '2022-04-13', 2, 1, 4, NULL, '2022-04-10 05:14:02'),
(23, 'qweww', 'qweqe', '150.00', '2022-04-23', '2022-05-21', 1, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'ira', 'ira@mail.ru', NULL, '$2y$10$V9dlhvS3H/v7JbTNcY7cD.dXmwZDQxmHQOdrExkqc3tBNy2px5h4m', NULL, '2022-03-11 03:13:38', '2022-03-11 03:13:38'),
(3, 'test', 'test@gmail.com', NULL, '$2y$10$VOKOzo1NDlzq8obe5TQKbOf5xul1j56aCseyHOGeDCrnJFQakPx..', NULL, '2022-03-18 08:48:31', '2022-03-18 08:48:31'),
(4, 'test1', 'test1@gmail.com', NULL, '$2y$10$kkcCx4uTu.G0s3eh.7B0wOJP06DeHrEEhFzwgszuT7oxfYMncwdAa', NULL, '2022-03-19 03:29:39', '2022-03-19 03:29:39'),
(5, 'Ирина', 'q@q.ru', NULL, '$2y$10$OjmWV3rKdlRsy6yknZFtHOMuJMXGM8BGHnuXd9eS5qt17LCd1yWpq', NULL, '2022-03-31 22:41:35', '2022-03-31 22:41:35'),
(6, 'Тася', 'w@w.ru', NULL, '$2y$10$SYEO8tadvaog8FbPulnT3u9flrylrnu5BDWUbyg83LOliBFQ.Cmnm', NULL, '2022-03-31 22:43:28', '2022-03-31 22:43:28');

-- --------------------------------------------------------

--
-- Структура таблицы `users_subtasks`
--

CREATE TABLE `users_subtasks` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_users` bigint(20) UNSIGNED DEFAULT NULL,
  `id_subtasks` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users_subtasks`
--

INSERT INTO `users_subtasks` (`id`, `id_users`, `id_subtasks`, `created_at`, `updated_at`) VALUES
(8, 2, 12, NULL, NULL),
(17, 6, 21, NULL, NULL),
(19, 6, 23, NULL, NULL),
(43, 6, 45, NULL, NULL),
(44, 3, 45, NULL, NULL),
(45, 6, 46, NULL, NULL),
(46, 3, 46, NULL, NULL),
(47, 3, 42, NULL, NULL),
(48, 2, 42, NULL, NULL),
(49, 2, 44, NULL, NULL),
(50, 3, 44, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_id_tasks_foreign` (`id_tasks`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `flags`
--
ALTER TABLE `flags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `flags_tasks`
--
ALTER TABLE `flags_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `flags_tasks_id_flags_foreign` (`id_flags`),
  ADD KEY `flags_tasks_id_tasks_foreign` (`id_tasks`);

--
-- Индексы таблицы `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subtasks`
--
ALTER TABLE `subtasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subtasks_ibfk_1` (`id_statuses`),
  ADD KEY `subtasks_id_tasks_foreign` (`id_tasks`);

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_id_spaces_foreign` (`id_spaces`),
  ADD KEY `tasks_id_statuses_foreign` (`id_statuses`),
  ADD KEY `id_users` (`id_users`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `users_subtasks`
--
ALTER TABLE `users_subtasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_subtasks_id_subtasks_foreign` (`id_subtasks`),
  ADD KEY `users_subtasks_id_users_foreign` (`id_users`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `flags`
--
ALTER TABLE `flags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `flags_tasks`
--
ALTER TABLE `flags_tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `links`
--
ALTER TABLE `links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `subtasks`
--
ALTER TABLE `subtasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `users_subtasks`
--
ALTER TABLE `users_subtasks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_id_tasks_foreign` FOREIGN KEY (`id_tasks`) REFERENCES `tasks` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `flags_tasks`
--
ALTER TABLE `flags_tasks`
  ADD CONSTRAINT `flags_tasks_id_flags_foreign` FOREIGN KEY (`id_flags`) REFERENCES `flags` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `flags_tasks_id_tasks_foreign` FOREIGN KEY (`id_tasks`) REFERENCES `tasks` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subtasks`
--
ALTER TABLE `subtasks`
  ADD CONSTRAINT `subtasks_ibfk_1` FOREIGN KEY (`id_statuses`) REFERENCES `statuses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `subtasks_id_tasks_foreign` FOREIGN KEY (`id_tasks`) REFERENCES `tasks` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tasks_id_spaces_foreign` FOREIGN KEY (`id_spaces`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tasks_id_statuses_foreign` FOREIGN KEY (`id_statuses`) REFERENCES `statuses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users_subtasks`
--
ALTER TABLE `users_subtasks`
  ADD CONSTRAINT `users_subtasks_id_subtasks_foreign` FOREIGN KEY (`id_subtasks`) REFERENCES `subtasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_subtasks_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
