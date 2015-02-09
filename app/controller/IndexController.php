<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 13:48
 */

class Index extends Controller{
    /**
     *
     */
    public function index_action(){


        $idade =  $this->getParams('idade');
        $nome =   $this->getParams('nome');


        $funcionarios = new Funcionarios();
        $lista = $funcionarios->listarFuncionarios();



        $dados = array(
            'nome'  => $nome,
            'email' => 'dacolera360@gmail.com',
            'empresa' => 'catho',
            'cidade' => 'barueri',
            'idade'  => $idade,
            'funcionarios' => $lista
        );
        $this->view(null,$dados);

    }

    public function listarAjax(){

        $grupo = $this->getParams('tipo');
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
        if($this->isPost()){
            $func = new Funcionarios();
            $cargo = new Cargo();
            $sal = new Salario();

            // gravando o funcionario no banco
            $id = $func->insert(array('nome' => $this->getParams('nome')));
            if($id)
            {
                $cargo->insert(
                    array(
                        'cargo' => $this->getParams('cargo'),
                        'func_id' => $id
                    )
                );

                $sal->insert(
                    array(
                        'salario' => $this->getParams('salario'),
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