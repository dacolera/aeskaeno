<?php

namespace aeskaeno\app\model;

use aeskaeno\system\core\Model;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 21:37
 */

class Funcionarios extends Model {

    protected $_table = 'funcionarios';

    public function listarFuncionarios()
    {
        return $this->fetchAll();
    }

    public function insert(Array $dados = null)
    {
        return $this->save($dados);
    }

    /**
     * @return PDOStatement
     */
    public function joinSelect(){
        return $this->query(
            "SELECT f.id,f.nome,c.cargo,s.salario FROM {$this->_table} f
              JOIN cargo c  ON f.id = c.func_id
              JOIN salario s ON s.func_id = f.id"
        );
    }
}