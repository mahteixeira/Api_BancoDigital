<?php

namespace Api\Model;

use Api\DAO\ChaveDAO;
use Api\DAO\ContaDAO;
use Exception;

class ContaModel extends Model 
{
    public $id, $numero, $tipo, $id_correntista, $saldo, $limite;
    public $lista_pix;

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

    public function getContaByNumeroConta(string $numero)
    {
        return (new ContaDAO())->selectByNumeroConta($numero);
    }

    public function getAllChaves()
    {
        include './DAO/ChaveDAO.php';

        $dao = new ChaveDAO;

        $this->lista_pix = $dao->select();
    }
  
}