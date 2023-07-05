-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2023-07-05 08:15:55
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `7_1`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `articles`
--

CREATE TABLE `articles` (
  `id` int(32) NOT NULL,
  `title` varchar(20) NOT NULL,
  `body` text DEFAULT NULL,
  `genre_id` int(32) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `completion_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `articles`
--

INSERT INTO `articles` (`id`, `title`, `body`, `genre_id`, `created_at`, `updated_at`, `completion_at`) VALUES
(1, 'IT', 'インターネットなどの通信とコンピュータとを駆使する情報技術。', 2, '2023-07-02 05:49:06', '2023-07-04 16:35:16', NULL),
(3, '語学', '外国語を身につける勉強。また、その学科。俗に、外国語を使う能力。', 3, '2023-07-02 05:52:50', '2023-07-02 05:57:11', NULL),
(4, '経営学', '経営学とは「常に変化する内外の環境において組織をいかに効率的に運営するか」を解明する学問である。\r\nその対象は今日では広く、企業だけでなく、官庁組織、学校その他一般に組織といわれるものすべてを含むと考えられる。', 4, '2023-07-02 05:55:46', '2023-07-04 13:44:39', NULL),
(5, 'HTML', 'このコースではWebページを作ることを目指します。', 5, '2023-07-02 05:58:07', '2023-07-04 15:31:56', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `chapters`
--

CREATE TABLE `chapters` (
  `id` int(32) NOT NULL,
  `title` varchar(20) NOT NULL,
  `body` text DEFAULT NULL,
  `articles_id` int(32) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `completion_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `chapters`
--

INSERT INTO `chapters` (`id`, `title`, `body`, `articles_id`, `created_at`, `updated_at`, `completion_at`) VALUES
(1, 'HTML', 'HTMLとは「HyperText Markup Language（ハイパーテキストマークアップランゲージ）」の略で、簡単に言うと “WEBページを作成するためにつくられた言語” のことを言います。', 1, '2023-07-02 06:03:42', '2023-07-02 12:34:54', NULL),
(2, 'CSS', 'CSS（Cascading Style Sheets）とは、 Webサイトのサイズや色、レイアウトなどを設定 するためのプログラミング言語です。 CSSは「シーエスエス」や「スタイルシート」などと呼ばれており、背景の色の変更や画像の設置、文字のフォントや色などの幅広いデザインを定義する際に使用されます。', 1, '2023-07-02 06:03:49', '2023-07-02 06:16:06', NULL),
(3, 'PHP', 'PHP ( PHP: Hypertext Preprocessor を再帰的に略したものです) は、広く使われているオープンソースの汎用スクリプト言語です。 PHP は、特に Web 開発に適しており、HTML に埋め込むことができます。', 1, '2023-07-02 06:03:53', '2023-07-02 06:16:35', NULL),
(4, 'JavaScript', '「JavaScript」（ジャバスクリプト）は、プログラミング言語の1つ。 Webブラウザが読み込むことによって、Webページ上に動きのある表現を付けたり、入力フォームなどで選択候補を動的に表示させたりできる。 Webブラウザ上での動作に特化しており、Webサイト制御やWebアプリに用いられていることが多い。', 1, '2023-07-02 06:04:20', '2023-07-02 06:15:21', NULL),
(5, 'データベース', 'データベースとは、コンピュータ上で集積・整理された情報群のことです。 データベースには階層型データベースやリレーショナルデータベースなどの種類があり、操作にはSQLというデータベース言語が必要となる場合があります。', 1, '2023-07-02 06:04:38', '2023-07-02 06:17:01', NULL),
(7, '日本語', '日本語にはひらがな、カタカナ、漢字があります', 3, '2023-07-02 06:18:19', '2023-07-02 06:20:54', NULL),
(8, '英語', '英語ではアルファベットを使います', 3, '2023-07-02 06:18:26', '2023-07-02 06:21:16', NULL),
(9, '中国語', '一般に中国語と呼ばれているのは、「普通話」（意味は「広く通じる言葉」）という共通語を指しています', 3, '2023-07-02 06:18:41', '2023-07-02 06:22:11', NULL),
(15, 'HTMLとは…', 'HTMLとは、HyperText Markup Languageの略で、マークアップ言語の1つです。 \r\nマークアップとは、文章の構成や役割を示すことを意味します。\r\n HTMLはWebサイトを作成する際に、コンピューターへ構成指示を出し、表示したい文章や写真などの情報を形作ります。', 5, '2023-07-04 13:22:11', '2023-07-04 13:22:37', NULL),
(16, 'タグとは…', 'HTMLでは、テキストに「タグ」と呼ばれる印を付けていきます。\r\nテキストをタグで囲むことにより、テキストが「見出し」や「リンク」といった意味をもつことになります。\r\n\r\n例）\r\n<h1>プログラミングの世界へようこそ</h1>\r\n\r\n<p>一緒に勉強しよう！</p>\r\n\r\n<h1>や<p>の事を開始タグと呼ぶよ\r\n</h1>や</p>の事を終了タグと呼ぶよ', 5, '2023-07-04 15:33:11', '2023-07-04 15:37:37', NULL),
(17, '見出しを作る', '<h1>見出し1</h1>\r\n<h2>見出し2</h2>\r\n<h3>見出し3</h3>\r\n<h4>見出し4</h4>\r\n<h5>見出し5</h5>\r\n<h6>見出し6</h6>\r\n\r\n※注意点\r\n<h1>の見出しのほうが大きく表示されるよ', 5, '2023-07-04 15:37:56', '2023-07-04 15:39:58', NULL),
(18, '段落を作る', '<p>段落1</p>\r\n<p>段落2</p>\r\n<p>段落3</p>\r\n\r\n※段落には<p1>や<p2>は存在しないよ！', 5, '2023-07-04 15:40:48', '2023-07-04 15:46:38', NULL),
(19, 'コメントを作る', '<!-- -->で囲んだテキストのことを「コメント」と呼びます。\r\nコメントとして書かれたテキストはブラウザには表示されないので、メモとして使うことができます。\r\n\r\n例)<!--これはコメントだよ！-->\r\n\r\n※Ctrl ＋/ で範囲指定した行をコメントアウトするよ！\r\n言語によってコメントアウトの表記が違うから Ctrl ＋/ で覚えるのがオススメ！', 5, '2023-07-04 15:54:02', '2023-07-04 15:58:36', NULL),
(20, 'リンクを作る', 'リンクを作成するためには<a>要素を用います。\r\nテキストを<a>タグで囲むことで、簡単にリンクを作ることができます。\r\n実際に表示されるテキストは、<a>タグに囲まれた部分です。\r\n<a href=\"ここには遷移先のURLを書くよ\">ここが画面に表示されるテキストでボタンを押す個所になるよ</a>\r\n\r\n例)\r\n<a href=\"http://localhost/top\">トップへ戻る</a>', 5, '2023-07-04 15:59:42', '2023-07-04 16:03:25', NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `favorite`
--

CREATE TABLE `favorite` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `chapter_id` varchar(64) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `folder` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `chapter_id`, `created_at`, `updated_at`, `folder`) VALUES
(30, '2', '2', '2023-07-05 02:59:10', NULL, 0),
(31, '2', '3', '2023-07-05 02:59:14', NULL, 0),
(36, '2', '16', '2023-07-05 03:06:36', NULL, 0),
(37, '2', '15', '2023-07-05 03:16:51', NULL, 0);

-- --------------------------------------------------------

--
-- テーブルの構造 `flights`
--

CREATE TABLE `flights` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `folders`
--

CREATE TABLE `folders` (
  `id` int(32) NOT NULL,
  `user_id` int(32) NOT NULL,
  `title` varchar(20) NOT NULL,
  `favorite_id` int(32) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `genres`
--

CREATE TABLE `genres` (
  `id` int(32) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(5, 'HTML'),
(2, 'IT'),
(12, 'ジャンルを追加'),
(1, 'ジャンルを選択してください'),
(4, '経営学'),
(3, '語学');

-- --------------------------------------------------------

--
-- テーブルの構造 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_15_081623_create_flights_table', 1),
(6, '2023_06_23_151533_create_favorite_table', 2);

-- --------------------------------------------------------

--
-- テーブルの構造 `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `body` varchar(500) NOT NULL DEFAULT 'ここにお知らせの内容を記入せてください',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `notices`
--

INSERT INTO `notices` (`id`, `title`, `body`, `created_at`, `updated_at`) VALUES
(1, '6月30日のお知らせ', '今日が6月の最終日です', '2023-07-02 06:24:15', '2023-07-02 06:24:59'),
(2, '7月1日のお知らせ', '今日から7月が始まります', '2023-07-02 06:25:30', '2023-07-02 06:25:45'),
(3, '新しい講義ができました！', 'より専門的なHTMLコースができましたので、ITコースのHTMLは8月1日に削除いたします。', '2023-07-02 06:26:05', '2023-07-02 06:27:46');

-- --------------------------------------------------------

--
-- テーブルの構造 `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('l3997487@gmail.com', '$2y$10$clFaKHki0KSNAoNiKn9CF.BcAWuDP0PuN34vv2Jem/sRN62e2No7S', '2023-06-30 05:11:43');

-- --------------------------------------------------------

--
-- テーブルの構造 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` int(8) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, '管理者画面', 'administrator@administrator', NULL, '$2y$10$qymHryGEIEYRsYmEyOR2hewrrTNaz6UKyVPKgrmnWPptH70Lm0xae', NULL, '2023-06-16 02:58:10', '2023-07-05 02:24:36', 1),
(2, 'ユーザー画面', 'user@user', NULL, '$2y$10$wj0nVLyTkbpvOeza8fZEvuR2D4c0vGmSilTA6gC5jTsv5kCgCxcRm', NULL, '2023-06-21 03:02:17', '2023-07-05 02:25:43', 0);

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`,`title`) USING BTREE;

--
-- テーブルのインデックス `chapters`
--
ALTER TABLE `chapters`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- テーブルのインデックス `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- テーブルのインデックス `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- テーブルのインデックス `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- テーブルの AUTO_INCREMENT `chapters`
--
ALTER TABLE `chapters`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- テーブルの AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- テーブルの AUTO_INCREMENT `flights`
--
ALTER TABLE `flights`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- テーブルの AUTO_INCREMENT `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- テーブルの AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルの AUTO_INCREMENT `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
