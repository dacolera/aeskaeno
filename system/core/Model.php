<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 20:55
 * Classe abstrata que serve de base para todas as Models da aplicacao
 */

abstract class Model {

    use Configuration;
    /**
     * @var PDO
     */
    private $db ;
    /**
     * @var que armazena o nome da tabela nas models que a estendem
     */
    protected $_table;

    protected $bootstrap;

    /**
     * Metodo construct para coneccao com banco de dados
     */
    public function __construct()
    {
        $config = $this->getConfig('config');
        $this->db = new PDO("mysql:host={$config['hostname']};dbname={$config['dbname']}", $config['username'], $config['password'], array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }

    /**
     * @param $dados
     * @return PDOStatement
     * Metodo que insere ou atualiza os dados
     */
    public function save($dados)
    {
        $this->filterSave($dados);
        if(!isset($dados['id']) || !$dados['id'])
            return $this->db->query("INSERT INTO {$this->_table} (".implode(', ',array_keys($dados)).") VALUES ('".implode("','",$dados)."')");
        else
        {
            $id = $dados['id'];
            unset($dados['id']);
            $last = count($dados) -1;
            $set = '';
            $c = 0;
            foreach($dados as $campo => $valor)
            {
                if($c == $last)
                   $set .= "{$campo} = '{$valor}'";
                else
                   $set .= "{$campo} = '{$valor}' , ";
                $c++;
            }

            //die("UPDATE {$this->_table} SET {$set} WHERE id={$id}");
            return $this->db->query("UPDATE {$this->_table} SET {$set} WHERE id={$id}");
        }
    }

    /**
     * @param $id
     * @return PDOStatement
     * Metodo que deleta um registro do banco de dados
     */
    public function delete($id)
    {
        return $this->db->query("DELETE FROM {$this->_table} WHERE id={$id}");
    }

    /**
     * @return PDOStatement
     * metodo primario para trazer todos os registros de uma determinada tabela
     */
    public function fetchAll()
    {
        return $this->db->query("SELECT * FROM {$this->_table}");
    }

    /**
     * @param $query
     * @return PDOStatement
     * metodo que permite passar uma query personalizada
     */
    public function query($query)
    {
        return $this->db->query($query);
    }

    /**
     * filtra a entrada de dados vinda do controlador
     */
    public function filterSave($dados)
    {
        if(!is_array($dados))
            die("Dados para insercao e edicao devem ser do tipo array");
    }
}