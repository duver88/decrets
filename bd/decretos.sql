/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `concept_themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concept_type_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `concept_themes_concept_type_id_foreign` (`concept_type_id`),
  CONSTRAINT `concept_themes_concept_type_id_foreign` FOREIGN KEY (`concept_type_id`) REFERENCES `concept_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `concept_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `concepts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenido` text COLLATE utf8mb4_unicode_ci,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concept_type_id` bigint unsigned NOT NULL,
  `concept_theme_id` bigint unsigned NOT NULL,
  `tipo_documento` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dependencia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint unsigned NOT NULL,
  `año` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `concepts_concept_type_id_foreign` (`concept_type_id`),
  KEY `concepts_concept_theme_id_foreign` (`concept_theme_id`),
  KEY `concepts_user_id_foreign` (`user_id`),
  CONSTRAINT `concepts_concept_theme_id_foreign` FOREIGN KEY (`concept_theme_id`) REFERENCES `concept_themes` (`id`),
  CONSTRAINT `concepts_concept_type_id_foreign` FOREIGN KEY (`concept_type_id`) REFERENCES `concept_types` (`id`),
  CONSTRAINT `concepts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `document_themes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `document_type_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_themes_document_type_id_foreign` (`document_type_id`),
  CONSTRAINT `document_themes_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `document_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `documents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` enum('decreto','resolución') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `archivo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` text COLLATE utf8mb4_unicode_ci,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `document_type_id` bigint unsigned DEFAULT NULL,
  `document_theme_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_category_id_foreign` (`category_id`),
  KEY `documents_document_type_id_foreign` (`document_type_id`),
  KEY `documents_document_theme_id_foreign` (`document_theme_id`),
  CONSTRAINT `documents_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_document_theme_id_foreign` FOREIGN KEY (`document_theme_id`) REFERENCES `document_themes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_category_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_category_permissions_user_id_category_id_unique` (`user_id`,`category_id`),
  KEY `user_category_permissions_category_id_foreign` (`category_id`),
  CONSTRAINT `user_category_permissions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_category_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `user_concept_permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `concept_type_id` bigint unsigned NOT NULL,
  `can_create` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_concept_permissions_user_id_foreign` (`user_id`),
  KEY `user_concept_permissions_concept_type_id_foreign` (`concept_type_id`),
  CONSTRAINT `user_concept_permissions_concept_type_id_foreign` FOREIGN KEY (`concept_type_id`) REFERENCES `concept_types` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_concept_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





INSERT INTO `categories` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Administrativa', '2025-06-05 16:36:48', '2025-06-05 16:36:48');
INSERT INTO `categories` (`id`, `nombre`, `created_at`, `updated_at`) VALUES
(2, 'Tics', '2025-06-12 10:42:15', '2025-06-12 10:42:15');


INSERT INTO `concept_themes` (`id`, `nombre`, `concept_type_id`, `created_at`, `updated_at`) VALUES
(1, 'testt', 1, '2025-06-05 16:45:33', '2025-06-05 16:45:33');
INSERT INTO `concept_themes` (`id`, `nombre`, `concept_type_id`, `created_at`, `updated_at`) VALUES
(2, 'Seguridad Social', 2, '2025-06-12 10:47:38', '2025-06-12 10:47:38');
INSERT INTO `concept_themes` (`id`, `nombre`, `concept_type_id`, `created_at`, `updated_at`) VALUES
(3, 'Otros', 2, '2025-06-12 10:47:52', '2025-06-12 10:47:52');

INSERT INTO `concept_types` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'test', NULL, '2025-06-05 16:45:30', '2025-06-05 16:45:30');
INSERT INTO `concept_types` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(2, 'Laboral', '\"\"', '2025-06-12 10:47:29', '2025-06-12 10:47:29');


INSERT INTO `concepts` (`id`, `titulo`, `contenido`, `archivo`, `concept_type_id`, `concept_theme_id`, `tipo_documento`, `dependencia`, `user_id`, `año`, `fecha`, `created_at`, `updated_at`) VALUES
(2, '324', '323', 'concepts/1749163711_2-IPU09-202504-00026940__(1).pdf', 1, 1, 'Concepto', 'Oficina Asesora TIC', 1, '2024', '2025-06-11', '2025-06-05 17:48:31', '2025-06-06 11:27:58');
INSERT INTO `concepts` (`id`, `titulo`, `contenido`, `archivo`, `concept_type_id`, `concept_theme_id`, `tipo_documento`, `dependencia`, `user_id`, `año`, `fecha`, `created_at`, `updated_at`) VALUES
(3, '2-S-SdDSB-202504-00024699', '\"AHAH\"', 'concepts/1749743360_AUTO_PERENCION__11417_.pdf', 2, 2, 'Concepto', 'Secretaria Hacienda', 1, '2025', '2025-06-10', '2025-06-12 10:49:20', '2025-06-12 10:49:20');


INSERT INTO `document_themes` (`id`, `nombre`, `document_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Otros', 1, '2025-06-12 19:55:43', '2025-06-12 19:55:43');


