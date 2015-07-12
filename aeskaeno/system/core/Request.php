<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 10/07/15
 * Time: 11:40
 */

namespace Aeskaeno\System\Core;


class Request {

    /**
     * @var url http request
     */
    protected $_url;

    /**
     * @var array com as variaveis de requisicao
     */
    protected $_explode = array();

    /**
     * @var nome do controlador
     */
    protected $_controller;

    /**
     * @var nome da action
     */
    protected $_action;

    protected $getParameters = array();

    protected $postParameters = array();

    protected $parameters = array();

    /**
     * metodo de url register
     */
    public function setUrl()
    {
        $this->_url = isset($_GET['key']) ?$_GET['key'].'/' : 'public/index/index';
        return $this;
    }

    /**
     * Metodo que alimenta o array das variaveis de requisicao
     */
    public function setExplode()
    {
        $this->_explode = explode('/',$this->_url);
        return $this;
    }

    /**
     * Metodo que seta o nome do controlador
     */
    public function setController()
    {
        $this->_controller = $this->_explode[1] == null ? 'index' : $this->_explode[1];
        return $this;
    }

    public function getController() {

        return $this->_controller;
    }

    /**
     * Metodo que seta o nome da action
     */
    public function setAction()
    {
        $this->_action = $this->_explode[2] == null || $this->_explode[2] == 'index' ? 'index_action' : $this->_explode[2];
        return $this;
    }

    public function getAction($complete = false) {

        if($complete) return $this->_action;
        return str_replace('_action', '', $this->_action);
    }

    public function getParams($param = null,$return = null)
    {
        return $this->retornoFilter($param,$return);
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
        return $this;
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
        return $this;
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

    public final function __construct() {

        $this
            ->setUrl()
            ->setExplode()
            ->setController()
            ->setAction()
            ->setGetParams()
            ->setPostParams()
            ->init();
    }

    public function init() {}
}