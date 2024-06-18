
ALTER TABLE `nuorodos` ADD `data` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP AFTER `url`;

ALTER TABLE `nuorodos` ADD `zymos` VARCHAR(255) NOT NULL AFTER `data`;

CREATE TABLE `zymos` (
  `id` int(11) NOT NULL,
  `zyma` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `kiek_kartojasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


ALTER TABLE `zymos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `zyma` (`zyma`);
  
  ALTER TABLE `zymos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
  
  ALTER TABLE `zymos` CHANGE `kiek_kartojasi` `kiek_kartojasi` INT(11) NOT NULL DEFAULT '1';
