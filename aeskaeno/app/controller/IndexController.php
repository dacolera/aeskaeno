<?php

namespace aeskaeno\app\controller;

use aeskaeno\system\core\Controller;
use aeskaeno\app\model\Funcionarios;
use aeskaeno\app\model\Cargo;
use aeskaeno\app\model\Salario;
use aeskaeno\system\helpers\Register;

/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 13:48
 */

class IndexController extends Controller{
    /**
     *
     */
    public function index_action(){

        $session = Register::getInstance();

        $session->setRegister(
            array(
                'nome' => 'jurandir dacol junior',
                'idade' => 36,
                'sexo' => 'masculino',
                'profissao' => 'programador'
            )
        );



        $this->view(null,$session->getRegister());

    }

    public function listarAjax(){

        $grupo = $this->getRequest()->getParams('tipo');
        $frutas = array(
            'citricas' => array(
              'laranja', 'acerola','limao','abacaxi'
            ),
            'fibrosas' => array(
                'banana','melancia','morango','amora'
            ),
            'leitosas' => array(
                'manga','mamao','caju','goiaba'
            )
        );

        echo json_encode($frutas[$grupo]);
    }

    public function listar(){
        $func = new Funcionarios();
        $dados = array('dados' => $func->joinSelect());
        $this->view('listar',$dados);
    }

    public function cadastrar()
    {
        if($this->getRequest()->isPost()){
            $func = new Funcionarios();
            $cargo = new Cargo();
            $sal = new Salario();

            // gravando o funcionario no banco
            $id = $func->insert(array('nome' => $this->getRequest()->getParams('nome')));
            if($id)
            {
                $cargo->insert(
                    array(
                        'cargo' => $this->getRequest()->getParams('cargo'),
                        'func_id' => $id
                    )
                );

                $sal->insert(
                    array(
                        'salario' => $this->getRequest()->getParams('salario'),
                        'func_id' => $id
                    )
                );

                $this->listar();
            }
        }
        else
            $this->view('cadastrar');
    }

    public function editar()
    {
        $array = array(
            'nome' => 'Rodrigo  P',
            'id'  => '8'
        );

        $funcionarios = new Funcionarios();
        $funcionarios->insert($array);
    }
}