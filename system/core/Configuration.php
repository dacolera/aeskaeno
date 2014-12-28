<?php
/**
 * Created by PhpStorm.
 * User: dacol
 * Date: 28/12/14
 * Time: 21:39
 */

trait Configuration {

    public function getConfig($file)
    {
        return include "../app/config/{$file}.php";
    }
}