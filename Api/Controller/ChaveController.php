<?php

namespace Api\Controller;

use Api\Model\ChaveModel;
use Exception;

class ChaveController extends Controller
{
    public static function salvar() : void
    {
        try
        {
            $json_obj = json_decode(file_get_contents('php://input'));

            $model = new ChaveModel();
            $model->id = $json_obj->id;
            $model->chave = $json_obj->chave;
            $model->tipo = $json_obj->tipo;
            $model->id_conta = $json_obj->id_conta;

            $model->save();
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
    }

    public static function listar() : void
    {
        try
        {
            $model = new ChaveModel();
            
            $model->getAllRows();

            parent::getResponseAsJSON($model->rows);
              
        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
    }

    public static function deletar() : void
    {
        try 
        {
            $model = new ChaveModel();
            
            $model->id = parent::getIntFromUrl(isset($_GET['id']) ? $_GET['id'] : null);

            $model->delete();


        } catch (Exception $e) {

            parent::getExceptionAsJSON($e);
        }
    }
}