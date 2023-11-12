/* Create One Line Plugin Table */
CREATE TABLE IF NOT EXISTS `cot_oneline` (
	`oneline_id` int(11) unsigned NOT NULL auto_increment,
	`oneline_date` int(11) collate utf8_unicode_ci NOT NULL,
	`oneline_text` varchar(255) collate utf8_unicode_ci NOT NULL,
	`oneline_section` varchar(64) collate utf8_unicode_ci NOT NULL,
	PRIMARY KEY  (`oneline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
