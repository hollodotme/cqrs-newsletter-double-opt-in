CREATE DATABASE IF NOT EXISTS `newsletter`
  DEFAULT CHARACTER SET utf8
  COLLATE utf8_general_ci;

USE `newsletter`;
DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `id`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT
  COMMENT 'Record-ID',
  `subscriptionId` CHAR(36)         NOT NULL
  COMMENT 'Subscription-UUID',
  `email`          VARCHAR(255)     NOT NULL
  COMMENT 'E-Mail address',
  `status`         VARCHAR(50)      NOT NULL DEFAULT 'pending'
  COMMENT 'Subscription status',
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscriptionId` (`subscriptionId`),
  UNIQUE KEY `email` (`email`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8
  COMMENT = 'Newsletter subscriptions';
