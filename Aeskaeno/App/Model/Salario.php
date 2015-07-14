<?php

namespace Aeskaeno\App\Model;

use Aeskaeno\System\Core\Model;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 18/01/15
 * Time: 19:19
 */

class Salario extends Model{

    protected $_table = 'salario';

    public function insert(Array $dados = null)
    {
        return $this->save($dados);
    }
}