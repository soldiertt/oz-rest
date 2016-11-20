<?php

/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:38
 */

namespace Oz\model;

class Boolean
{

    public $value;

    public function __construct($value) {
        $this->value = $value ? true : false;
    }
}