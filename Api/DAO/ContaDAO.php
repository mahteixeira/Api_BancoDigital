<?php

namespace Api\DAO;

use Api\Model\ContaModel;

class ContaDAO extends DAO{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(ContaModel $m) : ?ContaModel
    {
        $sql = "INSERT INTO conta (numero, tipo, id_correntista, saldo, limite) values (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->numero);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->id_correntista);
        $stmt->bindValue(4, $m->saldo);
        $stmt->bindValue(5, $m->limite);

        $stmt->execute();

        $m->id = $this->conexao->lastInsertId();

        return $m;
    }

    public function update(ContaModel $m)
    {
        $sql = "UPDATE conta SET numero=?, tipo=?, id_correntista=?, saldo=?, limite=?  WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->numero);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->id_correntista);
        $stmt->bindValue(4, $m->saldo);
        $stmt->bindValue(5, $m->limite);
        $stmt->bindValue(6, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM conta WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM conta";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function selectByIdCorrentista(int $id_correntista) : array
    {
        
        $sql = "SELECT * FROM conta WHERE id_correntista=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$id_correntista);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\ContaModel");
    }

    public function numeroConta(){

        $pt1 = rand(10000000,99999999);
        $pt2 = rand(0,9);

        $num_conta = $pt1."-".$pt2;

        return $num_conta;

    }

    public function selectByNumeroConta(string $numero)
    {
        
        $sql = "SELECT * FROM conta WHERE numero=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$numero);
        
        $obj = $stmt->fetchObject("Api\Model\ContaModel");

        if (is_object($obj))
        {
            var_dump($obj);
            return $obj;
        }
        else return new ContaModel();

        
    }


}