<?php

namespace Api\Model;

use Api\DAO\ContaDAO;
use Api\DAO\CorrentistaDAO;

class CorrentistaModel extends Model 
{
    public $id, $nome, $cpf, $data_nasc, $senha;
    public $lista_conta;

    public function save()
    {
        if($this->id == null)
            (new CorrentistaDAO())->insert($this);
        else
            (new CorrentistaDAO())->update($this);
    }

    public function getAllRows()
    {
        $this->rows = (new CorrentistaDAO())->select();
    }

    public function delete()
    {
        (new CorrentistaDAO())->delete($this->id);
    }

    public function getAllContas(){   
        include './DAO/ContaDAO.php';

        $dao = new ContaDAO();

        $this->lista_conta = $dao->select();
    }
}