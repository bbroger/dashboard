<h1>Painel de controle</h1>

<h3>Funcionalidades</h3> 

* Login
* Logout
* Register
* Register update

<h3>Páginas Disponíveis</h3>

* Personalizável 
* 404 
* Check out

<h3>Estrutura do Banco de dados</h3>

    CREATE TABLE `sb` (
    `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(150) NOT NULL,
    `value` longtext NOT NULL,
    PRIMARY KEY (`id`),
    UNIQUE KEY `name` (`name`)
    ) ENGINE=MyISAM AUTO_INCREMENT=295 DEFAULT CHARSET=utf8;


