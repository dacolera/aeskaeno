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

        $this->view('index',$dados);

    }

    public function listar(){
        $func = new Funcionarios();
        $dados = array('dados' => $func->joinSelect());
        $this->view('listar',$dados);
    }

    public function cadastrar()
    {
        if($this->bootstrap->isPost()){
            //die('formulario submetido '.implode('  ',$this->postParams()));
            $insercao = new Funcionarios();
            $insercao->insert($this->postParams());

            if($insercao)
                die('cadastrado com sucesso');
            die('Erro ao inserir');
        }
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