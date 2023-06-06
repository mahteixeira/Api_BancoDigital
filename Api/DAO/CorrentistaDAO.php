<?php

namespace Api\DAO;

use Api\Controller\Controller;
use Api\Model\CorrentistaModel;
use Exception;
use PDOException;

class CorrentistaDAO extends DAO {

    public function __construct()
    {
        parent::__construct();
    }

    public function insert(CorrentistaModel $m) : CorrentistaModel
    {
        try
        {
            $sql = "INSERT INTO correntista (nome, cpf, data_nasc, senha) Values (?, ?, ?, ?) ";

            $stmt = $this->conexao->prepare($sql);
            $stmt->bindValue(1, $m->nome);
            $stmt->bindValue(2, $m->cpf);
            $stmt->bindValue(3, $m->data_nasc);
            $stmt->bindValue(4, $m->senha);

            $stmt->execute();

           // $m->id = $this->conexao->lastInsertId();            

        } catch(PDOException $e)
        {
            Controller::LogError($e);
            //throw new Exception(message: "Erro no banco", previous: $e);
        }

        return $m;
    }

    public function update(CorrentistaModel $m)
    {
        $sql = "UPDATE correntista SET nome=?, cpf=?, data_nasc=?, senha=? WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $m->nome);
        $stmt->bindValue(2, $m->cpf);
        $stmt->bindValue(3, $m->data_nasc);
        $stmt->bindValue(4, $m->senha);
        $stmt->bindValue(5, $m->id);

        return $stmt->execute();
    }

    public function delete(int $id) : bool
    {
        $sql = "DELETE FROM correntista WHERE id=?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $id);

        return $stmt->execute();
    }

    public function select()
    {
        $sql = "SELECT * FROM correntista";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(DAO::FETCH_CLASS);
    }

    public function getCorrentistaByCpfAndSenha($cpf, $senha)
    {
        $sql = "SELECT * FROM correntista c WHERE cpf = ? AND senha = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);
        $stmt->bindValue(2, $senha);

        $stmt->execute();

        $obj = $stmt->fetchObject("Api\Model\CorrentistaModel");

        return (is_object($obj)) ? $obj : new CorrentistaModel();
    }

    public function getCorrentistabyCPF($cpf)
    {
        $sql = "SELECT * FROM correntista c WHERE cfp = ?";

        $stmt = $this->conexao->prepare($sql);
        $stmt->bindValue(1, $cpf);

        $obj = $stmt->fetchObject("Api\Model\CorrentistaModel");

        return (is_object($obj)) ? $obj : new CorrentistaModel();
    }

}