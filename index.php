<?php

/*
 * session_status() - Retorna o status atual da sessão
 * 
 * 0 ----> PHP_SESSION_DISABLED se as sessões estiverem desabilitadas.
 * 1 ----> PHP_SESSION_NONE se as sessões estiverem habilitadas, mas nenhuma existir.
 * 2 ----> PHP_SESSION_ACTIVE se as sessões estiverem habilitadas, e uma existir.
 * 
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once (__DIR__ . DIRECTORY_SEPARATOR . "_sys/Conn" . DIRECTORY_SEPARATOR . "config.php");

spl_autoload_register(function($Class) {

    $cDir = ['Controllers', 'Models', 'Core'];
    $iDir = null;

    foreach ($cDir as $DirName):

        $pasta = __DIR__ . DIRECTORY_SEPARATOR . "_sys" . DIRECTORY_SEPARATOR . "{$DirName}" . DIRECTORY_SEPARATOR;

        if (!$iDir && file_exists($pasta . "{$Class}.php") && !is_dir($pasta . "{$Class}.php")):

            include_once ($pasta . "{$Class}.php");
            $iDir = true;

        endif;

    endforeach;

    if (!$iDir):
        echo "Não foi possível incluir {$Class}.php";
        die;

    endif;
});

$core = new Core;
$core->Compilar();
