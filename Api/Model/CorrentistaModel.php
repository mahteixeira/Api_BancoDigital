<?php

namespace Api\Model;

use Api\DAO\ContaDAO;
use Api\DAO\CorrentistaDAO;
use Exception;

class CorrentistaModel extends Model
{
    public $id, $nome, $cpf, $data_nasc, $senha;
    public $lista_conta;


    public function save() : ?CorrentistaModel
    {

        $dao_correntista = new CorrentistaDAO();

        $model_preenchido = $dao_correntista->insert($this);
     

        // Se o insert do correntista deu certo
        // vamos inserir sua conta corrente e poupança
        if($model_preenchido->id !== null)
        {
   
            $dao_conta = new ContaDAO();

            // Abrindo a conta corrente
            
            $conta_corrente = new ContaModel();
            $conta_corrente->senha = $model_preenchido->senha;
            $conta_corrente->
            $conta_corrente->id_correntista = $model_preenchido->id;
            $conta_corrente->saldo = 0;
            $conta_corrente->limite = 100;
            $conta_corrente->tipo = 'Conta Corrente';
            $conta_corrente = $dao_conta->insert($conta_corrente);

            $model_preenchido->lista_conta[] = $conta_corrente;

            // Abrindo a conta poupança

            $conta_poupanca = new ContaModel();
            $conta_poupanca->id_correntista = $model_preenchido->id;
            $conta_poupanca->senha = $model_preenchido->senha;
            $conta_poupanca->saldo = 0;
            $conta_poupanca->limite = 0;
            $conta_poupanca->tipo = 'Conta Poupança';
            $conta_poupanca = $dao_conta->insert($conta_poupanca);

            $model_preenchido->lista_conta[] = $conta_poupanca;
        }

        return $model_preenchido;    
    }

    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select();
    }

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }

    public function getAllContas()
    {
        include './DAO/ContaDAO.php';

        $dao = new ContaDAO();

        $this->lista_conta = $dao->select();
    }

    public function auth($cpf, $senha)
    {
	    $dao = new CorrentistaDAO();

		return $dao->getCorrentistaByCpfAndSenha($cpf, $senha);		
	}

    public function consultaCPF($cpf)
    {
        $dao = new CorrentistaDAO();

		return $dao->getCorrentistaByCPF($cpf);		
    }
}
