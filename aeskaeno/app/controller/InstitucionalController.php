<?php

namespace aeskaeno\app\controller;

use aeskaeno\system\core\Controller;
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 14:26
 */

class InstitucionalController extends Controller {
        public function index_action(){
            $this->view('index');
        }

        public function quemsomos(){
            $this->view('quemsomos');
        }
}