<?php

/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:38
 */

namespace Oz\model;

class Holiday extends Entity
{

    public static $table = "holiday";

    public static function findAll() {
        return self::queryList("SELECT * FROM ".static::$table);
    }

}