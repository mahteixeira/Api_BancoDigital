<?php

use Api\Controller\CorrentistaController;

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch($url)
{
    case '/correntista/save':
        CorrentistaController::salvar();
    break;

    case '/correntista/listar':
        CorrentistaController::listar();
        break;
        

    case '/correntista/entrar':

    case '/conta/pix/enviar':

    case 'conta/pix/receber':

    case 'conta/extrato':
}