INSERT INTO `document_types` (`id`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'Laboral', 'TEST', '2025-06-12 19:55:34', '2025-06-12 19:55:34');


INSERT INTO `documents` (`id`, `nombre`, `numero`, `tipo`, `fecha`, `archivo`, `descripcion`, `category_id`, `created_at`, `updated_at`, `document_type_id`, `document_theme_id`) VALUES
(2, '2023', '234', 'decreto', '2025-06-16', 'documents/1749161585_2-IPU09-202505-00032442_(1).pdf', '\"asdfasdf\"', 1, '2025-06-05 17:13:05', '2025-06-12 10:43:36', NULL, NULL);
INSERT INTO `documents` (`id`, `nombre`, `numero`, `tipo`, `fecha`, `archivo`, `descripcion`, `category_id`, `created_at`, `updated_at`, `document_type_id`, `document_theme_id`) VALUES
(3, '2023', '3435', 'resolución', '2025-06-10', 'documents/1749743005_CamScanner_11-06-2025_OFICIO_TIC_JUNIO-_11.pdf', '\"POR EL CUAL SE HACE ENCARGO\"', 1, '2025-06-12 10:43:25', '2025-06-12 10:43:25', NULL, NULL);








INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(4, '2025_02_02_135032_create_categories_table', 1),
(5, '2025_04_02_134932_create_documents_table', 1),
(6, '2025_04_02_142057_add_is_admin_to_users_table', 1),
(7, '2025_04_02_212722_add_numero_to_documents', 1),
(8, '2025_05_13_162533_create_user_category_permissions_table', 1),
(9, '2025_05_18_110602_create_concept_types_table', 1),
(10, '2025_05_19_105241_create_concept_themes_table', 1),
(11, '2025_05_19_105242_create_concepts_table', 1),
(12, '2025_05_19_105242_create_user_concept_permissions_table', 1),
(13, '2025_05_20_105920_add_tipo_documento_to_concepts_table', 1),
(14, '2025_06_05_173342_add_dependencias_to_concepts_table', 2),
(15, '2025_06_05_174307_change_dependencias_to_dependencia_in_concepts_table', 3),
(16, '2025_06_12_183658_create_document_types_table', 4),
(17, '2025_06_12_183745_create_document_themes_table', 4),
(18, '2025_06_12_183759_add_type_and_theme_to_documents_table', 4);







INSERT INTO `user_concept_permissions` (`id`, `user_id`, `concept_type_id`, `can_create`, `can_edit`, `can_delete`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 1, 1, 1, '2025-06-12 10:52:21', '2025-06-12 10:52:21');
INSERT INTO `user_concept_permissions` (`id`, `user_id`, `concept_type_id`, `can_create`, `can_edit`, `can_delete`, `created_at`, `updated_at`) VALUES
(4, 2, 2, 1, 1, 1, '2025-06-12 10:52:21', '2025-06-12 10:52:21');


INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'duver20000@gmail.com', NULL, '$2y$12$ST4mH8jJlW/qFttzUKghyezgLpdUZZuh2JllxKePbyaiwY2p/ZcB6', 1, NULL, NULL, '2025-06-05 16:36:37');
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `is_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Tics', 'tics@gmail.com', NULL, '$2y$12$QjQX1nqH6AAXLbOISBF2Me.8FlbuZmbAtk7sQKH1DOdePkhNmxpxq', 0, NULL, NULL, '2025-06-05 16:37:11');



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;