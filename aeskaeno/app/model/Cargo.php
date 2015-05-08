<?php

namespace aeskaeno\app\model;

use aeskaeno\system\core\Model;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 28/12/14
 * Time: 15:12
 */

class Cargo extends Model{

    protected $_table = 'cargo';

    public function insert(Array $dados = null)
    {
        return $this->save($dados);
    }

}