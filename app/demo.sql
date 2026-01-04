DROP TABLE IF EXISTS `alumnus`;
CREATE TABLE `alumnus` (
                           `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                           `tenant_id` bigint unsigned DEFAULT NULL,
                           `user_id` bigint unsigned NOT NULL,
                           `batch_id` bigint unsigned NOT NULL,
                           `department_id` bigint unsigned NOT NULL,
                           `passing_year_id` bigint unsigned NOT NULL,
                           `id_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `company` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `company_designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `company_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `blood_group` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `date_of_birth` date DEFAULT NULL,
                           `gender` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `about_me` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                           `linkedin_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `facebook_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `instagram_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                           `address` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `banks`;
CREATE TABLE `banks` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `tenant_id` bigint unsigned DEFAULT NULL,
                         `gateway_id` bigint unsigned NOT NULL,
                         `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `status` tinyint NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `batches`;
CREATE TABLE `batches` (
                           `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                           `tenant_id` bigint unsigned DEFAULT NULL,
                           `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `chat_media`;
CREATE TABLE `chat_media` (
                              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                              `chat_id` bigint unsigned NOT NULL,
                              `file` int NOT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `chats`;
CREATE TABLE `chats` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `tenant_id` bigint unsigned DEFAULT NULL,
                         `sender_id` int NOT NULL DEFAULT '0',
                         `receiver_id` int NOT NULL DEFAULT '0',
                         `message` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                         `is_seen` int NOT NULL DEFAULT '0',
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE `contact_messages` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    `deleted_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
                              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                              `tenant_id` bigint unsigned DEFAULT NULL,
                              `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `issue` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `deleted_at` timestamp NULL DEFAULT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `core_pages_settings`;
CREATE TABLE `core_pages_settings` (
                                       `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                       `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                       `description` longtext COLLATE utf8mb4_unicode_ci,
                                       `image` int DEFAULT NULL,
                                       `status` tinyint NOT NULL DEFAULT '1',
                                       `created_at` timestamp NULL DEFAULT NULL,
                                       `updated_at` timestamp NULL DEFAULT NULL,
                                       `deleted_at` timestamp NULL DEFAULT NULL,
                                       PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `countries`;
CREATE TABLE `countries` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `short_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `country_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `flag` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `phonecode` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `continent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `status` tinyint NOT NULL DEFAULT '1',
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE `currencies` (
                              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                              `tenant_id` bigint unsigned DEFAULT NULL,
                              `currency_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `symbol` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `currency_placement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
                              `current_currency` smallint unsigned DEFAULT '0',
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `custom_domain_requests`;
CREATE TABLE `custom_domain_requests` (
                                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                          `tenant_id` bigint unsigned NOT NULL,
                                          `user_id` bigint unsigned NOT NULL,
                                          `old_domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `request_domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `status` tinyint NOT NULL DEFAULT '0',
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `database_backup_cron_settings`;
CREATE TABLE `database_backup_cron_settings` (
                                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                                 `status` enum('active','inactive') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                                 `hour_of_day` time NOT NULL DEFAULT '00:00:00',
                                                 `backup_after_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                 `delete_backup_after_days` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                                 `created_at` timestamp NULL DEFAULT NULL,
                                                 `updated_at` timestamp NULL DEFAULT NULL,
                                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `database_backups`;
CREATE TABLE `database_backups` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                    `filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
                               `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                               `tenant_id` bigint unsigned DEFAULT NULL,
                               `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `short_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `created_at` timestamp NULL DEFAULT NULL,
                               `updated_at` timestamp NULL DEFAULT NULL,
                               PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
DROP TABLE IF EXISTS `domains`;
CREATE TABLE `domains` (
                           `id` int unsigned NOT NULL AUTO_INCREMENT,
                           `domain` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `tenant_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `domains_domain_unique` (`domain`),
                           KEY `domains_tenant_id_foreign` (`tenant_id`),
                           CONSTRAINT `domains_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
                                   `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                   `tenant_id` bigint unsigned DEFAULT NULL,
                                   `category` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `slug` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                   `default` tinyint NOT NULL DEFAULT '0',
                                   `status` tinyint NOT NULL DEFAULT '0',
                                   `deleted_at` timestamp NULL DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `event_categories`;
CREATE TABLE `event_categories` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                    `tenant_id` bigint unsigned DEFAULT NULL,
                                    `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `event_tickets`;
CREATE TABLE `event_tickets` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `event_id` bigint unsigned NOT NULL,
                                 `user_id` bigint unsigned NOT NULL,
                                 `ticket_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `events`;
CREATE TABLE `events` (
                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                          `tenant_id` bigint unsigned DEFAULT NULL,
                          `event_category_id` bigint unsigned NOT NULL,
                          `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                          `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                          `thumbnail` int NOT NULL,
                          `ticket_image` int DEFAULT NULL,
                          `date` datetime NOT NULL,
                          `type` tinyint NOT NULL DEFAULT '1',
                          `location` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                          `price` decimal(12,2) NOT NULL DEFAULT '0.00',
                          `number_of_ticket` int NOT NULL DEFAULT '0',
                          `number_of_ticket_left` int NOT NULL DEFAULT '0',
                          `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                          `user_id` bigint unsigned NOT NULL,
                          `status` tinyint NOT NULL DEFAULT '0',
                          `approved_by` bigint unsigned DEFAULT NULL,
                          `deleted_at` timestamp NULL DEFAULT NULL,
                          `created_at` timestamp NULL DEFAULT NULL,
                          `updated_at` timestamp NULL DEFAULT NULL,
                          PRIMARY KEY (`id`),
                          UNIQUE KEY `events_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
                               `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                               `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                               `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs` (
                        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                        `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
                        `description` longtext COLLATE utf8mb4_unicode_ci,
                        `status` tinyint NOT NULL DEFAULT '1',
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        `deleted_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `features_settings`;
CREATE TABLE `features_settings` (
                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                     `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `description` longtext COLLATE utf8mb4_unicode_ci,
                                     `icon` int DEFAULT NULL,
                                     `status` tinyint NOT NULL DEFAULT '1',
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     `deleted_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `file_managers`;
CREATE TABLE `file_managers` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `file_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `storage_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `original_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `user_id` bigint unsigned DEFAULT NULL,
                                 `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `extension` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `size` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `external_link` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`),
                                 UNIQUE KEY `file_managers_file_name_unique` (`file_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `frontend_sections`;
CREATE TABLE `frontend_sections` (
                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                     `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                     `page_title` text COLLATE utf8mb4_unicode_ci,
                                     `title` text COLLATE utf8mb4_unicode_ci,
                                     `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                     `has_page_title` tinyint DEFAULT NULL,
                                     `has_banner_image` tinyint NOT NULL DEFAULT '0',
                                     `has_image` tinyint NOT NULL DEFAULT '0',
                                     `has_description` tinyint NOT NULL DEFAULT '0',
                                     `description` longtext COLLATE utf8mb4_unicode_ci,
                                     `banner_image` int DEFAULT NULL,
                                     `image` int DEFAULT NULL,
                                     `status` tinyint NOT NULL DEFAULT '0',
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     `deleted_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `gateway_currencies`;
CREATE TABLE `gateway_currencies` (
                                      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                      `gateway_id` bigint unsigned NOT NULL,
                                      `currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'USD',
                                      `conversion_rate` decimal(8,2) NOT NULL DEFAULT '1.00',
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL,
                                      `deleted_at` timestamp NULL DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `gateways`;
CREATE TABLE `gateways` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `tenant_id` bigint unsigned DEFAULT NULL,
                            `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `status` tinyint NOT NULL DEFAULT '0' COMMENT '1=Active,0=Disable',
                            `mode` tinyint NOT NULL DEFAULT '2' COMMENT '1=live,2=sandbox',
                            `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'client id, public key, key, store id, api key',
                            `secret` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'client secret, secret, store password, auth token',
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `how_its_works`;
CREATE TABLE `how_its_works` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `description` longtext COLLATE utf8mb4_unicode_ci,
                                 `image` int DEFAULT NULL,
                                 `status` tinyint NOT NULL DEFAULT '1',
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `job_posts`;
CREATE TABLE `job_posts` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `tenant_id` bigint unsigned DEFAULT NULL,
                             `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `compensation_n_benefits` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `salary` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
                             `company_logo` int NOT NULL,
                             `location` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `post_link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `application_deadline` datetime NOT NULL,
                             `job_responsibility` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `job_context` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `educational_requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `additional_requirements` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                             `user_id` bigint unsigned NOT NULL,
                             `employee_status` tinyint NOT NULL,
                             `status` tinyint NOT NULL DEFAULT '0',
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `job_posts_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `languages`;
CREATE TABLE `languages` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `language` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `iso_code` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `flag_id` bigint unsigned DEFAULT NULL,
                             `font` bigint unsigned DEFAULT NULL,
                             `rtl` tinyint DEFAULT '3',
                             `status` tinyint NOT NULL DEFAULT '1',
                             `default` tinyint DEFAULT '0',
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`),
                             UNIQUE KEY `languages_language_unique` (`language`),
                             UNIQUE KEY `languages_iso_code_unique` (`iso_code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `mail_histories`;
CREATE TABLE `mail_histories` (
                                  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                  `owner_user_id` bigint unsigned NOT NULL,
                                  `host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                  `status` tinyint NOT NULL DEFAULT '1',
                                  `user_id` bigint unsigned DEFAULT NULL,
                                  `date` datetime DEFAULT NULL,
                                  `error` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL,
                                  `deleted_at` timestamp NULL DEFAULT NULL,
                                  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `membership_plans`;
CREATE TABLE `membership_plans` (
                                    `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                    `tenant_id` bigint unsigned DEFAULT NULL,
                                    `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `badge` int NOT NULL,
                                    `price` decimal(12,2) NOT NULL,
                                    `duration_type` tinyint NOT NULL DEFAULT '2',
                                    `duration` int NOT NULL,
                                    `status` tinyint NOT NULL DEFAULT '1',
                                    `deleted_at` timestamp NULL DEFAULT NULL,
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL,
                                    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `metas`;
CREATE TABLE `metas` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `slug` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `page_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `meta_title` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                         `meta_description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                         `meta_keyword` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                         `og_image` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `metas_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
                              `id` int unsigned NOT NULL AUTO_INCREMENT,
                              `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                              `batch` int NOT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
                        `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                        `tenant_id` bigint unsigned DEFAULT NULL,
                        `news_category_id` bigint unsigned NOT NULL,
                        `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                        `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                        `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                        `image` int DEFAULT NULL,
                        `status` tinyint NOT NULL DEFAULT '0',
                        `created_by` bigint unsigned NOT NULL,
                        `created_at` timestamp NULL DEFAULT NULL,
                        `updated_at` timestamp NULL DEFAULT NULL,
                        `deleted_at` timestamp NULL DEFAULT NULL,
                        PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `news_categories`;
CREATE TABLE `news_categories` (
                                   `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                   `tenant_id` bigint unsigned DEFAULT NULL,
                                   `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `status` tinyint NOT NULL DEFAULT '0',
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `news_tag`;
CREATE TABLE `news_tag` (
                            `news_id` bigint unsigned NOT NULL,
                            `tag_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `news_tags`;
CREATE TABLE `news_tags` (
                             `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                             `tenant_id` bigint unsigned DEFAULT NULL,
                             `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `notice_categories`;
CREATE TABLE `notice_categories` (
                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                     `tenant_id` bigint unsigned DEFAULT NULL,
                                     `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `status` tinyint NOT NULL DEFAULT '0',
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
                           `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                           `tenant_id` bigint unsigned DEFAULT NULL,
                           `notice_category_id` bigint unsigned NOT NULL,
                           `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `image` int DEFAULT NULL,
                           `status` tinyint NOT NULL DEFAULT '0',
                           `created_by` bigint unsigned NOT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `notification_seens`;
CREATE TABLE `notification_seens` (
                                      `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                      `tenant_id` bigint unsigned DEFAULT NULL,
                                      `user_id` int DEFAULT NULL,
                                      `notification_id` int DEFAULT NULL,
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL,
                                      PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `user_id` int DEFAULT NULL,
                                 `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                 `link` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                 `view_status` tinyint NOT NULL DEFAULT '0',
                                 `status` tinyint NOT NULL DEFAULT '1',
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `alumni_limit` int NOT NULL DEFAULT '-1',
                            `custom_domain` tinyint NOT NULL DEFAULT '0',
                            `event_limit` int NOT NULL DEFAULT '-1',
                            `icon_id` int DEFAULT NULL,
                            `others` text COLLATE utf8mb4_unicode_ci,
                            `monthly_price` decimal(12,2) NOT NULL DEFAULT '0.00',
                            `yearly_price` decimal(12,2) NOT NULL DEFAULT '0.00',
                            `status` tinyint NOT NULL DEFAULT '0' COMMENT 'active for 1 , deactivate for 0',
                            `is_default` tinyint NOT NULL DEFAULT '0' COMMENT 'active for 1 , deactivate for 0',
                            `is_trail` tinyint NOT NULL DEFAULT '0' COMMENT 'active for 1 , deactivate for 0',
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `passing_years`;
CREATE TABLE `passing_years` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
                                         `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
                                   `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `otp` int DEFAULT NULL,
                                   `otp_expiry` datetime DEFAULT NULL,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `tenant_id` bigint unsigned DEFAULT NULL,
                            `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `paymentable_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `paymentable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `gateway_id` bigint unsigned NOT NULL,
                            `paymentId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `tnxId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `user_id` bigint unsigned NOT NULL,
                            `bank_id` bigint unsigned DEFAULT NULL,
                            `deposit_slip` int DEFAULT NULL,
                            `sub_total` decimal(12,2) NOT NULL DEFAULT '0.00',
                            `tax` decimal(12,2) NOT NULL DEFAULT '0.00',
                            `system_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `payment_currency` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `conversion_rate` decimal(18,8) NOT NULL DEFAULT '0.00000000',
                            `grand_total_with_conversation_rate` decimal(18,8) NOT NULL DEFAULT '0.00000000',
                            `grand_total` decimal(12,2) NOT NULL DEFAULT '0.00',
                            `subscription_type` tinyint DEFAULT NULL,
                            `payment_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                            `gateway_callback_details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                            `payment_time` datetime DEFAULT NULL,
                            `payment_status` tinyint NOT NULL DEFAULT '1',
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`),
                            UNIQUE KEY `payments_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
                                          `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                          `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `tokenable_id` bigint unsigned NOT NULL,
                                          `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                          `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                                          `last_used_at` timestamp NULL DEFAULT NULL,
                                          `expires_at` timestamp NULL DEFAULT NULL,
                                          `created_at` timestamp NULL DEFAULT NULL,
                                          `updated_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`),
                                          UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
                                          KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `photo_galleries`;
CREATE TABLE `photo_galleries` (
                                   `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                   `tenant_id` bigint unsigned DEFAULT NULL,
                                   `caption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `photo` int NOT NULL,
                                   `status` tinyint NOT NULL DEFAULT '1',
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE `post_comments` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `user_id` bigint unsigned NOT NULL,
                                 `post_id` bigint unsigned NOT NULL,
                                 `parent_id` bigint unsigned DEFAULT NULL,
                                 `body` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `post_like`;
CREATE TABLE `post_like` (
                             `user_id` bigint unsigned NOT NULL,
                             `post_id` bigint unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `post_media`;
CREATE TABLE `post_media` (
                              `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                              `tenant_id` bigint unsigned DEFAULT NULL,
                              `user_id` bigint unsigned NOT NULL,
                              `post_id` bigint unsigned NOT NULL,
                              `file` int NOT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL,
                              PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `tenant_id` bigint unsigned DEFAULT NULL,
                         `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `status` tinyint NOT NULL DEFAULT '1',
                         `created_by` bigint unsigned NOT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
                            `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                            `tenant_id` bigint unsigned DEFAULT NULL,
                            `option_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                            `option_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `sms_histories`;
CREATE TABLE `sms_histories` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `owner_user_id` bigint unsigned NOT NULL,
                                 `api` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `message` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `status` tinyint NOT NULL DEFAULT '1',
                                 `user_id` bigint unsigned DEFAULT NULL,
                                 `date` datetime DEFAULT NULL,
                                 `error` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `stories`;
CREATE TABLE `stories` (
                           `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                           `tenant_id` bigint unsigned DEFAULT NULL,
                           `user_id` bigint unsigned NOT NULL,
                           `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `thumbnail` int NOT NULL,
                           `body` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                           `status` tinyint NOT NULL DEFAULT '0',
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           UNIQUE KEY `stories_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `tenants`;
CREATE TABLE `tenants` (
                           `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                           `created_at` timestamp NULL DEFAULT NULL,
                           `updated_at` timestamp NULL DEFAULT NULL,
                           `data` text COLLATE utf8mb4_unicode_ci,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `testimonials`;
CREATE TABLE `testimonials` (
                                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `comment` longtext COLLATE utf8mb4_unicode_ci,
                                `status` tinyint NOT NULL DEFAULT '0',
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                `deleted_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE `transactions` (
                                `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                `tenant_id` bigint unsigned DEFAULT NULL,
                                `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `user_id` bigint unsigned NOT NULL,
                                `payment_id` bigint unsigned NOT NULL,
                                `reference_id` bigint unsigned DEFAULT NULL,
                                `type` tinyint NOT NULL,
                                `tnxId` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `amount` decimal(12,2) NOT NULL,
                                `purpose` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `payment_time` datetime NOT NULL,
                                `payment_method` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                `deleted_at` timestamp NULL DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL,
                                PRIMARY KEY (`id`),
                                UNIQUE KEY `transactions_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `user_institutions`;
CREATE TABLE `user_institutions` (
                                     `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                     `tenant_id` bigint unsigned DEFAULT NULL,
                                     `user_id` bigint unsigned NOT NULL,
                                     `degree` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `passing_year` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `institute` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                                     `created_at` timestamp NULL DEFAULT NULL,
                                     `updated_at` timestamp NULL DEFAULT NULL,
                                     PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `user_membership_plans`;
CREATE TABLE `user_membership_plans` (
                                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                         `tenant_id` bigint unsigned DEFAULT NULL,
                                         `membership_id` bigint unsigned NOT NULL,
                                         `user_id` bigint unsigned NOT NULL,
                                         `expired_date` datetime NOT NULL,
                                         `status` tinyint NOT NULL DEFAULT '0',
                                         `deleted_at` timestamp NULL DEFAULT NULL,
                                         `created_at` timestamp NULL DEFAULT NULL,
                                         `updated_at` timestamp NULL DEFAULT NULL,
                                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `user_packages`;
CREATE TABLE `user_packages` (
                                 `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                                 `tenant_id` bigint unsigned DEFAULT NULL,
                                 `user_id` bigint unsigned NOT NULL,
                                 `package_id` bigint unsigned NOT NULL,
                                 `payment_id` bigint unsigned DEFAULT NULL,
                                 `start_date` datetime DEFAULT NULL,
                                 `end_date` datetime DEFAULT NULL,
                                 `subscription_type` tinyint NOT NULL DEFAULT '1',
                                 `status` tinyint NOT NULL DEFAULT '0',
                                 `is_trail` tinyint NOT NULL DEFAULT '0' COMMENT 'active for 1 , deactivate for 0',
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL,
                                 `deleted_at` timestamp NULL DEFAULT NULL,
                                 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
                         `id` bigint unsigned NOT NULL AUTO_INCREMENT,
                         `tenant_id` bigint unsigned DEFAULT NULL,
                         `uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `nick_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `mobile` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
                         `image` bigint unsigned DEFAULT NULL,
                         `role` tinyint NOT NULL DEFAULT '2',
                         `email_verification_status` tinyint NOT NULL DEFAULT '0',
                         `phone_verification_status` tinyint NOT NULL DEFAULT '0',
                         `google_auth_status` tinyint NOT NULL DEFAULT '0',
                         `google2fa_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
                         `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `facebook_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `verify_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `otp` int DEFAULT NULL,
                         `otp_expiry` datetime DEFAULT NULL,
                         `last_seen` datetime NOT NULL DEFAULT '2023-09-24 14:01:03',
                         `show_email_in_public` tinyint NOT NULL DEFAULT '1',
                         `show_phone_in_public` tinyint NOT NULL DEFAULT '1',
                         `created_by` bigint unsigned DEFAULT NULL,
                         `status` tinyint NOT NULL DEFAULT '1',
                         `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL,
                         PRIMARY KEY (`id`),
                         UNIQUE KEY `users_uuid_unique` (`uuid`),
                         UNIQUE KEY `users_email_unique` (`email`),
                         UNIQUE KEY `users_mobile_unique` (`mobile`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `domains` (id, domain, tenant_id, created_at, updated_at) VALUES  (1,'default.".implode(''.'', array_slice(explode(''.'', parse_url(\Config::get(''tenancy.central_domains'')[0], PHP_URL_HOST)), -2));."','1','2023-11-16 07:37:54','2023-11-16 07:37:54');
INSERT INTO `email_templates` (id, tenant_id, category, slug, subject, body, `default`, status, deleted_at, created_at, updated_at) VALUES (1,1,'Email Verification','email-verification','Verify Your Account','\r\n                Hello, {{username}}\r\n                Thank you for creating an account with us. We\'re excited to have you as a part of our community! Before you can start using your account, we need to verify your email address. Please click on the link below to complete the verification process:\r\n                Your Otp is: {{otp}}\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(2,1,'Password Reset','password-reset','Reset your password','\r\n                    We\'re sending you this email because you requested a password reset. Please use the OTP code below to create a new password:\r\n                OTP Code: {{otp}}\r\n                If you didn\'t request a password reset, you can safely ignore this email. Your password will not be changed.\r\n                Thank you!\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(3,1,'Account Approval','account-approval','Your Account Approved','We are pleased to inform you that your account application has been approved and your account is now active.\r\n                Thank you!\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(4,1,'Account Reject','account-rejection','Your Account Rejected','\r\n                We are pleased to inform you that your account application has been rejected and your account is now inactive. Please contact with admin\r\n                Thank you!\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(5,1,'Ticket Reservation','ticket-confirmation','Ticket Reservation','\r\n                    Hi {{username}},\r\n                    Thank you for reserving your tickets with us. Your booking has been confirmed with the following details:\r\n                    Ticket No: {{ticket_number}}\r\n                    Please keep this confirmation email for your records.\r\n                    If you have any questions or need assistance, please feel free to contact us at:\r\n                    Phone: {{app_contact_number}}\r\n                    Email: {{app_email}}\r\n                    We look forward to welcoming you to the event!\r\n                    Regards,\r\n                    {{app_name}}\r\n                    Click here to more view your Ticket Reservation details.\r\n                    {{link}}\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(6,1,'Membership Apply Application','membership-apply-application','Membership Apply Application','\r\n                Hi {{username}},\r\n                Thank you for applying for membership with us.\r\n                We have received your membership application and will review it shortly. We will notify you once your application has been processed.\r\n                If you have any questions or need further assistance, please feel free to contact us at:\r\n                Phone: {{app_contact_number}}\r\n                Email: {{app_email}}\r\n                Regards,\r\n                {{app_name}}\r\n                Click here to more view your Membership Apply Application details.\r\n                    {{link}}\r\n                    ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(7,1,'Event Purchase','event-purchase','Event Purchase','\r\n                Hi {{username}},\r\n                Thank you for your purchase. Your order with the following details has been confirmed:\r\n                Order No: {{transaction_no}}\r\n                If you have any questions or need assistance, please feel free to contact us at:\r\n                Phone: {{app_contact_number}}\r\n                Email: {{app_email}}\r\n                We look forward to seeing you at the event!\r\n                Regards,\r\n                {{app_name}}\r\n                    Click here to more view your Event Purchase details.\r\n                    {{link}}\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(8,1,'Payment Success','payment-success','Payment Successful','\r\n                    Hi {{username}},\r\n                    We are writing to inform you that your payment has been successfully processed for the following order:\r\n                    Order No: {{transaction_no}}\r\n                    If you have any questions or need assistance, please feel free to contact us at:\r\n                    Phone: {{app_contact_number}}\r\n                    Email: {{app_email}}\r\n                    Thank you for your payment. We appreciate your business and look forward to serving you again in the future.\r\n                    Regards,\r\n                    {{app_name}}\r\n                    ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(9,1,'Payment Cancel','payment-cancel','Payment Cancel','\r\n                    Hi {{username}},\r\n                    We are writing to inform you that your payment has been canceled for the following order:\r\n                    Order No: {{transaction_no}}\r\n                    If you have any questions or need assistance, please feel free to contact us at:\r\n                    Phone: {{app_contact_number}}\r\n                    Email: {{app_email}}\r\n                    Thank you for your payment. We appreciate your business and look forward to serving you again in the future.\r\n                    Regards,\r\n                    {{app_name}}\r\n                    ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55'),(10,1,'Membership Approval','membership-approval','Membership Application Approved','\r\n                    Hi {{username}},\r\n                    We are pleased to inform you that your membership application with us has been approved!\r\n                    You are now an official member of our community. We look forward to your active participation.\r\n                    If you have any questions or need assistance, please feel free to contact us at:\r\n                    Phone: {{app_contact_number}}\r\n                    Email: {{app_email}}\r\n                    Welcome aboard!\r\n                    Regards,\r\n                    {{app_name}}\r\n                    Click here to more view your Membership Approval details.\r\n                    {{link}}\r\n\r\n                ',1,1,NULL,'2023-09-24 02:01:03','2023-11-16 07:37:55');
INSERT INTO `file_managers` (id, tenant_id, file_type, storage_type, original_name, file_name, user_id, path, extension, size, external_link, deleted_at, created_at, updated_at) VALUES (1,1,'image/png','public','logo-black.png','6751695564188.png',1,'uploads/Setting/6751695564188.png','png','1422',NULL,NULL,'2023-09-24 08:03:08','2023-11-16 07:37:55'),(2,1,'image/png','public','logo.png','3371695564188.png',1,'uploads/Setting/3371695564188.png','png','3895',NULL,NULL,'2023-09-24 08:03:08','2023-11-16 07:37:55'),(3,1,'image/png','public','favicon.png','5561695564188.png',1,'uploads/Setting/5561695564188.png','png','924',NULL,NULL,'2023-09-24 08:03:08','2023-11-16 07:37:55'),(4,1,'image/jpeg','public','regiser-left-image.jpg','6251695564188.jpg',1,'uploads/Setting/6251695564188.jpg','jpg','86463',NULL,NULL,'2023-09-24 08:03:08','2023-11-16 07:37:55');
INSERT INTO `frontend_sections` (id, name, page_title, title, slug, has_page_title, has_banner_image, has_image, has_description, description, banner_image, image, status, created_at, updated_at, deleted_at) VALUES (1,'Hero Banner','Banner page title','Manage Alumni Related Tasks In One Place.','hero_banner',3,1,1,1,'Create and see all your free and paid events, job post, news, notification, buy ticket with bunch of payment gateway system, find an alumni & chat with them, get membership more & more through fgco07alumni.',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL),(2,'Core Features','Core Features','Bunch Of Features','core_features',3,0,3,3,'2023-11-16 13:39:04',1,NULL,1,NULL,'2023-11-16 07:39:04',NULL),(3,'Explore Core Pages','Explore Core Pages','fgco07alumni Made The App Effortless With Some Core Pages','core_pages',1,3,3,1,'Explore some of our core pages that made the app effortless by itself.',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL),(4,'Pricing Plan','Pricing Plan','Pick the plan that\'s right for your business.','pricing_plan',1,3,3,3,'Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals, They can also help them',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL),(5,'Testimonials','Testimonials','What Our Student Have to Say About fgco07alumni.','testimonials_area',1,3,3,1,'Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals, They can also help them',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL),(6,'Faq\'s Area','FAQ\'S','Most Common Question About Saas Services.','faqs_area',1,3,3,1,'Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals, They can also help them',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL),(7,'How Its Work','How Its Work','Nothing less than excellent','how_its_work_area',1,3,3,1,'Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals, They can also help them',NULL,NULL,1,'2023-11-16 07:39:04','2023-11-16 07:39:04',NULL);
INSERT INTO `gateway_currencies` (id, gateway_id, currency, conversion_rate, created_at, updated_at, deleted_at) VALUES (1,1,'USD',1.00,NULL,NULL,NULL),(2,2,'USD',1.00,NULL,NULL,NULL),(3,3,'INR',80.00,NULL,NULL,NULL),(4,4,'INR',80.00,NULL,NULL,NULL),(5,5,'USD',1.00,NULL,NULL,NULL),(6,6,'NGN',464.00,NULL,NULL,NULL),(7,7,'BDT',100.00,NULL,NULL,NULL),(8,8,'NGN',464.00,NULL,NULL,NULL),(9,9,'BRL',5.00,NULL,NULL,NULL),(10,10,'USD',1.00,NULL,NULL,NULL),(11,11,'USD',1.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(12,12,'USD',1.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(13,13,'INR',80.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(14,14,'INR',80.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(15,15,'USD',1.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(16,16,'NGN',464.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(17,17,'BDT',100.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(18,18,'NGN',464.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(19,19,'BRL',5.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(20,20,'USD',1.00,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL);
INSERT INTO `gateways` (id, tenant_id, title, slug, image, status, mode, url, `key`, secret, created_at, updated_at, deleted_at) VALUES (1,1,'Paypal','paypal','assets/images/gateway-icon/paypal.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(2,1,'Stripe','stripe','assets/images/gateway-icon/stripe.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(3,1,'Razorpay','razorpay','assets/images/gateway-icon/razorpay.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(4,1,'Instamojo','instamojo','assets/images/gateway-icon/instamojo.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(5,1,'Mollie','mollie','assets/images/gateway-icon/mollie.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(6,1,'Paystack','paystack','assets/images/gateway-icon/paystack.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(7,1,'Sslcommerz','sslcommerz','assets/images/gateway-icon/sslcommerz.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(8,1,'Flutterwave','flutterwave','assets/images/gateway-icon/flutterwave.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(9,1,'Mercadopago','mercadopago','assets/images/gateway-icon/mercadopago.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(10,1,'Bank','bank','assets/images/gateway-icon/bank.png',1,2,'','','',NULL,'2023-11-16 07:37:55',NULL),(11,NULL,'Paypal','paypal','assets/images/gateway-icon/paypal.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(12,NULL,'Stripe','stripe','assets/images/gateway-icon/stripe.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(13,NULL,'Razorpay','razorpay','assets/images/gateway-icon/razorpay.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(14,NULL,'Instamojo','instamojo','assets/images/gateway-icon/instamojo.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(15,NULL,'Mollie','mollie','assets/images/gateway-icon/mollie.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(16,NULL,'Paystack','paystack','assets/images/gateway-icon/paystack.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(17,NULL,'Sslcommerz','sslcommerz','assets/images/gateway-icon/sslcommerz.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(18,NULL,'Flutterwave','flutterwave','assets/images/gateway-icon/flutterwave.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(19,NULL,'Mercadopago','mercadopago','assets/images/gateway-icon/mercadopago.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL),(20,NULL,'Bank','bank','assets/images/gateway-icon/bank.png',1,2,NULL,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56',NULL);
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2014_10_12_100000_create_password_resets_table',1),(4,'2019_08_19_000000_create_failed_jobs_table',1),(5,'2019_12_14_000001_create_personal_access_tokens_table',1),(6,'2022_06_23_121213_create_settings_table',1),(7,'2022_06_25_104329_create_countries_table',1),(8,'2022_06_25_110824_create_currencies_table',1),(9,'2022_06_25_111037_create_languages_table',1),(10,'2022_06_26_130302_create_alumnis_table',1),(11,'2022_06_27_104144_create_user_institutions_table',1),(12,'2022_11_30_040739_create_gateways_table',1),(13,'2023_01_03_075827_create_gateway_currencies_table',1),(14,'2023_01_05_092212_create_file_managers_table',1),(15,'2023_01_07_120244_create_banks_table',1),(16,'2023_01_30_071830_create_payments_table',1),(17,'2023_05_29_125747_create_contact_messages_table',1),(18,'2023_05_30_123930_create_news_tags_table',1),(19,'2023_05_30_124208_create_news_categories_table',1),(20,'2023_05_31_053037_create_news_table',1),(21,'2023_06_01_124435_create_news_tag',1),(22,'2023_06_11_075340_create_memebrship_plans',1),(23,'2023_06_12_095437_create_sms_histories_table',1),(24,'2023_06_14_062807_create_mail_histories_table',1),(25,'2023_07_09_100721_create_notifications_table',1),(26,'2023_07_20_052653_create_email_templates_table',1),(27,'2023_07_22_111528_database_backups_table',1),(28,'2023_07_22_111738_database_backup_cron_settings_table',1),(29,'2023_08_06_094452_create_event_categories_table',1),(30,'2023_08_06_094458_create_passing_years_table',1),(31,'2023_08_06_094504_create_batches_table',1),(32,'2023_08_06_094512_create_departments_table',1),(33,'2023_08_07_062359_create_authentication_log_table',1),(34,'2023_08_08_095649_create_notice_categories_table',1),(35,'2023_08_08_095707_create_notices_table',1),(36,'2023_08_08_121638_create_user_membership_plans_table',1),(37,'2023_08_08_122610_create_posts_table',1),(38,'2023_08_08_130843_create_events_table',1),(39,'2023_08_08_131212_create_event_tickets_table',1),(40,'2023_08_08_133927_create_post_likes_table',1),(41,'2023_08_08_133946_create_post_comments_table',1),(42,'2023_08_08_135504_create_post_media_table',1),(43,'2023_08_16_074843_create_chats_table',1),(44,'2023_08_26_075204_create_metas_table',1),(45,'2023_09_03_115217_create_job_posts_table',1),(46,'2023_09_05_090819_create_notification_seens_table',1),(47,'2023_09_07_133233_update_password_resets_table',1),(48,'2023_09_10_112408_create_transactions_table',1),(49,'2023_09_14_114317_add_column_in_transactions_table',1),(50,'2023_09_15_114317_add_reference_column_in_transactions_table',1),(51,'2023_09_17_092916_add_timestamps_to_posts_table',1),(52,'2023_09_20_061038_change_migration_in_currencies_table',1),(53,'2023_09_20_061618_add_column_in_events_table',1),(54,'2023_09_21_072359_change_column_in_events_table',1),(55,'2023_09_21_192710_create_chat_media_table',1),(56,'2023_09_23_115114_add_column_in_users_table',1),(58,'2023_10_18_162437_create_stories_table',1),(59,'2023_10_19_193144_create_photo_galleries_table',1),(60,'2023_10_22_142555_create_contact_us_table',1),(61,'2019_09_15_000010_create_tenants_table',2),(62,'2019_09_15_000020_create_domains_table',2),(63,'2023_10_23_093637_create_packages_table',2),(64,'2023_10_23_094232_create_user_packages_table',2),(65,'2023_10_25_075216_create_frontend_sections_table',2),(66,'2023_10_25_125314_create_features_settings_table',2),(67,'2023_10_26_110108_create_core_pages_settings_table',2),(68,'2023_10_26_122659_create_testimonials_table',2),(69,'2023_10_26_124142_create_faqs_table',2),(70,'2023_10_29_190449_add_tenant_id_in_all_tables',2),(71,'2023_11_01_131517_create_custom_domain_requests_table',2),(72,'2023_11_07_131034_add_column_in_payments_table',2),(73,'2023_11_08_151228_create_how_its_works_table',2),(74,'2023_11_09_213219_add_new_field_to_contact_us_table',2),(75,'2023_11_15_121034_remove_gateway_slug_unique_in_gateways_table',2),(76,'database/migrations/2023_11_30_094646_add_column_in_user_packages_table',2);
INSERT INTO `languages` (id, language, iso_code, flag_id, font, rtl, status, `default`, created_at, updated_at, deleted_at) VALUES (1,'English','en',NULL,NULL,0,1,1,'2023-09-24 02:01:03','2023-09-24 02:01:03',NULL);
INSERT INTO `settings` (id, tenant_id, option_key, option_value, created_at, updated_at) VALUES (30,NULL,'build_version','5','2023-09-24 02:01:03','2023-09-24 02:01:03'),(31,NULL,'current_version','3.1','2023-09-24 02:01:03','2023-09-24 02:01:03'),(32,1,'app_name','fgco07alumni','2023-09-24 02:02:45','2023-11-16 07:37:55'),(33,1,'app_email','fgco07alumni@example.com','2023-09-24 02:02:45','2023-11-16 07:37:55'),(34,1,'app_contact_number','+00000000000','2023-09-24 02:02:45','2023-11-16 07:37:55'),(35,1,'app_location','Khulna, Bangladesh','2023-09-24 02:02:45','2023-11-16 07:37:55'),(36,NULL,'app_copyright','© 2023 Zainik Lab. All Rights Reserved.','2023-09-24 02:02:45','2023-09-24 02:02:45'),(37,NULL,'app_developed','Zainikthemes','2023-09-24 02:02:45','2023-09-24 02:02:45'),(38,1,'app_timezone','Asia/Dhaka','2023-09-24 02:02:45','2023-11-16 07:37:55'),(39,1,'app_color_design_type','1','2023-09-24 08:03:08','2023-11-16 07:37:55'),(40,1,'app_primary_color','#ff671b','2023-09-24 08:03:08','2023-11-16 07:37:55'),(41,1,'app_secondary_color','#111111','2023-09-24 08:03:08','2023-11-16 07:37:55'),(42,1,'app_text_color','#585858','2023-09-24 08:03:08','2023-11-16 07:37:55'),(43,1,'app_section_bg_color','#fffaf7','2023-09-24 08:03:08','2023-11-16 07:37:55'),(44,1,'app_hero_bg_color1','#000000','2023-09-24 08:03:08','2023-11-16 07:37:55'),(45,1,'app_hero_bg_color2','#000000','2023-09-24 08:03:08','2023-11-16 07:37:55'),(46,1,'app_hero_bg_color',NULL,'2023-09-24 08:03:08','2023-11-16 07:37:55'),(47,1,'app_preloader','1','2023-09-24 08:03:08','2023-11-16 07:37:55'),(48,1,'app_logo','2','2023-09-24 08:03:08','2023-11-16 07:37:55'),(49,1,'app_fav_icon','3','2023-09-24 08:03:08','2023-11-16 07:37:55'),(50,1,'login_left_image','4','2023-09-24 08:03:08','2023-11-16 07:37:55'),(51,1,'google_login_status','1','2023-09-24 08:03:24','2023-11-16 07:37:55'),(52,1,'facebook_login_status','1','2023-09-24 08:03:25','2023-11-16 07:37:55'),(53,1,'cookie_status','1','2023-09-24 08:03:32','2023-11-16 07:37:55'),(54,1,'register_file_required','1','2023-09-24 08:04:37','2023-11-16 07:37:55'),(55,1,'app_preloader_status','1','2023-09-24 08:04:39','2023-11-16 07:37:55'),(56,1,'registration_approval','1','2023-09-24 08:04:42','2023-11-16 07:37:55'),(57,NULL,'show_language_switcher','1','2023-09-24 08:04:43','2023-09-24 08:04:43'),(58,1,'gateway_settings','{\"paypal\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Client ID\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Secret\",\"name\":\"secret\",\"is_show\":1}],\"stripe\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Public Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Secret Key\",\"name\":\"secret\",\"is_show\":0}],\"razorpay\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Secret\",\"name\":\"secret\",\"is_show\":1}],\"instamojo\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Api Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Auth Token\",\"name\":\"secret\",\"is_show\":1}],\"mollie\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Mollie Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Secret\",\"name\":\"secret\",\"is_show\":0}],\"paystack\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Public Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Secret Key\",\"name\":\"secret\",\"is_show\":0}],\"mercadopago\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Client ID\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Client Secret\",\"name\":\"secret\",\"is_show\":1}],\"sslcommerz\":[{\"label\":\"Url\",\"name\":\"url\",\"is_show\":0},{\"label\":\"Store ID\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Store Password\",\"name\":\"secret\",\"is_show\":1}],\"flutterwave\":[{\"label\":\"Hash\",\"name\":\"url\",\"is_show\":1},{\"label\":\"Public Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Client Secret\",\"name\":\"secret\",\"is_show\":1}],\"coinbase\":[{\"label\":\"Hash\",\"name\":\"url\",\"is_show\":0},{\"label\":\"API Key\",\"name\":\"key\",\"is_show\":1},{\"label\":\"Client Secret\",\"name\":\"secret\",\"is_show\":0}]}','2023-06-19 01:35:33','2023-11-16 07:37:55'),(59,NULL,'STORAGE_DRIVER','public','2023-09-24 02:01:03','2023-09-24 02:01:03'),(60,1,'facebook_url','https://www.facebook.com/','2023-10-22 13:19:16','2023-11-16 07:37:55'),(61,1,'linkedin_url','https://www.linkedin.com/','2023-10-22 13:19:16','2023-11-16 07:37:55'),(62,1,'twitter_url','https://www.google.com/','2023-10-22 13:19:16','2023-11-16 07:37:55'),(63,1,'instagram_url','https://www.google.com/','2023-10-22 13:19:16','2023-11-16 07:37:55'),(64,1,'sign_up_left_text_title','Welcome Back','2023-10-22 13:19:16','2023-11-16 07:37:55'),(65,1,'join_our_community_title','Join Our Community Now','2023-10-22 13:19:16','2023-11-16 07:37:55'),(66,1,'sign_up_left_text_subtitle','Register now to see people who have attended or graduated from a particular school, college or university.','2023-10-22 13:19:16','2023-11-16 07:37:55'),(67,1,'footer_left_text','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempus elementum metus vitae vulputate. Proin mattis ligula a nunc suscipit, sed aliquam mi condimentum. In dictum erat lacus, id iaculis mauris tincidunt quis.','2023-10-22 13:19:16','2023-11-16 07:37:55'),(68,1,'page_breadcrumb','245','2023-10-22 13:19:16','2023-11-16 07:37:55'),(69,1,'banner_title','We are the proud student of fgco07alumni university forever','2023-10-22 13:22:43','2023-11-16 07:37:55'),(70,1,'banner_description','fgco07alumni is a user friendly that helps alumni easily connect and manage their activities. Alumni can sign up and get approved by submitting necessary documents, which allows them to join the alumni community','2023-10-22 13:22:43','2023-11-16 07:37:55'),(71,1,'banner_background_breadcrumb','229','2023-10-22 13:22:43','2023-11-16 07:37:55'),(72,1,'upcoming_events_background','230','2023-10-22 13:22:43','2023-11-16 07:37:55'),(73,1,'app_black_logo','231','2023-10-22 13:28:40','2023-11-16 07:37:55'),(74,1,'about_us_title','About fgco07alumni','2023-10-22 13:30:22','2023-11-16 07:37:55'),(75,1,'about_us_description','<ul class=\"list-pb-22\"><li class=\"d-flex align-items-start cg-12\"><div class=\"flex-shrink-0 d-flex pt-5\"><img src=\"/frontend/images/icon/check-circle.svg\" alt=\"\"></div><p class=\"fs-18 fw-400 lh-28 text-color1\">Alumni Association provides and supports alumni programs and services, facilitates communication with alumni, and seeks to strengthen alumni bonds of fellowship, professional association and university affiliation.</p></li><li class=\"d-flex align-items-start cg-12\"><div class=\"flex-shrink-0 d-flex pt-5\"><img src=\"/frontend/images/icon/check-circle.svg\" alt=\"\"></div><p class=\"fs-18 fw-400 lh-28 text-color1\">Connect alumni with mentors or coaches who can offer them guidance, advice, or feedback on their personal or professional goals. They can also help them expand their network, explore new opportunities, or overcome challenges</p></li><li class=\"d-flex align-items-start cg-12\"><div class=\"flex-shrink-0 d-flex pt-5\"><img src=\"/frontend/images/icon/check-circle.svg\" alt=\"\"></div><p class=\"fs-18 fw-400 lh-28 text-color1\">The Alumni Association leverages the resources, talents, and initiatives of alumni and friends to advise, guide, advocate for and support the Association and the university in achieving their respective missions and goals. The Alumni Association provides an alumni network and encourages alumni engagement in the life of the university.</p></li><li class=\"d-flex align-items-start cg-12\"><div class=\"flex-shrink-0 d-flex pt-5\"><img src=\"/frontend/images/icon/check-circle.svg\" alt=\"\"></div><p class=\"fs-18 fw-400 lh-28 text-color1\">Alumni Association provides and supports alumni programs and services, facilitates communication with alumni, and seeks to strengthen alumni bonds of fellowship, professional association and university affiliation.</p></li></ul>','2023-10-22 13:30:22','2023-11-16 07:37:55'),(76,1,'about_us_background_breadcrumb','233','2023-10-22 13:30:22','2023-11-16 07:37:55'),(77,1,'join_us_left_title','Attend Events','2023-10-22 13:38:18','2023-11-16 07:37:55'),(78,1,'join_us_left_description','<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempus elementum metus vitae vulputate. Proin mattis ligula a nunc suscipit,</span><br></p>','2023-10-22 13:38:18','2023-11-16 07:37:55'),(79,1,'join_us_middle_title','Advance Your Career','2023-10-22 13:38:18','2023-11-16 07:37:55'),(80,1,'join_us_middle_description','<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempus elementum metus vitae vulputate. Proin mattis ligula a nunc suscipit,</span><br></p>','2023-10-22 13:38:18','2023-11-16 07:37:55'),(81,1,'join_us_right_title','Reconnect your Friend','2023-10-22 13:38:18','2023-11-16 07:37:55'),(82,1,'join_us_right_description','<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tempus elementum metus vitae vulputate. Proin mattis ligula a nunc suscipit,</span><br></p>','2023-10-22 13:38:18','2023-11-16 07:37:55'),(83,1,'join_us_left_icon','255','2023-10-22 13:40:40','2023-11-16 07:37:55'),(84,1,'join_us_middle_icon','256','2023-10-22 13:40:40','2023-11-16 07:37:55'),(85,1,'join_us_right_icon','257','2023-10-22 13:40:40','2023-11-16 07:37:55'),(86,1,'refund_policy_title','Refund Policy Of Our Site','2023-10-22 14:11:13','2023-11-16 07:37:55'),(87,1,'refund_policy_description','Refund Policy','2023-10-22 14:11:13','2023-11-16 07:37:55'),(88,1,'terms_condition_title','Terms & Condition','2023-10-22 14:12:13','2023-11-16 07:37:55'),(89,1,'terms_condition_description','Terms & Condition','2023-10-22 14:12:13','2023-11-16 07:37:55'),(90,1,'cookie_policy_title','Cookie Policy','2023-10-22 14:12:37','2023-11-16 07:37:55'),(91,1,'cookie_policy_description','Cookie Policy','2023-10-22 14:12:37','2023-11-16 07:37:55'),(92,1,'privacy_policy_title','Privacy Policy','2023-10-22 14:12:54','2023-11-16 07:37:55'),(93,1,'privacy_policy_description','Privacy Policy','2023-10-22 14:12:54','2023-11-16 07:37:55');
INSERT INTO `tenants` (id, created_at, updated_at, data) VALUES ('1','2023-11-16 07:37:54','2023-11-16 07:37:54',NULL);
INSERT INTO `currencies` (id, tenant_id, currency_code, symbol, currency_placement, current_currency, created_at, updated_at) VALUES (1,1,'USD','$','before',1,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(2,1,'BDT','৳','before',0,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(3,1,'INR','₹','before',0,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(4,1,'GBP','£','after',0,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(5,1,'MXN','$','before',0,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(6,1,'SAR','SR','before',0,'2023-09-24 02:01:03','2023-11-16 07:37:54'),(7,0,'USD','$','before',1,'2023-11-16 07:37:56','2023-11-16 07:37:56'),(8,0,'BDT','৳','before',0,'2023-11-16 07:37:56','2023-11-16 07:37:56'),(9,0,'INR','₹','before',0,'2023-11-16 07:37:56','2023-11-16 07:37:56'),(10,0,'GBP','£','after',0,'2023-11-16 07:37:56','2023-11-16 07:37:56'),(11,0,'MXN','$','before',0,'2023-11-16 07:37:56','2023-11-16 07:37:56'),(12,0,'SAR','SR','before',0,'2023-11-16 07:37:56','2023-11-16 07:37:56');
INSERT INTO `users` (id, tenant_id, uuid, name, nick_name, email, mobile, email_verified_at, password, image, role, email_verification_status, phone_verification_status, google_auth_status, google2fa_secret, google_id, facebook_id, verify_token, otp, otp_expiry, last_seen, show_email_in_public, show_phone_in_public, created_by, status, remember_token, deleted_at, created_at, updated_at) VALUES (1,1,'12345','Administrator Doe',NULL,'admin@gmail.com','0',NULL,'$2y$10$TS8ajJg94NX98zYEcqvzmeSxpVHzTghhLZKtXi4nq4WwcK4jtVas6',NULL,1,1,1,0,'QQKI6NEOYRGL6DYS',NULL,NULL,NULL,NULL,NULL,'2023-09-24 20:07:50',1,1,NULL,1,NULL,NULL,NULL,'2023-11-16 07:37:55'),(3,NULL,'62cabcb7-f067-494e-b8a7-2865785ba12e','Super Admin',NULL,'superadmin@gmail.com','+0000123456','2023-11-16 07:37:55','$2y$10$cRyGYZgz7FdOovft0g/v/OduR/M55iGyVd8fEcpp2.ifC6c2CgpCu',NULL,3,1,1,0,'5P5XZZ4V2U6NWOI5',NULL,NULL,NULL,NULL,NULL,'2023-09-24 14:01:03',1,1,NULL,1,NULL,NULL,'2023-11-16 07:37:56','2023-11-16 07:37:56');
