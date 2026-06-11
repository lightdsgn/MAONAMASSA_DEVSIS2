-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           9.3.0 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para maonamassa_devsis2
CREATE DATABASE IF NOT EXISTS `maonamassa_devsis2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `maonamassa_devsis2`;

-- Copiando estrutura para tabela maonamassa_devsis2.agendamentos
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `cliente_id` bigint unsigned NOT NULL,
  `servico_id` bigint unsigned NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `status` enum('pendente','confirmado','concluido','cancelado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `orcamento_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agendamentos_cliente_id_foreign` (`cliente_id`),
  KEY `agendamentos_servico_id_foreign` (`servico_id`),
  KEY `agendamentos_orcamento_id_foreign` (`orcamento_id`),
  CONSTRAINT `agendamentos_cliente_id_foreign` FOREIGN KEY (`cliente_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `agendamentos_orcamento_id_foreign` FOREIGN KEY (`orcamento_id`) REFERENCES `orcamentos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `agendamentos_servico_id_foreign` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.agendamentos: ~43 rows (aproximadamente)
INSERT INTO `agendamentos` (`id`, `cliente_id`, `servico_id`, `data`, `horario`, `status`, `observacoes`, `created_at`, `updated_at`, `orcamento_id`) VALUES
	(1, 2, 1, '2026-05-06', '09:00:00', 'concluido', 'Confirmar endereço: Rua das Flores, 123.', '2026-05-04 02:38:17', '2026-05-07 02:38:17', 1),
	(2, 2, 2, '2026-05-25', '14:00:00', 'concluido', 'Deixar registro geral acessível.', '2026-05-24 02:38:17', '2026-05-26 02:38:17', 2),
	(3, 2, 3, '2026-06-07', '10:00:00', 'concluido', 'Cliente confirmado por WhatsApp.', '2026-06-06 02:38:17', '2026-06-08 02:38:17', 3),
	(4, 2, 1, '2026-06-13', '09:00:00', 'confirmado', 'Preferência pelo período da manhã.', '2026-06-10 02:38:17', '2026-06-10 02:38:17', 5),
	(5, 2, 1, '2026-06-16', '14:00:00', 'pendente', 'Aguardando confirmação do prestador.', '2026-06-10 20:38:17', '2026-06-10 20:38:17', 6),
	(6, 17, 15, '2026-04-30', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-30 02:38:17', '2026-05-01 02:38:17', 7),
	(7, 20, 5, '2026-06-06', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-31 02:38:17', '2026-06-07 02:38:17', 8),
	(8, 16, 18, '2026-04-02', '13:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-01 02:38:17', '2026-04-03 02:38:17', 9),
	(9, 15, 14, '2026-05-24', '09:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-20 02:38:17', '2026-05-25 02:38:17', 10),
	(10, 14, 18, '2026-03-01', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-02-24 02:38:17', '2026-03-02 02:38:17', 11),
	(11, 20, 11, '2026-05-08', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-04 02:38:17', '2026-05-09 02:38:17', 12),
	(12, 16, 6, '2026-03-05', '09:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-02-28 02:38:17', '2026-03-06 02:38:17', 13),
	(13, 21, 9, '2026-02-16', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-02-15 02:38:17', '2026-02-17 02:38:17', 14),
	(14, 22, 13, '2026-05-08', '10:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-01 02:38:17', '2026-05-09 02:38:17', 15),
	(15, 14, 14, '2026-04-12', '13:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-11 02:38:17', '2026-04-13 02:38:17', 16),
	(16, 13, 19, '2026-06-03', '14:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-06-03 02:38:17', '2026-06-04 02:38:17', 17),
	(17, 12, 7, '2026-03-23', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-18 02:38:17', '2026-03-24 02:38:17', 18),
	(18, 14, 21, '2026-05-27', '10:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-24 02:38:17', '2026-05-28 02:38:17', 19),
	(19, 16, 20, '2026-03-26', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-25 02:38:17', '2026-03-27 02:38:17', 20),
	(20, 18, 20, '2026-05-19', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-14 02:38:17', '2026-05-20 02:38:17', 21),
	(21, 14, 16, '2026-04-10', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-05 02:38:17', '2026-04-11 02:38:17', 22),
	(22, 15, 15, '2026-02-28', '13:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-02-26 02:38:17', '2026-03-01 02:38:17', 23),
	(23, 17, 6, '2026-03-11', '13:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-07 02:38:17', '2026-03-12 02:38:17', 24),
	(24, 21, 9, '2026-05-17', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-14 02:38:17', '2026-05-18 02:38:17', 25),
	(25, 14, 14, '2026-05-15', '10:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-15 02:38:17', '2026-05-16 02:38:17', 26),
	(26, 14, 10, '2026-03-03', '13:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-02 02:38:17', '2026-03-04 02:38:17', 27),
	(27, 14, 5, '2026-04-24', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-20 02:38:17', '2026-04-25 02:38:17', 28),
	(28, 20, 4, '2026-02-26', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-02-21 02:38:17', '2026-02-27 02:38:17', 29),
	(29, 14, 19, '2026-03-24', '15:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-21 02:38:17', '2026-03-25 02:38:17', 30),
	(30, 22, 21, '2026-05-27', '09:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-25 02:38:17', '2026-05-28 02:38:17', 31),
	(31, 19, 10, '2026-04-17', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-16 02:38:17', '2026-04-18 02:38:17', 32),
	(32, 12, 21, '2026-04-17', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-04-11 02:38:18', '2026-04-18 02:38:18', 33),
	(33, 13, 6, '2026-05-29', '08:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-23 02:38:18', '2026-05-30 02:38:18', 34),
	(34, 16, 22, '2026-03-24', '09:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-03-21 02:38:18', '2026-03-25 02:38:18', 35),
	(35, 15, 9, '2026-05-20', '09:00:00', 'concluido', 'Confirmar endereço por telefone antes da visita.', '2026-05-13 02:38:18', '2026-05-21 02:38:18', 36),
	(36, 12, 5, '2026-06-15', '10:00:00', 'pendente', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 37),
	(37, 23, 21, '2026-06-21', '14:00:00', 'pendente', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 38),
	(38, 13, 9, '2026-06-21', '10:00:00', 'pendente', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 39),
	(39, 22, 4, '2026-06-14', '08:00:00', 'pendente', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 40),
	(40, 15, 4, '2026-06-17', '10:00:00', 'confirmado', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 41),
	(41, 13, 6, '2026-06-11', '16:00:00', 'confirmado', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 42),
	(42, 18, 14, '2026-06-24', '14:00:00', 'confirmado', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 43),
	(43, 16, 12, '2026-06-17', '10:00:00', 'confirmado', NULL, '2026-06-11 02:38:18', '2026-06-11 02:38:18', 44);

-- Copiando estrutura para tabela maonamassa_devsis2.avaliacoes
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agendamento_id` bigint unsigned NOT NULL,
  `servico_id` bigint unsigned NOT NULL,
  `usuario_id` bigint unsigned NOT NULL,
  `nota` tinyint unsigned NOT NULL,
  `comentario` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `avaliacoes_agendamento_id_usuario_id_unique` (`agendamento_id`,`usuario_id`),
  KEY `avaliacoes_servico_id_foreign` (`servico_id`),
  KEY `avaliacoes_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `avaliacoes_agendamento_id_foreign` FOREIGN KEY (`agendamento_id`) REFERENCES `agendamentos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_servico_id_foreign` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE CASCADE,
  CONSTRAINT `avaliacoes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.avaliacoes: ~0 rows (aproximadamente)
