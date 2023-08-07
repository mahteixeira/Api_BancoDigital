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
        $sql = "INSERT INTO conta (numero, tipo, senha, id_correntista, saldo, limite) values (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->numero);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id_correntista);
        $stmt->bindValue(5, $m->saldo);
        $stmt->bindValue(6, $m->limite);

        $stmt->execute();

        $m->id = $this->conexao->lastInsertId();

        return $m;
    }

    public function update(ContaModel $m)
    {
        $sql = "UPDATE conta SET numero=?, tipo=?, senha=?, id_correntista=?, saldo=?, limite=?  WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->numero);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->senha);
        $stmt->bindValue(4, $m->id_correntista);
        $stmt->bindValue(5, $m->saldo);
        $stmt->bindValue(6, $m->limite);
        $stmt->bindValue(7, $m->id);

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

    public function selectByIdCorrentista(int $id_correntista){
        $sql = "SELECT * FROM conta WHERE id_correntista=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$id_correntista);
        $stmt->execute();

        $obj = $stmt->fetchObject("Api\Model\ContaModel");

        return (is_object($obj)) ? $obj : new ContaModel();
    }

    public function numeroConta(){

        $pt1 = rand(10000000,99999999);
        $pt2 = rand(0,9);

        $num_conta = $pt1."-".$pt2;

        return $num_conta;

    }

}