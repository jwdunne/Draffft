SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `sf_draffft_articles` (
  `id`          int(11)                 unsigned NOT NULL AUTO_INCREMENT,
  `user_id`     mediumint(8)            unsigned NOT NULL DEFAULT '0',
  `date`        int(11)                 unsigned NOT NULL DEFAULT '0',
  `title`       varchar(100)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` varchar(150)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `body`        mediumtext      COLLATE utf8_bin NOT NULL,
  `slug`        varchar(255)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `show_about`  tinyint(4)              unsigned NOT NULL DEFAULT '1',
  `allow_comments` tinyint(4)           unsigned NOT NULL DEFAULT '1',
  `category_id` mediumint(8)            unsigned NOT NULL DEFAULT '0',
  `tags`        varchar(100)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `image`       varchar(50)     COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sf_draffft_categories` (
  `id`          mediumint(8)            unsigned NOT NULL AUTO_INCREMENT,
  `title`       varchar(255)    COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sf_draffft_comments` (
  `id`          int(11)                 unsigned NOT NULL AUTO_INCREMENT,
  `article_id`  int(11)                 unsigned NOT NULL DEFAULT '0',
  `user_id`     mediumint(8)            unsigned NOT NULL DEFAULT '0',
  `date`        int(11)                 unsigned NOT NULL DEFAULT '0',
  `comment`     mediumtext      COLLATE utf8_bin NOT NULL,
  `reply_to`    int(11)                 unsigned NOT NULL DEFAULT '0',
  `status`      tinyint(4)              unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sf_draffft_likes` (
  `like_id`     int(11)                 unsigned NOT NULL AUTO_INCREMENT,
  `article_id`  int(11)                 unsigned NOT NULL DEFAULT '0',
  `user_id`     int(11)                 unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`like_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sf_draffft_pingback` (
  `id`          mediumint(8)            unsigned NOT NULL AUTO_INCREMENT,
  `uri`         varchar(100)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `article_id`  int(11)                 unsigned NOT NULL DEFAULT '0',
  `author`      varchar(50)     COLLATE utf8_bin NOT NULL DEFAULT '',
  `date`        int(11)                 unsigned NOT NULL DEFAULT '0',
  `excerpt`     varchar(100)    COLLATE utf8_bin NOT NULL DEFAULT '',
  `status`      tinyint(4)              unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `sf_draffft_tags` (
  `id`          int(11)                 unsigned NOT NULL AUTO_INCREMENT,
  `name`        varchar(50)     COLLATE utf8_bin NOT NULL DEFAULT '',
  `articles`    mediumtext      COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1;

INSERT INTO `sf_settings` (`setting`, `value`, `app`) VALUES
('draffft_articles_per_page', '5', 'draffft');

INSERT INTO `sf_applications` (`id`, `name`, `slug`, `public_name`, `tagline`, `version`, `release`, `update_url`, `author`, `uninstall_sql`, `theme`, `locale`) VALUES
(NULL, 'draffft', 'blog,draffft', 'We Love Programming', 'Programming Community By Programmers, For Programmers.', '1.5', 'Beta', 'http://release.devxdev.com/update/app/draffft/v/151', 'Soule', '', 'wlp', 'en-US');

ALTER TABLE `sf_usergroups`
    ADD `draffft_post_comment`      tinyint(4) unsigned NOT NULL DEFAULT '0',
    ADD `draffft_delete_comment`    tinyint(4) unsigned NOT NULL DEFAULT '0',
    ADD `draffft_post_article`      tinyint(4) unsigned NOT NULL DEFAULT '0',
    ADD `draffft_delete_article`    tinyint(4) unsigned DEFAULT '0',
    ADD `draffft_edit_article`      tinyint(4) unsigned NOT NULL DEFAULT '0';

INSERT INTO  `sf_usergroups` (`id`, `name`, `is_admin`, `is_mod`, `draffft_post_comment`, `draffft_delete_comment`, `draffft_post_article`, `draffft_delete_article`, `draffft_edit_article`)
VALUES (NULL, 'Author', '0', '1', '1', '0', '1', '0', '1');

ALTER TABLE `sf_users`
    ADD `draffft_about`     mediumtext COLLATE utf8_bin NOT NULL;

