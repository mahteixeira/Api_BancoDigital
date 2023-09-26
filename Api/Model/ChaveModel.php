<?php

namespace Api\Model;

use Api\DAO\ChaveDAO;

class ChaveModel extends Model 
{
    public $id, $chave, $tipo, $id_conta;

    public function save()
    {
        if($this->id == null)
            (new ChaveDAO())->insert($this);
        else
            (new ChaveDAO())->update($this);
    }

    public function getAllRows()
    {
        $this->rows = (new ChaveDAO())->select();
    }

    public function delete()
    {
        (new ChaveDAO())->delete($this->id);
    }

    public function GetChavePixByIdConta(int $id_conta){

        $dao = new ChaveDAO();

        $this->rows = $dao->selectByIdConta($id_conta);
    }
}