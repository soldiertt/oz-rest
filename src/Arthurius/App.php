<?php
/**
 * Created by IntelliJ IDEA.
 * User: soldi
 * Date: 05-10-16
 * Time: 15:59
 */

namespace Arthurius;


class App
{

    const DB_HOST = 'localhost';
    const DB_NAME = 'arthuriu';
    const DB_USER = 'root';
    const DB_PASS = 'UeyK7b45';

    private static $database;

    public static function getDb() {
        if (self::$database === null) {
            self::$database = new Database(self::DB_HOST, self::DB_NAME, self::DB_USER, self::DB_PASS);
        }
        return self::$database;
    }

}