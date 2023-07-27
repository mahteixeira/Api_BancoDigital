<?php

namespace Api\Controller;

use Api\Model\ContaModel;
use Exception;

class ContaController extends Controller
{
    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ContaModel();
            $model->id = $json_obj->id;
            $model->numero = $json_obj->numero;
            $model->tipo = $json_obj->tipo;
            $model->senha = $json_obj->senha;
            $model->id_correntista = $json_obj->id_correntista;
            $model->saldo = $json_obj->saldo;
            $model->limite = $json_obj->limite;

            parent::getResponseAsJSON($model->save());
              
        } catch (Exception $e) {
            parent::LogError($e->getPrevious());
            parent::getExceptionAsJSON($e);
        }
    }

    public static function listar() : void
    {
        try
        {
            $model = new ContaModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function deletar() : void
    {
        try 
        {
            $model = new ContaModel();
            
            $model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id'] : null);

            $model->delete();


        } catch (Exception $e) {

            parent::LogError($e);
            parent::getExceptionAsJSON($e);
        }
    }

    public static function ListarContas() : void 
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));


			$model = new ContaModel();
			$model->id_correntista = $json_obj->id_correntista;


			parent::getResponseAsJSON($model->getContaByIdCorrentista($json_obj->cpf));
        }
        catch(Exception $e)
		{
			parent::getResponseAsJSON($e);
		}
    }

}