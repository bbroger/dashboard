# dashboard
Painel de controle

Funcionalidades 

-Login -Logout -Register -Update register 

Modelo de páginas 

-Personalizável -404 -Check out

Estrutura do Banco de dados

CREATE TABLE `sb` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=295 DEFAULT CHARSET=utf8;


