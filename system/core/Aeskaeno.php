<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 23:39
 * Principal classe do sistema
 */

class Aeskaeno {
    /**
     * @var nome do controlador
     */
    private $_controller;
    /**
     * @var nome da action
     */
    private $_action;
    /**
     * @var url http request
     */
    private $_url;
    /**
     * @var array com as variaveis de requisicao
     */
    private $_explode = array();
    /**
     * @var array com os parametros de requisicao
     */
    private $parameters = array();

    /**
     * metodo construtor
     */
    public function __construct()
    {
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
    }

    /**
     * metodo de inicializacao do sistema
     */
    public function start()
    {
        require_once('../app/controller/'. $this->_controller .'Controller.php');
        $controler = new $this->_controller();

        $controler->{$this->_action}();
    }

    /**
     * Metodo que alimenta o array das variaveis de requisicao
     */
    public function setExplode()
    {
        $this->_explode = explode('/',$this->_url);
    }

    /**
     * metodo de url register
     */
    public function setUrl()
    {
        $this->_url = isset($_GET['key']) ?$_GET['key'].'/' : 'public/index/index';
    }

    /**
     * @param null $param
     * @param null $return
     * @return array|null
     * Metodo que gera o array de parametros get da requisicao
     * a partir do nome da acao extrai parametros como param/value
     */
    public function getParams($param = null,$return = null)
    {
        $last = array_search(end($this->_explode), $this->_explode);
        unset($this->_explode[0], $this->_explode[1], $this->_explode[2], $this->_explode[$last]);

        $this->paramFilter($this->_explode);
        return $this->retornoFilter($param,$return);
    }

    /**
     * @param null $param
     * @param null $return
     * @return array|null
     * Metodo que retorna os parametros do post da requisicao
     */
    public function postParams($param = null,$return = null)
    {
        $this->paramFilter($_POST);
        return  $this->retornoFilter($param,$return);
    }

    /**
     * @return bool
     * verifica a existencia de uma requisicao post
     */
    public function isPost()
    {
        if(isset($_POST) && !empty($_POST))
            return true;
        return false;
    }

    /**
     * Metodo que seta o nome do controlador
     */
    public function setController()
    {
        $this->_controller = $this->_explode[1] == null ? 'index' : $this->_explode[1];
    }

    /**
     * Metodo que seta o nome da action
     */
    public function setAction()
    {
        $this->_action = $this->_explode[2] == null || $this->_explode[2] == 'index' ? 'index_action' : $this->_explode[2];
    }

    /**
     * @param array $source
     * Metodo interno que auxilia a extracao de chave valor para requests get e post
     */
    private function paramFilter(Array $source)
    {
        if(!empty($source)) {
            if(is_numeric(array_keys($source)))
            {
                foreach ($source as $chave => $valor) {
                    if ($chave % 2 != 0)
                        $keys[] = $valor;
                    else
                        $values[] = $valor;
                }
                if (count($keys) == count($values))
                    $this->parameters = array_combine($keys, $values);
            }
            else
                $this->parameters = $source;

        }
    }

    /**
     * @param null $input
     * @param null $return
     * @return array|null
     * Metodo auxiliar que modifica o retorno dos parametros para requests get e post
     */
    private function retornoFilter($input = null,$return = null)
    {
        if($input === null)
            return $this->parameters;
        else
            if(array_key_exists($input,$this->parameters))
                return $this->parameters[$input];
            else
                return $return;
    }
}