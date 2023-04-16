-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 24. Jan 2022 um 20:09
-- Server-Version: 10.3.31-MariaDB-0+deb10u1
-- PHP-Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT = @@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS = @@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION = @@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `bhpanel1`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adventskalender`
--

CREATE TABLE `adventskalender`
(
    `id`        int(11)        NOT NULL,
    `win`       text           NOT NULL,
    `amount`    decimal(12, 2) NOT NULL,
    `able_at`   datetime DEFAULT NULL,
    `closed_at` datetime       NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `adventskalender_used`
--

CREATE TABLE `adventskalender_used`
(
    `id`        int(11)  NOT NULL,
    `tor`       text     NOT NULL,
    `userid`    text     NOT NULL,
    `opened_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `aff_clicks`
--

CREATE TABLE `aff_clicks`
(
    `id`         int(11)      NOT NULL,
    `owner_name` varchar(512) NOT NULL,
    `user_ip`    text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cashbox_clicks`
--

CREATE TABLE `cashbox_clicks`
(
    `id`         int(11)      NOT NULL,
    `box_id`     varchar(255) NOT NULL,
    `ip_addr`    varchar(255) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cloudserver`
--

CREATE TABLE `cloudserver`
(
    `id`          int(11)                                         NOT NULL,
    `user_id`     int(11)                                         NOT NULL,
    `nc_username` text                                                     DEFAULT NULL,
    `nc_pass`     text                                                     DEFAULT NULL,
    `nc_speicher` text                                            NOT NULL,
    `nc_url`      text                                                     DEFAULT NULL,
    `state`       enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`   datetime                                        NOT NULL,
    `price`       decimal(12, 2)                                  NOT NULL,
    `locked`      text                                                     DEFAULT NULL,
    `created_at`  datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`  datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`  datetime                                                 DEFAULT NULL,
    `days`        int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cloudserver_codes`
--

CREATE TABLE `cloudserver_codes`
(
    `id`      int(11)        NOT NULL,
    `code`    varchar(512)   NOT NULL,
    `amount`  text           NOT NULL,
    `useable` decimal(10, 0) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `cloudserver_packs`
--

CREATE TABLE `cloudserver_packs`
(
    `id`               int(11)        NOT NULL,
    `nc_pack_speicher` text DEFAULT NULL,
    `nc_pack_price`    decimal(12, 2) NOT NULL,
    `nc_pack_oldprice` decimal(12, 2) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `codes`
--

CREATE TABLE `codes`
(
    `id`      int(11)        NOT NULL,
    `code`    varchar(512)   NOT NULL,
    `amount`  decimal(12, 2) NOT NULL,
    `useable` decimal(10, 0) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `code_used`
--

CREATE TABLE `code_used`
(
    `id`         int(11)      NOT NULL,
    `code`       varchar(512) NOT NULL,
    `user_id`    text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `daily_rew`
--

CREATE TABLE `daily_rew`
(
    `id`         int(11)  NOT NULL,
    `userid`     text     NOT NULL,
    `state`      text     NOT NULL,
    `claimed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `domains`
--

CREATE TABLE `domains`
(
    `id`            int(11)                                         NOT NULL,
    `domain_name`   text                                            NOT NULL,
    `domain_endung` text                                            NOT NULL,
    `zone_id`       text                                                     DEFAULT NULL,
    `user_id`       int(11)                                         NOT NULL,
    `state`         enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`     datetime                                        NOT NULL,
    `price`         decimal(12, 2)                                  NOT NULL,
    `locked`        text                                                     DEFAULT NULL,
    `created_at`    datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`    datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`    datetime                                                 DEFAULT NULL,
    `days`          int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `domain_dns`
--

CREATE TABLE `domain_dns`
(
    `id`        int(11) NOT NULL,
    `domain_id` text    NOT NULL,
    `dns_id`    int(11) DEFAULT NULL,
    `subdomain` text    NOT NULL,
    `type`      text    NOT NULL,
    `ziel`      text    NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `domain_marktplatz`
--

CREATE TABLE `domain_marktplatz`
(
    `id`            int(11)        NOT NULL,
    `trader_id`     text           NOT NULL,
    `code`          text           NOT NULL,
    `domain_name`   text           NOT NULL,
    `domain_endung` text           NOT NULL,
    `state`         text           NOT NULL,
    `price`         decimal(12, 2) NOT NULL,
    `price_more`    text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gamecloud_clouds`
--

CREATE TABLE `gamecloud_clouds`
(
    `id`             int(11)                                         NOT NULL,
    `user_id`        int(11)                                         NOT NULL,
    `gs_cpu`         text                                            NOT NULL,
    `gs_ram`         text                                            NOT NULL,
    `gs_disk`        text                                            NOT NULL,
    `gs_datenbanken` int(11)                                         NOT NULL,
    `state`          enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`      datetime                                        NOT NULL,
    `price`          decimal(12, 2)                                  NOT NULL,
    `locked`         text                                                     DEFAULT NULL,
    `created_at`     datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`     datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`     datetime                                                 DEFAULT NULL,
    `days`           int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gamecloud_packs`
--

CREATE TABLE `gamecloud_packs`
(
    `id`                int(11)        NOT NULL,
    `gc_pack_name`      text DEFAULT NULL,
    `gc_pack_cpu`       text           NOT NULL,
    `gc_pack_ram`       text           NOT NULL,
    `gc_pack_ssd`       text           NOT NULL,
    `gc_datenbanken`    text           NOT NULL,
    `gc_pack_price`     decimal(12, 2) NOT NULL,
    `gc_pack_price_old` decimal(12, 2) NOT NULL,
    `disabled`          text           NOT NULL,
    `special`           text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gamecloud_server`
--

CREATE TABLE `gamecloud_server`
(
    `id`             int(11)                                         NOT NULL,
    `custom_name`    text    DEFAULT NULL,
    `cloud_id`       int(11)                                         NOT NULL,
    `wisp_id`        int(11) DEFAULT NULL,
    `allo_id`        text    DEFAULT NULL,
    `gs_name`        text                                            NOT NULL,
    `gs_cpu`         text                                            NOT NULL,
    `gs_ram`         text                                            NOT NULL,
    `gs_disk`        text                                            NOT NULL,
    `gs_datenbanken` int(11) DEFAULT NULL,
    `state`          enum ('active','suspended','deleted','pending') NOT NULL,
    `response`       longtext                                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gameserver_codes`
--

CREATE TABLE `gameserver_codes`
(
    `id`      int(11)        NOT NULL,
    `code`    varchar(512)   NOT NULL,
    `amount`  decimal(12, 2) NOT NULL,
    `useable` decimal(10, 0) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gameserver_csgo`
--

CREATE TABLE `gameserver_csgo`
(
    `id`         int(11)                                         NOT NULL,
    `user_id`    int(11)                                         NOT NULL,
    `gs_cpu`     text                                            NOT NULL,
    `gs_ram`     text                                            NOT NULL,
    `gs_disk`    text                                            NOT NULL,
    `gs_backups` text                                            NOT NULL,
    `gs_host`    text                                            NOT NULL,
    `state`      enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`  datetime                                        NOT NULL,
    `price`      decimal(12, 2)                                  NOT NULL,
    `locked`     text                                                     DEFAULT NULL,
    `created_at` datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at` datetime                                                 DEFAULT NULL,
    `days`       int(11)                                                  DEFAULT NULL,
    `response`   longtext                                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gameserver_mc`
--

CREATE TABLE `gameserver_mc`
(
    `id`             int(11)                                         NOT NULL,
    `user_id`        int(11)                                         NOT NULL,
    `gs_cpu`         text                                            NOT NULL,
    `gs_ram`         text                                            NOT NULL,
    `gs_disk`        text                                            NOT NULL,
    `gs_backups`     int(11)                                                  DEFAULT NULL,
    `gs_datenbanken` int(11)                                         NOT NULL,
    `gs_host`        text                                            NOT NULL,
    `state`          enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`      datetime                                        NOT NULL,
    `price`          decimal(12, 2)                                  NOT NULL,
    `locked`         text                                                     DEFAULT NULL,
    `created_at`     datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`     datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`     datetime                                                 DEFAULT NULL,
    `days`           int(11)                                                  DEFAULT NULL,
    `response`       longtext                                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ip_addresses`
--

CREATE TABLE `ip_addresses`
(
    `id`           int(110)     NOT NULL,
    `service_id`   int(11)               DEFAULT NULL,
    `service_type` enum ('VPS')          DEFAULT NULL,
    `node_id`      varchar(512)          DEFAULT NULL,
    `ip`           varchar(255) NOT NULL,
    `cidr`         int(11)      NOT NULL,
    `gateway`      varchar(255) NOT NULL,
    `mac_address`  varchar(255)          DEFAULT NULL,
    `rdns`         varchar(512)          DEFAULT NULL,
    `created_at`   datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kvm`
--

CREATE TABLE `kvm`
(
    `id`            int(11)                                         NOT NULL,
    `vt_rootpw`     text                                            NOT NULL,
    `vt_ownermail`  text                                            NOT NULL,
    `vt_ownerpass`  text                                            NOT NULL,
    `vt_ownerid`    text                                            NOT NULL,
    `kvm_cpu`       text                                            NOT NULL,
    `kvm_ram`       text                                            NOT NULL,
    `kvm_speicher`  text                                            NOT NULL,
    `kvm_ipv4`      text                                            NOT NULL,
    `kvm_ipv6`      text                                            NOT NULL,
    `kvm_anbindung` text                                            NOT NULL,
    `state`         enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`     datetime                                        NOT NULL,
    `price`         decimal(12, 2)                                  NOT NULL,
    `locked`        text                                                     DEFAULT NULL,
    `created_at`    datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`    datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`    datetime                                                 DEFAULT NULL,
    `days`          int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kvm_codes`
--

CREATE TABLE `kvm_codes`
(
    `id`      int(11)        NOT NULL,
    `code`    varchar(512)   NOT NULL,
    `amount`  decimal(12, 2) NOT NULL,
    `useable` decimal(10, 0) NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kvm_ipv6`
--

CREATE TABLE `kvm_ipv6`
(
    `id`           int(11)                                         NOT NULL,
    `vt_rootpw`    text                                            NOT NULL,
    `vt_ownermail` text                                            NOT NULL,
    `vt_ownerpass` text                                            NOT NULL,
    `vt_ownerid`   text                                            NOT NULL,
    `vt_host`      text                                            NOT NULL,
    `kvm_cpu`      text                                            NOT NULL,
    `kvm_ram`      text                                            NOT NULL,
    `kvm_speicher` text                                            NOT NULL,
    `kvm_ipv4`     text                                            NOT NULL,
    `kvm_ipv6`     text                                            NOT NULL,
    `state`        enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`    datetime                                        NOT NULL,
    `price`        decimal(12, 2)                                  NOT NULL,
    `locked`       text                                                     DEFAULT NULL,
    `created_at`   datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`   datetime                                                 DEFAULT NULL,
    `days`         int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kvm_packs`
--

CREATE TABLE `kvm_packs`
(
    `id`             int(11)        NOT NULL,
    `pack_name`      text DEFAULT NULL,
    `pack_cpu`       text           NOT NULL,
    `pack_ram`       text           NOT NULL,
    `pack_ssd`       text           NOT NULL,
    `pack_price`     decimal(12, 2) NOT NULL,
    `pack_price_old` decimal(12, 2) NOT NULL,
    `disabled`       text           NOT NULL,
    `special`        text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kvm_server`
--

CREATE TABLE `kvm_server`
(
    `id`           int(11)                                         NOT NULL,
    `vt_rootpw`    text                                            NOT NULL,
    `vt_ownermail` text                                            NOT NULL,
    `vt_ownerpass` text                                            NOT NULL,
    `vt_ownerid`   text                                            NOT NULL,
    `vt_host`      text                                            NOT NULL,
    `kvm_cpu`      text                                            NOT NULL,
    `kvm_ram`      text                                            NOT NULL,
    `kvm_speicher` text                                            NOT NULL,
    `kvm_ip`       text                                            NOT NULL,
    `state`        enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`    datetime                                        NOT NULL,
    `price`        decimal(12, 2)                                  NOT NULL,
    `locked`       text                                                     DEFAULT NULL,
    `created_at`   datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`   datetime                                                 DEFAULT NULL,
    `days`         int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `login_logs`
--

CREATE TABLE `login_logs`
(
    `id`         int(11)      NOT NULL,
    `user_id`    int(11)      NOT NULL,
    `user_addr`  varchar(255) NOT NULL,
    `user_agent` varchar(255) NOT NULL,
    `show`       int(11)      NOT NULL DEFAULT 1,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `lxc`
--

CREATE TABLE `lxc`
(
    `id`           int(11)                                         NOT NULL,
    `vt_rootpw`    text                                            NOT NULL,
    `vt_ownermail` text                                            NOT NULL,
    `vt_ownerpass` text                                            NOT NULL,
    `vt_ownerid`   text                                            NOT NULL,
    `vt_host`      text                                            NOT NULL,
    `kvm_cpu`      text                                            NOT NULL,
    `kvm_ram`      text                                            NOT NULL,
    `kvm_speicher` text                                            NOT NULL,
    `kvm_ip`       text                                            NOT NULL,
    `state`        enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`    datetime                                        NOT NULL,
    `price`        decimal(12, 2)                                  NOT NULL,
    `locked`       text                                                     DEFAULT NULL,
    `created_at`   datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`   datetime                                                 DEFAULT NULL,
    `days`         int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `marktplatz`
--

CREATE TABLE `marktplatz`
(
    `id`              int(11)                                         NOT NULL,
    `mp_name`         text                                            NOT NULL,
    `user_id`         int(11)                                         NOT NULL,
    `mp_pass`         text                                                     DEFAULT NULL,
    `mp_ip`           text                                            NOT NULL,
    `mp_ipv4add`      text                                                     DEFAULT NULL,
    `mp_ipv6`         text                                                     DEFAULT NULL,
    `mp_servernumber` text                                                     DEFAULT NULL,
    `mp_desc`         text                                                     DEFAULT NULL,
    `storno`          text                                            NOT NULL,
    `state`           enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`       datetime                                        NOT NULL,
    `price`           decimal(12, 2)                                  NOT NULL,
    `locked`          text                                                     DEFAULT NULL,
    `created_at`      datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`      datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`      datetime                                                 DEFAULT NULL,
    `days`            int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `marktplatz_zusatz`
--

CREATE TABLE `marktplatz_zusatz`
(
    `id`          int(11)        NOT NULL,
    `mp_id`       text           NOT NULL,
    `zusatz_name` text DEFAULT NULL,
    `zusatz_desc` text           NOT NULL,
    `price`       decimal(12, 2) NOT NULL,
    `locked`      text DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE `news`
(
    `id`         int(11)      NOT NULL,
    `icon`       varchar(255)          DEFAULT NULL,
    `title`      varchar(512) NOT NULL,
    `text`       text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `password_resets`
--

CREATE TABLE `password_resets`
(
    `id`         int(11)      NOT NULL,
    `user_info`  varchar(255) NOT NULL,
    `key`        varchar(255) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `products`
--

CREATE TABLE `products`
(
    `id`         int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_options`
--

CREATE TABLE `product_options`
(
    `id`         int(11)      NOT NULL,
    `product_id` int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `product_options` (`id`, `product_id`, `name`, `created_at`, `updated_at`)
VALUES (20, 20, 'Kerne Minecraft', '2023-04-07 11:32:11', '2023-04-16 07:49:36'),
       (21, 21, 'Arbeitsspeicher Minecraft', '2023-04-07 11:32:47', '2023-04-07 11:32:47'),
       (22, 22, 'Festplattenspeicher Minecraft', '2023-04-07 11:33:22', '2023-04-07 11:33:22'),
       (24, 24, 'Datenbanken Minecraft', '2023-04-07 11:33:55', '2023-04-07 11:34:36');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_option_entries`
--

CREATE TABLE `product_option_entries`
(
    `id`         int(11)        NOT NULL,
    `option_id`  int(11)        NOT NULL,
    `name`       varchar(255)   NOT NULL,
    `value`      varchar(255)   NOT NULL,
    `price`      decimal(43, 2) NOT NULL,
    `disabled`   int(11)        NOT NULL,
    `created_at` datetime       NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime       NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `product_option_entries` (`id`, `option_id`, `name`, `value`, `price`, `disabled`, `created_at`,
                                      `updated_at`)
VALUES (10, 20, '1 Kern', '1', '0.00', 0, '2023-04-07 11:32:28', '2023-04-07 11:34:55'),
       (11, 20, '2 Kerne', '2', '1.00', 0, '2023-04-07 11:32:28', '2023-04-07 11:46:36'),
       (50, 21, '1GB reg. DDR4 ECC', '1024', '0.00', 0, '2023-04-07 11:33:07', '2023-04-07 11:47:08'),
       (51, 21, '2GB reg. DDR4 ECC', '2048', '0.50', 0, '2023-04-07 11:33:07', '2023-04-07 11:47:10'),
       (100, 22, '10GB Ceph-SSD', '10', '0.00', 0, '2023-04-07 11:33:36', '2023-04-07 11:34:59'),
       (101, 22, '20GB Ceph-SSD', '20', '0.30', 0, '2023-04-07 11:33:36', '2023-04-07 11:34:59'),
       (150, 24, '1 inkl.', '1', '0.00', 0, '2023-04-07 11:34:10', '2023-04-07 11:35:02'),
       (151, 24, '2 Datenbanken', '2', '1.49', 0, '2023-04-07 11:34:10', '2023-04-07 11:35:02');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product_prices`
--

CREATE TABLE `product_prices`
(
    `id`          int(11)        NOT NULL,
    `name`        varchar(255)   NOT NULL,
    `price`       decimal(12, 2) NOT NULL,
    `created_at`  datetime       NOT NULL DEFAULT current_timestamp(),
    `updadted_at` datetime       NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `product_prices` (`id`, `name`, `price`, `created_at`, `updadted_at`)
VALUES (1, 'GAMESERVER_MC', '1.95', '2023-04-07 11:35:47', '2023-04-07 11:35:47');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkt_rabatt`
--

CREATE TABLE `produkt_rabatt`
(
    `id`      int(11)        NOT NULL,
    `produkt` text           NOT NULL,
    `rabatt`  decimal(12, 0) NOT NULL,
    `end_at`  text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `pterodactyl_servers`
--

CREATE TABLE `pterodactyl_servers`
(
    `id`            int(11)                               NOT NULL,
    `user_id`       int(11)                               NOT NULL,
    `service_id`    varchar(255)                          NOT NULL,
    `uuid`          varchar(255)                          NOT NULL,
    `identifier`    varchar(255)                          NOT NULL,
    `state`         enum ('active','suspended','deleted') NOT NULL,
    `memory`        int(255)                              NOT NULL,
    `cpu`           varchar(255)                          NOT NULL,
    `disk`          varchar(255)                          NOT NULL,
    `allocation_id` varchar(255)                          NOT NULL,
    `price`         decimal(12, 2)                        NOT NULL,
    `locked`        text                                           DEFAULT NULL,
    `custom_name`   text                                           DEFAULT NULL,
    `expire_at`     datetime                              NOT NULL,
    `created_at`    datetime                              NOT NULL DEFAULT current_timestamp(),
    `updated_at`    datetime                              NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`    datetime                                       DEFAULT NULL,
    `days`          int(11)                                        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `queue`
--

CREATE TABLE `queue`
(
    `id`         int(11)  NOT NULL,
    `user_id`    int(11)           DEFAULT NULL,
    `payload`    longtext          DEFAULT NULL,
    `retries`    int(11)  NOT NULL DEFAULT 0,
    `error_log`  longtext          DEFAULT NULL,
    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE `settings`
(
    `login`                 int(11)                    NOT NULL DEFAULT 1,
    `register`              int(11)                    NOT NULL DEFAULT 1,
    `webspace`              int(11)                    NOT NULL DEFAULT 1,
    `teamspeak`             int(11)                    NOT NULL DEFAULT 1,
    `vps`                   int(11)                    NOT NULL DEFAULT 1,
    `psc_fees`              int(5)                     NOT NULL DEFAULT 0,
    `default_traffic_limit` int(11)                    NOT NULL DEFAULT 1000,
    `rootserver`            enum ('own','venocix')     NOT NULL DEFAULT 'venocix',
    `captcha`               enum ('google','hcaptcha') NOT NULL DEFAULT 'hcaptcha',
    `webspace_type`         enum ('plesk','keyhelp')   NOT NULL DEFAULT 'plesk'
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `settings` (`login`, `register`, `webspace`, `teamspeak`, `vps`, `psc_fees`, `default_traffic_limit`,
                        `rootserver`, `captcha`, `webspace_type`)
VALUES (1, 0, 1, 1, 1, 0, 1000, 'venocix', 'hcaptcha', 'plesk');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `sinusbots`
--

CREATE TABLE `sinusbots`
(
    `id`          int(11)                                         NOT NULL,
    `user_id`     int(11)                                         NOT NULL,
    `gs_cpu`      text                                            NOT NULL,
    `gs_ram`      text                                            NOT NULL,
    `gs_disk`     text                                            NOT NULL,
    `gs_backups`  int(11)                                         NOT NULL,
    `sb_password` text                                            NOT NULL,
    `gs_host`     text                                            NOT NULL,
    `gs_username` text                                                     DEFAULT NULL,
    `gs_pass`     text                                                     DEFAULT NULL,
    `state`       enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`   datetime                                        NOT NULL,
    `price`       decimal(12, 2)                                  NOT NULL,
    `locked`      text                                                     DEFAULT NULL,
    `created_at`  datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at`  datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`  datetime                                                 DEFAULT NULL,
    `days`        int(11)                                                  DEFAULT NULL,
    `response`    longtext                                        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teamspeaks`
--

CREATE TABLE `teamspeaks`
(
    `id`             int(11)                               NOT NULL,
    `user_id`        int(11)                               NOT NULL,
    `slots`          int(11)                               NOT NULL,
    `node_id`        int(11)                               NOT NULL,
    `teamspeak_ip`   varchar(255)                          NOT NULL,
    `teamspeak_port` varchar(255)                          NOT NULL,
    `sid`            int(11)                               NOT NULL,
    `expire_at`      datetime                              NOT NULL,
    `price`          decimal(12, 2)                        NOT NULL,
    `state`          enum ('ACTIVE','SUSPENDED','DELETED') NOT NULL,
    `custom_name`    varchar(255)                                   DEFAULT NULL,
    `locked`         text                                           DEFAULT NULL,
    `created_at`     datetime                              NOT NULL DEFAULT current_timestamp(),
    `updated_at`     datetime                              NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`     datetime                                       DEFAULT NULL,
    `days`           int(11)                                        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teamspeak_backups`
--

CREATE TABLE `teamspeak_backups`
(
    `id`           int(11)  NOT NULL,
    `user_id`      int(11)  NOT NULL,
    `teamspeak_id` int(11)  NOT NULL,
    `files`        longtext NOT NULL,
    `desc`         text              DEFAULT NULL,
    `created_at`   datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `teamspeak_hosts`
--

CREATE TABLE `teamspeak_hosts`
(
    `id`             int(11)                    NOT NULL,
    `name`           varchar(255)               NOT NULL,
    `login_ip`       varchar(255)               NOT NULL,
    `login_port`     varchar(255)               NOT NULL,
    `login_name`     varchar(255)               NOT NULL,
    `login_passwort` varchar(255)               NOT NULL,
    `status`         enum ('ACTIVE','DISABLED') NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tickets`
--

CREATE TABLE `tickets`
(
    `id`         int(11)                                                                          NOT NULL,
    `user_id`    int(11)                                                                          NOT NULL,
    `categorie`  enum ('ALLGEMEIN','TECHNIK','BUCHHALTUNG','PARTNER','FEEDBACK','AUSFALL','BUGS') NOT NULL,
    `priority`   enum ('NIEDRIG','MITTEL','HOCH')                                                 NOT NULL,
    `title`      varchar(255)                                                                     NOT NULL,
    `state`      enum ('OPEN','CLOSED')                                                           NOT NULL,
    `last_msg`   enum ('CUSTOMER','SUPPORT')                                                      NOT NULL,
    `created_at` datetime                                                                         NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                                                                         NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `ticket_message`
--

CREATE TABLE `ticket_message`
(
    `id`         int(11)  NOT NULL,
    `ticket_id`  int(11)  NOT NULL,
    `writer_id`  int(11)  NOT NULL,
    `message`    longtext NOT NULL,
    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timeouts`
--

CREATE TABLE `timeouts`
(
    `id`       int(11)        NOT NULL,
    `produkt`  text           NOT NULL,
    `state`    text           NOT NULL,
    `amount`   decimal(12, 2) NOT NULL,
    `found_at` datetime       NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `timeout_back`
--

CREATE TABLE `timeout_back`
(
    `id`         int(11)  NOT NULL,
    `userid`     text     NOT NULL,
    `claimed_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `transactions`
--

CREATE TABLE `transactions`
(
    `id`         int(11)                            NOT NULL,
    `user_id`    int(11)                            NOT NULL,
    `gateway`    varchar(255)                       NOT NULL,
    `state`      enum ('pending','success','abort') NOT NULL,
    `amount`     decimal(12, 2)                     NOT NULL,
    `desc`       varchar(255)                       NOT NULL,
    `tid`        varchar(255)                                DEFAULT NULL,
    `created_at` datetime                           NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                           NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users`
(
    `id`                   int(11)                             NOT NULL,
    `username`             varchar(255)                        NOT NULL,
    `email`                varchar(255)                        NOT NULL,
    `password`             varchar(255)                        NOT NULL,
    `state`                enum ('pending','active','banned')  NOT NULL,
    `role`                 enum ('customer','support','admin') NOT NULL,
    `amount`               decimal(12, 2)                      NOT NULL DEFAULT 0.00,
    `session_token`        varchar(255)                                 DEFAULT NULL,
    `verify_code`          varchar(255)                                 DEFAULT NULL,
    `user_addr`            varchar(255)                                 DEFAULT NULL,
    `plesk_uid`            varchar(255)                                 DEFAULT NULL,
    `plesk_password`       varchar(255)                                 DEFAULT NULL,
    `s_pin`                varchar(255)                                 DEFAULT NULL,
    `datasavingmode`       int(11)                             NOT NULL DEFAULT 0,
    `darkmode`             int(11)                             NOT NULL DEFAULT 1,
    `notes`                longtext                                     DEFAULT NULL,
    `livechat`             int(11)                             NOT NULL DEFAULT 1,
    `preloader`            int(11)                             NOT NULL DEFAULT 1,
    `legal_accepted`       int(11)                             NOT NULL DEFAULT 0,
    `firstname`            varchar(255)                                 DEFAULT NULL,
    `lastname`             varchar(255)                                 DEFAULT NULL,
    `street`               varchar(255)                                 DEFAULT NULL,
    `number`               varchar(255)                                 DEFAULT NULL,
    `postcode`             varchar(255)                                 DEFAULT NULL,
    `city`                 varchar(255)                                 DEFAULT NULL,
    `country`              varchar(255)                                 DEFAULT NULL,
    `discord_id`           varchar(255)                                 DEFAULT NULL,
    `cashbox`              enum ('active','inactive')          NOT NULL DEFAULT 'inactive',
    `projectname`          varchar(512)                                 DEFAULT NULL,
    `projectlogo`          varchar(512)                                 DEFAULT NULL,
    `mail_ticket`          int(11)                             NOT NULL DEFAULT 1,
    `mail_runtime`         int(11)                             NOT NULL DEFAULT 1,
    `mail_suspend`         int(11)                             NOT NULL DEFAULT 1,
    `mail_order`           int(11)                             NOT NULL DEFAULT 1,
    `pterodactyl_id`       varchar(255)                                 DEFAULT NULL,
    `pterodactyl_password` varchar(255)                                 DEFAULT NULL,
    `keyhelp_uuid`         varchar(255)                                 DEFAULT NULL,
    `keyhelp_username`     varchar(255)                                 DEFAULT NULL,
    `keyhelp_password`     varchar(255)                                 DEFAULT NULL,
    `created_at`           datetime                            NOT NULL DEFAULT current_timestamp(),
    `updated_at`           datetime                            NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user_transactions`
--

CREATE TABLE `user_transactions`
(
    `id`         int(11)        NOT NULL,
    `user_id`    int(11)        NOT NULL,
    `amount`     decimal(12, 2) NOT NULL,
    `desc`       varchar(255)   NOT NULL,
    `created_at` datetime       NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime       NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_host_nodes`
--

CREATE TABLE `vm_host_nodes`
(
    `id`            int(11)                                   NOT NULL,
    `hostname`      varchar(255)                              NOT NULL,
    `name`          varchar(255)                              NOT NULL,
    `username`      varchar(255)                              NOT NULL,
    `password`      varchar(255)                              NOT NULL,
    `root_password` varchar(512)                                       DEFAULT NULL,
    `realm`         varchar(255)                              NOT NULL,
    `state`         enum ('ACTIVE','DISABLED')                NOT NULL,
    `disc_name`     varchar(255)                              NOT NULL,
    `disc_type`     enum ('ssd','hdd')                        NOT NULL,
    `api_name`      enum ('NO_API','PLOCIC','VENOCIX','GAME') NOT NULL,
    `active`        enum ('yes','no')                         NOT NULL,
    `type`          enum ('LXC','KVM')                        NOT NULL DEFAULT 'LXC',
    `created_at`    datetime                                  NOT NULL DEFAULT current_timestamp(),
    `updated_at`    datetime                                  NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_servers`
--

CREATE TABLE `vm_servers`
(
    `id`           int(11)                                                    NOT NULL,
    `user_id`      int(11)                                                    NOT NULL,
    `hostname`     varchar(255)                                                        DEFAULT NULL,
    `password`     varchar(255)                                                        DEFAULT NULL,
    `template_id`  varchar(512)                                               NOT NULL,
    `node_id`      int(11)                                                    NOT NULL,
    `cores`        int(11)                                                    NOT NULL,
    `memory`       int(11)                                                    NOT NULL,
    `disc`         int(11)                                                    NOT NULL,
    `addresses`    int(11)                                                    NOT NULL,
    `network`      varchar(255)                                                        DEFAULT NULL,
    `price`        decimal(43, 2)                                             NOT NULL,
    `state`        enum ('ACTIVE','DISABLED','SUSPENDED','DELETED','PENDING') NOT NULL,
    `custom_name`  varchar(255)                                                        DEFAULT NULL,
    `locked`       text                                                                DEFAULT NULL,
    `expire_at`    datetime                                                   NOT NULL,
    `disc_name`    varchar(255)                                                        DEFAULT NULL,
    `traffic`      int(11)                                                             DEFAULT NULL,
    `curr_traffic` varchar(255)                                                        DEFAULT NULL,
    `api_name`     enum ('NO_API','PLOCIC','VENOCIX','GAME')                           DEFAULT NULL,
    `pack_name`    varchar(255)                                                        DEFAULT NULL,
    `created_at`   datetime                                                   NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime                                                   NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`   datetime                                                            DEFAULT NULL,
    `days`         int(11)                                                             DEFAULT NULL,
    `type`         enum ('LXC','KVM')                                         NOT NULL DEFAULT 'LXC',
    `notes`        text                                                                DEFAULT NULL,
    `job_id`       int(11)                                                             DEFAULT NULL,
    `venocix_id`   text                                                                DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_server_command_presets`
--

CREATE TABLE `vm_server_command_presets`
(
    `id`         int(11)      NOT NULL,
    `server_id`  int(11)      NOT NULL,
    `desc`       text         NOT NULL,
    `command`    text         NOT NULL,
    `icon`       varchar(255) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_server_os`
--

CREATE TABLE `vm_server_os`
(
    `id`         int(11)                      NOT NULL,
    `name`       varchar(255)                 NOT NULL,
    `template`   varchar(255)                 NOT NULL,
    `type`       enum ('LXC','KVM','VENOCIX') NOT NULL DEFAULT 'LXC',
    `created_at` datetime                     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_server_packs`
--

CREATE TABLE `vm_server_packs`
(
    `id`         int(11)                NOT NULL,
    `type`       enum ('normal','game') NOT NULL DEFAULT 'normal',
    `name`       varchar(255)           NOT NULL,
    `cores`      varchar(255)           NOT NULL,
    `memory`     varchar(255)           NOT NULL,
    `disk`       varchar(255)           NOT NULL,
    `price`      decimal(12, 2)         NOT NULL,
    `created_at` datetime               NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime               NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_software`
--

CREATE TABLE `vm_software`
(
    `id`         int(11)      NOT NULL,
    `name`       varchar(512) NOT NULL,
    `url`        varchar(512) NOT NULL,
    `file_name`  varchar(512) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_software_tasks`
--

CREATE TABLE `vm_software_tasks`
(
    `id`         int(11)      NOT NULL,
    `vm_id`      int(11)      NOT NULL,
    `type`       varchar(512) NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vm_tasks`
--

CREATE TABLE `vm_tasks`
(
    `id`         int(11)  NOT NULL,
    `service_id` int(11)  NOT NULL,
    `task`       text              DEFAULT NULL,
    `created_at` datetime NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webserver_rs_packs`
--

CREATE TABLE `webserver_rs_packs`
(
    `id`        int(11)        NOT NULL,
    `pack_name` text           DEFAULT NULL,
    `kunden`    text           NOT NULL,
    `price`     decimal(12, 2) NOT NULL,
    `price_old` decimal(12, 2) DEFAULT NULL,
    `disabled`  text           NOT NULL,
    `special`   text           NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace`
--

CREATE TABLE `webspace`
(
    `id`           int(11)                               NOT NULL,
    `plan_id`      varchar(255)                          NOT NULL,
    `user_id`      int(11)                               NOT NULL,
    `ftp_name`     varchar(255)                          NOT NULL,
    `ftp_password` varchar(255)                          NOT NULL,
    `domainName`   varchar(255)                          NOT NULL,
    `webspace_id`  int(11)                               NOT NULL,
    `state`        enum ('active','suspended','deleted') NOT NULL,
    `expire_at`    datetime                              NOT NULL,
    `price`        decimal(12, 2)                        NOT NULL,
    `custom_name`  varchar(255)                                   DEFAULT NULL,
    `locked`       text                                           DEFAULT NULL,
    `created_at`   datetime                              NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime                              NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at`   datetime                                       DEFAULT NULL,
    `days`         int(11)                                        DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace_host`
--

CREATE TABLE `webspace_host`
(
    `id`         int(11)                   NOT NULL,
    `domainName` varchar(255)              NOT NULL,
    `ip`         varchar(255)              NOT NULL,
    `name`       varchar(255)              NOT NULL,
    `password`   varchar(255)              NOT NULL,
    `state`      enum ('offline','online') NOT NULL,
    `created_at` datetime                  NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                  NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace_packs`
--

CREATE TABLE `webspace_packs`
(
    `id`           int(11)        NOT NULL,
    `plesk_id`     varchar(255)   NOT NULL,
    `keyhelp_id`   int(11)                 DEFAULT NULL,
    `name`         varchar(255)   NOT NULL,
    `desc`         text                    DEFAULT NULL,
    `price`        decimal(12, 2) NOT NULL,
    `disc`         varchar(255)   NOT NULL,
    `domains`      varchar(255)   NOT NULL,
    `subdomains`   varchar(255)   NOT NULL,
    `databases`    varchar(255)   NOT NULL,
    `ftp_accounts` varchar(255)   NOT NULL,
    `emails`       varchar(255)   NOT NULL,
    `price_old`    text                    DEFAULT NULL,
    `kat`          text           NOT NULL,
    `created_at`   datetime       NOT NULL DEFAULT current_timestamp(),
    `updated_at`   datetime       NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `webspace_rs`
--

CREATE TABLE `webspace_rs`
(
    `id`         int(11)                                         NOT NULL,
    `plan_id`    varchar(255)                                    NOT NULL,
    `user_id`    int(11)                                         NOT NULL,
    `rs_name`    text                                                     DEFAULT NULL,
    `rs_pass`    text                                                     DEFAULT NULL,
    `rs_url`     text                                                     DEFAULT NULL,
    `state`      enum ('active','suspended','deleted','pending') NOT NULL,
    `expire_at`  datetime                                        NOT NULL,
    `price`      decimal(12, 2)                                  NOT NULL,
    `locked`     text                                                     DEFAULT NULL,
    `created_at` datetime                                        NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime                                        NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    `deleted_at` datetime                                                 DEFAULT NULL,
    `days`       int(11)                                                  DEFAULT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `wiki`
--

CREATE TABLE `wiki`
(
    `id`         int(11)      NOT NULL,
    `icon`       varchar(255)          DEFAULT NULL,
    `title`      varchar(512) NOT NULL,
    `text`       text         NOT NULL,
    `kat`        text         NOT NULL,
    `created_at` datetime     NOT NULL DEFAULT current_timestamp(),
    `updated_at` datetime     NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `adventskalender`
--
ALTER TABLE `adventskalender`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `adventskalender_used`
--
ALTER TABLE `adventskalender_used`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `aff_clicks`
--
ALTER TABLE `aff_clicks`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cashbox_clicks`
--
ALTER TABLE `cashbox_clicks`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cloudserver`
--
ALTER TABLE `cloudserver`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cloudserver_codes`
--
ALTER TABLE `cloudserver_codes`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `cloudserver_packs`
--
ALTER TABLE `cloudserver_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `codes`
--
ALTER TABLE `codes`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `code_used`
--
ALTER TABLE `code_used`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `daily_rew`
--
ALTER TABLE `daily_rew`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `domains`
--
ALTER TABLE `domains`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `domain_dns`
--
ALTER TABLE `domain_dns`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `domain_marktplatz`
--
ALTER TABLE `domain_marktplatz`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gamecloud_clouds`
--
ALTER TABLE `gamecloud_clouds`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gamecloud_packs`
--
ALTER TABLE `gamecloud_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gamecloud_server`
--
ALTER TABLE `gamecloud_server`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gameserver_codes`
--
ALTER TABLE `gameserver_codes`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gameserver_csgo`
--
ALTER TABLE `gameserver_csgo`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `gameserver_mc`
--
ALTER TABLE `gameserver_mc`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `ip_addresses`
--
ALTER TABLE `ip_addresses`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `mac` (`mac_address`);

--
-- Indizes für die Tabelle `kvm`
--
ALTER TABLE `kvm`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kvm_codes`
--
ALTER TABLE `kvm_codes`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kvm_ipv6`
--
ALTER TABLE `kvm_ipv6`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kvm_packs`
--
ALTER TABLE `kvm_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `kvm_server`
--
ALTER TABLE `kvm_server`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `login_logs`
--
ALTER TABLE `login_logs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `lxc`
--
ALTER TABLE `lxc`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `marktplatz`
--
ALTER TABLE `marktplatz`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `marktplatz_zusatz`
--
ALTER TABLE `marktplatz_zusatz`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `news`
--
ALTER TABLE `news`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `password_resets`
--
ALTER TABLE `password_resets`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `products`
--
ALTER TABLE `products`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `product_options`
--
ALTER TABLE `product_options`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `product_option_entries`
--
ALTER TABLE `product_option_entries`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `product_prices`
--
ALTER TABLE `product_prices`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `produkt_rabatt`
--
ALTER TABLE `produkt_rabatt`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `pterodactyl_servers`
--
ALTER TABLE `pterodactyl_servers`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `queue`
--
ALTER TABLE `queue`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `sinusbots`
--
ALTER TABLE `sinusbots`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `teamspeaks`
--
ALTER TABLE `teamspeaks`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `teamspeak_backups`
--
ALTER TABLE `teamspeak_backups`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `teamspeak_hosts`
--
ALTER TABLE `teamspeak_hosts`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tickets`
--
ALTER TABLE `tickets`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `id_2` (`id`),
    ADD KEY `id` (`id`);

--
-- Indizes für die Tabelle `ticket_message`
--
ALTER TABLE `ticket_message`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `timeouts`
--
ALTER TABLE `timeouts`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `timeout_back`
--
ALTER TABLE `timeout_back`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `transactions`
--
ALTER TABLE `transactions`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `user_transactions`
--
ALTER TABLE `user_transactions`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_host_nodes`
--
ALTER TABLE `vm_host_nodes`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_servers`
--
ALTER TABLE `vm_servers`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_server_command_presets`
--
ALTER TABLE `vm_server_command_presets`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_server_os`
--
ALTER TABLE `vm_server_os`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_server_packs`
--
ALTER TABLE `vm_server_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_software`
--
ALTER TABLE `vm_software`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_software_tasks`
--
ALTER TABLE `vm_software_tasks`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `vm_tasks`
--
ALTER TABLE `vm_tasks`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webserver_rs_packs`
--
ALTER TABLE `webserver_rs_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace`
--
ALTER TABLE `webspace`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace_host`
--
ALTER TABLE `webspace_host`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace_packs`
--
ALTER TABLE `webspace_packs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `webspace_rs`
--
ALTER TABLE `webspace_rs`
    ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `wiki`
--
ALTER TABLE `wiki`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `adventskalender`
--
ALTER TABLE `adventskalender`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `adventskalender_used`
--
ALTER TABLE `adventskalender_used`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `aff_clicks`
--
ALTER TABLE `aff_clicks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `cashbox_clicks`
--
ALTER TABLE `cashbox_clicks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `cloudserver`
--
ALTER TABLE `cloudserver`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `cloudserver_codes`
--
ALTER TABLE `cloudserver_codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `cloudserver_packs`
--
ALTER TABLE `cloudserver_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `codes`
--
ALTER TABLE `codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `code_used`
--
ALTER TABLE `code_used`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `daily_rew`
--
ALTER TABLE `daily_rew`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `domains`
--
ALTER TABLE `domains`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `domain_dns`
--
ALTER TABLE `domain_dns`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `domain_marktplatz`
--
ALTER TABLE `domain_marktplatz`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gamecloud_clouds`
--
ALTER TABLE `gamecloud_clouds`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gamecloud_packs`
--
ALTER TABLE `gamecloud_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gamecloud_server`
--
ALTER TABLE `gamecloud_server`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gameserver_codes`
--
ALTER TABLE `gameserver_codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gameserver_csgo`
--
ALTER TABLE `gameserver_csgo`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `gameserver_mc`
--
ALTER TABLE `gameserver_mc`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ip_addresses`
--
ALTER TABLE `ip_addresses`
    MODIFY `id` int(110) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kvm`
--
ALTER TABLE `kvm`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kvm_codes`
--
ALTER TABLE `kvm_codes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kvm_ipv6`
--
ALTER TABLE `kvm_ipv6`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kvm_packs`
--
ALTER TABLE `kvm_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `kvm_server`
--
ALTER TABLE `kvm_server`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `login_logs`
--
ALTER TABLE `login_logs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `lxc`
--
ALTER TABLE `lxc`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `marktplatz`
--
ALTER TABLE `marktplatz`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `marktplatz_zusatz`
--
ALTER TABLE `marktplatz_zusatz`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `news`
--
ALTER TABLE `news`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `password_resets`
--
ALTER TABLE `password_resets`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `products`
--
ALTER TABLE `products`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `product_options`
--
ALTER TABLE `product_options`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT für Tabelle `product_option_entries`
--
ALTER TABLE `product_option_entries`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT für Tabelle `product_prices`
--
ALTER TABLE `product_prices`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `pterodactyl_servers`
--
ALTER TABLE `pterodactyl_servers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `queue`
--
ALTER TABLE `queue`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `sinusbots`
--
ALTER TABLE `sinusbots`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `teamspeaks`
--
ALTER TABLE `teamspeaks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `teamspeak_backups`
--
ALTER TABLE `teamspeak_backups`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `teamspeak_hosts`
--
ALTER TABLE `teamspeak_hosts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `tickets`
--
ALTER TABLE `tickets`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `ticket_message`
--
ALTER TABLE `ticket_message`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `timeouts`
--
ALTER TABLE `timeouts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `timeout_back`
--
ALTER TABLE `timeout_back`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `transactions`
--
ALTER TABLE `transactions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `user_transactions`
--
ALTER TABLE `user_transactions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_host_nodes`
--
ALTER TABLE `vm_host_nodes`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_servers`
--
ALTER TABLE `vm_servers`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_server_command_presets`
--
ALTER TABLE `vm_server_command_presets`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_server_os`
--
ALTER TABLE `vm_server_os`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_server_packs`
--
ALTER TABLE `vm_server_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_software`
--
ALTER TABLE `vm_software`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_software_tasks`
--
ALTER TABLE `vm_software_tasks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `vm_tasks`
--
ALTER TABLE `vm_tasks`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webserver_rs_packs`
--
ALTER TABLE `webserver_rs_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webspace`
--
ALTER TABLE `webspace`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webspace_host`
--
ALTER TABLE `webspace_host`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webspace_packs`
--
ALTER TABLE `webspace_packs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `webspace_rs`
--
ALTER TABLE `webspace_rs`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT für Tabelle `wiki`
--
ALTER TABLE `wiki`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT = @OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS = @OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION = @OLD_COLLATION_CONNECTION */;
