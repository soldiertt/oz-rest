<?php

/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:38
 */

namespace Oz\model;

class Common extends Entity
{

    public static function findAllGrade() {
        return self::queryList("SELECT * FROM grade");
    }

    public static function findAllBrigade() {
        return self::queryList("SELECT * FROM brigade");
    }

    public static function findAllCertification() {
        return self::queryList("SELECT * FROM certification");
    }
}