<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 27/01/15
 * Time: 18:35
 */

class Register {

    //singleton patern

    private static $instance = null;
    private $registry = array();

    /**
     * no clones for this
     */
    private function __clone(){}

    /**
     * no new instances for this
     */
    private function __construct(){
        session_start();
        $this->registry = $_SESSION;
    }

    /**
     * neither serialize
     */
    private function __sleep(){}

    /**
     * or unserialize
     */
    private function __wakeup(){}

    public function setRegister($key, $value = null)
    {
        if(null !== $key && null !== $value){
            $_SESSION[$key] = $value;
        }
        else{
            if(is_array($key)){
                foreach($key as $intKey => $intValue){
                    $_SESSION[$intKey] = $intValue;
                }
            }
            return false;
        }
    }

    public function getRegister($key = null)
    {
        if(null === $key){
            return $this->registry;
        }
    }

    public function clearRegister()
    {
        $this->registry = $_SESSION =  array();
        session_destroy();
    }

    /**
     * @return null|Register
     */
    public static function getInstance()
    {
        if(null === self::$instance){
            self::$instance = new self();
        }
        return self::$instance;
    }



}