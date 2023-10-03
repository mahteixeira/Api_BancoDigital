<?php

spl_autoload_register(function($nome_da_classe)
{
    $nome_da_classe = str_replace('\\', '/', $nome_da_classe);

    $arquivo = BASEDIR . "/". $nome_da_classe . '.php';

    //echo $arquivo . '<br />';

    if(file_exists($arquivo))
    {
        require_once($arquivo);
    }else
        exit('Arquivo não encontrado. Arquivos' .$arquivo. "<br />");
}); 