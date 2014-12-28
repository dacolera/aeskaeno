<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 26/12/14
 * Time: 14:26
 */

class institucional extends Controller {
        public function index_action(){
            $this->view('index');
        }

        public function quemsomos(){
            $this->view('quemsomos');
        }
}