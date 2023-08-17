<?php

use Api\Controller\ContaController;
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

    case '/correntista/conferir':
        CorrentistaController::ConsultaCPF();
    break;
        
    case '/correntista/entrar':
        CorrentistaController::Login();
    break;

    case '/conta/criar':
        ContaController::salvar();
    break;

    case '/conta/listar':
        ContaController::listar();
    break;

    case '/conta/entrar':
        ContaController::SelecionarConta();

    case '/conta/pix/enviar':

    case 'conta/pix/receber':

    case 'conta/extrato':
}