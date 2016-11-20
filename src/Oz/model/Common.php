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

    public static function findAllWorkRegimes() {
        return self::queryList("SELECT * FROM work_regime");
    }

    public static function findPnr($value) {
        return self::queryList("SELECT pnr FROM person WHERE pnr = ?", [$value]);
    }

    public static function findBadge($value) {
        return self::queryList("SELECT badge FROM person WHERE badge = ?", [$value]);
    }

    public static function findSsin($value) {
        return self::queryList("SELECT ssin FROM person WHERE ssin = ?", [$value]);
    }
}