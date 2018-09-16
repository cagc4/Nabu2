CREATE TABLE `usuario_google` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
 `photo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=MyIsam  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