INSERT INTO `avaliacoes` (`id`, `agendamento_id`, `servico_id`, `usuario_id`, `nota`, `comentario`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 2, 5, 'Serviço excelente! Muito profissional e pontual.', '2026-05-09 02:38:17', '2026-05-09 02:38:17'),
	(2, 2, 2, 2, 4, 'Ótimo atendimento, recomendo a todos!', '2026-05-27 02:38:17', '2026-05-27 02:38:17'),
	(3, 6, 15, 17, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-05-04 02:38:17', '2026-05-02 02:38:17'),
	(4, 7, 5, 20, 2, 'Demorou mais do que o combinado.', '2026-06-10 02:38:17', '2026-06-08 02:38:17'),
	(5, 8, 18, 16, 1, 'Demorou mais do que o combinado.', '2026-04-05 02:38:17', '2026-04-04 02:38:17'),
	(6, 9, 14, 15, 5, 'Trabalho impecável, superou minhas expectativas.', '2026-05-27 02:38:17', '2026-05-28 02:38:17'),
	(7, 10, 18, 14, 4, 'Ótimo atendimento, recomendo a todos!', '2026-03-04 02:38:17', '2026-03-04 02:38:17'),
	(8, 11, 11, 20, 5, 'Profissional de confiança, serviço rápido e bem feito.', '2026-05-11 02:38:17', '2026-05-10 02:38:17'),
	(9, 12, 6, 16, 5, 'Ótimo atendimento, recomendo a todos!', '2026-03-09 02:38:17', '2026-03-09 02:38:17'),
	(10, 13, 9, 21, 4, 'Trabalho impecável, superou minhas expectativas.', '2026-02-19 02:38:17', '2026-02-18 02:38:17'),
	(11, 14, 13, 22, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-05-10 02:38:17', '2026-05-11 02:38:17'),
	(12, 15, 14, 14, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-04-16 02:38:17', '2026-04-14 02:38:17'),
	(13, 16, 19, 13, 3, 'Atendeu as necessidades, sem reclamações.', '2026-06-07 02:38:17', '2026-06-06 02:38:17'),
	(14, 17, 7, 12, 5, 'Serviço excelente! Muito profissional e pontual.', '2026-03-27 02:38:17', '2026-03-25 02:38:17'),
	(15, 18, 21, 14, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-05-29 02:38:17', '2026-05-31 02:38:17'),
	(16, 19, 20, 16, 4, 'Profissional de confiança, serviço rápido e bem feito.', '2026-03-30 02:38:17', '2026-03-29 02:38:17'),
	(17, 20, 20, 18, 4, 'Muito satisfeito, voltarei a contratar com certeza.', '2026-05-23 02:38:17', '2026-05-22 02:38:17'),
	(18, 21, 16, 14, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-04-13 02:38:17', '2026-04-12 02:38:17'),
	(19, 22, 15, 15, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-03-04 02:38:17', '2026-03-04 02:38:17'),
	(20, 23, 6, 17, 4, 'Muito satisfeito, voltarei a contratar com certeza.', '2026-03-13 02:38:17', '2026-03-15 02:38:17'),
	(21, 24, 9, 21, 1, 'Demorou mais do que o combinado.', '2026-05-20 02:38:17', '2026-05-19 02:38:17'),
	(22, 25, 14, 14, 2, 'Demorou mais do que o combinado.', '2026-05-19 02:38:17', '2026-05-18 02:38:17'),
	(23, 26, 10, 14, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-03-06 02:38:17', '2026-03-07 02:38:17'),
	(24, 27, 5, 14, 4, 'Profissional de confiança, serviço rápido e bem feito.', '2026-04-27 02:38:17', '2026-04-26 02:38:17'),
	(25, 28, 4, 20, 5, 'Muito satisfeito, voltarei a contratar com certeza.', '2026-03-01 02:38:17', '2026-03-01 02:38:17'),
	(26, 29, 19, 14, 4, 'Serviço excelente! Muito profissional e pontual.', '2026-03-26 02:38:17', '2026-03-26 02:38:17'),
	(27, 30, 21, 22, 4, 'Trabalho impecável, superou minhas expectativas.', '2026-05-29 02:38:17', '2026-05-29 02:38:17'),
	(28, 31, 10, 19, 4, 'Trabalho impecável, superou minhas expectativas.', '2026-04-19 02:38:17', '2026-04-19 02:38:17'),
	(29, 32, 21, 12, 5, 'Trabalho impecável, superou minhas expectativas.', '2026-04-19 02:38:18', '2026-04-20 02:38:18'),
	(30, 33, 6, 13, 5, 'Muito satisfeito, voltarei a contratar com certeza.', '2026-05-31 02:38:18', '2026-05-31 02:38:18'),
	(31, 34, 22, 16, 5, 'Muito satisfeito, voltarei a contratar com certeza.', '2026-03-26 02:38:18', '2026-03-28 02:38:18'),
	(32, 35, 9, 15, 4, 'Ótimo atendimento, recomendo a todos!', '2026-05-24 02:38:18', '2026-05-24 02:38:18');

-- Copiando estrutura para tabela maonamassa_devsis2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.cache: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.cache_locks: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.failed_jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.jobs: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
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

-- Copiando dados para a tabela maonamassa_devsis2.job_batches: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.migrations: ~11 rows (aproximadamente)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1),
	(4, '2026_05_20_194905_create_usuarios_table', 1),
	(5, '2026_05_20_195556_create_servicos_table', 1),
	(6, '2026_05_20_195600_create_solicitacoes_table', 1),
	(7, '2026_05_20_195700_create_orcamentos_table', 1),
	(8, '2026_05_20_195720_create_produtos_table', 1),
	(9, '2026_05_20_195800_create_agendamentos_table', 1),
	(10, '2026_05_20_195820_create_pagamentos_table', 1),
	(11, '2026_05_20_195837_create_avaliacoes_table', 1),
	(12, '2026_05_29_000000_add_orcamento_id_to_agendamentos_table', 1);

-- Copiando estrutura para tabela maonamassa_devsis2.orcamentos
CREATE TABLE IF NOT EXISTS `orcamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `solicitacao_id` bigint unsigned NOT NULL,
  `usuario_id` bigint unsigned NOT NULL,
  `servico_id` bigint unsigned DEFAULT NULL,
  `mao_de_obra` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `prazo` int NOT NULL,
  `observacoes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('pendente','aceito','recusado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orcamentos_solicitacao_id_foreign` (`solicitacao_id`),
  KEY `orcamentos_usuario_id_foreign` (`usuario_id`),
  KEY `orcamentos_servico_id_foreign` (`servico_id`),
  CONSTRAINT `orcamentos_servico_id_foreign` FOREIGN KEY (`servico_id`) REFERENCES `servicos` (`id`) ON DELETE SET NULL,
  CONSTRAINT `orcamentos_solicitacao_id_foreign` FOREIGN KEY (`solicitacao_id`) REFERENCES `solicitacoes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orcamentos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.orcamentos: ~0 rows (aproximadamente)
INSERT INTO `orcamentos` (`id`, `solicitacao_id`, `usuario_id`, `servico_id`, `mao_de_obra`, `valor_total`, `prazo`, `observacoes`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, 3, 1, 168.00, 280.00, 2, 'Inclui materiais básicos. Garantia de 90 dias.', 'aceito', '2026-05-03 02:38:17', '2026-05-04 02:38:17'),
	(2, 2, 3, 2, 120.00, 200.00, 1, 'Inclui troca de vedação e registro. Materiais à parte se necessário substituição total.', 'aceito', '2026-05-23 02:38:17', '2026-05-24 02:38:17'),
	(3, 3, 3, 3, 90.00, 150.00, 1, 'Serviço rápido, estimativa de 2h.', 'aceito', '2026-06-05 02:38:17', '2026-06-06 02:38:17'),
	(4, 5, 3, 2, 90.00, 150.00, 1, 'Atendimento no mesmo dia. Inclui produto desentupidor.', 'pendente', '2026-06-09 05:38:17', '2026-06-09 05:38:17'),
	(5, 6, 3, 1, 100.00, 180.00, 1, '4 tomadas padrão NBR. Material incluso.', 'aceito', '2026-06-10 02:38:17', '2026-06-10 02:38:17'),
	(6, 7, 3, 1, 168.00, 280.00, 3, 'Vistoria + laudo + ajuste do quadro se necessário.', 'aceito', '2026-06-10 20:38:17', '2026-06-10 20:38:17'),
	(7, 8, 8, 15, 108.00, 180.00, 1, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-29 02:38:17', '2026-04-29 02:38:17'),
	(8, 9, 4, 5, 210.00, 350.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-30 02:38:17', '2026-05-30 02:38:17'),
	(9, 10, 9, 18, 132.00, 220.00, 5, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-31 02:38:17', '2026-03-31 02:38:17'),
	(10, 11, 8, 14, 120.00, 200.00, 7, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-19 02:38:17', '2026-05-19 02:38:17'),
	(11, 12, 9, 18, 132.00, 220.00, 2, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-02-23 02:38:17', '2026-02-23 02:38:17'),
	(12, 13, 7, 11, 360.00, 600.00, 6, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-03 02:38:17', '2026-05-03 02:38:17'),
	(13, 14, 5, 6, 90.00, 150.00, 6, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-02-27 02:38:17', '2026-02-27 02:38:17'),
	(14, 15, 6, 9, 480.00, 800.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-02-14 02:38:17', '2026-02-14 02:38:17'),
	(15, 16, 7, 13, 450.00, 750.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-30 02:38:17', '2026-04-30 02:38:17'),
	(16, 17, 8, 14, 120.00, 200.00, 5, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-10 02:38:17', '2026-04-10 02:38:17'),
	(17, 18, 10, 19, 720.00, 1200.00, 5, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-06-02 02:38:17', '2026-06-02 02:38:17'),
	(18, 19, 5, 7, 72.00, 120.00, 4, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-17 02:38:17', '2026-03-17 02:38:17'),
	(19, 20, 11, 21, 150.00, 250.00, 1, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-23 02:38:17', '2026-05-23 02:38:17'),
	(20, 21, 10, 20, 1500.00, 2500.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-24 02:38:17', '2026-03-24 02:38:17'),
	(21, 22, 10, 20, 1500.00, 2500.00, 2, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-13 02:38:17', '2026-05-13 02:38:17'),
	(22, 23, 9, 16, 108.00, 180.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-04 02:38:17', '2026-04-04 02:38:17'),
	(23, 24, 8, 15, 108.00, 180.00, 4, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-02-25 02:38:17', '2026-02-25 02:38:17'),
	(24, 25, 5, 6, 90.00, 150.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-06 02:38:17', '2026-03-06 02:38:17'),
	(25, 26, 6, 9, 480.00, 800.00, 1, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-13 02:38:17', '2026-05-13 02:38:17'),
	(26, 27, 8, 14, 120.00, 200.00, 4, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-14 02:38:17', '2026-05-14 02:38:17'),
	(27, 28, 6, 10, 180.00, 300.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-01 02:38:17', '2026-03-01 02:38:17'),
	(28, 29, 4, 5, 210.00, 350.00, 5, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-19 02:38:17', '2026-04-19 02:38:17'),
	(29, 30, 4, 4, 108.00, 180.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-02-20 02:38:17', '2026-02-20 02:38:17'),
	(30, 31, 10, 19, 720.00, 1200.00, 6, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-20 02:38:17', '2026-03-20 02:38:17'),
	(31, 32, 11, 21, 150.00, 250.00, 6, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-24 02:38:17', '2026-05-24 02:38:17'),
	(32, 33, 6, 10, 180.00, 300.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-15 02:38:17', '2026-04-15 02:38:17'),
	(33, 34, 11, 21, 150.00, 250.00, 5, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-04-10 02:38:18', '2026-04-10 02:38:18'),
	(34, 35, 5, 6, 90.00, 150.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-22 02:38:18', '2026-05-22 02:38:18'),
	(35, 36, 11, 22, 228.00, 380.00, 4, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-03-20 02:38:18', '2026-03-20 02:38:18'),
	(36, 37, 6, 9, 480.00, 800.00, 3, 'Materiais inclusos. Garantia de 90 dias.', 'aceito', '2026-05-12 02:38:18', '2026-05-12 02:38:18'),
	(37, 46, 4, 5, 210.00, 350.00, 3, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(38, 47, 11, 21, 150.00, 250.00, 5, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(39, 48, 6, 9, 480.00, 800.00, 5, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(40, 49, 4, 4, 108.00, 180.00, 5, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(41, 50, 4, 4, 108.00, 180.00, 5, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(42, 51, 5, 6, 90.00, 150.00, 1, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(43, 52, 8, 14, 120.00, 200.00, 4, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(44, 53, 7, 12, 540.00, 900.00, 4, NULL, 'aceito', '2026-06-11 02:38:18', '2026-06-11 02:38:18');

-- Copiando estrutura para tabela maonamassa_devsis2.pagamentos
CREATE TABLE IF NOT EXISTS `pagamentos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `agendamento_id` bigint unsigned NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `metodo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pendente','pago','cancelado','estornado') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pendente',
  `data_pagamento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pagamentos_agendamento_id_unique` (`agendamento_id`),
  CONSTRAINT `pagamentos_agendamento_id_foreign` FOREIGN KEY (`agendamento_id`) REFERENCES `agendamentos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.pagamentos: ~0 rows (aproximadamente)
INSERT INTO `pagamentos` (`id`, `agendamento_id`, `valor`, `metodo`, `status`, `data_pagamento`, `created_at`, `updated_at`) VALUES
	(1, 1, 280.00, 'pix', 'pago', '2026-05-07', '2026-05-07 02:38:17', '2026-05-08 02:38:17'),
	(2, 2, 200.00, 'cartao_credito', 'pago', '2026-05-25', '2026-05-26 02:38:17', '2026-05-26 02:38:17'),
	(3, 3, 150.00, 'boleto', 'pendente', NULL, '2026-06-08 02:38:17', '2026-06-08 02:38:17'),
	(4, 6, 180.00, 'cartao_credito', 'pago', '2026-05-01', '2026-05-01 02:38:17', '2026-05-01 02:38:17'),
	(5, 7, 350.00, 'pix', 'pago', '2026-06-07', '2026-06-07 02:38:17', '2026-06-07 02:38:17'),
	(6, 8, 220.00, 'dinheiro', 'pendente', NULL, '2026-04-03 02:38:17', '2026-04-03 02:38:17'),
	(7, 9, 200.00, 'boleto', 'pago', '2026-05-25', '2026-05-25 02:38:17', '2026-05-25 02:38:17'),
	(8, 10, 220.00, 'cartao_credito', 'pago', '2026-03-02', '2026-03-02 02:38:17', '2026-03-02 02:38:17'),
	(9, 11, 600.00, 'dinheiro', 'pago', '2026-05-09', '2026-05-09 02:38:17', '2026-05-09 02:38:17'),
	(10, 12, 150.00, 'dinheiro', 'pago', '2026-03-06', '2026-03-06 02:38:17', '2026-03-06 02:38:17'),
	(11, 13, 800.00, 'cartao_credito', 'pago', '2026-02-17', '2026-02-17 02:38:17', '2026-02-17 02:38:17'),
	(12, 14, 750.00, 'boleto', 'pago', '2026-05-09', '2026-05-09 02:38:17', '2026-05-09 02:38:17'),
	(13, 15, 200.00, 'cartao_credito', 'pago', '2026-04-13', '2026-04-13 02:38:17', '2026-04-13 02:38:17'),
	(14, 16, 1200.00, 'dinheiro', 'pendente', NULL, '2026-06-04 02:38:17', '2026-06-04 02:38:17'),
	(15, 17, 120.00, 'cartao_credito', 'pago', '2026-03-24', '2026-03-24 02:38:17', '2026-03-24 02:38:17'),
	(16, 18, 250.00, 'boleto', 'pendente', NULL, '2026-05-28 02:38:17', '2026-05-28 02:38:17'),
	(17, 19, 2500.00, 'dinheiro', 'pago', '2026-03-27', '2026-03-27 02:38:17', '2026-03-27 02:38:17'),
	(18, 20, 2500.00, 'boleto', 'pago', '2026-05-20', '2026-05-20 02:38:17', '2026-05-20 02:38:17'),
	(19, 21, 180.00, 'cartao_credito', 'pago', '2026-04-11', '2026-04-11 02:38:17', '2026-04-11 02:38:17'),
	(20, 22, 180.00, 'dinheiro', 'pendente', NULL, '2026-03-01 02:38:17', '2026-03-01 02:38:17'),
	(21, 23, 150.00, 'cartao_credito', 'pendente', NULL, '2026-03-12 02:38:17', '2026-03-12 02:38:17'),
	(22, 24, 800.00, 'boleto', 'pago', '2026-05-18', '2026-05-18 02:38:17', '2026-05-18 02:38:17'),
	(23, 25, 200.00, 'dinheiro', 'pago', '2026-05-16', '2026-05-16 02:38:17', '2026-05-16 02:38:17'),
	(24, 26, 300.00, 'pix', 'pago', '2026-03-04', '2026-03-04 02:38:17', '2026-03-04 02:38:17'),
	(25, 27, 350.00, 'cartao_credito', 'pago', '2026-04-25', '2026-04-25 02:38:17', '2026-04-25 02:38:17'),
	(26, 28, 180.00, 'boleto', 'pago', '2026-02-27', '2026-02-27 02:38:17', '2026-02-27 02:38:17'),
	(27, 29, 1200.00, 'boleto', 'pago', '2026-03-25', '2026-03-25 02:38:17', '2026-03-25 02:38:17'),
	(28, 30, 250.00, 'dinheiro', 'pago', '2026-05-28', '2026-05-28 02:38:17', '2026-05-28 02:38:17'),
	(29, 31, 300.00, 'cartao_credito', 'pago', '2026-04-18', '2026-04-18 02:38:17', '2026-04-18 02:38:17'),
	(30, 32, 250.00, 'cartao_credito', 'pago', '2026-04-18', '2026-04-18 02:38:18', '2026-04-18 02:38:18'),
	(31, 33, 150.00, 'boleto', 'pendente', NULL, '2026-05-30 02:38:18', '2026-05-30 02:38:18'),
	(32, 34, 380.00, 'pix', 'pendente', NULL, '2026-03-25 02:38:18', '2026-03-25 02:38:18'),
	(33, 35, 800.00, 'dinheiro', 'pago', '2026-05-21', '2026-05-21 02:38:18', '2026-05-21 02:38:18');

-- Copiando estrutura para tabela maonamassa_devsis2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.password_reset_tokens: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela maonamassa_devsis2.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preco` decimal(10,2) NOT NULL,
  `quantidade` int NOT NULL DEFAULT '0',
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produtos_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `produtos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.produtos: ~0 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `usuario_id`, `nome`, `descricao`, `categoria`, `preco`, `quantidade`, `foto`, `status`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Kit Tomadas e Interruptores', 'Produto de qualidade profissional: Kit Tomadas e Interruptores.', 'Elétrica', 89.90, 20, 'fotos/produtos/T9h1ICP6mcXpQBkfbUWxndamUhGSi1liiXDJPw26.png', 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:55:12'),
	(2, 3, 'Cabo Flexível 2,5mm 100m', 'Produto de qualidade profissional: Cabo Flexível 2,5mm 100m.', 'Decoração', 149.00, 15, 'fotos/produtos/al46SFkpkNuDrSTgGbvTUGY1PWqdfY37tPber29v.png', 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:55:47'),
	(3, 4, 'Fita Isolante Kit 10 Unidades', 'Produto de qualidade profissional: Fita Isolante Kit 10 Unidades.', 'Elétrica', 25.90, 50, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(4, 5, 'Registro de Pressão 1/2"', 'Produto de qualidade profissional: Registro de Pressão 1/2".', 'Hidráulica', 45.00, 30, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(5, 5, 'Veda Rosca Teflon 50m', 'Produto de qualidade profissional: Veda Rosca Teflon 50m.', 'Hidráulica', 12.50, 80, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(6, 6, 'Verniz para Madeira 900ml', 'Produto de qualidade profissional: Verniz para Madeira 900ml.', 'Marcenaria', 38.50, 25, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(7, 7, 'Tinta Acrílica Premium 18L', 'Produto de qualidade profissional: Tinta Acrílica Premium 18L.', 'Pintura', 210.00, 12, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(8, 7, 'Rolo de Lã 23cm Kit 5un', 'Produto de qualidade profissional: Rolo de Lã 23cm Kit 5un.', 'Pintura', 55.00, 40, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(9, 9, 'Kit Produtos de Limpeza Profissional', 'Produto de qualidade profissional: Kit Produtos de Limpeza Profissional.', 'Limpeza', 120.00, 18, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(10, 11, 'Inseticida Profissional 5L', 'Produto de qualidade profissional: Inseticida Profissional 5L.', 'Dedetização', 180.00, 8, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17');

-- Copiando estrutura para tabela maonamassa_devsis2.servicos
CREATE TABLE IF NOT EXISTS `servicos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preco_estimado` decimal(10,2) DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('ativo','inativo') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ativo',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `servicos_usuario_id_foreign` (`usuario_id`),
  CONSTRAINT `servicos_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.servicos: ~22 rows (aproximadamente)
INSERT INTO `servicos` (`id`, `usuario_id`, `titulo`, `descricao`, `categoria`, `preco_estimado`, `foto`, `status`, `created_at`, `updated_at`) VALUES
	(1, 3, 'Instalação Elétrica Residencial', 'Serviço profissional de Instalação Elétrica Residencial. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'eletricidade', 280.00, 'fotos/servicos/5cuKFhZoRAaX7KFhP1L6uVfMyMU04M4miuqlrb92.png', 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:46:42'),
	(2, 3, 'Revisão Hidráulica Completa', 'Serviço profissional de Revisão Hidráulica Completa. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Hidráulica', 200.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(3, 3, 'Serviços Gerais de Manutenção', 'Serviço profissional de Serviços Gerais de Manutenção. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Manutenção', 150.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(4, 4, 'Troca de Disjuntores e Quadro Elétrico', 'Serviço profissional de Troca de Disjuntores e Quadro Elétrico. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Elétrica', 180.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(5, 4, 'Instalação de Ar-condicionado', 'Serviço profissional de Instalação de Ar-condicionado. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Elétrica', 350.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(6, 5, 'Conserto de Vazamento', 'Serviço profissional de Conserto de Vazamento. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Hidráulica', 150.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(7, 5, 'Instalação de Torneiras e Registros', 'Serviço profissional de Instalação de Torneiras e Registros. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Hidráulica', 120.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(8, 5, 'Desentupimento de Esgoto', 'Serviço profissional de Desentupimento de Esgoto. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Hidráulica', 200.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(9, 6, 'Fabricação de Móveis Planejados', 'Serviço profissional de Fabricação de Móveis Planejados. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Marcenaria', 800.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(10, 6, 'Reforma de Móveis Antigos', 'Serviço profissional de Reforma de Móveis Antigos. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Marcenaria', 300.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(11, 7, 'Pintura Interna Completa', 'Serviço profissional de Pintura Interna Completa. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Pintura', 600.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(12, 7, 'Pintura de Fachada', 'Serviço profissional de Pintura de Fachada. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Pintura', 900.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(13, 7, 'Textura e Grafiato', 'Serviço profissional de Textura e Grafiato. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Pintura', 750.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(14, 8, 'Jardinagem e Paisagismo', 'Serviço profissional de Jardinagem e Paisagismo. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Jardinagem', 200.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(15, 8, 'Poda de Árvores', 'Serviço profissional de Poda de Árvores. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Jardinagem', 180.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(16, 9, 'Limpeza Residencial Completa', 'Serviço profissional de Limpeza Residencial Completa. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Limpeza', 180.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(17, 9, 'Limpeza Pós-Obra', 'Serviço profissional de Limpeza Pós-Obra. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Limpeza', 400.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(18, 9, 'Higienização de Sofás e Colchões', 'Serviço profissional de Higienização de Sofás e Colchões. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Limpeza', 220.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(19, 10, 'Construção de Muro e Alambrado', 'Serviço profissional de Construção de Muro e Alambrado. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Construção Civil', 1200.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(20, 10, 'Reforma de Banheiro Completa', 'Serviço profissional de Reforma de Banheiro Completa. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Construção Civil', 2500.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(21, 11, 'Dedetização Residencial', 'Serviço profissional de Dedetização Residencial. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Dedetização', 250.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(22, 11, 'Controle de Cupins', 'Serviço profissional de Controle de Cupins. Orçamento sem compromisso, materiais inclusos quando aplicável.', 'Dedetização', 380.00, NULL, 'ativo', '2026-06-11 02:38:17', '2026-06-11 02:38:17');

-- Copiando estrutura para tabela maonamassa_devsis2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
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

-- Copiando dados para a tabela maonamassa_devsis2.sessions: ~1 rows (aproximadamente)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('VNvKb1A6DrEgSsNHN5E8pSsptJOr5hscKVGRhB9D', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/147.0.0.0 Safari/537.36 OPR/131.0.0.0', 'eyJfdG9rZW4iOiJFbFNSQ29ZOEFnUDE5U2UxQkRVTDRhVkhUZDZQWU1aTnVhNzkxYWNhIiwidXJsIjpbXSwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MDAwXC9wcm9kdXRvcyIsInJvdXRlIjoicHJvZHV0b3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1781135747);

-- Copiando estrutura para tabela maonamassa_devsis2.solicitacoes
CREATE TABLE IF NOT EXISTS `solicitacoes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` bigint unsigned NOT NULL,
  `prestador_id` bigint unsigned DEFAULT NULL,
  `titulo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('aberta','em_andamento','concluida','cancelada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aberta',
  `disponibilidade` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitacoes_usuario_id_foreign` (`usuario_id`),
  KEY `solicitacoes_prestador_id_foreign` (`prestador_id`),
  CONSTRAINT `solicitacoes_prestador_id_foreign` FOREIGN KEY (`prestador_id`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  CONSTRAINT `solicitacoes_usuario_id_foreign` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.solicitacoes: ~0 rows (aproximadamente)
INSERT INTO `solicitacoes` (`id`, `usuario_id`, `prestador_id`, `titulo`, `descricao`, `categoria`, `foto`, `status`, `disponibilidade`, `created_at`, `updated_at`) VALUES
	(1, 2, 3, 'Instalação elétrica na cozinha', 'Preciso instalar 3 tomadas novas na cozinha e verificar o quadro elétrico.', 'Elétrica', NULL, 'concluida', '2026-05-04', '2026-05-02 02:38:17', '2026-05-12 02:38:17'),
	(2, 2, 3, 'Revisão hidráulica no banheiro', 'Torneira pingando e pressão baixa no chuveiro. Preciso de revisão completa.', 'Hidráulica', NULL, 'concluida', '2026-05-23', '2026-05-22 02:38:17', '2026-05-30 02:38:17'),
	(3, 2, 3, 'Manutenção geral — quintal e varanda', 'Pequenos reparos: fixar prateleiras, ajustar dobradiças, verificar tomadas externas.', 'Manutenção', NULL, 'concluida', '2026-06-05', '2026-06-04 02:38:17', '2026-06-09 02:38:17'),
	(4, 2, NULL, 'Instalar iluminação LED na sala', 'Quero instalar spots de LED embutidos no teto da sala. Preciso de orçamento.', 'Elétrica', NULL, 'aberta', '2026-06-15', '2026-06-11 02:38:17', '2026-06-11 02:38:17'),
	(5, 2, 3, 'Desentupimento da pia da cozinha', 'Pia está entupida há dois dias, urgente.', 'Hidráulica', NULL, 'em_andamento', '2026-06-11', '2026-06-09 02:38:17', '2026-06-09 02:38:17'),
	(6, 2, 3, 'Troca de tomadas no quarto', 'Tomadas do quarto principal com folga, preciso trocar todas (4 tomadas).', 'Elétrica', NULL, 'em_andamento', '2026-06-13', '2026-06-10 02:38:17', '2026-06-10 02:38:17'),
	(7, 2, 3, 'Verificar quadro elétrico — sobrecarga', 'Disjuntor cai com frequência quando uso microondas e ar junto. Preciso de vistoria.', 'Elétrica', NULL, 'em_andamento', '2026-06-16', '2026-06-10 20:38:17', '2026-06-10 20:38:17'),
	(8, 17, 8, 'Preciso trocar fiação do quarto', 'Olá, Preciso trocar fiação do quarto. Preciso de atendimento o quanto antes.', 'Jardinagem', NULL, 'concluida', '2026-04-29', '2026-04-28 02:38:17', '2026-04-28 02:38:17'),
	(9, 20, 4, 'Torneira pingando na cozinha', 'Olá, Torneira pingando na cozinha. Preciso de atendimento o quanto antes.', 'Elétrica', NULL, 'concluida', '2026-05-30', '2026-05-29 02:38:17', '2026-05-29 02:38:17'),
	(10, 16, 9, 'Quero pintar sala e cozinha', 'Olá, Quero pintar sala e cozinha. Preciso de atendimento o quanto antes.', 'Limpeza', NULL, 'concluida', '2026-03-31', '2026-03-30 02:38:17', '2026-03-30 02:38:17'),
	(11, 15, 8, 'Jardim precisando de cuidados', 'Olá, Jardim precisando de cuidados. Preciso de atendimento o quanto antes.', 'Jardinagem', NULL, 'concluida', '2026-05-19', '2026-05-18 02:38:17', '2026-05-18 02:38:17'),
	(12, 14, 9, 'Limpeza após reforma na casa', 'Olá, Limpeza após reforma na casa. Preciso de atendimento o quanto antes.', 'Limpeza', NULL, 'concluida', '2026-02-23', '2026-02-22 02:38:17', '2026-02-22 02:38:17'),
	(13, 20, 7, 'Vistoria elétrica completa', 'Olá, Vistoria elétrica completa. Preciso de atendimento o quanto antes.', 'Pintura', NULL, 'concluida', '2026-05-03', '2026-05-02 02:38:17', '2026-05-02 02:38:17'),
	(14, 16, 5, 'Desentupimento de pia', 'Olá, Desentupimento de pia. Preciso de atendimento o quanto antes.', 'Hidráulica', NULL, 'concluida', '2026-02-27', '2026-02-26 02:38:17', '2026-02-26 02:38:17'),
	(15, 21, 6, 'Orçamento para banheiro novo', 'Olá, Orçamento para banheiro novo. Preciso de atendimento o quanto antes.', 'Marcenaria', NULL, 'concluida', '2026-02-14', '2026-02-13 02:38:17', '2026-02-13 02:38:17'),
	(16, 22, 7, 'Instalação de chuveiro elétrico', 'Olá, Instalação de chuveiro elétrico. Preciso de atendimento o quanto antes.', 'Pintura', NULL, 'concluida', '2026-04-30', '2026-04-29 02:38:17', '2026-04-29 02:38:17'),
	(17, 14, 8, 'Pintura de fachada da loja', 'Olá, Pintura de fachada da loja. Preciso de atendimento o quanto antes.', 'Jardinagem', NULL, 'concluida', '2026-04-10', '2026-04-09 02:38:17', '2026-04-09 02:38:17'),
	(18, 13, 10, 'Poda das árvores do quintal', 'Olá, Poda das árvores do quintal. Preciso de atendimento o quanto antes.', 'Construção Civil', NULL, 'concluida', '2026-06-02', '2026-06-01 02:38:17', '2026-06-01 02:38:17'),
	(19, 12, 5, 'Higienização de sofás', 'Olá, Higienização de sofás. Preciso de atendimento o quanto antes.', 'Hidráulica', NULL, 'concluida', '2026-03-17', '2026-03-16 02:38:17', '2026-03-16 02:38:17'),
	(20, 14, 11, 'Controle de baratas e formigas', 'Olá, Controle de baratas e formigas. Preciso de atendimento o quanto antes.', 'Dedetização', NULL, 'concluida', '2026-05-23', '2026-05-22 02:38:17', '2026-05-22 02:38:17'),
	(21, 16, 10, 'Fabricar estante para escritório', 'Olá, Fabricar estante para escritório. Preciso de atendimento o quanto antes.', 'Construção Civil', NULL, 'concluida', '2026-03-24', '2026-03-23 02:38:17', '2026-03-23 02:38:17'),
	(22, 18, 10, 'Reparo em muro de divisa', 'Olá, Reparo em muro de divisa. Preciso de atendimento o quanto antes.', 'Construção Civil', NULL, 'concluida', '2026-05-13', '2026-05-12 02:38:17', '2026-05-12 02:38:17'),
	(23, 14, 9, 'Instalação de luminárias', 'Olá, Instalação de luminárias. Preciso de atendimento o quanto antes.', 'Limpeza', NULL, 'concluida', '2026-04-04', '2026-04-03 02:38:17', '2026-04-03 02:38:17'),
	(24, 15, 8, 'Conserto de vaso sanitário', 'Olá, Conserto de vaso sanitário. Preciso de atendimento o quanto antes.', 'Jardinagem', NULL, 'concluida', '2026-02-25', '2026-02-24 02:38:17', '2026-02-24 02:38:17'),
	(25, 17, 5, 'Limpeza geral da casa', 'Olá, Limpeza geral da casa. Preciso de atendimento o quanto antes.', 'Hidráulica', NULL, 'concluida', '2026-03-06', '2026-03-05 02:38:17', '2026-03-05 02:38:17'),
	(26, 21, 6, 'Verniz nos móveis da sala', 'Olá, Verniz nos móveis da sala. Preciso de atendimento o quanto antes.', 'Marcenaria', NULL, 'concluida', '2026-05-13', '2026-05-12 02:38:17', '2026-05-12 02:38:17'),
	(27, 14, 8, 'Dedetização preventiva anual', 'Olá, Dedetização preventiva anual. Preciso de atendimento o quanto antes.', 'Jardinagem', NULL, 'concluida', '2026-05-14', '2026-05-13 02:38:17', '2026-05-13 02:38:17'),
	(28, 14, 6, 'Preciso trocar fiação do quarto', 'Olá, Preciso trocar fiação do quarto. Preciso de atendimento o quanto antes.', 'Marcenaria', NULL, 'concluida', '2026-03-01', '2026-02-28 02:38:17', '2026-02-28 02:38:17'),
	(29, 14, 4, 'Torneira pingando na cozinha', 'Olá, Torneira pingando na cozinha. Preciso de atendimento o quanto antes.', 'Elétrica', NULL, 'concluida', '2026-04-19', '2026-04-18 02:38:17', '2026-04-18 02:38:17'),
	(30, 20, 4, 'Quero pintar sala e cozinha', 'Olá, Quero pintar sala e cozinha. Preciso de atendimento o quanto antes.', 'Elétrica', NULL, 'concluida', '2026-02-20', '2026-02-19 02:38:17', '2026-02-19 02:38:17'),
	(31, 14, 10, 'Jardim precisando de cuidados', 'Olá, Jardim precisando de cuidados. Preciso de atendimento o quanto antes.', 'Construção Civil', NULL, 'concluida', '2026-03-20', '2026-03-19 02:38:17', '2026-03-19 02:38:17'),
	(32, 22, 11, 'Limpeza após reforma na casa', 'Olá, Limpeza após reforma na casa. Preciso de atendimento o quanto antes.', 'Dedetização', NULL, 'concluida', '2026-05-24', '2026-05-23 02:38:17', '2026-05-23 02:38:17'),
	(33, 19, 6, 'Vistoria elétrica completa', 'Olá, Vistoria elétrica completa. Preciso de atendimento o quanto antes.', 'Marcenaria', NULL, 'concluida', '2026-04-15', '2026-04-14 02:38:17', '2026-04-14 02:38:17'),
	(34, 12, 11, 'Desentupimento de pia', 'Olá, Desentupimento de pia. Preciso de atendimento o quanto antes.', 'Dedetização', NULL, 'concluida', '2026-04-10', '2026-04-09 02:38:18', '2026-04-09 02:38:18'),
	(35, 13, 5, 'Orçamento para banheiro novo', 'Olá, Orçamento para banheiro novo. Preciso de atendimento o quanto antes.', 'Hidráulica', NULL, 'concluida', '2026-05-22', '2026-05-21 02:38:18', '2026-05-21 02:38:18'),
	(36, 16, 11, 'Instalação de chuveiro elétrico', 'Olá, Instalação de chuveiro elétrico. Preciso de atendimento o quanto antes.', 'Dedetização', NULL, 'concluida', '2026-03-20', '2026-03-19 02:38:18', '2026-03-19 02:38:18'),
	(37, 15, 6, 'Pintura de fachada da loja', 'Olá, Pintura de fachada da loja. Preciso de atendimento o quanto antes.', 'Marcenaria', NULL, 'concluida', '2026-05-12', '2026-05-11 02:38:18', '2026-05-11 02:38:18'),
	(38, 12, NULL, 'Instalação de tomadas no escritório', 'Instalação de tomadas no escritório. Preciso de orçamento com urgência.', 'Elétrica', NULL, 'aberta', '2026-06-13', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(39, 17, NULL, 'Vazamento no teto do quarto', 'Vazamento no teto do quarto. Preciso de orçamento com urgência.', 'Hidráulica', NULL, 'aberta', '2026-06-15', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(40, 21, NULL, 'Pintura do corredor e hall', 'Pintura do corredor e hall. Preciso de orçamento com urgência.', 'Pintura', NULL, 'aberta', '2026-06-14', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(41, 18, NULL, 'Limpeza de caixa d\'água', 'Limpeza de caixa d\'água. Preciso de orçamento com urgência.', 'Limpeza', NULL, 'aberta', '2026-06-14', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(42, 21, NULL, 'Manutenção de jardim mensal', 'Manutenção de jardim mensal. Preciso de orçamento com urgência.', 'Jardinagem', NULL, 'aberta', '2026-06-16', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(43, 21, NULL, 'Dedetização de apartamento', 'Dedetização de apartamento. Preciso de orçamento com urgência.', 'Dedetização', NULL, 'aberta', '2026-06-17', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(44, 16, NULL, 'Reforma do lavabo', 'Reforma do lavabo. Preciso de orçamento com urgência.', 'Construção Civil', NULL, 'aberta', '2026-06-14', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(45, 21, NULL, 'Troca de telhas quebradas', 'Troca de telhas quebradas. Preciso de orçamento com urgência.', 'Construção Civil', NULL, 'aberta', '2026-06-13', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(46, 12, 4, 'Agendamento — Instalação de Ar-condicionado', 'Agendamento solicitado via plataforma.', 'Elétrica', NULL, 'em_andamento', '2026-06-15', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(47, 23, 11, 'Agendamento — Dedetização Residencial', 'Agendamento solicitado via plataforma.', 'Dedetização', NULL, 'em_andamento', '2026-06-21', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(48, 13, 6, 'Agendamento — Fabricação de Móveis Planejados', 'Agendamento solicitado via plataforma.', 'Marcenaria', NULL, 'em_andamento', '2026-06-21', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(49, 22, 4, 'Agendamento — Troca de Disjuntores e Quadro Elétrico', 'Agendamento solicitado via plataforma.', 'Elétrica', NULL, 'em_andamento', '2026-06-14', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(50, 15, 4, 'Agendamento — Troca de Disjuntores e Quadro Elétrico', 'Agendamento solicitado via plataforma.', 'Elétrica', NULL, 'em_andamento', '2026-06-17', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(51, 13, 5, 'Agendamento — Conserto de Vazamento', 'Agendamento solicitado via plataforma.', 'Hidráulica', NULL, 'em_andamento', '2026-06-11', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(52, 18, 8, 'Agendamento — Jardinagem e Paisagismo', 'Agendamento solicitado via plataforma.', 'Jardinagem', NULL, 'em_andamento', '2026-06-24', '2026-06-11 02:38:18', '2026-06-11 02:38:18'),
	(53, 16, 7, 'Agendamento — Pintura de Fachada', 'Agendamento solicitado via plataforma.', 'Pintura', NULL, 'em_andamento', '2026-06-17', '2026-06-11 02:38:18', '2026-06-11 02:38:18');

-- Copiando estrutura para tabela maonamassa_devsis2.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foto` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` enum('cliente','prestador','adm') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cliente',
  `tipo_pessoa` enum('fisico','juridico') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cpf_cnpj` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `razao_social` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nome_fantasia` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `especialidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio` text COLLATE utf8mb4_unicode_ci,
  `cep` varchar(9) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logradouro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `complemento` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bairro` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cidade` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuarios_email_unique` (`email`),
  UNIQUE KEY `usuarios_cpf_cnpj_unique` (`cpf_cnpj`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Copiando dados para a tabela maonamassa_devsis2.usuarios: ~4 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `email`, `password`, `telefone`, `foto`, `tipo`, `tipo_pessoa`, `cpf_cnpj`, `razao_social`, `nome_fantasia`, `especialidade`, `portfolio`, `cep`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Administrador', 'admin@maonamassa.com.br', '$2y$12$e15bYyS3lV9/0EqWDj/ad.706RxnlTVt/84ATYg8dDRAG0J3Apdum', '(49) 99999-0000', 'https://robohash.org/e89715a970fad2f67d5f0e64496968aa?set=set1&size=200x200', 'adm', 'fisico', '000.000.000-00', 'Administrador do Sistema', 'Admin Mão na Massa', 'Administração', 'Administrador do sistema.', '89801-001', 'Rua Marechal Bormann', '100', 'Sala ADM', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:09', '2026-06-11 02:38:09'),
	(2, 'Cliente Padrão', 'cliente@maonamassa.com.br', '$2y$12$HZj5jc8kuvFNl2pU7nGQze1W7uqKd69TuAEN0JsUKKMHhaMxIZPUy', '(49) 99111-1111', 'https://robohash.org/4651fda75b5c320a8b94519c759f6446?set=set1&size=200x200', 'cliente', 'fisico', '111.111.111-11', 'Cliente Padrão', 'Cliente Padrão', 'Contratante', 'Cliente padrão para testes da plataforma.', '89801-100', 'Rua das Flores', '123', 'Casa', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:09', '2026-06-11 02:38:09'),
	(3, 'Prestador Padrão', 'prestador@maonamassa.com.br', '$2y$12$H/YXwCsBwBlIhjpBKosFEeKN8KZeeS0lE.CA5QmjJd/RH0KVtXqCi', '(49) 99222-2222', 'https://robohash.org/92d679c791bd0083431ce15edc88f96d?set=set1&size=200x200', 'prestador', 'fisico', '222.222.222-22', 'Prestador Padrão Serviços', 'Prestador Padrão', 'Serviços Gerais', 'Prestador de serviços gerais com experiência em elétrica, hidráulica e reformas.', '89802-112', 'Avenida Getúlio Vargas', '456', 'Sala 01', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:09', '2026-06-11 02:38:09'),
	(4, 'Carlos Eduardo Ramos', 'carlos@email.com', '$2y$12$TatmA0OnKKdFggE5KWL3yemnsVr26kCygLqCRoluNNdFMHgwHw3my', '(49) 99333-3333', 'https://robohash.org/7113a9fa59beade32b6ceeb163e8f8c5?set=set1&size=200x200', 'prestador', 'fisico', '333.333.333-33', 'Carlos Eduardo Ramos Serviços', 'Elétrica Ramos', 'elétrica', 'Experiência profissional em elétrica. Atendimento em Chapecó e região.', '89803-001', 'Rua Carlos', '100', 'Sala 1', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:10', '2026-06-11 02:38:10'),
	(5, 'Ana Paula Ferreira', 'ana@email.com', '$2y$12$DPK.ZzBchmYfPvq2AoQ2iuAtKBZ0cG/j3vYhh6NBV1MGNtRASjfS6', '(49) 99444-4444', 'https://robohash.org/226269b7ccd3e556c6862b2beb0ebddd?set=set1&size=200x200', 'prestador', 'fisico', '444.444.444-44', 'Ana Paula Ferreira Serviços', 'Ana Hidráulica', 'hidráulica', 'Experiência profissional em hidráulica. Atendimento em Chapecó e região.', '89804-002', 'Rua Ana', '137', 'Sala 2', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:10', '2026-06-11 02:38:10'),
	(6, 'Roberto Lima', 'roberto@email.com', '$2y$12$L8W6OgVft7EnSydYxgTKuetOmTByUmqzWnYog.D1M19OeTMmIvjQW', '(49) 99555-5555', 'https://robohash.org/c50108fd26461b2efc208272380abe30?set=set1&size=200x200', 'prestador', 'fisico', '555.555.555-55', 'Roberto Lima Marcenaria', 'Roberto Marceneiro', 'marcenaria', 'Experiência profissional em marcenaria. Atendimento em Chapecó e região.', '89805-003', 'Rua Roberto', '174', 'Sala 3', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:10', '2026-06-11 02:38:10'),
	(7, 'Fernanda Costa', 'fernanda@email.com', '$2y$12$A8nHv5LoBkSGRZOFkKrtcuQvmVmqF22L62cQ5IpBfJQ2JzST/sqcO', '(49) 99666-6666', 'https://robohash.org/e376a9d2acd0e5abfd511426fc49df2b?set=set1&size=200x200', 'prestador', 'juridico', '11.111.111/0001-11', 'Costa Reformas LTDA', 'Costa Reformas', 'pintura', 'Experiência profissional em pintura. Atendimento em Chapecó e região.', '89806-004', 'Rua Fernanda', '211', 'Sala 4', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:11', '2026-06-11 02:38:11'),
	(8, 'Marcos Oliveira', 'marcos@email.com', '$2y$12$r3Z9oIlJNBZPVNZVxshtL.bLQ6lRd405mdNn7g3UnWFTAy6.wJi4i', '(49) 99777-7777', 'https://robohash.org/2a93df1a7fa8ab4bd9873bf34569c1d5?set=set1&size=200x200', 'prestador', 'fisico', '666.666.666-66', 'Marcos Oliveira Jardinagem', 'Marcos Jardins', 'jardinagem', 'Experiência profissional em jardinagem. Atendimento em Chapecó e região.', '89807-005', 'Rua Marcos', '248', 'Sala 5', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:11', '2026-06-11 02:38:11'),
	(9, 'Juliana Souza', 'juliana@email.com', '$2y$12$p0etqRngyX./jbd5hGJxeOXnMsPe/iFYCIc.ggfb8a76ZXCNr6tyC', '(49) 99888-8888', 'https://robohash.org/c65e7acbabfa74eac5e413bdfb91e324?set=set1&size=200x200', 'prestador', 'fisico', '777.777.777-77', 'Juliana Souza Limpeza', 'Juliana Clean', 'limpeza', 'Experiência profissional em limpeza. Atendimento em Chapecó e região.', '89808-006', 'Rua Juliana', '285', 'Sala 6', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:11', '2026-06-11 02:38:11'),
	(10, 'Diego Alves', 'diego@email.com', '$2y$12$Xx.7i.YHkJTz10BfZtk0u.qIuUzzQutt1raSl6lsTDAPest0.sknG', '(49) 99123-4567', 'https://robohash.org/e1bbcf0423a28c8618605c1c9f477ae5?set=set1&size=200x200', 'prestador', 'juridico', '22.222.222/0001-22', 'Alves Construções LTDA', 'Alves Construções', 'construção civil', 'Experiência profissional em construção civil. Atendimento em Chapecó e região.', '89809-007', 'Rua Diego', '322', 'Sala 7', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:12', '2026-06-11 02:38:12'),
	(11, 'Patricia Mendes', 'patricia@email.com', '$2y$12$B3QUqhiAalE9zGH.ja3m3.ivwi8OaazFGaLemWqEcLMDfV8dPqGO2', '(49) 99234-5678', 'https://robohash.org/e1488fde612f786c50c63a2dad995a4c?set=set1&size=200x200', 'prestador', 'fisico', '888.888.888-88', 'Patricia Mendes Dedetização', 'Patricia Dedet', 'dedetização', 'Experiência profissional em dedetização. Atendimento em Chapecó e região.', '89810-008', 'Rua Patricia', '359', 'Sala 8', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:12', '2026-06-11 02:38:12'),
	(12, 'Lucas Martins', 'lucas1@email.com', '$2y$12$346vZZsq5Hc0RJoCuA.cUudcs3lVD80W4zjaDpw6Byd5FwtSc2JwG', '(49) 99301-1001', 'https://robohash.org/8f4f9111ea14e62c7d4500f75a70041c?set=set1&size=200x200', 'cliente', 'fisico', '123.456.789-01', 'Lucas Martins', 'Lucas Martins', 'Contratante', 'Cliente cadastrado na plataforma.', '89801-010', 'Rua Lucas Martins', '50', 'Casa 1', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:13', '2026-06-11 02:38:13'),
	(13, 'Beatriz Carvalho', 'beatriz2@email.com', '$2y$12$i9ajSTicpF9EH93NSSzD5OIcWinaWtlxRsfvv0Fx463rZ5DQkfg9i', '(49) 99302-1002', 'https://robohash.org/265e691c455e8615726378bcda0ec74e?set=set1&size=200x200', 'cliente', 'fisico', '234.567.890-12', 'Beatriz Carvalho', 'Beatriz Carvalho', 'Contratante', 'Cliente cadastrado na plataforma.', '89802-011', 'Rua Beatriz Carvalho', '63', 'Casa 2', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:13', '2026-06-11 02:38:13'),
	(14, 'Felipe Rodrigues', 'felipe3@email.com', '$2y$12$leKpUqmZyWNWnrLRuBBwDuV6bWPwxsrQD8JrOPmgdFmjDXkmiNeT2', '(49) 99303-1003', 'https://robohash.org/ce04e9774a902b9d28cc9108fc2e4fe3?set=set1&size=200x200', 'cliente', 'fisico', '345.678.901-23', 'Felipe Rodrigues', 'Felipe Rodrigues', 'Contratante', 'Cliente cadastrado na plataforma.', '89803-012', 'Rua Felipe Rodrigues', '76', 'Casa 3', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:13', '2026-06-11 02:38:13'),
	(15, 'Camila Nascimento', 'camila4@email.com', '$2y$12$UlnQdRL3gniXTaeIbVBebuaf5wSLTpjo1RX4JwR7YMq5QpAxtgbha', '(49) 99304-1004', 'https://robohash.org/e3954ea2e2d67949eabf2a711f187356?set=set1&size=200x200', 'cliente', 'fisico', '456.789.012-34', 'Camila Nascimento', 'Camila Nascimento', 'Contratante', 'Cliente cadastrado na plataforma.', '89804-013', 'Rua Camila Nascimento', '89', 'Casa 4', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:14', '2026-06-11 02:38:14'),
	(16, 'Gabriel Pereira', 'gabriel5@email.com', '$2y$12$A1vm3JZsRAYZ4ytyR3MJTOE5Rq8meiOT2fRBQ8UkZyhrm/Fk8lR7q', '(49) 99305-1005', 'https://robohash.org/2c6b5bf3e0ce66b86c237a9d6d43285e?set=set1&size=200x200', 'cliente', 'fisico', '567.890.123-45', 'Gabriel Pereira', 'Gabriel Pereira', 'Contratante', 'Cliente cadastrado na plataforma.', '89805-014', 'Rua Gabriel Pereira', '102', 'Casa 5', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:14', '2026-06-11 02:38:14'),
	(17, 'Larissa Gomes', 'larissa6@email.com', '$2y$12$robwVtY/ZWf35yljMtW6jORLLA6KIYdex3mMA3QPlziinjQ0h0hfS', '(49) 99306-1006', 'https://robohash.org/8489b157ecbc6e198d508c7c4037f5d4?set=set1&size=200x200', 'cliente', 'fisico', '678.901.234-56', 'Larissa Gomes', 'Larissa Gomes', 'Contratante', 'Cliente cadastrado na plataforma.', '89806-015', 'Rua Larissa Gomes', '115', 'Casa 6', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:14', '2026-06-11 02:38:14'),
	(18, 'Thiago Barbosa', 'thiago7@email.com', '$2y$12$dYdOyrEtOif1TWs/U7e7IuyvgHLI3WOYhjTKnnXozKJxKMkGMQiMa', '(49) 99307-1007', 'https://robohash.org/218689a7c709f7cd6fd7810c43dfa859?set=set1&size=200x200', 'cliente', 'fisico', '789.012.345-67', 'Thiago Barbosa', 'Thiago Barbosa', 'Contratante', 'Cliente cadastrado na plataforma.', '89807-016', 'Rua Thiago Barbosa', '128', 'Casa 7', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:15', '2026-06-11 02:38:15'),
	(19, 'Isabela Moreira', 'isabela8@email.com', '$2y$12$ku4tVd/B5JxCRSKbWfjvzOBcWn7r4ooeTWfS3qevHYzXpyiPp4aIi', '(49) 99308-1008', 'https://robohash.org/94b9738cea690511952c2b81ecaacdc0?set=set1&size=200x200', 'cliente', 'fisico', '890.123.456-78', 'Isabela Moreira', 'Isabela Moreira', 'Contratante', 'Cliente cadastrado na plataforma.', '89808-017', 'Rua Isabela Moreira', '141', 'Casa 8', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:15', '2026-06-11 02:38:15'),
	(20, 'Vinícius Santos', 'vinicius9@email.com', '$2y$12$eEmRN5kIQJ5sIfwB3m4EF.BxgKV44Inetr2FHPpdBb3uFfrG8zhjy', '(49) 99309-1009', 'https://robohash.org/7bd2b339cd7a552c97cc81171fb9de7d?set=set1&size=200x200', 'cliente', 'fisico', '901.234.567-89', 'Vinícius Santos', 'Vinícius Santos', 'Contratante', 'Cliente cadastrado na plataforma.', '89809-018', 'Rua Vinícius Santos', '154', 'Casa 9', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:16', '2026-06-11 02:38:16'),
	(21, 'Mariana Ribeiro', 'mariana10@email.com', '$2y$12$k1JmznffNeL4Xq22kf.NPO8uXxC9zJAGEvqBcM0K6YsnGFULnJ.P2', '(49) 99310-1010', 'https://robohash.org/77175fc34c33bb7da7a5a85830f5f539?set=set1&size=200x200', 'cliente', 'fisico', '012.345.678-90', 'Mariana Ribeiro', 'Mariana Ribeiro', 'Contratante', 'Cliente cadastrado na plataforma.', '89801-019', 'Rua Mariana Ribeiro', '167', 'Casa 10', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:16', '2026-06-11 02:38:16'),
	(22, 'Eduardo Lopes', 'eduardo11@email.com', '$2y$12$yfnx/B6erYOD2lN4phHyLOmEzAvV3newLH4FHlVRZVdUr3xZ6tgNW', '(49) 99311-1011', 'https://robohash.org/c2323950faba489e1b5acfa5742e7d93?set=set1&size=200x200', 'cliente', 'fisico', '321.654.987-01', 'Eduardo Lopes', 'Eduardo Lopes', 'Contratante', 'Cliente cadastrado na plataforma.', '89802-020', 'Rua Eduardo Lopes', '180', 'Casa 11', 'Centro', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:16', '2026-06-11 02:38:16'),
	(23, 'Natália Araújo', 'natalia12@email.com', '$2y$12$rH0TjSDHYpjaZxl02BHZieO69kVG2JiXKdQX.Vbj4rTcCGO5FiN1C', '(49) 99312-1012', 'https://robohash.org/67defc7e914f41ba922b93a1b52c6df5?set=set1&size=200x200', 'cliente', 'fisico', '432.765.098-12', 'Natália Araújo', 'Natália Araújo', 'Contratante', 'Cliente cadastrado na plataforma.', '89803-021', 'Rua Natália Araújo', '193', 'Casa 12', 'Efapi', 'Chapecó', 'SC', NULL, '2026-06-11 02:38:17', '2026-06-11 02:38:17');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
