<h1>Dashboard</h1>

<h3>Funcionalidades PHP</h3> 

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

<h3>htaccess</h3>

    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ /index.php?url=$1 [QSA,L]
