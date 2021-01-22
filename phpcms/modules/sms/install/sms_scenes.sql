DROP TABLE IF EXISTS `phpcms_sms_scenes`;
CREATE TABLE `phpcms_sms_scenes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `scenes_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `sms_content` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '发送内容',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`id`),
  KEY `template_id` (`template_id`),
  KEY `scenes_name` (`scenes_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='阿里云短信模板配置';