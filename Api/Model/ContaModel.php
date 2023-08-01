<?php

namespace Api\Model;

use Api\DAO\ContaDAO;
use Exception;

class ContaModel extends Model 
{
    public $id, $numero, $tipo, $senha, $id_correntista, $saldo, $limite;

    public function save()
    {
        if($this->id == null)
            (new ContaDAO())->insert($this);
        else
            (new ContaDAO())->update($this);
    }

    public function getAllRows()
    {
        $this->rows = (new ContaDAO())->select();
    }

    public function delete()
    {
        (new ContaDAO())->delete($this->id);
    }

    public function getContaByIdCorrentista(int $id_correntista)
    {
            $dao = new ContaDAO();

            $this->rows = $dao->selectByIdCorrentista($id_correntista);
    }

  
}