<?php

namespace Api\DAO;

use Api\Model\ChaveModel;

class ChaveDAO extends DAO{

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(ChaveModel $m) : ?ChaveModel
    {
        $sql = "INSERT INTO chave_pix (chave, tipo, id_conta) values (?, ?, ?)";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->chave);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->id_conta);

        $stmt->execute();

        $m->id = $this->conexao->lastInsertId();

        return $m;
    }

    public function update(ChaveModel $m)
    {
        $sql = "UPDATE chave_pix SET chave=?, tipo=?, id_conta=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->chave);
        $stmt->bindValue(2, $m->tipo);
        $stmt->bindValue(3, $m->id_conta);
        $stmt->bindValue(4, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM chave_pix WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM chave";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function selectByIdConta(string $id_conta)
    {      
        $sql = "SELECT * FROM conta WHERE id_conta=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1,$id_conta);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS, "Api\Model\ChaveModel");
    
    }
}