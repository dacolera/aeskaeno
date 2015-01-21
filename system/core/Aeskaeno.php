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
    protected $_controller;
    /**
     * @var nome da action
     */
    protected $_action;
    /**
     * @var url http request
     */
    protected $_url;
    /**
     * @var array com as variaveis de requisicao
     */
    protected $_explode = array();
    /**
     * @var array com os parametros de requisicao
     */
    protected $getParameters = array();

    protected $postParameters = array();

    protected $parameters = array();

    /**
     * metodo construtor
     */
    public function __construct()
    {
        $this->setUrl();
        $this->setExplode();
        $this->setController();
        $this->setAction();
        $this->setGetParams();
        $this->setPostParams();
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
    public function setGetParams()
    {
        $last = array_search(end($this->_explode), $this->_explode);
        unset($this->_explode[0], $this->_explode[1], $this->_explode[2], $this->_explode[$last]);

        $this->paramFilter($this->_explode);
    }

    public function getParams($param = null,$return = null)
    {
        return $this->retornoFilter($param,$return);
    }

    /**
     * @param null $param
     * @param null $return
     * @return array|null
     * Metodo que retorna os parametros do post da requisicao
     */
    public function setPostParams()
    {
        $this->paramFilter($_POST);
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
    protected function paramFilter($source)
    {
        if(!empty($source)) {
            if (array_keys($source)[0] == '3') {
                foreach ($source as $chave => $valor) {
                    if ($chave % 2 != 0)
                        $keys[] = $valor;
                    else
                        $values[] = $valor;
                }
                if (count($keys) == count($values)) {
                    $this->getParameters = array_combine($keys, $values);
                }
            }
            else
                $this->postParameters = $source;
        }
        $this->parameters = array_merge($this->getParameters,$this->postParameters);
        $this->getParameters = $this->postParameters = array();
    }

    /**
     * @param null $input
     * @param null $return
     * @return array|null
     * Metodo auxiliar que modifica o retorno dos parametros para requests get e post
     */
    protected function retornoFilter($input = null,$return = null)
    {
        if($input === null)
            return $this->parameters;
        else
            if(array_key_exists($input,$this->parameters))
                return $this->parameters[$input];
            else
                return $return;
    }

    public function getConfig($file)
    {
        return include "../app/config/{$file}.php";
    }
}