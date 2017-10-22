<?php
/**
 * Created by PhpStorm.
 * User: Home
 * Date: 22.10.2017
 * Time: 23:22
 */

namespace RedBeanPHP;
require_once 'rb.php';

abstract class Parser {
    protected $src;

    public function __construct($src)
    {
        $this->src = $src;
    }

    abstract public function Parse();
}